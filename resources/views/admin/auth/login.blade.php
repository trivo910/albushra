<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased" style="background: var(--sidebar-bg);">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-sm">
            <div class="text-center mb-7">
                <div class="text-lg font-semibold" style="color: var(--sidebar-text-active);">{{ config('app.name') }}</div>
                <div class="text-sm mt-1" style="color: var(--sidebar-text-muted);">Admin panel</div>
            </div>

            <div class="rounded p-7" style="background: var(--color-surface); border-radius: var(--radius-md);">
                @if ($errors->any())
                    <div class="alert-error rounded px-4 py-2.5 text-sm mb-5" style="border-radius: var(--radius-sm);">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label for="email" class="field-label">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                               class="field-input">
                    </div>
                    <div>
                        <label for="password" class="field-label">Password</label>
                        <input id="password" type="password" name="password" required
                               class="field-input">
                    </div>
                    <label class="flex items-center gap-2 text-sm" style="color: var(--color-text-muted);">
                        <input type="checkbox" name="remember" class="rounded" style="border-color: var(--color-border-strong);">
                        Remember me
                    </label>
                    <button type="submit" class="btn btn-primary w-full">
                        Log in
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
