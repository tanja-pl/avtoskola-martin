<?php

namespace App\Services;

use App\Mail\ChatLeadCollectedMail;
use Illuminate\Support\Facades\Mail;
use RuntimeException;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Throwable;

class ChatLeadNotifier
{
    /**
     * Send the lead notification after the conversation and lead are committed.
     * The mailable reloads the transcript from the database.
     */
    public function send(int $conversationId): void
    {
        $recipient = trim((string) config('services.school.mail_to'));
        if (filter_var($recipient, FILTER_VALIDATE_EMAIL) === false) {
            report(new RuntimeException('Chat lead notification was not sent because MAIL_TO is missing or invalid.'));

            return;
        }

        try {
            retry(3, function () use ($recipient, $conversationId): void {
                Mail::to($recipient)->send(new ChatLeadCollectedMail($conversationId));
            }, 200, fn (Throwable $e): bool => $e instanceof TransportExceptionInterface);
        } catch (Throwable $e) {
            report($e);
        }
    }
}
