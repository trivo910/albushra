<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            [
                'title' => 'Economy Umrah Package - 10 Days',
                'category' => 'umrah',
                'price' => 65000,
                'duration' => '10 Days / 9 Nights',
                'tour_type' => 'Group Tour',
                'group_size' => '15-20 People',
                'languages' => 'Urdu, English, Arabic',
                'description' => 'A budget-friendly Umrah package covering Makkah and Madinah with comfortable 3-star hotel stays, group Ziyarat and return airfare.',
                'included' => ['Return Airfare', 'Visa Processing', '3-Star Hotel Stay', 'Group Ziyarat', 'Airport Transfers'],
                'excluded' => ['Personal Expenses', 'Laundry', 'Excess Baggage Charges'],
                'map_embed' => '<iframe src="https://www.google.com/maps?q=Masjid+al-Haram+Makkah+Saudi+Arabia&z=15&output=embed" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                'rating' => 4.2,
                'is_featured' => true,
                'status' => 'published',
                'meta_title' => 'Economy Umrah Package 10 Days | Al Bushra Travel',
                'meta_description' => 'Book our affordable 10-day Umrah package with 3-star hotels, visa and airfare included.',
            ],
            [
                'title' => 'Deluxe Umrah Package - 14 Days',
                'category' => 'umrah',
                'price' => 125000,
                'duration' => '14 Days / 13 Nights',
                'tour_type' => 'Group Tour',
                'group_size' => '10-15 People',
                'languages' => 'Urdu, English, Arabic',
                'description' => 'Enjoy a comfortable Umrah journey with 5-star hotels near Haram, private transfers and guided Ziyarat tours in Makkah and Madinah.',
                'included' => ['Return Airfare', 'Visa Processing', '5-Star Hotel Near Haram', 'Private Transfers', 'Guided Ziyarat', 'Daily Breakfast & Dinner'],
                'excluded' => ['Personal Expenses', 'Lunch', 'Zamzam Water Excess Baggage'],
                'map_embed' => '<iframe src="https://www.google.com/maps?q=Masjid+al-Haram+Makkah+Saudi+Arabia&z=15&output=embed" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                'rating' => 4.8,
                'is_featured' => true,
                'status' => 'published',
                'meta_title' => 'Deluxe Umrah Package 14 Days | Al Bushra Travel',
                'meta_description' => 'Luxury 14-day Umrah package with 5-star hotels near Haram and private transfers.',
            ],
            [
                'title' => 'Ramadan Umrah Special Package',
                'category' => 'umrah',
                'price' => 155000,
                'duration' => '15 Days / 14 Nights',
                'tour_type' => 'Group Tour',
                'group_size' => '20-25 People',
                'languages' => 'Urdu, English, Arabic',
                'description' => 'Experience the blessings of Ramadan in the Holy cities with our special package including Iftar and Suhoor arrangements near Haram.',
                'included' => ['Return Airfare', 'Visa Processing', '4-Star Hotel Stay', 'Iftar & Suhoor Meals', 'Group Ziyarat'],
                'excluded' => ['Personal Expenses', 'Laundry', 'Optional Tours'],
                'map_embed' => '<iframe src="https://www.google.com/maps?q=Masjid+al-Haram+Makkah+Saudi+Arabia&z=15&output=embed" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                'rating' => 4.6,
                'is_featured' => false,
                'status' => 'published',
                'meta_title' => 'Ramadan Umrah Special Package | Al Bushra Travel',
                'meta_description' => 'Spend the blessed month of Ramadan in Makkah and Madinah with our special Umrah package.',
            ],
            [
                'title' => 'Standard Hajj Package',
                'category' => 'hajj',
                'price' => 385000,
                'duration' => '21 Days / 20 Nights',
                'tour_type' => 'Group Tour',
                'group_size' => '30-40 People',
                'languages' => 'Urdu, English, Arabic',
                'description' => 'Complete Hajj package including Mina, Arafat and Muzdalifah accommodation, guided rituals, and stays in Makkah and Madinah.',
                'included' => ['Return Airfare', 'Hajj Visa', 'Mina/Arafat/Muzdalifah Camps', 'Hotel Stay in Makkah & Madinah', 'Guided Rituals', 'All Meals'],
                'excluded' => ['Personal Expenses', 'Qurbani (Optional)', 'Excess Baggage'],
                'map_embed' => '<iframe src="https://www.google.com/maps?q=Masjid+al-Haram+Makkah+Saudi+Arabia&z=15&output=embed" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                'rating' => 4.9,
                'is_featured' => true,
                'status' => 'published',
                'meta_title' => 'Standard Hajj Package | Al Bushra Travel',
                'meta_description' => 'Complete Hajj package with camps, hotel stays and guided rituals for a hassle-free pilgrimage.',
            ],
            [
                'title' => 'VIP Hajj Package',
                'category' => 'hajj',
                'price' => 650000,
                'duration' => '21 Days / 20 Nights',
                'tour_type' => 'Private/Group Tour',
                'group_size' => '5-10 People',
                'languages' => 'Urdu, English, Arabic',
                'description' => 'Premium Hajj experience with 5-star hotels, VIP Mina/Arafat tents, private transport and dedicated group leader support throughout.',
                'included' => ['Return Business/Economy Airfare', 'Hajj Visa', 'VIP Mina/Arafat Tents', '5-Star Hotel Stay', 'Private Transport', 'Dedicated Group Leader'],
                'excluded' => ['Personal Expenses', 'Qurbani (Optional)'],
                'map_embed' => '<iframe src="https://www.google.com/maps?q=Masjid+al-Haram+Makkah+Saudi+Arabia&z=15&output=embed" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                'rating' => 5.0,
                'is_featured' => true,
                'status' => 'published',
                'meta_title' => 'VIP Hajj Package | Al Bushra Travel',
                'meta_description' => 'Premium VIP Hajj package with 5-star hotels and private transport for a comfortable pilgrimage.',
            ],
            [
                'title' => 'Family Umrah Package - 7 Days',
                'category' => 'umrah',
                'price' => 78000,
                'duration' => '7 Days / 6 Nights',
                'tour_type' => 'Family Tour',
                'group_size' => '4-8 People',
                'languages' => 'Urdu, English, Arabic',
                'description' => 'A short and comfortable Umrah trip designed for families, with family rooms, flexible schedules and dedicated support.',
                'included' => ['Return Airfare', 'Visa Processing', 'Family Rooms', 'Airport Transfers', 'Local Guide Support'],
                'excluded' => ['Personal Expenses', 'Meals', 'Optional Ziyarat Tours'],
                'map_embed' => '<iframe src="https://www.google.com/maps?q=Masjid+al-Haram+Makkah+Saudi+Arabia&z=15&output=embed" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                'rating' => 4.4,
                'is_featured' => false,
                'status' => 'published',
                'meta_title' => 'Family Umrah Package 7 Days | Al Bushra Travel',
                'meta_description' => 'A short family-friendly 7-day Umrah package with comfortable rooms and flexible schedules.',
            ],
        ];

        foreach ($packages as $package) {
            Package::create($package);
        }
    }
}
