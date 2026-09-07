<?php

namespace App\Mail;

use App\Models\Enquiry;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EnquiryAutoReply extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Enquiry $enquiry, public Setting $setting)
    {
    }

    public function envelope(): Envelope
    {
        $siteName = $this->setting->site_name ?: config('app.name');

        return new Envelope(
            subject: "We've received your message - {$siteName}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.enquiry-auto-reply',
        );
    }
}
