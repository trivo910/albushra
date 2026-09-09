@extends('layouts.public')

@section('content')
@php
$settings = \App\Models\Setting::current();
@endphp

{{-- Hero --}}
<section class="relative overflow-hidden" style="background: var(--p-light-grey);">
    <div class="relative h-[340px] sm:h-[440px] lg:h-[520px]" data-carousel>
        @forelse ($heroSlides as $i => $slide)
        <div data-slide class="absolute inset-0 transition-opacity duration-700 {{ $i === 0 ? 'opacity-100' : 'opacity-0' }}">
            <img src="{{ \Illuminate\Support\Facades\Storage::url($slide->image_path) }}" alt="{{ $slide->caption ?: ($settings->site_name ?? config('app.name')) }}" class="w-full h-full object-cover">
        </div>
        @empty
        <div data-slide class="absolute inset-0 opacity-100" style="background: linear-gradient(135deg, var(--p-navy), #2c4267);"></div>
        @endforelse

        <div class="absolute inset-0 flex items-center">
            <div class="container-p">
                <!-- <p class="eyebrow text-white" style="color: #fbd0c4;">Welcome to {{ $settings->site_name ?? config('app.name') }}</p> -->
                <!-- <h1 class="font-poppins text-3xl sm:text-5xl font-bold text-white max-w-xl leading-tight mb-6">
                        Our Hajj and Umrah Packages Are The Perfect Journey of Faith
                    </h1> -->

            </div>
        </div>

        @if ($heroSlides->count() > 1)
        <div data-carousel-dots class="absolute bottom-5 left-1/2 -translate-x-1/2 flex items-center gap-2"></div>
        @endif
    </div>
</section>

{{-- Intro --}}
<div class="home-grid">
    <div class="home-grid-1">
        <img src="{{ \Illuminate\Support\Facades\Storage::url('home/28-600x1067.png') }}" alt="Intro Image">
        <img src="{{ \Illuminate\Support\Facades\Storage::url('home/29-600x854.png') }}" alt="Intro Image">

    </div>
    <div class="home-grid-2">
        <section class="py-16 sm:py-20">
            <div class="container-p max-w-3xl text-center mx-auto">
                <p class="eyebrow">Welcome To Al Bushra</p>
                <h2 class="section-title">Our Hajj And Umrah Packages Are The Perfect Choice</h2>
                <p class="text-base leading-relaxed">
                    Al Bushra Tours &amp; Travels — your trusted companion on the most sacred journeys of your life. We are honored to
                    assist you in performing Hajj and Umrah with complete peace of mind, comfort, and faith. Every journey is handled
                    with sincerity, care, and attention to detail, so you can focus solely on your worship.
                </p>
            </div>
        </section>
    </div>
</div>

{{-- Featured Hajj Packages --}}
<section class="featured-hajj-packages">

    <div class="container-p">

        {{-- Section Heading --}}
        <div class="featured-hajj-heading">

            <!-- <p class="eyebrow">
                Our Hajj Packages
            </p> -->

            <h2 class="section-title">
                Our Special Hajj Packages
            </h2>

        </div>


        {{-- Packages --}}
        @if ($hajjPackages->isEmpty())

        <p class="featured-hajj-empty">
            Hajj packages will appear here once published from the admin panel.
        </p>

        @else

        <div class="featured-hajj-grid">

            @foreach ($hajjPackages as $package)

            @include('packages._card', ['package' => $package])

            @endforeach

        </div>

        @endif

    </div>

</section>


{{-- Featured Umrah Packages --}}
<section class="featured-hajj-packages">
    <div class="container-p">
        <div class="featured-hajj-heading">
            <div>
                <!-- <p class="eyebrow">Our Umrah Packages</p> -->
                <h2 class="section-title">Our Special Umrah Packages</h2>
            </div>

        </div>

        @if ($umrahPackages->isEmpty())
        <p class="featured-hajj-empty">Umrah packages will appear here once published from the admin panel.</p>
        @else
        <div class="featured-hajj-grid">
            @foreach ($umrahPackages as $package)
            @include('packages._card', ['package' => $package])
            @endforeach
        </div>
        @endif
    </div>
