<?php

namespace App\Support;

use App\Models\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Throwable;

class MailConfigurator
{
    /**
     * Override the app's mail configuration with the SMTP details stored
     * in the settings table, if any have been configured by the admin.
     */
    public static function apply(): void
    {
        try {
            if (! Schema::hasTable('settings')) {
                return;
            }

            $setting = Setting::current();
        } catch (Throwable) {
            return;
        }

        if (blank($setting->mail_host)) {
            return;
        }

        Config::set('mail.mailers.smtp', [
            'transport' => 'smtp',
            'host' => $setting->mail_host,
            'port' => $setting->mail_port ?: 587,
            'username' => $setting->mail_username,
            'password' => $setting->mail_password,
            'encryption' => $setting->mail_encryption ?: null,
            'timeout' => null,
        ]);

        Config::set('mail.default', $setting->mail_mailer ?: 'smtp');

        if (filled($setting->mail_from_address)) {
            Config::set('mail.from.address', $setting->mail_from_address);
            Config::set('mail.from.name', $setting->mail_from_name ?: $setting->site_name ?: config('mail.from.name'));
        }
    }
}
