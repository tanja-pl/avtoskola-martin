<?php

namespace Tests\Feature;

use App\Mail\ContactMessageMail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormSecurityTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Mail::fake();
        config(['services.school.mail_to' => 'avtoskolamartin@example.com']);
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();

        parent::tearDown();
    }

    public function test_the_contact_page_shows_a_human_check_without_revealing_the_code(): void
    {
        $response = $this->get('/kontakt');

        $response->assertOk();
        $response->assertSee('Потврдете дека сте човек', false);
        $response->assertSee('name="consent"', false);
        $response->assertSee('id="humanCheckVisual"', false);

        $code = session('contact_human.debug_code');
        $image = session('contact_human.image');

        $this->assertIsString($code);
        $this->assertSame(4, strlen($code));
        $this->assertIsString($image);
        $this->assertStringNotContainsString($code, $image);
        $this->assertStringNotContainsString('<text', $image);
        $this->assertStringNotContainsString('<script', $image);
        $response->assertDontSee('value="'.$code.'"', false);
    }

    public function test_a_visitor_who_solves_the_check_can_send_a_message(): void
    {
        $this->openForm();
        $used = session('contact_human.token');

        $response = $this->postJson('/kontakt', $this->solved([
            'email' => 'ana@example.com',
            'subject' => 'Информации за категории',
        ]));

        $response->assertOk();
        $response->assertJsonPath('ok', true);
        $this->assertNotSame($used, $response->json('challenge.token'));
        $this->assertSame($response->json('challenge.token'), session('contact_human.token'));

        Mail::assertSent(ContactMessageMail::class, function (ContactMessageMail $mail) {
            return $mail->payload['name'] === 'Ана Петровска'
                && $mail->payload['phone'] === '071 251 259'
                && $mail->payload['email'] === 'ana@example.com'
                && $mail->payload['subject'] === 'Информации за категории'
                && $mail->payload['message'] === 'Сакам информации за Б категорија.'
                && ! array_key_exists('human_answer', $mail->payload);
        });
    }

    public function test_a_message_can_include_an_email_address_and_an_empty_subject(): void
    {
        $this->get('/kontakt');
        $this->travel(2)->seconds();

        $this->postJson('/kontakt', $this->solved([
            'email' => null,
            'subject' => '',
            'message' => 'Јавете ми се. Мојата е-пошта е ana.petrovska@example.com и сакам термин.',
        ]))->assertOk();

        Mail::assertSent(ContactMessageMail::class, function (ContactMessageMail $mail) {
            return $mail->payload['email'] === null
                && $mail->payload['subject'] === null
                && str_contains($mail->payload['message'], 'ana.petrovska@example.com');
        });
    }

    public function test_a_normal_form_post_still_sends_the_message(): void
    {
        $this->get('/kontakt');
        $this->travel(2)->seconds();

        $this->post('/kontakt', $this->solved())
            ->assertRedirect(route('contact'));

        Mail::assertSent(ContactMessageMail::class);
    }

    public function test_the_same_code_cannot_be_used_twice(): void
    {
        $this->get('/kontakt');
        $this->travel(2)->seconds();
        $fields = $this->solved();

        $this->postJson('/kontakt', $fields)->assertOk();
        $this->postJson('/kontakt', $fields)->assertStatus(422);

        Mail::assertSent(ContactMessageMail::class, 1);
    }

    public function test_an_instant_submission_is_rejected(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-11-14 12:00:00'));
        $this->get('/kontakt');

        $this->postJson('/kontakt', $this->solved())
            ->assertStatus(422)
            ->assertJsonPath('message', 'Потврдата не успеа. Почекајте момент и обидете се повторно.');

        Mail::assertNothingSent();
    }

    public function test_a_wrong_code_is_rejected_and_the_same_image_can_be_corrected(): void
    {
        $this->get('/kontakt');
        $this->travel(2)->seconds();
        $token = session('contact_human.token');

        $response = $this->postJson('/kontakt', $this->solved([
            'human_answer' => 'ZZZZ',
        ]));

        $response->assertStatus(422);
        $response->assertJsonPath('ok', false);
        $response->assertJsonPath('message', 'Потврдете дека сте човек. Кодот не е точен.');
        $response->assertJsonPath('challenge', null);
        $this->assertSame($token, session('contact_human.token'));
        Mail::assertNothingSent();
    }

    public function test_an_expired_check_is_replaced(): void
    {
        $this->get('/kontakt');
        $token = session('contact_human.token');
        $this->travel(3)->hours();

        $response = $this->postJson('/kontakt', $this->solved());

        $response->assertStatus(422);
        $response->assertJsonPath('message', 'Проверката истече. Внесете го новиот код.');
        $this->assertNotSame($token, $response->json('challenge.token'));
        Mail::assertNothingSent();
    }

    public function test_a_filled_honeypot_does_not_send_mail(): void
    {
        $this->get('/kontakt');

        $this->postJson('/kontakt', $this->solved([
            'website' => 'https://spam.example',
        ]))->assertOk()->assertJsonPath('ok', true);

        Mail::assertNothingSent();
    }

    public function test_messages_with_links_or_markup_are_rejected(): void
    {
        $this->get('/kontakt');
        $this->travel(2)->seconds();

        $this->postJson('/kontakt', $this->solved([
            'message' => 'Try it for free here: https://short-url.cc/1HRfL',
        ]))->assertStatus(422);

        $this->travel(2)->seconds();
        $this->post('/kontakt/proverka', [])->assertOk();

        $this->postJson('/kontakt', $this->solved([
            'name' => 'www.spam.com',
        ]))->assertStatus(422);

        Mail::assertNothingSent();
    }

    public function test_a_subject_outside_the_list_is_rejected(): void
    {
        $this->get('/kontakt');
        $this->travel(2)->seconds();

        $this->postJson('/kontakt', $this->solved([
            'subject' => '????',
        ]))->assertStatus(422)->assertJsonPath('message', 'Изберете предмет од листата.');

        Mail::assertNothingSent();
    }

    public function test_consent_is_required(): void
    {
        $this->get('/kontakt');
        $this->travel(2)->seconds();

        $this->postJson('/kontakt', $this->solved([
            'consent' => false,
        ]))->assertStatus(422)->assertJsonPath('message', 'Потребна е согласност за обработка на личните податоци.');

        Mail::assertNothingSent();
    }

    public function test_a_long_identical_message_is_accepted_once(): void
    {
        $message = 'Сакам информации за термините, цената и потребните документи за Б категорија во текот на следниот месец.';

        $this->get('/kontakt');
        $this->travel(2)->seconds();
        $this->postJson('/kontakt', $this->solved(['message' => $message]))->assertOk();

        $this->post('/kontakt/proverka', [])->assertOk();
        $this->travel(2)->seconds();
        $this->postJson('/kontakt', $this->solved(['message' => $message]))->assertStatus(422);

        Mail::assertSent(ContactMessageMail::class, 1);
    }

    public function test_refreshing_the_check_issues_a_new_code(): void
    {
        $this->get('/kontakt');
        $token = session('contact_human.token');

        $response = $this->postJson('/kontakt/proverka');

        $response->assertOk();
        $this->assertNotSame($token, $response->json('challenge.token'));
        $this->assertStringStartsWith('<svg', (string) $response->json('challenge.image'));
        $this->assertStringNotContainsString((string) session('contact_human.debug_code'), (string) $response->json('challenge.image'));
    }

    public function test_repeated_posts_are_rate_limited(): void
    {
        for ($attempt = 0; $attempt < 5; $attempt++) {
            $this->postJson('/kontakt', [])->assertStatus(422);
        }

        $this->postJson('/kontakt', [])
            ->assertStatus(429)
            ->assertJsonPath('ok', false)
            ->assertJsonPath('message', 'Премногу обиди. Почекајте неколку минути и обидете се повторно.');

        Mail::assertNothingSent();
    }

    private function openForm(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-11-14 12:00:00'));
        $this->get('/kontakt')->assertOk();
        $this->travel(2)->seconds();
    }

    /**
     * @param  array<string, mixed>  $overrides
     * @return array<string, mixed>
     */
    private function solved(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Ана Петровска',
            'phone' => '071 251 259',
            'email' => 'ana@example.com',
            'subject' => 'Информации за категории',
            'message' => 'Сакам информации за Б категорија.',
            'consent' => true,
            'website' => '',
            'human_token' => session('contact_human.token'),
            'human_answer' => session('contact_human.debug_code'),
        ], $overrides);
    }
}
