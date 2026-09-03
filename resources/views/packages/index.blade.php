@extends('layouts.public')

@php
    $seoTitle = $category === 'hajj'
        ? 'Hajj Packages | '.(\App\Models\Setting::current()->site_name ?? config('app.name'))
        : 'Hajj & Umrah Packages | '.(\App\Models\Setting::current()->site_name ?? config('app.name'));
    $seoDescription = $category === 'hajj'
        ? 'Browse our Hajj packages with visa, flights, hotels and guided services included.'
        : 'Browse our full range of Hajj and Umrah packages with visa, flights, hotels and guided services included.';
@endphp

@section('content')
    <section class="py-10 border-b" style="background: var(--p-light-grey); border-color: var(--p-light-grey);">
        <div class="container-p">
            <p class="eyebrow">{{ $category === 'hajj' ? 'Hajj' : 'Packages' }}</p>
            <h1 class="section-title !mb-0">{{ $category === 'hajj' ? 'Our Hajj Packages' : 'Our Hajj & Umrah Packages' }}</h1>
        </div>
    </section>

    <section class="py-12 sm:py-16">
        <div class="container-p">
            @if ($packages->isEmpty())
                <div class="text-center py-16">
                    <p class="font-poppins font-medium mb-1" style="color: var(--p-navy);">No packages available yet</p>
                    <p class="text-sm" style="color: var(--p-grey);">Please check back soon, or contact us for the latest offers.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                    @foreach ($packages as $package)
                        @include('packages._card', ['package' => $package])
                    @endforeach
                </div>
                {{ $packages->links() }}
            @endif
        </div>
    </section>
@endsection
