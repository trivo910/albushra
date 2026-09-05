@php
    $__settings = \App\Models\Setting::current();
    $__trending = \App\Models\Package::where('status', 'published')->latest()->limit(6)->get();
    $__logoUrl = $__settings->site_logo
        ? \Illuminate\Support\Facades\Storage::url($__settings->site_logo)
        : (file_exists(public_path('images/al-bushra-logo.png')) ? asset('images/al-bushra-logo.png') : null);
    $__hasLogo = !empty($__logoUrl);
@endphp
<footer class="font-poppins" style="background: var(--p-navy); color: #c7d0dc;">
    <div class="container-p py-14 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
        <div>
            <a href="{{ route('home') }}" class="inline-flex items-center mb-3" aria-label="{{ $__settings->site_name ?? config('app.name') }}">
                @if ($__hasLogo)
                    <img src="{{ $__logoUrl }}" alt="{{ $__settings->site_name ?? config('app.name') }}" class="h-14 w-auto rounded-md p-1" style="background: #ffffff;">
                    <span class="sr-only">{{ $__settings->site_name ?? config('app.name') }}</span>
                @else
                    <div class="text-lg font-bold text-white">{{ $__settings->site_name ?? config('app.name') }}</div>
                @endif
            </a>
            <p class="text-sm leading-relaxed mb-5" style="color: #93a0b3;">
                Your trusted companion on the most sacred journeys of your life — Hajj and Umrah, handled with sincerity and care.
            </p>
            <div class="flex items-center gap-3">
                @if ($__settings->facebook_url)
                    <a href="{{ $__settings->facebook_url }}" target="_blank" rel="noopener" aria-label="Facebook"
                       class="w-9 h-9 rounded-full flex items-center justify-center" style="background: rgba(255,255,255,0.08);">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M13.5 21v-8h2.7l.4-3.1h-3.1V8c0-.9.25-1.5 1.55-1.5H16.7V3.7C16.4 3.65 15.4 3.55 14.2 3.55c-2.4 0-4 1.45-4 4.15V10H7.5v3.1h2.7v8h3.3z"/></svg>
                    </a>
                @endif
                @if ($__settings->instagram_url)
                    <a href="{{ $__settings->instagram_url }}" target="_blank" rel="noopener" aria-label="Instagram"
                       class="w-9 h-9 rounded-full flex items-center justify-center" style="background: rgba(255,255,255,0.08);">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="3.5"/><circle cx="17.2" cy="6.8" r="1"/></svg>
                    </a>
                @endif
                @if ($__settings->twitter_url)
                    <a href="{{ $__settings->twitter_url }}" target="_blank" rel="noopener" aria-label="Twitter"
                       class="w-9 h-9 rounded-full flex items-center justify-center" style="background: rgba(255,255,255,0.08);">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M4 4l16 16M20 4L4 20" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                    </a>
                @endif
                @if ($__settings->youtube_url)
                    <a href="{{ $__settings->youtube_url }}" target="_blank" rel="noopener" aria-label="YouTube"
                       class="w-9 h-9 rounded-full flex items-center justify-center" style="background: rgba(255,255,255,0.08);">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M21.6 7.2s-.2-1.5-.8-2.1c-.8-.8-1.7-.8-2.1-.9C15.9 4 12 4 12 4s-3.9 0-6.7.2c-.4 0-1.3.1-2.1.9C2.6 5.7 2.4 7.2 2.4 7.2S2.2 9 2.2 10.7v1.6c0 1.7.2 3.5.2 3.5s.2 1.5.8 2.1c.8.8 1.9.8 2.4.9 1.7.2 7.4.2 7.4.2s3.9 0 6.7-.2c.4 0 1.3-.1 2.1-.9.6-.6.8-2.1.8-2.1s.2-1.7.2-3.5v-1.6c0-1.7-.2-3.5-.2-3.5zM10 14.6V8.9l5.2 2.9-5.2 2.8z"/></svg>
                    </a>
                @endif
            </div>
        </div>

        <div>
            <div class="text-white font-semibold mb-4">Quick Links</div>
            <ul class="space-y-2.5 text-sm" style="color: #93a0b3;">
                <li><a href="{{ route('pages.show', 'about-us') }}" class="hover:text-white">About Us</a></li>
                <li><a href="{{ route('blog.index') }}" class="hover:text-white">Blog</a></li>
                <li><a href="{{ route('contact.index') }}" class="hover:text-white">Contact Us</a></li>
                <li><a href="{{ route('gallery.index') }}" class="hover:text-white">Gallery</a></li>
                <li><a href="{{ route('pages.show', 'privacy-policy') }}" class="hover:text-white">Privacy Policy</a></li>
            </ul>
        </div>

        <div>
            <div class="text-white font-semibold mb-4">Trending Packages</div>
            <ul class="space-y-2.5 text-sm" style="color: #93a0b3;">
                @forelse ($__trending as $trend)
                    <li><a href="{{ route('packages.show', $trend) }}" class="hover:text-white">{{ $trend->title }}</a></li>
                @empty
                    <li>No packages yet</li>
                @endforelse
            </ul>
        </div>

        <div>
            <div class="text-white font-semibold mb-4">Contact Information</div>
            <ul class="space-y-3 text-sm" style="color: #93a0b3;">
                @if ($__settings->address)
                    <li>{{ $__settings->address }}</li>
                @endif
                @if ($__settings->phone)
                    <li><a href="tel:{{ preg_replace('/\s+/', '', $__settings->phone) }}" class="hover:text-white">{{ $__settings->phone }}</a></li>
                @endif
                @if ($__settings->phone_secondary)
                    <li><a href="tel:{{ preg_replace('/\s+/', '', $__settings->phone_secondary) }}" class="hover:text-white">{{ $__settings->phone_secondary }}</a></li>
                @endif
                @if ($__settings->email)
                    <li><a href="mailto:{{ $__settings->email }}" class="hover:text-white">{{ $__settings->email }}</a></li>
                @endif
            </ul>
        </div>
    </div>

    <div style="border-top: 1px solid rgba(255,255,255,0.1);">
        <div class="container-p py-5 text-xs text-center sm:text-left" style="color: #7c879a;">
            {{ $__settings->site_name ?? config('app.name') }} &copy; All Rights Reserved {{ date('Y') }}
        </div>
    </div>
</footer>
