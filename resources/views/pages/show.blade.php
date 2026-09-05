@extends('layouts.public')

@php
    $settings = \App\Models\Setting::current();
    $seoTitle = $page->meta_title ?: $page->title.' | '.($settings->site_name ?? config('app.name'));
    $seoDescription = $page->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($page->content ?? ''), 155);
@endphp

@section('content')
    <section class="py-10 border-b" style="background: var(--p-light-grey); border-color: var(--p-light-grey);">
        <div class="container-p">
            <p class="eyebrow">{{ $settings->site_name ?? config('app.name') }}</p>
            <h1 class="section-title !mb-0">{{ $page->title }}</h1>
        </div>
    </section>

    @if ($page->featured_image)
        <div class="container-p max-w-4xl mx-auto mt-8 sm:mt-10">
            <img src="{{ \Illuminate\Support\Facades\Storage::url($page->featured_image) }}"
                 alt="{{ $page->title }}"
                 class="w-full h-auto object-cover"
                 style="border-radius: var(--radius-md); border: 1px solid var(--color-border);">
        </div>
    @endif

    <section class="py-12 sm:py-16">
        <div class="container-p max-w-3xl mx-auto prose-p text-sm leading-relaxed" style="color: var(--p-grey);">
            {!! $page->content !!}
        </div>
    </section>
@endsection
