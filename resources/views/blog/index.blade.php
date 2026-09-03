@extends('layouts.public')

@php
    $seoTitle = 'Blog | '.(\App\Models\Setting::current()->site_name ?? config('app.name'));
    $seoDescription = 'Travel guides, tips and updates for pilgrims planning Hajj and Umrah.';
@endphp

@section('content')
    <section class="py-10 border-b" style="background: var(--p-light-grey); border-color: var(--p-light-grey);">
        <div class="container-p">
            <p class="eyebrow">Blog</p>
            <h1 class="section-title !mb-0">Travel Guides &amp; Updates</h1>
        </div>
    </section>

    <section class="py-12 sm:py-16">
        <div class="container-p">
            @if ($blogs->isEmpty())
                <div class="text-center py-16">
                    <p class="font-poppins font-medium mb-1" style="color: var(--p-navy);">No blog posts yet</p>
                    <p class="text-sm" style="color: var(--p-grey);">Check back soon for travel guides and updates.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                    @foreach ($blogs as $blog)
                        <a href="{{ route('blog.show', $blog) }}" class="card-p flex flex-col group">
                            <div class="h-48 overflow-hidden shrink-0" style="background: var(--p-light-grey);">
                                @if ($blog->featured_image)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @endif
                            </div>
                            <div class="p-5">
                                <div class="text-xs mb-2" style="color: var(--p-primary);">{{ $blog->published_at?->format('d M Y') }}</div>
                                <h2 class="font-poppins font-semibold mb-2 leading-snug group-hover:opacity-70" style="color: var(--p-navy);">{{ $blog->title }}</h2>
                                <p class="text-sm leading-relaxed" style="color: var(--p-grey);">{{ Str::limit(strip_tags($blog->content), 110) }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
                {{ $blogs->links() }}
            @endif
        </div>
    </section>
@endsection
