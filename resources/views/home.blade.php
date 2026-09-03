@extends('layouts.public')

@section('content')
    @php
        $settings = \App\Models\Setting::current();
        $heroImages = collect([$settings->hero_image_1, $settings->hero_image_2, $settings->hero_image_3])->filter();
    @endphp

    {{-- Hero --}}
    <section class="relative overflow-hidden" style="background: var(--p-light-grey);">
        <div class="relative h-[340px] sm:h-[440px] lg:h-[520px]" data-carousel>
            @forelse ($heroImages as $i => $image)
                <div data-slide class="absolute inset-0 transition-opacity duration-700 {{ $i === 0 ? 'opacity-100' : 'opacity-0' }}">
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($image) }}" alt="Al Bushra Tours &amp; Travels" class="w-full h-full object-cover">
                    <div class="absolute inset-0" style="background: linear-gradient(0deg, rgba(26,43,72,0.45), rgba(26,43,72,0.1));"></div>
                </div>
            @empty
                <div data-slide class="absolute inset-0 opacity-100" style="background: linear-gradient(135deg, var(--p-navy), #2c4267);"></div>
            @endforelse

            <div class="absolute inset-0 flex items-center">
                <div class="container-p">
                    <p class="eyebrow text-white" style="color: #fbd0c4;">Welcome to {{ $settings->site_name ?? config('app.name') }}</p>
                    <h1 class="font-poppins text-3xl sm:text-5xl font-bold text-white max-w-xl leading-tight mb-6">
                        Our Hajj and Umrah Packages Are The Perfect Journey of Faith
                    </h1>
                    <a href="{{ route('packages.index') }}" class="btn-brand">Explore Packages</a>
                </div>
            </div>

            @if ($heroImages->count() > 1)
                <div data-carousel-dots class="absolute bottom-5 left-1/2 -translate-x-1/2 flex items-center gap-2"></div>
            @endif
        </div>
    </section>

    {{-- Intro --}}
    <section class="py-16 sm:py-20">
        <div class="container-p max-w-3xl text-center mx-auto">
            <p class="eyebrow">Welcome To {{ $settings->site_name ?? config('app.name') }}</p>
            <h2 class="section-title">Our Hajj And Umrah Packages Are The Perfect Choice</h2>
            <p class="text-base leading-relaxed" style="color: var(--p-grey);">
                Al Bushra Tours &amp; Travels — your trusted companion on the most sacred journeys of your life. We are honored to
                assist you in performing Hajj and Umrah with complete peace of mind, comfort, and faith. Every journey is handled
                with sincerity, care, and attention to detail, so you can focus solely on your worship.
            </p>
        </div>
    </section>

    {{-- Featured Hajj Packages --}}
    <section class="py-10 sm:py-14" style="background: var(--p-light-grey);">
        <div class="container-p">
            <div class="flex items-end justify-between mb-8 flex-wrap gap-4">
                <div>
                    <p class="eyebrow">Our Hajj Packages</p>
                    <h2 class="section-title !mb-0">Our Special Hajj Packages</h2>
                </div>
                <a href="{{ route('packages.hajj') }}" class="btn-brand-outline">View All Hajj Packages</a>
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
    <section class="py-16 sm:py-20">
        <div class="container-p">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <p class="eyebrow">Get Special Services</p>
                <h2 class="section-title">Enjoy The Spiritual Pilgrimage Of A Lifetime</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ([
                    ['title' => 'Guided Pilgrimages', 'text' => 'Experienced guides walk you through every ritual, step by step.'],
                    ['title' => 'Spiritual Guidance', 'text' => 'Scholars and mentors on hand to support your worship.'],
                    ['title' => 'Cultural Experiences', 'text' => 'Ziyarat tours to historic and sacred sites in Makkah and Madinah.'],
                    ['title' => 'Custom Itineraries', 'text' => 'Packages tailored to your family, group size and budget.'],
                    ['title' => 'Exclusive Amenities', 'text' => 'Comfortable transport and hotels chosen for pilgrims.'],
                    ['title' => 'Accommodation', 'text' => 'Stays close to the Haram for easy access to prayer.'],
                ] as $service)
                    <div class="card-p p-6">
                        <div class="icon-badge mb-4">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="12" r="9"/><path d="M8 12l2.5 2.5L16 9"/></svg>
                        </div>
                        <h3 class="font-poppins font-semibold mb-2" style="color: var(--p-navy);">{{ $service['title'] }}</h3>
                        <p class="text-sm" style="color: var(--p-grey);">{{ $service['text'] }}</p>
                    </div>
                @endforeach
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
