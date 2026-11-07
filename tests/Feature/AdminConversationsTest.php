<?php

namespace Tests\Feature;

use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\User;
use App\Services\ChatConversationStore;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class AdminConversationsTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_sent_to_the_login_page(): void
    {
        $this->get('/admin/razgovori')->assertRedirect(route('admin.login'));
        $this->get('/admin')->assertRedirect(route('admin.login'));
        $this->get('/admin/login')->assertOk()->assertSee('Разговори со посетители');
    }

    public function test_staff_can_sign_in_and_out(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'secret-password',
        ]);

        $this->from('/admin/login')->post('/admin/login', [
            'email' => 'admin@example.com',
            'password' => 'wrong-password',
        ])->assertRedirect('/admin/login')->assertSessionHasErrors('email');

        $this->post('/admin/login', [
            'email' => 'admin@example.com',
            'password' => 'secret-password',
        ])->assertRedirect(route('admin.conversations.index'));

        $this->assertAuthenticatedAs($user);

        $this->actingAs($user)->get('/admin/login')->assertRedirect(route('admin.conversations.index'));
        $this->actingAs($user)->post('/admin/logout')->assertRedirect(route('admin.login'));
        $this->assertGuest();
    }

    public function test_conversations_can_be_browsed_filtered_and_opened_in_order(): void
    {
        $user = User::factory()->create();
        $records = $this->seedConversations();

        $this->actingAs($user)->get('/admin/razgovori')
            ->assertOk()
            ->assertSee('Марко Стојанов')
            ->assertSee('Ана Петровска')
            ->assertSee('Контакт')
            ->assertSee('Запишување')
            ->assertSee('Прашања за обука')
            ->assertSee('is-contact', false)
            ->assertSee('is-enrollment', false)
            ->assertDontSee('<script>', false);

        $this->actingAs($user)->get('/admin/razgovori?name='.urlencode('Марко'))
            ->assertOk()
            ->assertSee('Марко Стојанов')
            ->assertDontSee('Ана Петровска');

        $this->actingAs($user)->get('/admin/razgovori?phone='.urlencode('+389 71 222 333'))
            ->assertOk()
            ->assertSee('Марко Стојанов')
            ->assertDontSee('Ана Петровска');

        $this->actingAs($user)->get('/admin/razgovori?q='.urlencode('100%'))
            ->assertOk()
            ->assertSee('Дали имате 100% попуст?')
            ->assertDontSee('Марко Стојанов')
            ->assertDontSee('Старо прашање');

        $this->actingAs($user)->get('/admin/razgovori?q='.urlencode('Октомври'))
            ->assertOk()
            ->assertSee('Ана Петровска')
            ->assertDontSee('Марко Стојанов');

        $this->actingAs($user)->get('/admin/razgovori?contact=1&enrollment=1')
            ->assertOk()
            ->assertSee('Марко Стојанов')
            ->assertDontSee('Ана Петровска')
            ->assertDontSee('100% попуст');

        $today = now()->toDateString();
        $this->actingAs($user)->get('/admin/razgovori?from='.$today.'&to='.$today)
            ->assertOk()
            ->assertSee('Ана Петровска')
            ->assertDontSee('Старо прашање');

        $this->actingAs($user)->get('/admin/razgovori?name='.urlencode('Никој'))
            ->assertOk()
            ->assertSee('Нема разговори за овие филтри');

        $this->actingAs($user)
            ->get(route('admin.conversations.show', $records['ordered']))
            ->assertOk()
            ->assertSeeInOrder(['Прво прашање', 'Прв одговор', 'Второ прашање', 'Втор одговор'])
            ->assertSee('Посетител')
            ->assertSee('Асистент')
            ->assertSee(now()->format('d.m.Y'));

        $this->actingAs($user)
            ->get(route('admin.conversations.show', $records['script']))
            ->assertOk()
            ->assertDontSee('<script>', false)
            ->assertDontSee('<b>', false)
            ->assertSee('<script>alert(1)</script>')
            ->assertSee('<b>не</b>');

        $this->actingAs($user)->get('/admin/razgovori/99999')->assertNotFound();
    }

    /**
     * @return array{ordered: ChatConversation, script: ChatConversation}
     */
    private function seedConversations(): array
    {
        $store = app(ChatConversationStore::class);
        $token = (string) Str::uuid();

        $ordered = $store->record($token, 'Прво прашање', 'Прв одговор', [
            'name' => 'Ана Петровска',
            'interest' => 'low',
        ])->conversation;
        $this->travel(2)->minutes();
        $store->record($token, 'Второ прашање', 'Втор одговор на 11 Октомври.', [
            'name' => 'Ана Петровска',
            'interest' => 'low',
        ]);
        $this->travelBack();

        $store->record(null, 'Сакам да се запишам', 'Можеме да ве контактираме.', [
            'name' => 'Марко Стојанов',
            'phone' => '071222333',
            'interest' => 'high',
        ]);

        $store->record(null, 'Дали имате 100% попуст?', 'Нема попуст.', [
            'interest' => 'medium',
        ]);

        $old = $store->record(null, 'Старо прашање за работно време', 'Од 9 до 17.', [
            'interest' => 'low',
        ])->conversation;
        ChatMessage::query()->where('conversation_id', $old->id)->update([
            'created_at' => now()->subDays(12),
        ]);
        $old->update(['last_message_at' => now()->subDays(12)]);

        $script = $store->record(null, '<script>alert(1)</script>', 'Во ред <b>не</b>', [
            'interest' => 'low',
        ])->conversation;

        return [
            'ordered' => $ordered->fresh(),
            'script' => $script,
        ];
    }
}
