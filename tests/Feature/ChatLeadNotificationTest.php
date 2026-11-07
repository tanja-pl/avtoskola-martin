<?php

namespace Tests\Feature;

use App\Mail\ChatLeadCollectedMail;
use App\Models\ChatConversation;
use App\Models\Lead;
use App\Services\OpenAiChatClient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Sleep;
use Illuminate\Support\Str;
use Illuminate\Testing\TestResponse;
use Symfony\Component\Mailer\Exception\TransportException;
use Tests\TestCase;

class ChatLeadNotificationTest extends TestCase
{
    use RefreshDatabase;

    private string $ip = '127.0.0.1';

    protected function setUp(): void
    {
        parent::setUp();

        $this->ip = '10.'.random_int(0, 255).'.'.random_int(0, 255).'.'.random_int(1, 254);
        config([
            'services.openai.key' => 'test-key',
            'services.openai.monthly_budget_usd' => 100000,
            'services.school.mail_to' => 'prijavi@example.com',
        ]);
        Mail::fake();
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();
        $hash = hash('sha256', $this->ip);
        foreach (['m', 'h', 'd'] as $window) {
            @unlink(storage_path("app/chat/rate_{$window}_{$hash}.json"));
        }

        parent::tearDown();
    }

    public function test_a_new_lead_emails_the_saved_conversation_once(): void
    {
        $started = Carbon::parse('2026-11-07 14:00:00', 'UTC');
        $completed = Carbon::parse('2026-11-07 14:07:00', 'UTC');
        Carbon::setTestNow($started);

        $this->fakeAiSequence([
            'Се наоѓаме на 11 Октомври бр. 17.',
            'Обуката за Б категорија трае според договорениот распоред.',
            'Може да не посетите во работно време.',
        ]);

        $token = (string) Str::uuid();
        $phone = '070'.str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $this->postChat([
            'message' => 'Каде се наоѓате?',
            'history' => [],
            'conversation_id' => $token,
        ])->assertOk();

        Mail::assertNothingSent();

        Carbon::setTestNow($completed);

        $this->postChat([
            'message' => 'Се викам Ана Петровска, телефон '.$phone,
            'history' => [
                ['role' => 'user', 'content' => 'Лажна порака која не е во базата'],
                ['role' => 'assistant', 'content' => 'Лажен одговор кој не е во базата'],
            ],
            'conversation_id' => $token,
        ])->assertOk();

        $conversation = ChatConversation::query()->where('token', $token)->firstOrFail();
        $stored = $conversation->messages()->orderBy('id')->get();
        $this->assertCount(2, $stored);
        $this->assertSame($conversation->id, $conversation->lead?->conversation_id);

        Mail::assertSent(ChatLeadCollectedMail::class, function (ChatLeadCollectedMail $mail) use ($phone, $started, $completed, $stored): bool {
            $mail->assertHasSubject('Нов контакт од чатбот — Ана Петровска');
            $mail->assertSeeInHtml('Потенцијален клиент го користеше чатботот на веб-страницата и остави контакт податоци.');
            $mail->assertSeeInHtml('Ана Петровска');
            $mail->assertSeeInHtml($this->formattedPhone($phone));
            $mail->assertSeeInHtml($started->copy()->timezone('Europe/Skopje')->format('d.m.Y H:i'));
            $mail->assertSeeInHtml($completed->copy()->timezone('Europe/Skopje')->format('d.m.Y H:i'));
            $mail->assertSeeInOrderInHtml([
                $stored[0]->visitor_message,
                'Се наоѓаме на 11 Октомври бр. 17.',
                $stored[1]->visitor_message,
                'Обуката за Б категорија трае според договорениот распоред.',
                'Ви благодариме. Нашиот тим наскоро ќе стапи во контакт со вас.',
            ]);
            $mail->assertDontSeeInHtml('Лажна порака која не е во базата');
            $mail->assertDontSeeInHtml('Лажен одговор кој не е во базата');
            $mail->assertSeeInText('Ана Петровска');
            $mail->assertSeeInText($stored[0]->visitor_message);
            $mail->assertSeeInText('Ви благодариме. Нашиот тим наскоро ќе стапи во контакт со вас.');

            return $mail->hasTo('prijavi@example.com');
        });

        $this->postChat([
            'message' => 'Колку долго трае обуката?',
            'history' => [],
            'conversation_id' => $token,
        ])->assertOk();

        Mail::assertSent(ChatLeadCollectedMail::class, 1);
        $this->assertSame(3, $conversation->messages()->count());
    }

    public function test_an_ordinary_message_does_not_send_email(): void
    {
        $this->fakeAiSequence(['Се наоѓаме на 11 Октомври бр. 17.']);

        $this->postChat([
            'message' => 'Каде се наоѓате?',
            'history' => [],
        ])->assertOk();

        Mail::assertNothingSent();
        $this->assertSame(0, Lead::query()->count());
    }

    public function test_a_failed_answer_still_emails_the_collected_lead(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-11-07 09:15:00', 'UTC'));
        $this->fakeAiSequence([], ok: false);
        $phone = '071'.str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $this->postChat([
            'message' => 'Се викам Ана Петровска, телефон '.$phone,
            'history' => [],
        ])->assertStatus(502);

        $conversation = ChatConversation::query()->firstOrFail();
        $message = $conversation->messages()->firstOrFail();

        Mail::assertSent(ChatLeadCollectedMail::class, function (ChatLeadCollectedMail $mail) use ($message, $phone): bool {
            $mail->assertSeeInHtml('Ана Петровска');
            $mail->assertSeeInHtml($this->formattedPhone($phone));
            $mail->assertSeeInOrderInHtml([
                $message->visitor_message,
                'Извинете, моментално имам проблем со одговарањето.',
                'Ви благодариме. Нашиот тим наскоро ќе стапи во контакт со вас.',
            ]);
            $mail->assertSeeInHtml('07.11.2026 10:15');

            return $mail->hasTo('prijavi@example.com');
        });
    }

    public function test_a_mail_transport_failure_still_saves_the_lead(): void
    {
        Sleep::fake();
        $this->fakeAiSequence(['Се наоѓаме на 11 Октомври бр. 17.']);
        $phone = '072'.str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        Mail::shouldReceive('to')
            ->times(3)
            ->andThrow(new TransportException('smtp down'));

        $this->postChat([
            'message' => 'Се викам Ана Петровска, телефон '.$phone,
            'history' => [],
        ])->assertOk();

        $conversation = ChatConversation::query()->firstOrFail();
        $this->assertTrue($conversation->contact_provided);
        $this->assertSame($phone, $conversation->lead?->phone);
        $this->assertSame(1, $conversation->messages()->count());
    }

    private function formattedPhone(string $phone): string
    {
        return substr($phone, 0, 3).' '.substr($phone, 3, 3).' '.substr($phone, 6);
    }

    private function postChat(array $payload): TestResponse
    {
        return $this->withServerVariables(['REMOTE_ADDR' => $this->ip])
            ->postJson('/api/chat', $payload);
    }

    /**
     * @param  list<string>  $replies
     */
    private function fakeAiSequence(array $replies, bool $ok = true): void
    {
        $this->mock(OpenAiChatClient::class, function ($mock) use ($replies, $ok) {
            $expectation = $mock->shouldReceive('complete')->times(max(1, count($replies)));
            if (! $ok) {
                $expectation->andReturn(['ok' => false]);

                return;
            }

            $expectation->andReturn(...array_map(
                fn (string $reply): array => ['ok' => true, 'reply' => $reply],
                $replies,
            ));
        });
    }
}
