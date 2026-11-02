<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $payload)
    {
    }

    public function envelope(): Envelope
    {
        $topic = $this->payload['subject'] ?: 'Општа порака';

        $email = $this->payload['email'] ?? '';
        return new Envelope(
            subject: 'Нова порака од веб — '.$topic,
            replyTo: $email !== '' ? [$email] : [],
        );
    }

    public function content(): Content
    {
        return new Content(
            text: 'emails.contact',
        );
    }
}
