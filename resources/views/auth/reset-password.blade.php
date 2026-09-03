@extends('layouts.public')

@php
    $seoTitle = 'Reset Password | '.(\App\Models\Setting::current()->site_name ?? config('app.name'));
@endphp

@section('content')
    <section class="py-16 sm:py-20">
        <div class="container-p max-w-md mx-auto">
            <div class="card-p p-8">
                <h1 class="font-poppins font-bold text-2xl mb-6 text-center" style="color: var(--p-navy);">Reset Password</h1>

                @if ($errors->any())
                    <div class="rounded-lg px-4 py-3 text-sm mb-4" style="background: #fbeae9; color: #b3261e;">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div>
                        <label class="field-label-p">Email</label>
                        <input type="email" name="email" value="{{ old('email', $email) }}" required autofocus class="field-input-p">
                    </div>
                    <div>
                        <label class="field-label-p">New Password</label>
                        <input type="password" name="password" required class="field-input-p">
                    </div>
                    <div>
                        <label class="field-label-p">Confirm New Password</label>
                        <input type="password" name="password_confirmation" required class="field-input-p">
                    </div>
                    <button type="submit" class="btn-brand w-full">Reset Password</button>
                </form>
            </div>
        </div>
    </section>
@endsection
