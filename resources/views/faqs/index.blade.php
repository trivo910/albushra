@extends('layouts.public')

@php
    $seoTitle = 'FAQs | '.(\App\Models\Setting::current()->site_name ?? config('app.name'));
    $seoDescription = 'Frequently asked questions about booking Hajj and Umrah packages.';
@endphp

@section('content')
    <section class="py-10 border-b" style="background: var(--p-light-grey); border-color: var(--p-light-grey);">
        <div class="container-p">
            <p class="eyebrow">Support</p>
            <h1 class="section-title !mb-0">Frequently Asked Questions</h1>
        </div>
    </section>

    <section class="py-12 sm:py-16">
        <div class="container-p max-w-3xl mx-auto">
            @if ($faqs->isEmpty())
                <div class="text-center py-16">
                    <p class="font-poppins font-medium mb-1" style="color: var(--p-navy);">No FAQs published yet</p>
                    <p class="text-sm" style="color: var(--p-grey);">Have a question? <a href="{{ route('contact.index') }}" style="color: var(--p-primary);">Get in touch</a>.</p>
                </div>
            @else
                <div>
                    @foreach ($faqs as $faq)
                        <details class="accordion-p" style="border-bottom: 1px solid var(--p-light-grey);" @if ($loop->first) open @endif>
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
            @endif
        </div>
    </section>
@endsection
