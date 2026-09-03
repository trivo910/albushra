@extends('layouts.public')

@php
    $seoTitle = 'Forgot Password | '.(\App\Models\Setting::current()->site_name ?? config('app.name'));
@endphp

@section('content')
    <section class="py-16 sm:py-20">
        <div class="container-p max-w-md mx-auto">
            <div class="card-p p-8">
                <h1 class="font-poppins font-bold text-2xl mb-3 text-center" style="color: var(--p-navy);">Forgot Password</h1>
                <p class="text-sm text-center mb-6" style="color: var(--p-grey);">
                    Enter your email and we'll send you a password reset link.
                </p>

                @if ($errors->any())
                    <div class="rounded-lg px-4 py-3 text-sm mb-4" style="background: #fbeae9; color: #b3261e;">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="field-label-p">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus class="field-input-p">
                    </div>
                    <button type="submit" class="btn-brand w-full">Send Reset Link</button>
                </form>
            </div>
        </div>
    </section>
@endsection
