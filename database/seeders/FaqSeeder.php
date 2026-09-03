<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'What is the difference between Hajj and Umrah?',
                'answer' => 'Hajj is an obligatory pilgrimage performed during a specific period of the Islamic calendar, while Umrah is a non-obligatory pilgrimage that can be performed at any time of the year.',
                'sort_order' => 1,
            ],
            [
                'question' => 'How far in advance should I book my package?',
                'answer' => 'We recommend booking at least 2-3 months in advance, especially for Ramadan and Hajj season, to secure the best hotel availability and pricing.',
                'sort_order' => 2,
            ],
            [
                'question' => 'What documents do I need to travel?',
                'answer' => 'You will need a valid passport with at least 6 months validity, passport-sized photographs, and any additional documents required for visa processing, which our team will guide you through.',
                'sort_order' => 3,
            ],
            [
                'question' => 'Are flights included in the package price?',
                'answer' => 'Yes, most of our packages include return airfare. Please check the inclusions listed on each individual package page for details.',
                'sort_order' => 4,
            ],
            [
                'question' => 'Can I customize a package for my family or group?',
                'answer' => 'Absolutely. Contact our team with your requirements and group size, and we will prepare a customized itinerary and quote for you.',
                'sort_order' => 5,
            ],
            [
                'question' => 'What is your cancellation and refund policy?',
                'answer' => 'Cancellation terms vary depending on the package and how close to the departure date you cancel. Please contact us directly for the specific terms applicable to your booking.',
                'sort_order' => 6,
            ],
            [
                'question' => 'Do you provide visa assistance?',
                'answer' => 'Yes, visa processing is included in all our Hajj and Umrah packages and is handled entirely by our experienced team.',
                'sort_order' => 7,
            ],
            [
                'question' => 'Is accommodation close to the Haram?',
                'answer' => 'We offer a range of hotel options, from budget stays a short distance away to premium hotels located within walking distance of the Haram, depending on the package you choose.',
                'sort_order' => 8,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
