<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — Admin | {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased text-[15px]" style="background: var(--color-bg); color: var(--color-text);">
    <div class="min-h-screen flex">
        <aside class="w-60 shrink-0 flex flex-col" style="background: var(--sidebar-bg);">
            <div class="px-5 h-16 flex items-center border-b" style="border-color: var(--sidebar-border);">
                <span class="text-[15px] font-semibold" style="color: var(--sidebar-text-active);">{{ config('app.name') }}</span>
            </div>

            <nav class="flex-1 px-3 py-5 space-y-5 text-sm overflow-y-auto">
                @php
                    $navGroups = [
                        'Overview' => [
                            ['route' => 'admin.dashboard', 'pattern' => 'admin.dashboard', 'label' => 'Dashboard'],
                        ],
                        'Content' => [
                            ['route' => 'admin.hero-slides.index', 'pattern' => 'admin.hero-slides.*', 'label' => 'Hero Slider'],
                            ['route' => 'admin.packages.index', 'pattern' => 'admin.packages.*', 'label' => 'Packages'],
                            ['route' => 'admin.blogs.index', 'pattern' => 'admin.blogs.*', 'label' => 'Blog'],
                            ['route' => 'admin.pages.index', 'pattern' => 'admin.pages.*', 'label' => 'Pages'],
                            ['route' => 'admin.faqs.index', 'pattern' => 'admin.faqs.*', 'label' => 'FAQs'],
                            ['route' => 'admin.gallery.index', 'pattern' => 'admin.gallery.*', 'label' => 'Gallery'],
                        ],
                        'Operations' => [
                            ['route' => 'admin.enquiries.index', 'pattern' => 'admin.enquiries.*', 'label' => 'Enquiries'],
                        ],
                        'Settings' => [
                            ['route' => 'admin.settings.edit', 'pattern' => 'admin.settings.*', 'label' => 'General Settings'],
                        ],
                    ];
                @endphp

                @foreach ($navGroups as $group => $items)
                    @php $visibleItems = collect($items)->filter(fn ($item) => Route::has($item['route'])); @endphp
                    @if ($visibleItems->isNotEmpty())
                        <div>
                            <div class="px-3 mb-1.5 text-xs font-medium" style="color: var(--sidebar-text-muted);">{{ $group }}</div>
                            <div class="space-y-0.5">
                                @foreach ($visibleItems as $item)
                                    @php $isActive = request()->routeIs($item['pattern']); @endphp
                                    <a href="{{ route($item['route']) }}"
                                       class="flex items-center gap-2.5 rounded px-3 py-1.5"
                                       style="color: {{ $isActive ? 'var(--sidebar-text-active)' : 'var(--sidebar-text)' }}; background: {{ $isActive ? 'var(--sidebar-bg-active)' : 'transparent' }};">
                                        <span class="w-1 h-1 rounded-full shrink-0" style="background: {{ $isActive ? 'var(--sidebar-accent)' : 'transparent' }};"></span>
                                        {{ $item['label'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </nav>

            <div class="px-5 py-4 border-t text-xs" style="border-color: var(--sidebar-border); color: var(--sidebar-text-muted);">
                Signed in as <span style="color: var(--sidebar-text);">{{ auth()->guard('admin')->user()?->name }}</span>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">
            <header class="h-16 shrink-0 flex items-center justify-between px-8 border-b" style="background: var(--color-surface); border-color: var(--color-border);">
                <h1 class="text-base font-semibold">@yield('title', 'Dashboard')</h1>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="btn-link-muted">Log out</button>
                </form>
            </header>

            <main class="flex-1 px-8 py-7 overflow-y-auto">
                @if (session('success'))
                    <div class="alert-success rounded px-4 py-2.5 text-sm mb-5" style="border-radius: var(--radius-sm);">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert-error rounded px-4 py-3 text-sm mb-5" style="border-radius: var(--radius-sm);">
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
