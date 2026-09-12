@props([
    'image',
    'title',
    'breadcrumb' => null,
    'alt' => null,
])

<section class="albushra-page-hero">

    <img
        src="{{ \Illuminate\Support\Facades\Storage::url($image) }}"
        alt="{{ $alt ?? $title }}"
        class="albushra-page-hero-img"
    >

    <div class="albushra-page-hero-overlay">

        <div class="albushra-page-hero-breadcrumb">
            <a href="{{ url('/') }}">Home</a>
            <span>›</span>
            <span>{{ $breadcrumb ?? $title }}</span>
        </div>

        <h1 class="albushra-page-hero-title">
            {{ $title }}
        </h1>

    </div>

</section>

<style>
    /* =========================================
   ALBUSHRA PAGE HERO
   ========================================= */

.albushra-page-hero {
    position: relative !important;
    display: block !important;
    width: 100% !important;
    height: auto !important;
    min-height: 0 !important;
    margin: 0 !important;
    padding: 0 !important;
    overflow: hidden !important;
}

.albushra-page-hero-img {
    position: relative !important;
    display: block !important;
    width: 100% !important;
    height: auto !important;
    min-height: 0 !important;
    margin: 0 !important;
    padding: 0 !important;
    object-fit: contain !important;
}

.albushra-page-hero-overlay {
    position: absolute !important;
    inset: 0 !important;
    width: 100% !important;
    height: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
    box-sizing: border-box !important;
}

/* Breadcrumb */
.albushra-page-hero-breadcrumb {
    position: absolute !important;
    top: 14px !important;
    left: 15px !important;

    display: flex !important;
    align-items: center !important;
    gap: 6px !important;

    margin: 0 !important;
    padding: 0 !important;

    font-size: 12px !important;
    line-height: 1.4 !important;
}

.albushra-page-hero-breadcrumb a {
    color: #17345f !important;
    text-decoration: none !important;
}

.albushra-page-hero-breadcrumb span {
    color: #17345f !important;
}

/* Title */
.albushra-page-hero-title {
    position: absolute !important;
    left: 35px !important;
    bottom: 150px !important;

    margin: 0 !important;
    padding: 0 !important;

    font-size: 40px !important;
    line-height: 1.2 !important;
    font-weight: 700 !important;

    color: #2099dc !important;
}


/* =========================================
   MOBILE
   ========================================= */

@media (max-width: 767px) {

    .albushra-page-hero {
        width: 100% !important;
        height: auto !important;
        min-height: 0 !important;
    }

    .albushra-page-hero-img {
        width: 100% !important;
        height: auto !important;
        object-fit: contain !important;
    }

    .albushra-page-hero-breadcrumb {
        top: 10px !important;
        left: 10px !important;
        font-size: 10px !important;
        gap: 5px !important;
    }

    .albushra-page-hero-title {
        left: 15px !important;
        bottom: 30px !important;
        font-size: 24px !important;
    }
}
</style>