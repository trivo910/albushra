@extends('layouts.public')

@php
    $seoTitle = 'Gallery | '.(\App\Models\Setting::current()->site_name ?? config('app.name'));
    $seoDescription = 'Photos from our pilgrims\' Hajj and Umrah journeys.';
@endphp

@section('content')
    <section class="py-10 border-b" style="background: var(--p-light-grey); border-color: var(--p-light-grey);">
        <div class="container-p">
            <p class="eyebrow">Moments</p>
            <h1 class="section-title !mb-0">Gallery</h1>
        </div>
    </section>

    <section class="py-12 sm:py-16">
        <div class="container-p">
            @if ($images->isEmpty())
                <div class="text-center py-16">
                    <p class="font-poppins font-medium mb-1" style="color: var(--p-navy);">No photos yet</p>
                    <p class="text-sm" style="color: var(--p-grey);">Check back soon for photos from our pilgrims' journeys.</p>
                </div>
            @else
                <div data-lightbox-trigger class="columns-2 sm:columns-3 lg:columns-4 gap-4 [column-fill:_balance]">
                    @foreach ($images as $image)
                        <a href="{{ \Illuminate\Support\Facades\Storage::url($image->image_path) }}" class="block mb-4 rounded-xl overflow-hidden break-inside-avoid">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($image->image_path) }}" alt="{{ $image->caption ?? 'Gallery photo' }}" class="w-full h-auto hover:opacity-90 transition-opacity">
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
