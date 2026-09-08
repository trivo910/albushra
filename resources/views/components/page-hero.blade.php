@props([
    'image',
    'title',
    'breadcrumb' => null,
    'alt' => null,
])

<section class="page-hero">

    <img
        src="{{ \Illuminate\Support\Facades\Storage::url($image) }}"
        alt="{{ $alt ?? $title }}"
        class="page-hero-image"
    >

    <div class="page-hero-content">

        <div class="page-hero-breadcrumb">
            <a href="{{ url('/') }}">Home</a>
            <span>•</span>
            <span>{{ $breadcrumb ?? $title }}</span>
        </div>

        <h1>{{ $title }}</h1>

    </div>

</section>
