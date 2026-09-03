<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            PackageSeeder::class,
            BlogSeeder::class,
            PageSeeder::class,
            FaqSeeder::class,
        ]);

        Setting::firstOrCreate(['id' => 1], [
            'site_name' => 'Al Bushra Travel',
            'phone' => '+91 98765 43210',
            'phone_secondary' => '+91 91234 56789',
            'email' => 'info@albushratravel.com',
            'address' => '123 Travel Street, Mumbai, Maharashtra, India',
            'facebook_url' => 'https://facebook.com/albushratravel',
            'instagram_url' => 'https://instagram.com/albushratravel',
            'twitter_url' => 'https://twitter.com/albushratravel',
            'youtube_url' => 'https://youtube.com/@albushratravel',
            'whatsapp_number' => '919876543210',
            'whatsapp_greeting' => 'Assalamu Alaikum! How can we help you plan your Hajj or Umrah journey?',
            'ga_code' => '',
            'gtm_code' => '',
        ]);
    }
}