</section>
{{-- Why Choose Us --}}
<section class="why-choose-section">

    <div class="why-choose-container">

        {{-- LEFT CONTENT --}}
        <div class="why-choose-content">

            <p class="why-choose-eyebrow">
                Why Choose Us
            </p>

            <h2 class="why-choose-title">
                Al Bushra for Your
                <br>
                Hajj &amp; Umrah Journey
            </h2>

            <p class="why-choose-description">
                We understand that Hajj and Umrah are not just trips — they are deeply
                spiritual commitments. That’s why we go beyond just planning travel;
                we deliver peace of mind. From visa assistance and luxury hotel stays
                near Haram to group guidance and 24/7 support, every detail is
                handled with care, sincerity, and transparency. Our goal is to ensure
                you remain focused on your worship while we take care of everything else.
            </p>


            {{-- FEATURES --}}
            <div class="why-choose-features">

                @foreach ([
                [
                'title' => 'Free Luggage',
                'text' => 'Travel light and easy — we take care of your baggage for you.',
                'icon' => '🧳'
                ],
                [
                'title' => '5 Star Hotel',
                'text' => 'Enjoy premium stays near Haram with top-class hospitality.',
                'icon' => '🏨'
                ],
                [
                'title' => '24/7 Support',
                'text' => 'Round-the-clock assistance throughout your journey with us.',
                'icon' => '📞'
                ],
                ] as $item)

                <div class="why-choose-card">

                    <div class="why-choose-icon">
                        {{ $item['icon'] }}
                    </div>

                    <h3>
                        {{ $item['title'] }}
                    </h3>

                    <p>
                        {{ $item['text'] }}
                    </p>

                </div>

                @endforeach

            </div>

        </div>


        {{-- RIGHT IMAGE --}}
        <div class="why-choose-image">

            <!-- <img
                src="{{ \Illuminate\Support\Facades\Storage::url('home/home-why-choose-1536x1536.png') }}"
                alt="Al Bushra Hajj and Umrah"
            > -->
            <img src="{{ \Illuminate\Support\Facades\Storage::url('home/home-why-choose-1024x1024.png') }}" alt="Al Bushra Hajj and Umrah">
        </div>

    </div>

</section>

{{-- Services grid --}}
<section class="py-16 sm:py-20 services-section">
    <div class="container-p">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <p class="eyebrow">Get Special Services</p>
            <h2 class="section-title">Enjoy The Spiritual Pilgrimage Of A Lifetime</h2>
        </div>
        <div class="services-grid">
            {{-- 1. Guided Pilgrimages --}}
            <div class="service-card">
                <div class="service-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M2 5.5C2 4.67 2.67 4 3.5 4H8c1.66 0 3 1.34 3 3v12.2c0 .45-.5.7-.87.44C9.2 18.93 7.7 18.5 6 18.5c-1.4 0-2.6.3-3.6.74-.16.07-.4-.05-.4-.23V5.5z" />
                        <path d="M22 5.5c0-.83-.67-1.5-1.5-1.5H16c-1.66 0-3 1.34-3 3v12.2c0 .45.5.7.87.44.93-.71 2.43-1.14 4.13-1.14 1.4 0 2.6.3 3.6.74.16.07.4-.05.4-.23V5.5z" />
                    </svg>
                </div>
                <h3 class="service-title">Guided Pilgrimages</h3>
                <p class="service-text">Join our Guided Pilgrimages to experience every moment of your Hajj or Umrah journey with deep spiritual meaning. Our expert team ensures that.</p>
            </div>

            {{-- 2. Spiritual Guidance --}}
            <div class="service-card">
                <div class="service-icon">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3a7 7 0 0 0 9.79 9.79z" />
                    </svg>
                </div>
                <h3 class="service-title">Spiritual Guidance</h3>
                <p class="service-text">Our Spiritual Guidance service helps you connect deeply with the sacred journey of Hajj and Umrah. Through expert support, lectures, and faith-based mentoring.</p>
            </div>

            {{-- 3. Cultural Experiences --}}
            <div class="service-card">
                <div class="service-icon">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 17.27 18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                    </svg>
                </div>
                <h3 class="service-title">Cultural Experiences</h3>
                <p class="service-text">Explore the rich culture and traditions tied to the Hajj and Umrah pilgrimage. With our Cultural Experience service, you'll enjoy local cuisine, historic.</p>
            </div>

            {{-- 4. Custom Itineraries --}}
            <div class="service-card">
                <div class="service-icon">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 20h9" />
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
                    </svg>
                </div>
                <h3 class="service-title">Custom Itineraries</h3>
                <p class="service-text">Design your pilgrimage just the way you want it. Our Custom Itineraries allow you to plan your journey based on personal preferences, timing.</p>
            </div>

            {{-- 5. Exclusive Amenities --}}
            <div class="service-card">
                <div class="service-icon">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 12 20 22 4 22 4 12" />
                        <rect x="2" y="7" width="20" height="5" />
                        <line x1="12" y1="22" x2="12" y2="7" />
                        <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z" />
                        <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z" />
                    </svg>
                </div>
                <h3 class="service-title">Exclusive Amenities</h3>
                <p class="service-text">Enjoy our premium amenities during your pilgrimage. We provide quality services such as VIP lounge access, fast-track immigration, luxury buses, and welcome kits.</p>
            </div>

            {{-- 6. Accommodation --}}
            <div class="service-card">
                <div class="service-icon">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 22V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v18" />
                        <path d="M2 22h20" />
                        <path d="M17 22v-4h-2v4" />
                        <path d="M17 8h-3a2 2 0 0 0-2 2v2h5v-2a2 2 0 0 0-2-2z" />
                    </svg>
                </div>
                <h3 class="service-title">Accommodation</h3>
                <p class="service-text">Stay in handpicked hotels near the holy sites. Our accommodation ensures clean, comfortable, and well-located stays for every pilgrim.</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== Sacred Journey Section ===== -->
