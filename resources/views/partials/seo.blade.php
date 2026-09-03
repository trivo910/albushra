@php
    $__settings = \App\Models\Setting::current();
    $__title = $seoTitle ?? $__settings->meta_title ?? config('app.name');
    $__description = $seoDescription ?? $__settings->meta_description ?? '';
    $__canonical = $canonical ?? url()->current();
    $__image = $ogImage ?? null;
@endphp
<title>{{ $__title }}</title>
<meta name="description" content="{{ $__description }}">
<link rel="canonical" href="{{ $__canonical }}">
<meta property="og:site_name" content="{{ $__settings->site_name ?? config('app.name') }}">
<meta property="og:title" content="{{ $__title }}">
<meta property="og:description" content="{{ $__description }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ $__canonical }}">
@if ($__image)
    <meta property="og:image" content="{{ $__image }}">
@endif
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $__title }}">
<meta name="twitter:description" content="{{ $__description }}">
