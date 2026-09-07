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
<header class="sticky top-0 z-40 bg-white" style="box-shadow: 0 2px 12px rgba(26,43,72,0.06);">
    <div class="container-p flex items-center justify-between h-20 gap-10">
        <a href="{{ route('home') }}" class="shrink-0 inline-flex items-center" aria-label="{{ $__settings->site_name ?? config('app.name') }}">
            @if ($__hasLogo)
                <img src="{{ $__logoUrl }}" alt="{{ $__settings->site_name ?? config('app.name') }}" class="h-20 w-auto">
            @else
                <span class="font-poppins text-xl font-bold" style="color: var(--p-navy);">
                    {{ $__settings->site_name ?? config('app.name') }}
                </span>
            @endif
        </a>

        <nav class="hidden lg:flex items-center gap-10 font-poppins text-[15px] font-medium uppercase tracking-wide" style="color: var(--p-navy);">
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'is-active' : '' }}">Home</a>
            <a href="{{ route('pages.show', 'about-us') }}" class="nav-link {{ request()->routeIs('pages.show') && request()->route('about-us') ? 'is-active' : '' }}">About Us</a>
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
            @auth
                <span style="color: var(--p-grey);">Hi, {{ Str::before(auth()->user()->name, ' ') }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link">Log out</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-link">Login</a>
                <a href="{{ route('register') }}" class="nav-link">Sign Up</a>
            @endauth
        </div>

        <button type="button" data-nav-toggle aria-expanded="false" class="lg:hidden p-2" aria-label="Toggle menu">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M3 6h18M3 12h18M3 18h18" stroke="#1A2B48" stroke-width="1.6" stroke-linecap="round"/></svg>
        </button>
    </div>

    <nav data-nav-menu class="hidden lg:hidden border-t font-poppins text-[15px] font-medium uppercase tracking-wide" style="border-color: var(--p-light-grey);">
        <div class="container-p py-3 flex flex-col gap-1">
            <a href="{{ route('home') }}" class="nav-link py-2 {{ request()->routeIs('home') ? 'is-active' : '' }}">Home</a>
            <a href="{{ route('pages.show', 'about-us') }}" class="nav-link py-2 {{ request()->routeIs('pages.show') && request()->route('about-us') ? 'is-active' : '' }}">About Us</a>
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
</header>
