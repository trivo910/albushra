<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo')
    @if (config('services.recaptcha.enabled') && config('services.recaptcha.site_key'))
        <script src="https://www.google.com/recaptcha/api.js?render={{ urlencode(config('services.recaptcha.site_key')) }}" async defer></script>
        <script nonce="{{ request()->attributes->get('cspNonce') }}">
            document.querySelectorAll('input[name="recaptcha_token"]').forEach((tokenInput) => {
                const form = tokenInput.form;

                if (!form) {
                    return;
                }

                form.addEventListener('submit', async (event) => {
                    if (form.dataset.recaptchaSubmitting === 'true') {
                        delete form.dataset.recaptchaSubmitting;
                        return;
                    }

                    event.preventDefault();
                    const error = form.querySelector('[data-recaptcha-error]');
                    if (error) error.hidden = true;

                    try {
                        if (!window.grecaptcha) {
                            throw new Error('reCAPTCHA is not available');
                        }

                        const action = tokenInput.dataset.recaptchaAction;
                        const token = await new Promise((resolve, reject) => {
                            window.grecaptcha.ready(() => {
                                window.grecaptcha.execute(@json(config('services.recaptcha.site_key')), { action })
                                    .then(resolve, reject);
                            });
                        });

                        tokenInput.value = token;
                        form.dataset.recaptchaSubmitting = 'true';
                        form.requestSubmit(event.submitter || undefined);
                    } catch {
                        if (error) error.hidden = false;
                    }
                });
            });
        </script>
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> -->
    @vite(['resources/css/public.css', 'resources/js/public.js'])
    @php($__settings = \App\Models\Setting::current())
    @php($__gaCode = $__settings->ga_code ?: 'G-JWT8SV2Z1H')
    @php($__gtmCode = $__settings->gtm_code ?: 'GTM-PB7GPVL3')
    @if ($__gaCode)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $__gaCode }}"></script>
        <script nonce="{{ request()->attributes->get('cspNonce') }}">
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', @json($__gaCode));
            gtag('config', 'AW-18521381824');
        </script>
    @endif
    <script nonce="{{ request()->attributes->get('cspNonce') }}">
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer',@json($__gtmCode));
    </script>
    @stack('head')
</head>
<body class="antialiased bg-white">
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $__gtmCode }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

    @include('partials.header')

    @if (session('header_form_success') || (session('success') && ! request()->routeIs('contact.index') && ! session('hajj_2027_enquiry_success')))
        <div class="header-form-success" role="status" aria-live="polite" data-dismiss-after="3000" style="position: fixed; top: 50%; right: 1rem; z-index: 99999; width: min(24rem, calc(100% - 2rem)); box-sizing: border-box; padding: 0.75rem 1rem; border: 1px solid #bfe8cd; border-radius: 0.5rem; background: #e9f8ee; color: #1e7a46; box-shadow: 0 10px 25px rgba(26, 43, 72, 0.2); font-family: Poppins, sans-serif; font-size: 0.875rem; line-height: 1.5; transform: translateY(-50%); transition: opacity 200ms ease, transform 200ms ease;">
            {{ session('header_form_success') ?? session('success') }}
        </div>
    @endif

    <main>
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
