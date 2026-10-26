@php
    $__settings = \App\Models\Setting::current();
    $__packageCategories = \App\Models\Package::query()
        ->where('status', 'published')
        ->select('category')
        ->distinct()
        ->orderBy('category')
        ->pluck('category');
    $__logoUrl = $__settings->site_logo
        ? \Illuminate\Support\Facades\Storage::url($__settings->site_logo)
        : (file_exists(public_path('images/al-bushra-logo.png')) ? asset('images/al-bushra-logo.png') : null);
    $__hasLogo = !empty($__logoUrl);
@endphp
<header class="sticky top-0 z-40 bg-white" style="box-shadow: 0 2px 12px rgba(26, 43, 72, 0.06);">
    <div class="font-poppins text-sm" style="background: #0b2e7f; color: #fff;">
        <div class="container-p flex min-h-11 items-center justify-between gap-3 py-2">
            <a href="tel:+919998707032" class="inline-flex items-center gap-2 text-xs font-medium sm:text-sm" aria-label="Call +91 9998707032">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M5 4h4l2 5-2.5 1.5a15 15 0 0 0 5 5L15 13l5 2v4c0 1.1-.9 2-2 2C9.7 21 3 14.3 3 6c0-1.1.9-2 2-2Z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span style="font-size: 18px; font-weight: 400;">+91 9998707032</span>
            </a>
        
            <button type="button" popovertarget="quote-modal" class="shrink-0 rounded-md px-2 py-1.5 text-[11px] font-semibold sm:px-4 sm:text-sm" style="background: var(--p-primary); color: #030303;">
                Get Umrah Package Quote
            </button>
        </div>
    </div>
    <div class="container-p flex items-center justify-between h-16 sm:h-20 gap-4 sm:gap-10">
        <a href="{{ route('home') }}" class="shrink-0 inline-flex items-center" aria-label="{{ $__settings->site_name ?? config('app.name') }}">
            @if ($__hasLogo)
                <img src="{{ $__logoUrl }}" alt="{{ $__settings->site_name ?? config('app.name') }}" class="h-14 sm:h-20 w-auto">
            @else
                <span class="font-poppins text-xl font-bold" style="color: var(--p-navy);">
                    {{ $__settings->site_name ?? config('app.name') }}
                </span>
            @endif
        </a>

        <nav class="hidden lg:flex items-center gap-10 font-poppins text-[15px] font-medium uppercase tracking-wide" style="color: var(--p-navy);">
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'is-active' : '' }}">Home</a>
            <a href="{{ route('content.show', 'about-us') }}" class="nav-link {{ request()->routeIs('content.show') && request()->route('slug') === 'about-us' ? 'is-active' : '' }}">About Us</a>
            <div class="relative group" data-dropdown>
                <button type="button" data-dropdown-toggle class="nav-link flex items-center gap-1 uppercase">
                    Packages
                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M1 3l4 4 4-4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <div class="absolute left-0 top-full pt-2 hidden group-hover:block min-w-[180px]">
                    <div class="bg-white rounded-lg py-2" style="box-shadow: 0 10px 30px -10px rgba(26,43,72,0.3); border: 1px solid var(--p-light-grey);">
                        <a href="{{ route('packages.index') }}" class="block px-4 py-2 nav-link font-semibold uppercase">All Packages</a>
                        @foreach ($__packageCategories as $__cat)
                            <a href="{{ route('packages.category', $__cat) }}" class="block px-4 py-2 nav-link font-semibold uppercase">{{ ucfirst($__cat) }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <a href="{{ route('faqs.index') }}" class="nav-link {{ request()->routeIs('faqs.index') ? 'is-active' : '' }}">FAQs</a>
            <a href="{{ route('blog.index') }}" class="nav-link {{ request()->routeIs('blog.index') ? 'is-active' : '' }}">Blog</a>
            <a href="{{ route('gallery.index') }}" class="nav-link {{ request()->routeIs('gallery.index') ? 'is-active' : '' }}">Gallery</a>
            <a href="{{ route('contact.index') }}" class="nav-link {{ request()->routeIs('contact.index') ? 'is-active' : '' }}">Contact Us</a>
        </nav>

        <div class="hidden lg:flex items-center gap-6 font-poppins text-[15px] font-medium shrink-0 tracking-wide">
            <!-- @auth
                <span style="color: var(--p-grey);">Hi, {{ Str::before(auth()->user()->name, ' ') }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link">Log out</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-link">Login</a>
                <a href="{{ route('register') }}" class="nav-link">Sign Up</a>
            @endauth -->
        </div>

        <button type="button" data-nav-toggle aria-expanded="false" class="lg:hidden p-2" aria-label="Toggle menu">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M3 6h18M3 12h18M3 18h18" stroke="#1A2B48" stroke-width="1.6" stroke-linecap="round"/></svg>
        </button>
    </div>

    <nav data-nav-menu class="hidden lg:hidden border-t font-poppins text-[15px] font-medium uppercase tracking-wide max-h-[calc(100vh-4rem)] overflow-y-auto" style="border-color: var(--p-light-grey);">
        <div class="container-p py-3 flex flex-col gap-1">
            <a href="{{ route('home') }}" class="nav-link py-2 {{ request()->routeIs('home') ? 'is-active' : '' }}">Home</a>
            <a href="{{ route('content.show', 'about-us') }}" class="nav-link py-2 {{ request()->routeIs('content.show') && request()->route('slug') === 'about-us' ? 'is-active' : '' }}">About Us</a>
            <a href="{{ route('packages.index') }}" class="nav-link py-2 {{ request()->routeIs('packages.index') ? 'is-active' : '' }}">Packages</a>
            @foreach ($__packageCategories as $__cat)
                <a href="{{ route('packages.category', $__cat) }}" class="nav-link py-2 pl-4 font-semibold">— {{ ucfirst($__cat) }}</a>
            @endforeach
            <a href="{{ route('faqs.index') }}" class="nav-link py-2 {{ request()->routeIs('faqs.index') ? 'is-active' : '' }}">FAQs</a>
            <a href="{{ route('blog.index') }}" class="nav-link py-2 {{ request()->routeIs('blog.index') ? 'is-active' : '' }}">Blog</a>
            <a href="{{ route('gallery.index') }}" class="nav-link py-2 {{ request()->routeIs('gallery.index') ? 'is-active' : '' }}">Gallery</a>
            <a href="{{ route('contact.index') }}" class="nav-link py-2 {{ request()->routeIs('contact.index') ? 'is-active' : '' }}">Contact Us</a>
            <div class="flex items-center gap-6 pt-3 mt-2 border-t normal-case" style="border-color: var(--p-light-grey);">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link">Log out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                    <a href="{{ route('register') }}" class="nav-link">Sign Up</a>
                @endauth
            </div>
        </div>
    </nav>

    <div id="quote-modal" popover="auto" aria-labelledby="quote-modal-title" @if (old('_quote_form')) open @endif class="m-auto w-[calc(100%-2rem)] max-w-lg rounded-2xl border-0 p-0 shadow-2xl">
        <div class="relative max-h-[90vh] overflow-y-auto p-6 sm:p-8">
            <button type="button" popovertarget="quote-modal" popovertargetaction="hide" aria-label="Close quote form" class="absolute right-4 top-4 rounded-full p-2 hover:bg-slate-100">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m6 6 12 12M18 6 6 18" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
            </button>
            <h2 id="quote-modal-title" class="pr-8 font-poppins text-2xl font-semibold" style="color: var(--p-navy);">Get Umrah Package Quote</h2>
            <p class="mt-2 text-sm" style="color: var(--p-grey);">Share your details and our team will get in touch with you.</p>

            @if (old('_quote_form') && $errors->any())
                <div class="mt-4 rounded-lg px-4 py-3 text-sm" style="background: #fff1f0; color: #b42318;">
                    @foreach ($errors->all() as $__quoteError)
                        <p>{{ $__quoteError }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}" class="mt-5 space-y-4">
                @csrf
                <input type="hidden" name="_quote_form" value="1">
                <div style="position: absolute; left: -10000px; width: 1px; height: 1px; overflow: hidden;" aria-hidden="true">
                    <label for="quote-website">Leave this field blank</label>
                    <input type="text" id="quote-website" name="website" tabindex="-1" autocomplete="off">
                </div>
                <div>
                    <label for="quote-name" class="field-label-p">Your name</label>
                    <input id="quote-name" name="name" type="text" value="{{ old('_quote_form') ? old('name') : '' }}" required maxlength="255" autocomplete="name" class="field-input-p">
                </div>
                <div>
                    <label for="quote-phone" class="field-label-p">Phone number</label>
                    <input id="quote-phone" name="phone" type="tel" value="{{ old('_quote_form') ? old('phone') : '' }}" required maxlength="50" autocomplete="tel" class="field-input-p">
                </div>
                <div>
                    <label for="quote-email" class="field-label-p">Email address</label>
                    <input id="quote-email" name="email" type="email" value="{{ old('_quote_form') ? old('email') : '' }}" required maxlength="255" autocomplete="email" class="field-input-p">
                </div>
                <div>
                    <label for="quote-message" class="field-label-p">Message</label>
                    <textarea id="quote-message" name="message" rows="3" maxlength="2000" class="field-input-p">{{ old('_quote_form') ? old('message', 'I would like to get an Umrah package quote.') : 'I would like to get an Umrah package quote.' }}</textarea>
                </div>
                <button type="submit" class="btn-brand w-full">Request a Quote</button>
            </form>
        </div>
    </div>
</header>