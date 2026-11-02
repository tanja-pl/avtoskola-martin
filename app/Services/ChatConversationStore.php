<?php

namespace App\Services;

use App\Models\ChatConversation;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class ChatConversationStore
{
    /**
     * Contact already stored for this visit is trusted over anything the browser sends.
     *
     * @param  array<string, mixed>  $incoming
     * @return array<string, mixed>
     */
    public function priorLead(mixed $token, array $incoming): array
    {
        unset($incoming['name'], $incoming['phone']);

        try {
            $existing = $this->findByToken($token);
        } catch (Throwable $e) {
            report($e);

            return $incoming;
        }

        if ($existing === null) {
            return $incoming;
        }

        if (filled($existing->visitor_name)) {
            $incoming['name'] = $existing->visitor_name;
        }
        if (filled($existing->visitor_phone)) {
            $incoming['phone'] = $existing->visitor_phone;
        }
        if ($existing->contact_provided) {
            $incoming['captured'] = true;
        }

        return $incoming;
    }

    public function findByToken(mixed $token): ?ChatConversation
    {
        $token = $this->normalizeToken($token);
        if ($token === null) {
            return null;
        }

        return ChatConversation::query()->where('token', $token)->first();
    }

    /**
     * @param  array<string, mixed>  $lead
     */
    public function record(?string $token, string $visitorMessage, string $assistantResponse, array $lead): ChatConversation
    {
        try {
            return $this->write($token, $visitorMessage, $assistantResponse, $lead);
        } catch (UniqueConstraintViolationException) {
            return $this->write($token, $visitorMessage, $assistantResponse, $lead);
        }
    }

    /**
     * @param  array<string, mixed>  $lead
     */
    private function write(?string $token, string $visitorMessage, string $assistantResponse, array $lead): ChatConversation
    {
        return DB::transaction(function () use ($token, $visitorMessage, $assistantResponse, $lead) {
            $normalized = $this->normalizeToken($token);
            $conversation = null;

            if ($normalized !== null) {
                $conversation = ChatConversation::query()
                    ->where('token', $normalized)
                    ->lockForUpdate()
                    ->first();
            }

            if ($conversation === null) {
                $conversation = new ChatConversation([
                    'token' => $normalized ?? (string) Str::uuid(),
                    'interest_level' => 'low',
                ]);
            }

            $this->applyLead($conversation, $lead);
            $now = now();
            $conversation->last_message_at = $now;
            $conversation->save();

            $conversation->messages()->create([
                'visitor_message' => mb_substr(trim($visitorMessage), 0, 2000),
                'assistant_response' => mb_substr(trim($assistantResponse), 0, 5000),
                'visitor_name' => $conversation->visitor_name,
                'visitor_phone' => $conversation->visitor_phone,
                'created_at' => $now,
            ]);

            return $conversation->refresh();
        });
    }

    /**
     * @param  array<string, mixed>  $lead
     */
    private function applyLead(ChatConversation $conversation, array $lead): void
    {
        $name = $this->cleanName($lead['name'] ?? '');
        $phone = $this->cleanPhone($lead['phone'] ?? '');

        if ($name !== '') {
            $conversation->visitor_name = $name;
        }
        if ($phone !== '') {
            $conversation->visitor_phone = $phone;
        }

        $conversation->contact_provided = filled($conversation->visitor_name) && filled($conversation->visitor_phone);

        $interest = $this->normalizeInterest($lead['interest'] ?? null);
        if ($this->interestRank($interest) > $this->interestRank((string) $conversation->interest_level)) {
            $conversation->interest_level = $interest;
        }
        if ($conversation->interest_level === 'high') {
            $conversation->enrollment_interest = true;
        }
    }

    private function normalizeToken(mixed $token): ?string
    {
        if (! is_string($token)) {
            return null;
        }

        $token = strtolower(trim($token));

        return preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $token) === 1
            ? $token
            : null;
    }

    private function cleanName(mixed $value): string
    {
        if (! is_string($value)) {
            return '';
        }

        $value = trim(preg_replace('/\s+/u', ' ', $value) ?? '');

        return mb_substr($value, 0, 80);
    }

    private function cleanPhone(mixed $value): string
    {
        if (! is_string($value)) {
            return '';
        }

        $digits = preg_replace('/\D+/', '', $value) ?? '';

        return mb_substr($digits, 0, 20);
    }

    private function normalizeInterest(mixed $interest): string
    {
        return in_array($interest, ['low', 'warm', 'medium', 'high'], true) ? $interest : 'low';
    }

    private function interestRank(string $interest): int
    {
        return ['low' => 0, 'warm' => 1, 'medium' => 2, 'high' => 3][$interest] ?? 0;
    }
}
