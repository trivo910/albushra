<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/public.css', 'resources/js/public.js'])
    @php($__settings = \App\Models\Setting::current())
    @if ($__settings->ga_code)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $__settings->ga_code }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $__settings->ga_code }}');
        </script>
    @endif
    @if ($__settings->gtm_code)
        <script>
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','{{ $__settings->gtm_code }}');
        </script>
    @endif
    @stack('head')
</head>
<body class="antialiased bg-white">
    @if ($__settings->gtm_code)
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $__settings->gtm_code }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif

    @include('partials.header')

    <main>
        @if (session('success'))
            <div class="container-p mt-4">
                <div class="rounded-lg px-4 py-3 text-sm font-poppins" style="background: #e9f8ee; color: #1e7a46; border: 1px solid #bfe8cd;">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    @include('partials.footer')
    @include('partials.whatsapp-widget')

    <div data-lightbox class="hidden fixed inset-0 z-[60] bg-black/90 items-center justify-center">
        <button type="button" data-lightbox-close aria-label="Close" class="absolute top-5 right-5 text-white/80 hover:text-white">
            <svg width="28" height="28" viewBox="0 0 24 24"><path d="M4 4l16 16M20 4L4 20" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
        </button>
        <button type="button" data-lightbox-prev aria-label="Previous" class="absolute left-4 top-1/2 -translate-y-1/2 text-white/80 hover:text-white">
            <svg width="32" height="32" viewBox="0 0 24 24"><path d="M15 5l-7 7 7 7" stroke="currentColor" stroke-width="1.6" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        <img data-lightbox-img src="" alt="" class="max-h-[85vh] max-w-[85vw] object-contain rounded">
        <button type="button" data-lightbox-next aria-label="Next" class="absolute right-4 top-1/2 -translate-y-1/2 text-white/80 hover:text-white">
            <svg width="32" height="32" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke="currentColor" stroke-width="1.6" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
    </div>

    @stack('scripts')
</body>
</html>
