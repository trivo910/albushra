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
    <section class="py-10 sm:py-14" style="background: var(--p-light-grey);">
        <div class="container-p">
            <div class="flex items-end justify-between mb-8 flex-wrap gap-4">
                <div>
                    <p class="eyebrow">Our Hajj Packages</p>
                    <h2 class="section-title !mb-0">Our Special Hajj Packages</h2>
                </div>
                <a href="{{ route('packages.category', 'hajj') }}" class="btn-brand-outline">View All Hajj Packages</a>
            </div>

            @if ($hajjPackages->isEmpty())
                <p style="color: var(--p-grey);">Hajj packages will appear here once published from the admin panel.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($hajjPackages as $package)
                        @include('packages._card', ['package' => $package])
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- Featured Umrah Packages --}}
    <section class="py-10 sm:py-14">
        <div class="container-p">
            <div class="flex items-end justify-between mb-8 flex-wrap gap-4">
                <div>
                    <p class="eyebrow">Our Umrah Packages</p>
                    <h2 class="section-title !mb-0">Our Special Umrah Packages</h2>
                </div>
                <a href="{{ route('packages.index') }}" class="btn-brand-outline">View All Packages</a>
            </div>

            @if ($umrahPackages->isEmpty())
                <p style="color: var(--p-grey);">Umrah packages will appear here once published from the admin panel.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($umrahPackages as $package)
                        @include('packages._card', ['package' => $package])
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- Why Choose Us --}}
    <section class="py-14" style="background: var(--p-navy);">
        <div class="container-p grid grid-cols-1 sm:grid-cols-3 gap-8">
            @foreach ([
                ['title' => 'Free Luggage', 'text' => 'Generous baggage allowance included with every package, no hidden fees.'],
                ['title' => '5 Star Hotel', 'text' => 'Comfortable, well-located stays close to the Haram in Makkah and Madinah.'],
                ['title' => '24/7 Support', 'text' => 'A dedicated team on call throughout your journey, day and night.'],
            ] as $item)
                <div class="flex items-start gap-4">
                    <div class="icon-badge">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 2l2.4 6.6L21 11l-6.6 2.4L12 20l-2.4-6.6L3 11l6.6-2.4z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-poppins font-semibold text-white mb-1">{{ $item['title'] }}</h3>
                        <p class="text-sm" style="color: #93a0b3;">{{ $item['text'] }}</p>
                    </div>
                </div>
            @endforeach
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
                            <path d="M2 5.5C2 4.67 2.67 4 3.5 4H8c1.66 0 3 1.34 3 3v12.2c0 .45-.5.7-.87.44C9.2 18.93 7.7 18.5 6 18.5c-1.4 0-2.6.3-3.6.74-.16.07-.4-.05-.4-.23V5.5z"/>
                            <path d="M22 5.5c0-.83-.67-1.5-1.5-1.5H16c-1.66 0-3 1.34-3 3v12.2c0 .45.5.7.87.44.93-.71 2.43-1.14 4.13-1.14 1.4 0 2.6.3 3.6.74.16.07.4-.05.4-.23V5.5z"/>
                        </svg>
                    </div>
                    <h3 class="service-title">Guided Pilgrimages</h3>
                    <p class="service-text">Join our Guided Pilgrimages to experience every moment of your Hajj or Umrah journey with deep spiritual meaning. Our expert team ensures that.</p>
                </div>

                {{-- 2. Spiritual Guidance --}}
                <div class="service-card">
                    <div class="service-icon">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="currentColor"><path d="M21 12.79A9 9 0 1 1 11.21 3a7 7 0 0 0 9.79 9.79z"/></svg>
                    </div>
                    <h3 class="service-title">Spiritual Guidance</h3>
                    <p class="service-text">Our Spiritual Guidance service helps you connect deeply with the sacred journey of Hajj and Umrah. Through expert support, lectures, and faith-based mentoring.</p>
                </div>

                {{-- 3. Cultural Experiences --}}
                <div class="service-card">
                    <div class="service-icon">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="currentColor"><path d="M12 17.27 18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    </div>
                    <h3 class="service-title">Cultural Experiences</h3>
                    <p class="service-text">Explore the rich culture and traditions tied to the Hajj and Umrah pilgrimage. With our Cultural Experience service, you'll enjoy local cuisine, historic.</p>
                </div>

                {{-- 4. Custom Itineraries --}}
                <div class="service-card">
                    <div class="service-icon">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                    </div>
                    <h3 class="service-title">Custom Itineraries</h3>
                    <p class="service-text">Design your pilgrimage just the way you want it. Our Custom Itineraries allow you to plan your journey based on personal preferences, timing.</p>
                </div>

                {{-- 5. Exclusive Amenities --}}
                <div class="service-card">
                    <div class="service-icon">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 12 20 22 4 22 4 12"/><rect x="2" y="7" width="20" height="5"/><line x1="12" y1="22" x2="12" y2="7"/><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/></svg>
                    </div>
                    <h3 class="service-title">Exclusive Amenities</h3>
                    <p class="service-text">Enjoy our premium amenities during your pilgrimage. We provide quality services such as VIP lounge access, fast-track immigration, luxury buses, and welcome kits.</p>
                </div>

                {{-- 6. Accommodation --}}
                <div class="service-card">
                    <div class="service-icon">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v18"/><path d="M2 22h20"/><path d="M17 22v-4h-2v4"/><path d="M17 8h-3a2 2 0 0 0-2 2v2h5v-2a2 2 0 0 0-2-2z"/></svg>
                    </div>
                    <h3 class="service-title">Accommodation</h3>
                    <p class="service-text">Stay in handpicked hotels near the holy sites. Our accommodation ensures clean, comfortable, and well-located stays for every pilgrim.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- SEO text block --}}
    <section class="py-14" style="background: var(--p-light-grey);">
        <div class="container-p max-w-3xl mx-auto text-sm leading-relaxed space-y-4" style="color: var(--p-grey);">
            <h2 class="section-title !text-xl">Hajj &amp; Umrah Packages from Bangalore</h2>
            <p>
                Al Bushra Tours &amp; Travels has been guiding pilgrims from Bangalore and across India through safe, affordable and
                spiritually fulfilling Hajj and Umrah journeys for years. Whether you are looking for an economy Umrah package, a
                family-friendly trip, or a premium Hajj experience with five-star accommodation near the Haram, our team handles
                visas, flights, hotels and ground transport so you can focus entirely on your worship.
            </p>
            <p>
                Every package on this site is managed directly by our team and kept up to date with real pricing, durations and
                inclusions — so what you see is what you get. Get in touch with us for a customised itinerary for your group or
                family.
            </p>
        </div>
    </section>

    {{-- FAQ accordion --}}
    <section class="py-16 sm:py-20">
        <div class="container-p max-w-3xl mx-auto">
            <div class="text-center mb-10">
                <p class="eyebrow">Have Questions?</p>
                <h2 class="section-title">FAQs</h2>
            </div>

            @if ($faqs->isEmpty())
                <p class="text-center" style="color: var(--p-grey);">FAQs will appear here once added from the admin panel.</p>
            @else
                <div class="divide-y" style="border-color: var(--p-light-grey);">
                    @foreach ($faqs as $faq)
                        <details class="accordion-p" style="border-bottom: 1px solid var(--p-light-grey);">
                            <summary>
                                <span>{{ $faq->question }}</span>
                                <span class="accordion-icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--p-primary)" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
                                </span>
                            </summary>
                            <p class="pb-4 text-sm leading-relaxed" style="color: var(--p-grey);">{{ $faq->answer }}</p>
                        </details>
                    @endforeach
                </div>
                <div class="text-center mt-8">
                    <a href="{{ route('faqs.index') }}" class="btn-brand-outline">View All FAQs</a>
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
    color: #172f52 !important;
    font-size: 16px;
    line-height: 1.55;
    margin: 0;
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
</style>