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
            'site_name' => 'Al Bushra Tours & Travels',
            'phone' => '+91 99987 07032',
            'phone_secondary' => '080 - 40641691',
            'email' => 'info@albushratnt.in',
            'address' => '#151, Opp. Chichabas Taj, MM Road, Frazer Town, Bangalore - 560005',
            'facebook_url' => 'https://www.facebook.com/AlBushraToursAndTravelsOfficial',
            'instagram_url' => 'https://www.instagram.com/albushra183/',
            'twitter_url' => 'https://x.com/albushra_tours',
            'youtube_url' => 'https://www.youtube.com/@AlBushraTT',
            'whatsapp_number' => '919998707032',
            'whatsapp_greeting' => 'Hello 👋 Can we help you?',
            'ga_code' => '',
            'gtm_code' => '',
            'meta_title' => 'Al Bushra | Best Hajj &amp; Umrah Packages from Bangalore',
            'meta_description' => 'Book your Hajj or Umrah package with Al Bushra Tours & Travels. Affordable packages with visa, flights, hotels, and guided services for a comfortable pilgrimage.',
            'map_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3887.5471553920406!2d77.6102999748419!3d13.000790287317272!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae16ee3e5a5f9b%3A0x6c45351e151f2bec!2sAl%20Bushra%20Tours%20%26%20Travels!5e0!3m2!1sen!2sin!4v1751031926967!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
        ]);
    }
}
