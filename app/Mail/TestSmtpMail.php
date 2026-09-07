<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestSmtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $siteName)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Test email from {$this->siteName}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.test-smtp',
        );
    }
}
