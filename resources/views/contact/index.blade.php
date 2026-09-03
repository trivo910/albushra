@extends('layouts.public')

@php
    $settings = \App\Models\Setting::current();
    $seoTitle = 'Contact Us | '.($settings->site_name ?? config('app.name'));
    $seoDescription = 'Get in touch with '.($settings->site_name ?? config('app.name')).' for Hajj and Umrah package enquiries.';
@endphp

@section('content')
    <section class="py-10 border-b" style="background: var(--p-light-grey); border-color: var(--p-light-grey);">
        <div class="container-p">
            <p class="eyebrow">Get In Touch</p>
            <h1 class="section-title !mb-0">Contact Us</h1>
        </div>
    </section>

    <section class="py-12 sm:py-16">
        <div class="container-p grid grid-cols-1 lg:grid-cols-2 gap-10">
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
                        <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Phone No*" required class="field-input-p">
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

            <div>
                <h2 class="font-poppins font-semibold text-xl mb-5" style="color: var(--p-navy);">Contact Information</h2>
                <ul class="space-y-4 text-sm mb-8" style="color: var(--p-grey);">
                    @if ($settings->address)
                        <li class="flex gap-3">
                            <svg class="shrink-0 mt-0.5" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--p-primary)" stroke-width="1.8"><path d="M12 21s7-6.5 7-12a7 7 0 10-14 0c0 5.5 7 12 7 12z"/><circle cx="12" cy="9" r="2.5"/></svg>
                            <span>{{ $settings->address }}</span>
                        </li>
                    @endif
                    @if ($settings->phone)
                        <li class="flex gap-3 items-center">
                            <svg class="shrink-0" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--p-primary)" stroke-width="1.8"><path d="M4 4h4l2 5-2.5 1.5a11 11 0 005 5L14 13l5 2v4a2 2 0 01-2 2A15 15 0 014 6a2 2 0 012-2z"/></svg>
                            <a href="tel:{{ preg_replace('/\s+/', '', $settings->phone) }}" class="hover:opacity-70">{{ $settings->phone }}</a>
                        </li>
                    @endif
                    @if ($settings->email)
                        <li class="flex gap-3 items-center">
                            <svg class="shrink-0" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--p-primary)" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
                            <a href="mailto:{{ $settings->email }}" class="hover:opacity-70">{{ $settings->email }}</a>
                        </li>
                    @endif
                </ul>

                @if ($settings->map_embed)
                    <div class="rounded-xl overflow-hidden">
                        {!! $settings->map_embed !!}
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