<section class="sacred-journey">
    <div class="sacred-container">

        <!-- LEFT CONTENT -->
        <div class="sacred-left">

            <h2>Your Sacred Journey Begins<br>with Al Bushra</h2>

            <p>
                Embark on a life-changing journey with Al Bushra — where every Hajj &amp; Umrah
                trip is handled with sincerity, care, and expert guidance.<br>
                From visa to ziyarat, from Makkah to Madinah — we manage it all with premium
                hotels, group leaders, and 24/7 support.
            </p>

            <!-- LEFT IMAGE -->
            <div class="sacred-small-image">
                <img src="{{ \Illuminate\Support\Facades\Storage::url('home/sacred-journey-1536x1536.png') }}" alt="Al Bushra Hajj and Umrah">
            </div>

        </div>

        <!-- RIGHT IMAGE -->
        <div class="sacred-right">
            <img src="{{ \Illuminate\Support\Facades\Storage::url('home/al-bushra.png') }}" alt="Al Bushra Hajj and Umrah">
        </div>

    </div>
</section>

{{-- FAQ Accordion --}}
<section class="faq-section">

    <div class="faq-container">

        {{-- Heading --}}
        <div class="faq-heading">

            <!-- <p class="faq-eyebrow">
                Have Questions?
            </p> -->

            <h2 class="faq-title">
                FAQs
            </h2>

        </div>


        @if ($faqs->isEmpty())

        <p class="faq-empty">
            FAQs will appear here once added from the admin panel.
        </p>

        @else

        <div class="faq-list">

            @foreach ($faqs as $faq)

            <details class="faq-item">

                <summary class="faq-question">

                    <span>
                        {{ $faq->question }}
                    </span>

                    <span class="faq-icon">+</span>

                </summary>

                <div class="faq-answer">
                    {{ $faq->answer }}
                </div>

            </details>

            @endforeach

        </div>

        @endif

    </div>

</section>
@endsection


