@extends('layouts.public')

@php
    $settings = \App\Models\Setting::current();
    $seoTitle = 'Contact Us | '.($settings->site_name ?? config('app.name'));
    $seoDescription = 'Get in touch with '.($settings->site_name ?? config('app.name')).' for Hajj and Umrah package enquiries.';
@endphp

@section('content')
    <section class="py-10 border-b" style="background: var(--p-light-grey); border-color: var(--p-light-grey);">
        <div class="container-p">
            <nav class="text-xs font-poppins mb-2" style="color: var(--p-grey);" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:opacity-70">Home</a>
                <span class="mx-2">/</span>
                <span style="color: var(--p-navy);">Contact Us</span>
            </nav>
            <h1 class="section-title !mb-0">Contact Us</h1>
        </div>
    </section>

    <section class="py-12 sm:py-16">
        <div class="container-p grid grid-cols-1 lg:grid-cols-2 gap-10">
            <div>
                <h2 class="font-poppins font-semibold text-xl mb-5" style="color: var(--p-navy);">Contact Information</h2>

                <ul class="space-y-5 text-sm" style="color: var(--p-grey);">
                    <li class="flex gap-3">
                        <svg class="shrink-0 mt-0.5" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--p-primary)" stroke-width="1.8"><path d="M12 21s7-6.5 7-12a7 7 0 10-14 0c0 5.5 7 12 7 12z"/><circle cx="12" cy="9" r="2.5"/></svg>
                        <div class="space-y-2">
                            <div>
                                <div class="text-xs font-semibold uppercase tracking-wide mb-1" style="color: var(--p-navy);">Head Office</div>
                                @if ($settings->address)
                                    <div>{{ $settings->address }}</div>
                                @else
                                    <div class="italic">No head office address set.</div>
                                @endif
                            </div>
                            @if ($settings->branch_address)
                                <div>
                                    <div class="text-xs font-semibold uppercase tracking-wide mb-1" style="color: var(--p-navy);">Branch Office</div>
                                    <div>{{ $settings->branch_address }}</div>
                                </div>
                            @endif
                        </div>
                    </li>

                    @if ($settings->phone || $settings->phone_secondary)
                        <li class="flex gap-3">
                            <svg class="shrink-0 mt-0.5" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--p-primary)" stroke-width="1.8"><path d="M4 4h4l2 5-2.5 1.5a11 11 0 005 5L14 13l5 2v4a2 2 0 01-2 2A15 15 0 014 6a2 2 0 012-2z"/></svg>
                            <div>
                                <div class="text-xs font-semibold uppercase tracking-wide mb-1" style="color: var(--p-navy);">Phone Numbers</div>
                                @if ($settings->phone)
                                    <div><a href="tel:{{ preg_replace('/\s+/', '', $settings->phone) }}" class="hover:opacity-70">{{ $settings->phone }}</a></div>
                                @endif
                                @if ($settings->phone_secondary)
                                    <div><a href="tel:{{ preg_replace('/\s+/', '', $settings->phone_secondary) }}" class="hover:opacity-70">{{ $settings->phone_secondary }}</a></div>
                                @endif
                            </div>
                        </li>
                    @endif

                    @if ($settings->landline_1 || $settings->landline_2)
                        <li class="flex gap-3">
                            <svg class="shrink-0 mt-0.5" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--p-primary)" stroke-width="1.8"><path d="M4 4h4l2 5-2.5 1.5a11 11 0 005 5L14 13l5 2v4a2 2 0 01-2 2A15 15 0 014 6a2 2 0 012-2z"/></svg>
                            <div>
                                <div class="text-xs font-semibold uppercase tracking-wide mb-1" style="color: var(--p-navy);">Landline Numbers</div>
                                @if ($settings->landline_1)
                                    <div><a href="tel:{{ preg_replace('/\s+/', '', $settings->landline_1) }}" class="hover:opacity-70">{{ $settings->landline_1 }}</a></div>
                                @endif
                                @if ($settings->landline_2)
                                    <div><a href="tel:{{ preg_replace('/\s+/', '', $settings->landline_2) }}" class="hover:opacity-70">{{ $settings->landline_2 }}</a></div>
                                @endif
                            </div>
                        </li>
                    @endif

                    @if ($settings->email)
                        <li class="flex gap-3 items-start">
                            <svg class="shrink-0 mt-0.5" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--p-primary)" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
                            <div>
                                <div class="text-xs font-semibold uppercase tracking-wide mb-1" style="color: var(--p-navy);">Mail Us</div>
                                <a href="mailto:{{ $settings->email }}" class="hover:opacity-70">{{ $settings->email }}</a>
                            </div>
                        </li>
                    @endif

                    @if ($settings->facebook_url || $settings->instagram_url || $settings->twitter_url || $settings->youtube_url)
                        <li class="flex gap-3 items-start">
                            <svg class="shrink-0 mt-0.5" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--p-primary)" stroke-width="1.8"><path d="M16 8a6 6 0 016 6v5h-4v-5a2 2 0 00-4 0v5h-4v-5a6 6 0 016-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                            <div>
                                <div class="text-xs font-semibold uppercase tracking-wide mb-2" style="color: var(--p-navy);">Follow Us</div>
                                <div class="flex items-center gap-2 flex-wrap">
                                    @if ($settings->facebook_url)
                                        <a href="{{ $settings->facebook_url }}" target="_blank" rel="noopener" aria-label="Facebook" class="w-9 h-9 inline-flex items-center justify-center rounded-full border hover:opacity-80" style="border-color: var(--p-primary); color: var(--p-primary);">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12a10 10 0 10-11.56 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56V12h2.77l-.44 2.89h-2.33v6.99A10 10 0 0022 12z"/></svg>
                                        </a>
                                    @endif
                                    @if ($settings->instagram_url)
                                        <a href="{{ $settings->instagram_url }}" target="_blank" rel="noopener" aria-label="Instagram" class="w-9 h-9 inline-flex items-center justify-center rounded-full border hover:opacity-80" style="border-color: var(--p-primary); color: var(--p-primary);">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor"/></svg>
                                        </a>
                                    @endif
                                    @if ($settings->twitter_url)
                                        <a href="{{ $settings->twitter_url }}" target="_blank" rel="noopener" aria-label="Twitter / X" class="w-9 h-9 inline-flex items-center justify-center rounded-full border hover:opacity-80" style="border-color: var(--p-primary); color: var(--p-primary);">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2H21l-6.51 7.44L22 22h-6.79l-4.74-6.21L4.97 22H2.21l6.96-7.96L2 2h6.94l4.29 5.67L18.244 2zm-2.38 18h1.86L7.27 4H5.32l10.544 16z"/></svg>
                                        </a>
                                    @endif
                                    @if ($settings->youtube_url)
                                        <a href="{{ $settings->youtube_url }}" target="_blank" rel="noopener" aria-label="YouTube" class="w-9 h-9 inline-flex items-center justify-center rounded-full border hover:opacity-80" style="border-color: var(--p-primary); color: var(--p-primary);">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M23.5 6.2a3 3 0 00-2.1-2.1C19.5 3.6 12 3.6 12 3.6s-7.5 0-9.4.5A3 3 0 00.5 6.2C0 8.1 0 12 0 12s0 3.9.5 5.8a3 3 0 002.1 2.1c1.9.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 002.1-2.1c.5-1.9.5-5.8.5-5.8s0-3.9-.5-5.8zM9.6 15.6V8.4l6.2 3.6-6.2 3.6z"/></svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endif
                </ul>

                @if ($settings->map_embed)
                    <div class="rounded-xl overflow-hidden mt-8">
                        {!! $settings->map_embed !!}
                    </div>
                @endif
            </div>

            <div>
                <h2 class="font-poppins font-semibold text-xl mb-5" style="color: var(--p-navy);">Contact Form</h2>

                @if ($errors->any())
                    <div class="rounded-lg px-4 py-3 text-sm mb-4" style="background: #fbeae9; color: #b3261e;">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" class="space-y-4">
                    @csrf
                    @include('partials.honeypot')
                    <div>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Your Name*" required class="field-input-p">
                    </div>
                    <div>
                        <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Phone No" class="field-input-p">
                    </div>
                    <div>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Your Email Address*" required class="field-input-p">
                    </div>
                    <div>
                        <textarea name="message" rows="5" placeholder="Your Message*" required class="field-input-p">{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="btn-brand">Send</button>
                </form>
            </div>
        </div>
    </section>
@endsection
