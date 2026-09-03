<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        Page::create([
            'title' => 'About Us',
            'slug' => 'about-us',
            'content' => '<p>Al Bushra Travel has been serving pilgrims for over a decade, guiding thousands of families through safe, comfortable and spiritually fulfilling Hajj and Umrah journeys. Our team handles every detail, from visa processing to accommodation and ground transport, so you can focus entirely on your worship.</p><p>We are committed to transparency, fair pricing, and personalized service for every pilgrim who travels with us.</p>',
            'meta_title' => 'About Us | Al Bushra Travel',
            'meta_description' => 'Learn about Al Bushra Travel, a trusted Hajj and Umrah travel agency dedicated to serving pilgrims.',
        ]);

        Page::create([
            'title' => 'Privacy Policy',
            'slug' => 'privacy-policy',
            'content' => '<p>This Privacy Policy explains how Al Bushra Travel collects, uses and protects the personal information you share with us when booking a Hajj or Umrah package, submitting an enquiry, or otherwise using our website.</p><p>We only collect information necessary to process your booking and enquiries, and we do not share your data with third parties except as required to complete your travel arrangements (such as visa processing and airline bookings).</p>',
            'meta_title' => 'Privacy Policy | Al Bushra Travel',
            'meta_description' => 'Read the Al Bushra Travel privacy policy to understand how we handle your personal data.',
        ]);
    }
}
