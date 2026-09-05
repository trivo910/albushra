@extends('layouts.public')

@php
    $settings = \App\Models\Setting::current();
    $seoTitle = $blog->meta_title ?: $blog->title.' | '.($settings->site_name ?? config('app.name'));
    $seoDescription = $blog->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($blog->content ?? ''), 155);
    $ogImage = $blog->featured_image ? \Illuminate\Support\Facades\Storage::url($blog->featured_image) : null;
    $shareUrl = urlencode(route('blog.show', $blog));
    $shareTitle = urlencode($blog->title);
@endphp

@section('content')
    <div class="border-b" style="border-color: var(--p-light-grey);">
        <div class="container-p py-3 text-sm" style="color: var(--p-grey);">
            <a href="{{ route('home') }}" class="hover:opacity-70">Home</a>
            <span class="mx-1">/</span>
            <a href="{{ route('blog.index') }}" class="hover:opacity-70">Blog</a>
            <span class="mx-1">/</span>
            <span style="color: var(--p-navy);">{{ $blog->title }}</span>
        </div>
    </div>

    <article class="container-p max-w-3xl mx-auto py-10">
        <div class="text-xs mb-3" style="color: var(--p-primary);">{{ $blog->published_at?->format('d M Y') }}</div>
        <h1 class="font-poppins text-2xl sm:text-3xl font-bold mb-6" style="color: var(--p-navy);">{{ $blog->title }}</h1>

        @if ($blog->featured_image)
            <img src="{{ \Illuminate\Support\Facades\Storage::url($blog->featured_image) }}" alt="{{ $blog->featured_image_alt ?: $blog->title }}" class="w-full h-auto rounded-xl mb-8">
        @endif

        <div class="prose-p text-sm leading-relaxed mb-10" style="color: var(--p-grey);">
            {!! $blog->content !!}
        </div>

        <div class="flex items-center gap-3 py-6" style="border-top: 1px solid var(--p-light-grey); border-bottom: 1px solid var(--p-light-grey);">
            <span class="text-sm font-medium" style="color: var(--p-navy);">Share:</span>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" rel="noopener" aria-label="Share on Facebook"
               class="w-9 h-9 rounded-full flex items-center justify-center" style="background: var(--p-light-grey); color: var(--p-navy);">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M13.5 21v-8h2.7l.4-3.1h-3.1V8c0-.9.25-1.5 1.55-1.5H16.7V3.7C16.4 3.65 15.4 3.55 14.2 3.55c-2.4 0-4 1.45-4 4.15V10H7.5v3.1h2.7v8h3.3z"/></svg>
            </a>
            <a href="https://twitter.com/share?url={{ $shareUrl }}&text={{ $shareTitle }}" target="_blank" rel="noopener" aria-label="Share on Twitter"
               class="w-9 h-9 rounded-full flex items-center justify-center" style="background: var(--p-light-grey); color: var(--p-navy);">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4l16 16M20 4L4 20"/></svg>
            </a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $shareUrl }}&title={{ $shareTitle }}" target="_blank" rel="noopener" aria-label="Share on LinkedIn"
               class="w-9 h-9 rounded-full flex items-center justify-center" style="background: var(--p-light-grey); color: var(--p-navy);">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M4.98 3.5C4.98 4.88 3.87 6 2.5 6S0 4.88 0 3.5 1.11 1 2.48 1s2.5 1.12 2.5 2.5zM.24 8.25h4.5V23h-4.5V8.25zM8.5 8.25h4.31v2.02h.06c.6-1.13 2.07-2.33 4.26-2.33 4.56 0 5.4 3 5.4 6.9V23h-4.5v-6.6c0-1.57-.03-3.6-2.2-3.6-2.2 0-2.53 1.72-2.53 3.49V23h-4.5V8.25z"/></svg>
            </a>
        </div>

        @if ($related->isNotEmpty())
            <div class="mt-12">
                <h2 class="section-title !text-xl">Related Posts</h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @foreach ($related as $item)
                        <a href="{{ route('blog.show', $item) }}" class="card-p group">
                            <div class="h-32 overflow-hidden" style="background: var(--p-light-grey);">
                                @if ($item->featured_image)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($item->featured_image) }}" alt="{{ $item->featured_image_alt ?: $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="text-sm font-medium leading-snug group-hover:opacity-70" style="color: var(--p-navy);">{{ $item->title }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </article>
@endsection
