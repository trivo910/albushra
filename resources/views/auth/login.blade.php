@extends('layouts.public')

@php
    $seoTitle = 'Login | '.(\App\Models\Setting::current()->site_name ?? config('app.name'));
@endphp

@section('content')
    <section class="py-16 sm:py-20">
        <div class="container-p max-w-md mx-auto">
            <div class="card-p p-8">
                <h1 class="font-poppins font-bold text-2xl mb-6 text-center" style="color: var(--p-navy);">Login</h1>

                @if ($errors->any())
                    <div class="rounded-lg px-4 py-3 text-sm mb-4" style="background: #fbeae9; color: #b3261e;">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="field-label-p">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus class="field-input-p">
                    </div>
                    <div>
                        <label class="field-label-p">Password</label>
                        <input type="password" name="password" required class="field-input-p">
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center gap-2" style="color: var(--p-grey);">
                            <input type="checkbox" name="remember">
                            Remember me
                        </label>
                        <a href="{{ route('password.request') }}" style="color: var(--p-primary);">Forgot password?</a>
                    </div>
                    <button type="submit" class="btn-brand w-full">Log In</button>
                </form>

                <p class="text-center text-sm mt-6" style="color: var(--p-grey);">
                    Don't have an account? <a href="{{ route('register') }}" style="color: var(--p-primary);">Sign Up</a>
                </p>
            </div>
        </div>
    </section>
@endsection
