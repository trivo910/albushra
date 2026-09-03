<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') — Admin | {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900 antialiased">
    <div class="min-h-screen flex">
        <aside class="w-64 shrink-0 bg-gray-900 text-gray-200 flex flex-col">
            <div class="px-5 py-5 text-lg font-semibold text-white border-b border-gray-800">
                {{ config('app.name') }}
            </div>
            <nav class="flex-1 px-2 py-4 space-y-1 text-sm">
                @php
                    $navItems = [
                        ['route' => 'admin.dashboard', 'pattern' => 'admin.dashboard', 'label' => 'Dashboard'],
                        ['route' => 'admin.settings.edit', 'pattern' => 'admin.settings.*', 'label' => 'Settings'],
                        ['route' => 'admin.blogs.index', 'pattern' => 'admin.blogs.*', 'label' => 'Blog'],
                        ['route' => 'admin.packages.index', 'pattern' => 'admin.packages.*', 'label' => 'Packages'],
                        ['route' => 'admin.pages.index', 'pattern' => 'admin.pages.*', 'label' => 'Pages'],
                        ['route' => 'admin.faqs.index', 'pattern' => 'admin.faqs.*', 'label' => 'FAQs'],
                        ['route' => 'admin.enquiries.index', 'pattern' => 'admin.enquiries.*', 'label' => 'Enquiries'],
                        ['route' => 'admin.gallery.index', 'pattern' => 'admin.gallery.*', 'label' => 'Gallery'],
                    ];
                @endphp
                @foreach ($navItems as $item)
                    @if (Route::has($item['route']))
                        <a href="{{ route($item['route']) }}"
                           class="block rounded px-3 py-2 hover:bg-gray-800 {{ request()->routeIs($item['pattern']) ? 'bg-gray-800 text-white' : '' }}">
                            {{ $item['label'] }}
                        </a>
                    @endif
                @endforeach
            </nav>
            <div class="px-5 py-4 border-t border-gray-800 text-xs text-gray-400">
                Logged in as {{ auth()->guard('admin')->user()?->name }}
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">
            <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between">
                <h1 class="text-lg font-semibold">@yield('title', 'Dashboard')</h1>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-gray-600 hover:text-gray-900">Logout</button>
                </form>
            </header>

            <main class="flex-1 p-6">
                @if (session('success'))
                    <div class="mb-4 rounded border border-green-300 bg-green-50 px-4 py-3 text-sm text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 rounded border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-800">
                        <ul class="list-disc list-inside">
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
</body>
</html>