<style>
    /* ================================
   HOME INTRO SECTION
================================ */

    .home-grid {
        display: grid;
        grid-template-columns: 1.15fr 1fr;
        /* align-items: center; */
        /* gap: 40px; */
        max-width: 1400px;
        margin: 0 auto;
        padding: 70px 30px;
    }

    /* ================================
   IMAGE AREA
================================ */

    .home-grid-1 {
        display: flex;
        align-items: flex-end;
        gap: 55px;
        align-items: right;
    }

    /* Common image styling */
    .home-grid-1 img {
        display: block;
        width: 100%;
        object-fit: cover;
        /* border-radius: 0 90px 12px 12px; */
        position: relative;
        /* box-shadow: 10px 10px 0 #4b146b; */
    }

    /* First Image - home-1 */
    .home-grid-1 img:first-child {
        width: 40%;
        height: 560px;
        object-position: center;
        border-radius: 150px 150px 12px 12px;
        box-shadow: -10px 10px 0 #4b146b;
    }

    /* Second Image - home-2 */
    .home-grid-1 img:nth-child(2) {
        width: 40%;
        height: 450px;
        object-position: center;
        margin-bottom: 0;
        border-radius: 12px 150px 12px 12px;
        box-shadow: -10px 10px 0 #4b146b;
    }


    /* ================================
   TEXT AREA
================================ */

    .home-grid-2 {
        display: flex;
        align-items: flex-end;
        gap: 0px;
        align-items: left;
    }

    .home-grid-2 section {
        padding: 0 !important;
    }

    .home-grid-2 .container-p {
        max-width: 650px;
        margin: 0;
        padding: 0;
        text-align: left;
    }

    /* Welcome text */
    .home-grid-2 .eyebrow {
        color: #24b8a8;
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 25px;
    }

    /* Main heading */
    .home-grid-2 .section-title {
        font-family: "Poppins", Sans-serif;
        font-size: 36px;
        font-weight: 600;
        line-height: 45px;
        letter-spacing: -0.8px;
        color: #1A2B48;
    }

    /* Description */
    .home-grid-2 p.text-base {
        font-family: "Poppins", Sans-serif;
        color: #1A2B48;
        font-size: 16px;
        line-height: 1.55;
        margin: 0;
        max-width: 570px;
        font-weight: 500;
        text-align: justify;
    }


    /* ================================
   TABLET
================================ */

    @media (max-width: 1100px) {

        .home-grid {
            grid-template-columns: 1fr;
            gap: 60px;
        }

        .home-grid-1 {
            max-width: 850px;
            margin: 0 auto;
        }

        .home-grid-2 .container-p {
            max-width: 850px;
            margin: 0 auto;
            padding: 0;
            text-align: center;
        }

        .home-grid-2 .section-title {
            font-size: 42px;
        }

        .home-grid-2 p.text-base {
            text-align: center;
        }
    }


    /* ================================
   MOBILE
================================ */

    @media (max-width: 700px) {

        .home-grid {
            display: block;
            padding: 50px 20px;
        }

        .home-grid-1 {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            gap: 18px;
            width: 100%;
            margin: 0 auto 60px;
        }

        .home-grid-1 img {
            width: calc(50% - 9px);
            height: auto;
            max-width: none;
        }

        .home-grid-1 img:first-child {
            width: calc(50% - 9px);
        }

        .home-grid-1 img:nth-child(2) {
            width: calc(50% - 9px);
        }

        .home-grid-2 {
            width: 100%;
            text-align: center;
        }

    }


    /* ================================
   SMALL MOBILE
================================ */

    @media (max-width: 480px) {

        .home-grid-1 {
            gap: 18px;
        }

        .home-grid-1 img:first-child {
            height: 350px;
        }

        .home-grid-1 img:nth-child(2) {
            height: 280px;
        }

        .home-grid-2 .section-title {
            font-size: 29px;
        }

        .home-grid-2 .eyebrow {
            font-size: 21px;
        }
    }

    /* =========================================
   WHY CHOOSE US SECTION
========================================= */

    .why-choose-section {
        width: 100%;
        background: #ffffff;
        padding: 70px 0 60px;
    }

    .why-choose-container {
        width: 100%;
        max-width: 1450px;
        margin: 0 auto;
        padding: 0 36px;

        display: grid;
        grid-template-columns: 1fr 1fr;
        align-items: center;
        gap: 45px;
    }


    /* =========================================
   LEFT CONTENT
========================================= */

    .why-choose-content {
        width: 100%;
    }

    .why-choose-eyebrow {
        font-family: "Caveat", Sans-serif;
        font-size: 24px;
        font-weight: 700;
        line-height: normal;
        letter-spacing: 0.48px;
        color: #36BCA1;
    }

    .why-choose-title {
        font-family: "Poppins", Sans-serif;
        font-size: 36px;
        font-weight: 600;
        line-height: 45px;
        /* letter-spacing: -0.8px; */
        color: #1A2B48;
        padding: 10px 0 20px;
    }

    .why-choose-description {
        font-family: "Poppins", Sans-serif;
        color: #172f52;
        font-size: 16px;
        line-height: 1.55;
        margin: 0;
        max-width: 570px;
        /* font-weight: 400; */
    }


    /* =========================================
   FEATURE CARDS
========================================= */

    .why-choose-features {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-top: 28px;
    }

    .why-choose-card {
        background: #ffffff;
        border-radius: 10px;

        padding: 20px 15px;

        text-align: center;

        box-shadow:
            0 4px 12px rgba(0, 0, 0, 0.08);

        min-height: 185px;

        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .why-choose-icon {
        font-size: 25px;
        line-height: 1;
        margin-bottom: 16px;
    }

    .why-choose-card h3 {
        margin: 0 0 10px;
        font-size: 18px;
        color: #2f2f2f;
        font-weight: 600;
    }

    .why-choose-card p {
        color: #53627a;
        font-size: 16px;
        line-height: 1.45;
        margin: 0;

        /* font-size: 14px;
    color: #555;
    font-weight: 600; */
    }


    /* =========================================
   RIGHT IMAGE
========================================= */

    .why-choose-image {
        position: relative;
        width: 100%;
        z-index: 1;
    }

    .why-choose-image::after {
        content: "";
        position: absolute;

        right: -12px;
        bottom: -12px;

        width: 100%;
        height: 100%;

        background: #4b146b;

        border-radius: 160px 12px 12px 12px;

        z-index: -1;
    }

    .why-choose-image img {
        display: block;

        width: 100%;
        height: 465px;

        object-fit: cover;
        object-position: center;

        border-radius: 160px 12px 12px 12px;
    }


    /* =========================================
   TABLET
========================================= */

    @media (max-width: 1000px) {

        .why-choose-container {
            grid-template-columns: 1fr;
            gap: 50px;
        }

        .why-choose-content {
            text-align: center;
        }

        .why-choose-description {
            margin: 0 auto;
        }

        .why-choose-image {
            max-width: 800px;
            margin: 0 auto;
        }

    }


    /* =========================================
   MOBILE
========================================= */

    @media (max-width: 700px) {

        .why-choose-section {
            padding: 50px 0;
        }

        .why-choose-container {
            display: flex;
            flex-direction: column;

            padding: 0 20px;
            gap: 40px;
        }

        .why-choose-content {
            width: 100%;
            text-align: center;
        }

        .why-choose-eyebrow {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .why-choose-title {
            font-size: 29px;
            line-height: 1.2;
        }

        .why-choose-description {
            font-size: 15px;
            line-height: 1.6;
            text-align: left;
        }


        /* Cards */

        .why-choose-features {
            grid-template-columns: 1fr;
            gap: 15px;
            margin-top: 25px;
        }

        .why-choose-card {
            min-height: auto;
            padding: 22px 20px;
        }

        .why-choose-icon {
            font-size: 26px;
        }


        /* Image */

        .why-choose-image {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }

        .why-choose-image img {
            width: 100%;
            height: auto;
            min-height: 300px;
            object-fit: cover;
        }

        .why-choose-image::after {
            right: -8px;
            bottom: -8px;
        }

    }


    /* =========================================
   SMALL MOBILE
========================================= */

    @media (max-width: 480px) {

        .why-choose-container {
            padding: 0 16px;
        }

        .why-choose-title {
            font-size: 27px;
        }

        .why-choose-description {
            font-size: 14px;
        }

        .why-choose-image img {
            min-height: 250px;
        }

    }


    /* =========================================
   FEATURED HAJJ PACKAGES
========================================= */

    .featured-hajj-packages {
        width: 100%;
        background: #ffffff;
        padding: 55px 0 60px;
    }

    .featured-hajj-packages .container-p {
        width: 100%;
        max-width: 1250px;
        margin: 0 auto;
        padding: 0 25px;
        text-align: center;
    }


    /* =========================================
   HEADING
========================================= */

    .featured-hajj-heading {
        text-align: center;
        margin-bottom: 35px;
    }

    .featured-hajj-heading .eyebrow {
        color: #24b8a8;
        font-size: 19px;
        font-weight: 600;
        margin: 0 0 5px;
    }

    .featured-hajj-heading .section-title {
        font-family: "Poppins", Sans-serif;
        font-size: 36px;
        font-weight: 600;
        line-height: 45px;
        letter-spacing: -0.8px;
        color: #1A2B48;
    }


    /* =========================================
   PACKAGE GRID
========================================= */

    .featured-hajj-grid {
        display: grid;

        grid-template-columns:
            repeat(3, minmax(0, 1fr));

        gap: 20px;

        justify-content: center;
        align-items: stretch;

        min-width: 0;
        margin: 0 auto;
    }


    /* =========================================
   WHEN ONLY 2 PACKAGES
========================================= */

    /* 2 cards ko center mein rakhega */
    .featured-hajj-grid>*:nth-child(1):nth-last-child(2),
    .featured-hajj-grid>*:nth-child(2):nth-last-child(1) {
        /* normal grid */
    }


    /* =========================================
   EMPTY MESSAGE
========================================= */

    .featured-hajj-empty {
        text-align: center;
        color: var(--p-grey);
        margin: 30px auto;
    }


    /* =========================================
   TABLET
========================================= */

    @media (max-width: 1000px) {

        .featured-hajj-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            max-width: 750px;
        }

    }


    /* =========================================
   MOBILE
========================================= */

    @media (max-width: 700px) {

        .featured-hajj-packages {
            padding: 45px 0 50px;
        }

        .featured-hajj-packages .container-p {
            padding: 0 18px;
        }

        .featured-hajj-heading {
            margin-bottom: 28px;
        }

        .featured-hajj-heading .eyebrow {
            font-size: 18px;
        }

        .featured-hajj-heading .section-title {
            font-size: 27px;
        }

        .featured-hajj-grid {
            grid-template-columns: 1fr;
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            gap: 20px;
        }

    }


    /* =========================================
   SMALL MOBILE
========================================= */

    @media (max-width: 480px) {

        .featured-hajj-heading .section-title {
            font-size: 25px;
        }

    }

    .featured-hajj-packages .featured-hajj-heading .featured-hajj-grid .featured-hajj-empty
    /* =========================================
   SERVICES SECTION
========================================= */



    /* =========================================
   SERVICES SECTION
========================================= */

    .services-section {
        width: 100%;
        background: #ffffff;
        padding: 50px 0 65px;

    }


    /* =========================================
   CONTAINER
========================================= */

    .services-section .container-p {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        padding-left: 35px;
        padding-right: 35px;
        padding-top: 50px;
        padding-bottom: 50px;
    }


    /* =========================================
   HEADING
========================================= */

    .services-heading {
        width: 100%;
        max-width: 800px;
        margin: 0 auto 32px;

        display: flex;
        flex-direction: column;
        align-items: center;

        text-align: center !important;
    }

    .services-heading .eyebrow {
        display: block;
        width: 100%;

        font-family: "Caveat", Sans-serif;
        font-size: 24px;
        font-weight: 700;
        line-height: normal;
        letter-spacing: 0.48px;
        color: #36BCA1;

        text-align: center !important;

        margin: 0 0 5px !important;
    }

    .services-heading .section-title {
        width: 100%;

        font-family: "Poppins", Sans-serif;
        font-size: 36px;
        font-weight: 600;
        line-height: 45px;
        letter-spacing: -0.8px;
        color: #1A2B48;

        text-align: center !important;

        margin: 0 0 12px !important;
    }

    .services-intro {
        width: 100%;
        max-width: 700px;

        color: #172f52;
        font-size: 16px;
        line-height: 1.55;
        margin: 0;
        max-width: 570px;
        font-weight: 400;

        text-align: center !important;

        margin: 0 auto;
    }


    /* =========================================
   SERVICES GRID
========================================= */

    .services-grid {
        display: grid;

        grid-template-columns: repeat(3, 1fr);

        gap: 18px;

        width: 100%;
        max-width: 1250px;

        margin: 0 auto;
    }


    /* =========================================
   SERVICE CARD
========================================= */

    .service-card {
        width: 100%;
        min-width: 0;

        min-height: 190px;

        background: #ffffff;

        border: 1px solid #eeeeee;
        border-radius: 9px;

        padding: 22px 25px;

        text-align: center;

        display: flex;
        flex-direction: column;
        align-items: center;

        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);

        transition:
            background-color 0.3s ease,
            color 0.3s ease,
            transform 0.3s ease,
            box-shadow 0.3s ease;
    }


    /* =========================================
   ICON
========================================= */

    .service-icon {
        width: 60px;
        height: 60px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #fde8e5;
        color: #df3035;

        border-radius: 6px;

        margin-bottom: 14px;

        flex-shrink: 0;

        transition: all 0.3s ease;
    }


    /* =========================================
   TITLE
========================================= */

    .service-card h3 {
        font-family: "Poppins", Sans-serif;
        font-size: 30px;
        font-weight: 400;
        line-height: 45px;
        /* letter-spacing: -0.8px; */
        color: #1A2B48;

        margin: 0 0 10px;

        transition: color 0.3s ease;
    }


    /* =========================================
   TEXT
========================================= */

    .service-card p {
        font-family: "Poppins", Sans-serif;
        /* color: #172f52; */
        font-size: 16px;
        line-height: 1.55;
        margin: 0;
        max-width: 570px;
        font-weight: 400;

        margin: 0;

        transition: color 0.3s ease;
    }


    /* =========================================
   HOVER
========================================= */

    .service-card:hover {
        background: #35bda9;
        border-color: #35bda9;

        transform: translateY(-5px);

        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    }

    .service-card:hover .service-icon {
        background: #ffffff;
        color: #df3035;
    }

    .service-card:hover h3,
    .service-card:hover p {
        color: #ffffff;
    }


    /* =========================================
   TABLET
========================================= */

    @media (max-width: 900px) {

        .services-section .container-p {
            padding-left: 25px;
            padding-right: 25px;
        }

        .services-grid {
            grid-template-columns: repeat(2, 1fr);
        }

    }


    /* =========================================
   MOBILE
========================================= */

    @media (max-width: 600px) {

        .services-section {
            padding: 45px 0 55px;
        }

        .services-section .container-p {
            padding-left: 18px;
            padding-right: 18px;
        }

        .services-heading {
            margin-bottom: 28px;
        }

        .services-heading .eyebrow {
            font-size: 18px;
        }

        .services-heading .section-title {
            font-size: 26px;
        }

        .services-intro {
            font-size: 13px;
        }

        .services-grid {
            grid-template-columns: 1fr;
            max-width: 450px;
            gap: 15px;
        }

        .service-card {
            min-height: 175px;
            padding: 22px 20px;
        }

        .service-card h3 {
            font-size: 20px;
            line-height: 28px;
        }

    }

    /* ===== Sacred Journey Section ===== */

    .sacred-journey {
        width: 100%;
        padding: 50px 0 50px;
        background: #f7f9fc;
        box-sizing: border-box;
    }

    .sacred-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 32px;
        align-items: stretch;
        box-sizing: border-box;
    }

    /* LEFT SIDE */
    .sacred-left {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        min-width: 0;
    }

    .sacred-left h2 {
        font-family: "Poppins", Sans-serif;
        font-size: 36px;
        font-weight: 600;
        line-height: 45px;
        letter-spacing: -0.8px;
        color: #1A2B48;
    }

    .sacred-left p {
        margin: 20px 0 20px;
        color: #172f52;
        font-size: 16px;
        line-height: 1.55;
        font-weight: 400;
        max-width: 540px;
    }

    /* SMALL LEFT IMAGE */
    .sacred-small-image {
        width: 100%;
        height: 270px;
        overflow: hidden;
        border-radius: 7px;
        margin-top: 0;
    }

    .sacred-small-image img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .sacred-small-image:hover img {
        transform: scale(1.04);
    }

    /* RIGHT LARGE IMAGE */
    .sacred-right {
        width: 100%;
        height: 500px;
        overflow: hidden;
        border-radius: 7px;
    }

    .sacred-right img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .sacred-right:hover img {
        transform: scale(1.03);
    }


    /* ===== TABLET ===== */
    @media (max-width: 900px) {

        .sacred-container {
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            padding: 0 15px;
        }

        .sacred-left h2 {
            font-size: 26px;
        }

        .sacred-left p {
            font-size: 13px;
        }

        .sacred-small-image {
            height: 230px;
        }

        .sacred-right {
            height: 390px;
        }
    }


    /* ===== MOBILE ===== */
    @media (max-width: 767px) {

        .sacred-journey {
            padding: 10px 0 30px;
        }

        .sacred-container {
            grid-template-columns: 1fr;
            gap: 18px;
            padding: 0 15px;
        }

        .sacred-left h2 {
            font-size: 25px;
        }

        .sacred-left p {
            font-size: 14px;
            line-height: 1.6;
        }

        .sacred-small-image {
            height: 230px;
        }

        .sacred-right {
            height: 300px;
        }
    }

    /* =========================================
   FAQ SECTION
========================================= */

    .faq-section {
        width: 100%;
        background: #ffffff;
        padding: 55px 0 70px;
    }

    .faq-container {
        width: 100%;
        max-width: 1000px;

        margin: 0 auto;

        padding-left: 25px;
        padding-right: 25px;
    }


    /* =========================================
   FAQ HEADING
========================================= */

    .faq-heading {
        width: 100%;

        text-align: center;

        margin: 0 auto 30px;
    }

    .faq-eyebrow {
        color: #24b8a8;

        font-size: 18px;
        font-weight: 600;

        margin: 0 0 5px;
    }

    .faq-title {
        color: #172f52;

        font-size: 34px;
        line-height: 1.2;
        font-weight: 700;

        margin: 0;

        text-align: center;
    }


    /* =========================================
   FAQ LIST
========================================= */

    .faq-list {
        width: 100%;
    }


    /* =========================================
   FAQ ITEM
========================================= */

    .faq-item {
        width: 100%;

        margin-bottom: 14px;

        border: none;

        border-radius: 14px;

        overflow: hidden;

        background: transparent;
    }


    /* =========================================
   QUESTION
========================================= */

    .faq-question {
        width: 100%;
        min-height: 62px;
        padding: 0 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        background: #4b126d;
        color: #ffffff;
        border-radius: 14px;
        cursor: pointer;
        list-style: none;
        font-size: 16px;
        font-weight: 600;

        transition:
            background-color 0.3s ease,
            border-radius 0.3s ease;
    }


    /* Remove default arrow */

    .faq-question::-webkit-details-marker {
        display: none;
    }

    .faq-question::marker {
        display: none;
    }


    /* Question text */

    .faq-question>span:first-child {
        flex: 1;
        text-align: center;
        line-height: 1.4;
        font-size: 18px;
    }


    /* =========================================
   PLUS ICON
========================================= */

    .faq-icon {
        width: 28px;
        height: 28px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 24px;
        font-weight: 400;

        color: #ffffff;

        transition: transform 0.3s ease;
    }


    /* =========================================
   OPEN FAQ
========================================= */

    .faq-item[open] .faq-question {
        border-radius: 14px 14px 14px 14px;
    }

    .faq-item[open] .faq-icon {
        transform: rotate(45deg);
    }


    /* =========================================
   ANSWER
========================================= */

    .faq-answer {
        width: 100%;

        background: #ffffff;

        color: #000000;
        margin: 20px 0 0;
        padding: 18px 22px 20px;

        font-size: 16px;

        line-height: 1.55;

        border-radius: 14px 14px 14px 14px;

        /* border-left: 1px solid #eeeeee; */
        border-right: 5px solid #d9dcdf;
        border-bottom: 5px solid #d9dcdf;

        box-sizing: border-box;
    }


    /* =========================================
   HOVER
========================================= */

    @media (hover: hover) and (pointer: fine) {

        .faq-question:hover {
            background: #5a197d;
        }

    }


    /* =========================================
   EMPTY MESSAGE
========================================= */

    .faq-empty {
        text-align: center;

        color: var(--p-grey);

        font-size: 15px;

        margin: 30px auto;
    }


    /* =========================================
   MOBILE
========================================= */

    @media (max-width: 600px) {

        .faq-section {
            padding: 45px 0 55px;
        }

        .faq-container {
            padding-left: 16px;
            padding-right: 16px;
        }

        .faq-heading {
            margin-bottom: 25px;
        }

        .faq-eyebrow {
            font-size: 17px;
        }

        .faq-title {
            font-size: 29px;
        }

        .faq-question {
            min-height: 58px;

            padding: 14px 16px;

            font-size: 14px;

            gap: 10px;
        }

        .faq-question>span:first-child {
            text-align: center;
        }

        .faq-icon {
            width: 24px;
            height: 24px;

            font-size: 22px;
        }

        .faq-answer {
            padding: 16px;

            font-size: 14px;

            line-height: 1.55;
        }

    }


    /* =========================================
   SMALL MOBILE
========================================= */

    @media (max-width: 400px) {

        .faq-question {
            font-size: 13px;
            padding: 13px 14px;
        }

        .faq-answer {
            font-size: 13px;
        }

    }
</style>