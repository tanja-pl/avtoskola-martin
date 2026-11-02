<?php

namespace Tests\Feature;

use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\Lead;
use App\Services\OpenAiChatClient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class ChatConversationLoggingTest extends TestCase
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
        ]);
    }

    protected function tearDown(): void
    {
        $hash = hash('sha256', $this->ip);
        foreach (['m', 'h', 'd'] as $window) {
            @unlink(storage_path("app/chat/rate_{$window}_{$hash}.json"));
        }

        parent::tearDown();
    }

    public function test_a_visit_keeps_later_messages_in_one_conversation(): void
    {
        $this->fakeAi(times: 2);
        $token = (string) Str::uuid();

        $this->postChat([
            'message' => 'Каде се наоѓате?',
            'history' => [],
            'conversation_id' => $token,
        ])->assertOk()->assertJsonPath('conversation_id', $token);

        $this->postChat([
            'message' => 'Се викам Ана Петровска',
            'history' => [],
            'conversation_id' => $token,
        ])->assertOk();

        $conversation = ChatConversation::query()->where('token', $token)->first();
        $this->assertNotNull($conversation);
        $this->assertSame('Ана Петровска', $conversation->visitor_name);
        $this->assertSame(2, $conversation->messages()->count());
        $this->assertDatabaseHas('chat_messages', [
            'conversation_id' => $conversation->id,
            'visitor_message' => 'Каде се наоѓате?',
        ]);

        $unanswered = (string) @file_get_contents(storage_path('app/chat/unanswered.log'));
        $this->assertStringNotContainsString('Каде се наоѓате?', $unanswered);
    }

    public function test_contact_details_are_kept_with_the_conversation_and_out_of_debug_logs(): void
    {
        $this->fakeAi(times: 2);
        $token = (string) Str::uuid();
        $phone = '070'.str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $this->postChat([
            'message' => 'Се викам Ана Петровска',
            'history' => [],
            'conversation_id' => $token,
        ])->assertOk();

        $this->postChat([
            'message' => 'Телефон '.$phone,
            'history' => [],
            'conversation_id' => $token,
        ])->assertOk()->assertJsonFragment([
            'reply' => "Се наоѓаме на 11 Октомври бр. 17.\n\nВи благодариме. Нашиот тим наскоро ќе стапи во контакт со вас.",
        ]);

        $conversation = ChatConversation::query()->where('token', $token)->firstOrFail();
        $this->assertTrue($conversation->contact_provided);
        $this->assertSame('Ана Петровска', $conversation->visitor_name);
        $this->assertSame($phone, $conversation->visitor_phone);
        $this->assertInstanceOf(Lead::class, $conversation->lead);
        $this->assertSame($conversation->id, $conversation->lead->conversation_id);

        $messages = $conversation->messages()->orderBy('id')->get();
        $this->assertNull($messages[0]->visitor_phone);
        $this->assertSame($phone, $messages[1]->visitor_phone);
        $this->assertSame('Ана Петровска', $messages[1]->visitor_name);

        $log = (string) @file_get_contents(storage_path('app/chat/leads.log'));
        $this->assertStringNotContainsString($phone, $log);
    }

    public function test_a_call_us_for_details_reply_asks_for_a_name_and_phone_instead(): void
    {
        $this->fakeAi('Немам точна информација. За повеќе детали јавете се на 02-3114-065 или пишете на avtoskolamartin@hotmail.com.');

        $this->postChat([
            'message' => 'Дали имате попуст за студенти?',
            'history' => [],
        ])->assertOk()
            ->assertJsonPath('reply', 'Немам точна информација.'."\n\n".'Ако сакате повеќе детали, оставете го вашето име и контакт телефон — нашиот тим наскоро ќе стапи во контакт со вас.');
    }

    public function test_asking_about_a_category_returns_that_category_vehicle_photos(): void
    {
        $this->fakeAi('За Б категорија обуката е со патнички автомобил.', 2);

        $response = $this->postChat([
            'message' => 'Сакам да видам категорија Б',
            'history' => [],
        ])->assertOk();

        $urls = array_column($response->json('images'), 'url');
        $this->assertNotEmpty($urls);
        $this->assertTrue(collect($urls)->contains(fn (string $url): bool => str_ends_with($url, '/images/vehicles/b-1.png')));
        $this->assertTrue(collect($urls)->contains(fn (string $url): bool => str_ends_with($url, '/images/vehicles/b-8.png')));
        $this->assertFalse(collect($urls)->contains(fn (string $url): bool => str_contains($url, 'b-automatic')));

        $this->postChat([
            'message' => 'Каде се наоѓате?',
            'history' => [],
        ])->assertOk()->assertJsonPath('images', []);
    }

    public function test_a_direct_contact_question_still_receives_the_phone_number(): void
    {
        $this->fakeAi('Фиксен: 02-3114-065. За повеќе детали јавете се на 02-3114-065.');

        $this->postChat([
            'message' => 'Како можам да ве контактирам?',
            'history' => [],
        ])->assertOk()
            ->assertJsonPath('reply', 'Фиксен: 02-3114-065. За повеќе детали јавете се на 02-3114-065.');
    }

    public function test_enrollment_interest_stays_marked_after_a_later_casual_question(): void
    {
        $this->fakeAi(times: 2);
        $token = (string) Str::uuid();

        $this->postChat([
            'message' => 'Сакам да се запишам за Б категорија',
            'history' => [],
            'conversation_id' => $token,
        ])->assertOk();

        $this->postChat([
            'message' => 'Каде се наоѓате?',
            'history' => [],
            'conversation_id' => $token,
        ])->assertOk();

        $conversation = ChatConversation::query()->where('token', $token)->firstOrFail();
        $this->assertTrue($conversation->enrollment_interest);
        $this->assertSame('high', $conversation->interest_level);
    }

    public function test_the_browser_cannot_invent_contact_details(): void
    {
        $this->fakeAi();

        $this->postChat([
            'message' => 'Каде се наоѓате?',
            'lead' => ['name' => 'Лажен Контакт', 'phone' => '070999888', 'captured' => true],
        ])->assertOk();

        $conversation = ChatConversation::query()->firstOrFail();
        $this->assertNull($conversation->visitor_name);
        $this->assertNull($conversation->visitor_phone);
        $this->assertFalse($conversation->contact_provided);
        $this->assertSame(0, Lead::query()->count());
    }

    public function test_a_failed_answer_still_saves_the_question(): void
    {
        $this->fakeAi(ok: false);

        $this->postChat(['message' => 'Каде се наоѓате?'])->assertStatus(502);

        $message = ChatMessage::query()->first();
        $this->assertNotNull($message);
        $this->assertSame('Каде се наоѓате?', $message->visitor_message);
        $this->assertStringContainsString('проблем', $message->assistant_response);
    }

    public function test_spam_and_unconfigured_requests_are_not_stored(): void
    {
        $this->postChat([
            'message' => 'Каде се наоѓате?',
            'website' => 'https://spam.test',
        ])->assertOk();

        config(['services.openai.key' => '']);
        $this->postChat(['message' => 'Каде се наоѓате?'])->assertStatus(503);

        $this->assertSame(0, ChatConversation::query()->count());
    }

    public function test_an_invalid_conversation_token_starts_a_new_visit(): void
    {
        $this->fakeAi();

        $id = $this->postChat([
            'message' => 'Каде се наоѓате?',
            'conversation_id' => 'not-a-uuid',
        ])->assertOk()->json('conversation_id');

        $this->assertIsString($id);
        $this->assertNotSame('not-a-uuid', $id);
        $this->assertNotNull(ChatConversation::query()->where('token', $id)->first());
    }

    private function postChat(array $payload): TestResponse
    {
        return $this->withServerVariables(['REMOTE_ADDR' => $this->ip])
            ->postJson('/api/chat', $payload);
    }

    private function fakeAi(string $reply = 'Се наоѓаме на 11 Октомври бр. 17.', int $times = 1, bool $ok = true): void
    {
        $this->mock(OpenAiChatClient::class, function ($mock) use ($reply, $times, $ok) {
            $mock->shouldReceive('complete')->times($times)->andReturn(
                $ok ? ['ok' => true, 'reply' => $reply] : ['ok' => false]
            );
        });
    }
}
