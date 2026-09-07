<?php

namespace App\Observers;

use App\Mail\EnquiryAutoReply;
use App\Mail\EnquiryReceived;
use App\Models\Enquiry;
use App\Models\Setting;
use App\Support\MailConfigurator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class EnquiryObserver
{
    /**
     * Notify the site admin and auto-reply to the customer whenever a new
     * enquiry (contact form or package booking) comes in. Mail failures are
     * logged but must never block the enquiry from being saved.
     */
    public function created(Enquiry $enquiry): void
    {
        $setting = Setting::current();

        if (blank($setting->mail_host)) {
            return;
        }

        try {
            MailConfigurator::apply();

            if (filled($setting->email)) {
                Mail::to($setting->email)->send(new EnquiryReceived($enquiry));
            }

            Mail::to($enquiry->email)->send(new EnquiryAutoReply($enquiry, $setting));
        } catch (Throwable $e) {
            Log::warning('Failed to send enquiry notification emails.', [
                'enquiry_id' => $enquiry->id,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
