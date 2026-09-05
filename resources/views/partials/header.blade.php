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
    <div class="container-p flex items-center justify-between h-20">
        <a href="{{ route('home') }}" class="shrink-0 inline-flex items-center" aria-label="{{ $__settings->site_name ?? config('app.name') }}">
            @if ($__hasLogo)
                <img src="{{ $__logoUrl }}" alt="{{ $__settings->site_name ?? config('app.name') }}" class="h-14 w-auto">
                <span class="sr-only">{{ $__settings->site_name ?? config('app.name') }}</span>
            @else
                <span class="font-poppins text-xl font-bold" style="color: var(--p-navy);">
                    {{ $__settings->site_name ?? config('app.name') }}
                </span>
            @endif
        </a>

        <nav class="hidden lg:flex items-center gap-7 font-poppins text-sm font-medium" style="color: var(--p-navy);">
            <a href="{{ route('home') }}" class="hover:opacity-70 {{ request()->routeIs('home') ? 'font-semibold' : '' }}">Home</a>
            <a href="{{ route('pages.show', 'about-us') }}" class="hover:opacity-70">About Us</a>
            <div class="relative group" data-dropdown>
                <button type="button" data-dropdown-toggle class="flex items-center gap-1 hover:opacity-70">
                    Packages
                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M1 3l4 4 4-4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <div class="absolute left-0 top-full pt-2 hidden group-hover:block min-w-[180px]">
                    <div class="bg-white rounded-lg py-2" style="box-shadow: 0 10px 30px -10px rgba(26,43,72,0.3); border: 1px solid var(--p-light-grey);">
                        <a href="{{ route('packages.index') }}" class="block px-4 py-2 hover:opacity-70 font-semibold" style="color: var(--p-navy);">All Packages</a>
                        @foreach ($__packageCategories as $__cat)
                            <a href="{{ route('packages.category', $__cat) }}" class="block px-4 py-2 hover:opacity-70 font-semibold" style="color: var(--p-navy);">{{ ucfirst($__cat) }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <a href="{{ route('faqs.index') }}" class="hover:opacity-70">FAQs</a>
            <a href="{{ route('blog.index') }}" class="hover:opacity-70">Blog</a>
            <a href="{{ route('gallery.index') }}" class="hover:opacity-70">Gallery</a>
            <a href="{{ route('contact.index') }}" class="hover:opacity-70">Contact Us</a>
        </nav>

        <div class="hidden lg:flex items-center gap-4 font-poppins text-sm font-medium shrink-0">
            @auth
                <span style="color: var(--p-grey);">Hi, {{ Str::before(auth()->user()->name, ' ') }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="hover:opacity-70" style="color: var(--p-navy);">Log out</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:opacity-70" style="color: var(--p-navy);">Login</a>
                <a href="{{ route('register') }}" class="btn-brand !py-2 !px-5">Sign Up</a>
            @endauth
        </div>

        <button type="button" data-nav-toggle aria-expanded="false" class="lg:hidden p-2" aria-label="Toggle menu">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M3 6h18M3 12h18M3 18h18" stroke="#1A2B48" stroke-width="1.6" stroke-linecap="round"/></svg>
        </button>
    </div>

    <nav data-nav-menu class="hidden lg:hidden border-t font-poppins text-sm font-medium" style="border-color: var(--p-light-grey);">
        <div class="container-p py-3 flex flex-col gap-1">
            <a href="{{ route('home') }}" class="py-2">Home</a>
            <a href="{{ route('pages.show', 'about-us') }}" class="py-2">About Us</a>
            <a href="{{ route('packages.index') }}" class="py-2">Packages</a>
            @foreach ($__packageCategories as $__cat)
                <a href="{{ route('packages.category', $__cat) }}" class="py-2 pl-4 font-semibold" style="color: var(--p-navy);">— {{ ucfirst($__cat) }}</a>
            @endforeach
            <a href="{{ route('faqs.index') }}" class="py-2">FAQs</a>
            <a href="{{ route('blog.index') }}" class="py-2">Blog</a>
            <a href="{{ route('gallery.index') }}" class="py-2">Gallery</a>
            <a href="{{ route('contact.index') }}" class="py-2">Contact Us</a>
            <div class="flex items-center gap-4 pt-3 mt-2 border-t" style="border-color: var(--p-light-grey);">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Log out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}" class="btn-brand !py-2 !px-5">Sign Up</a>
                @endauth
            </div>
        </div>
    </nav>
</header>
