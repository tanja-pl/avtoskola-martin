<?php

namespace App\Mail;

use App\Models\ChatConversation;
use App\Models\ChatMessage;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Carbon;

class ChatLeadCollectedMail extends Mailable
{
    private const TIMEZONE = 'Europe/Skopje';

    private ?ChatConversation $conversation = null;

    public function __construct(private readonly int $conversationId) {}

    public function envelope(): Envelope
    {
        $name = trim((string) $this->conversation()->visitor_name);

        return new Envelope(
            subject: $name !== ''
                ? 'Нов контакт од чатбот — '.$name
                : 'Нов контакт од чатбот',
        );
    }

    public function content(): Content
    {
        $conversation = $this->conversation();
        $messages = $conversation->messages->map(fn (ChatMessage $message): array => [
            'at' => $this->formatMoment($message->created_at),
            'question' => $message->visitor_message,
            'answer' => $message->assistant_response,
        ])->all();

        return new Content(
            html: 'emails.chat-lead',
            text: 'emails.chat-lead-text',
            with: [
                'name' => (string) $conversation->visitor_name,
                'phone' => $conversation->formattedPhone() ?? (string) $conversation->visitor_phone,
                'phoneDigits' => (string) $conversation->visitor_phone,
                'when' => $this->whenLabel($conversation),
                'messages' => $messages,
            ],
        );
    }

    private function conversation(): ChatConversation
    {
        if ($this->conversation === null) {
            $this->conversation = ChatConversation::query()
                ->with(['messages' => fn ($query) => $query->orderBy('created_at')->orderBy('id')])
                ->findOrFail($this->conversationId);
        }

        return $this->conversation;
    }

    private function whenLabel(ChatConversation $conversation): string
    {
        $started = $this->formatMoment($conversation->created_at);
        $latestMessage = $conversation->messages->last();
        $latest = $this->formatMoment($conversation->last_message_at ?? $latestMessage?->created_at);

        if ($latest === '' || $latest === $started) {
            return $started;
        }

        return $started.' – '.$latest;
    }

    private function formatMoment(mixed $moment): string
    {
        if (! $moment instanceof Carbon) {
            return '';
        }

        return $moment->copy()->timezone(self::TIMEZONE)->format('d.m.Y H:i');
    }
}
