<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $blogs = [
            [
                'title' => 'A Complete Guide to Performing Umrah for First Timers',
                'content' => '<p>Umrah is a deeply spiritual journey, and for first-time pilgrims it can feel overwhelming. In this guide we walk you through the essential steps, from entering the state of Ihram to performing Tawaf and Sa\'i, so you can focus on the spiritual experience rather than the logistics.</p><p>We recommend arriving a day early to rest before beginning your rituals, and always keep your travel documents close at hand.</p>',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(20),
                'meta_title' => 'Complete Guide to Performing Umrah for First Timers',
                'meta_description' => 'Everything first-time pilgrims need to know before performing Umrah, step by step.',
            ],
            [
                'title' => 'Best Time of Year to Book Your Umrah Trip',
                'content' => '<p>Choosing the right time to travel for Umrah can significantly affect crowd levels, hotel prices and overall comfort. This article compares Ramadan, winter and off-peak season travel so you can plan the trip that suits your budget and schedule.</p>',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(12),
                'meta_title' => 'Best Time of Year to Book Your Umrah Trip',
                'meta_description' => 'Find out the best months to travel for Umrah based on crowd levels and pricing.',
            ],
            [
                'title' => 'Hajj Packing Checklist: What to Bring for a Comfortable Journey',
                'content' => '<p>Packing for Hajj requires careful thought given the physical demands of the pilgrimage. From comfortable Ihram-compliant footwear to essential medications, this checklist covers everything you need for a smooth journey.</p>',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(6),
                'meta_title' => 'Hajj Packing Checklist for a Comfortable Journey',
                'meta_description' => 'A practical packing checklist to help pilgrims prepare for Hajj.',
            ],
            [
                'title' => 'Understanding the Difference Between Hajj and Umrah',
                'content' => '<p>Many pilgrims planning their first trip to the Holy cities often ask about the difference between Hajj and Umrah. While both involve visiting the Kaaba, they differ in timing, rituals and religious obligation. This article breaks down the key differences.</p>',
                'status' => 'draft',
                'published_at' => null,
                'meta_title' => 'Difference Between Hajj and Umrah Explained',
                'meta_description' => 'Learn the key religious and practical differences between Hajj and Umrah.',
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::create($blog);
        }
    }
}
