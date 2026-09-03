@extends('layouts.public')

@php
    $seoTitle = 'Sign Up | '.(\App\Models\Setting::current()->site_name ?? config('app.name'));
@endphp

@section('content')
    <section class="py-16 sm:py-20">
        <div class="container-p max-w-md mx-auto">
            <div class="card-p p-8">
                <h1 class="font-poppins font-bold text-2xl mb-6 text-center" style="color: var(--p-navy);">Sign Up</h1>

                @if ($errors->any())
                    <div class="rounded-lg px-4 py-3 text-sm mb-4" style="background: #fbeae9; color: #b3261e;">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="field-label-p">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus class="field-input-p">
                    </div>
                    <div>
                        <label class="field-label-p">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="field-input-p">
                    </div>
                    <div>
                        <label class="field-label-p">Password</label>
                        <input type="password" name="password" required class="field-input-p">
                    </div>
                    <div>
                        <label class="field-label-p">Confirm Password</label>
                        <input type="password" name="password_confirmation" required class="field-input-p">
                    </div>
                    <div>
                        <p class="field-label-p">Select User Type</p>
                        <label class="flex items-center gap-2 text-sm mb-1.5" style="color: var(--p-navy);">
                            <input type="radio" name="user_type" value="normal" checked {{ old('user_type', 'normal') === 'normal' ? 'checked' : '' }}>
                            Normal User <span class="text-xs" style="color: var(--p-grey);">— used for booking services</span>
                        </label>
                        <label class="flex items-center gap-2 text-sm" style="color: var(--p-navy);">
                            <input type="radio" name="user_type" value="partner" {{ old('user_type') === 'partner' ? 'checked' : '' }}>
                            Partner User <span class="text-xs" style="color: var(--p-grey);">— used for upload and booking services</span>
                        </label>
                    </div>
                    <button type="submit" class="btn-brand w-full">Sign Up</button>
                </form>

                <p class="text-center text-sm mt-6" style="color: var(--p-grey);">
                    Already have an account? <a href="{{ route('login') }}" style="color: var(--p-primary);">Login</a>
                </p>
            </div>
        </div>
    </section>
@endsection
