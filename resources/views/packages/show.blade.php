@extends('layouts.public')

@php
    $settings = \App\Models\Setting::current();
    $seoTitle = $package->meta_title ?: $package->title.' | '.($settings->site_name ?? config('app.name'));
    $seoDescription = $package->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($package->description ?? ''), 155);
    $ogImage = $package->images->first() ? \Illuminate\Support\Facades\Storage::url($package->images->first()->image_path) : null;
@endphp

@section('content')
    {{-- Breadcrumb --}}
    <div class="border-b" style="border-color: var(--p-light-grey);">
        <div class="container-p py-3 text-sm" style="color: var(--p-grey);">
            <a href="{{ route('home') }}" class="hover:opacity-70">Home</a>
            <span class="mx-1">/</span>
            <a href="{{ route('packages.category', $package->category) }}" class="hover:opacity-70 capitalize">{{ $package->category }}</a>
            <span class="mx-1">/</span>
            <span style="color: var(--p-navy);">{{ $package->title }}</span>
        </div>
    </div>

    <div class="container-p py-8">
        <div class="flex items-start justify-between flex-wrap gap-4 mb-6">
            <div>
                <h1 class="font-poppins text-2xl sm:text-3xl font-bold mb-2" style="color: var(--p-navy);">{{ $package->title }}</h1>
                @if ($package->rating > 0)
                    <div class="star-rating text-sm">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="{{ $i <= round($package->rating) ? 'currentColor' : '#e5e7eb' }}"><path d="M10 1.5l2.6 5.4 5.9.7-4.3 4.1 1.1 5.9L10 14.8l-5.3 2.8 1.1-5.9-4.3-4.1 5.9-.7z"/></svg>
                        @endfor
                        <span class="ml-1" style="color: var(--p-grey);">{{ number_format($package->rating, 1) }} / 5</span>
                    </div>
                @endif
            </div>
        </div>

        {{-- Gallery --}}
        @if ($package->images->isNotEmpty())
            <div data-lightbox-trigger class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-10" style="grid-auto-rows: minmax(120px, 1fr);">
                @foreach ($package->images as $i => $image)
                    <a href="{{ \Illuminate\Support\Facades\Storage::url($image->image_path) }}"
                       class="{{ $i === 0 ? 'col-span-2 row-span-2' : '' }} block rounded-xl overflow-hidden">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($image->image_path) }}" alt="{{ $package->title }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    </a>
                @endforeach
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <div class="lg:col-span-2">
                {{-- Info block --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8 p-5 rounded-xl" style="background: var(--p-light-grey);">
                    @foreach ([
                        ['label' => 'Duration', 'value' => $package->duration],
                        ['label' => 'Tour Type', 'value' => $package->tour_type],
                        ['label' => 'Group Size', 'value' => $package->group_size],
                        ['label' => 'Languages', 'value' => $package->languages],
                    ] as $info)
                        <div>
                            <div class="text-xs mb-1" style="color: var(--p-grey);">{{ $info['label'] }}</div>
                            <div class="font-poppins font-medium text-sm" style="color: var(--p-navy);">{{ $info['value'] ?: '—' }}</div>
                        </div>
                    @endforeach
                </div>

                {{-- Description --}}
                <div class="mb-10">
                    <h2 class="section-title !text-xl">About This Tour</h2>
                    <div class="prose-p text-sm leading-relaxed" style="color: var(--p-grey);">
                        {!! $package->description !!}
                    </div>
                </div>

                {{-- Included / Excluded --}}
                @if (! empty($package->included) || ! empty($package->excluded))
                    <div class="mb-10">
                        <h2 class="section-title !text-xl">Included / Excluded</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <ul class="space-y-2.5">
                                @foreach ($package->included ?? [] as $item)
                                    <li class="flex items-start gap-2 text-sm" style="color: var(--p-navy);">
                                        <svg class="shrink-0 mt-0.5" width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="#2f9e5c" stroke-width="2"><path d="M4 10l4 4 8-8"/></svg>
                                        {{ $item }}
                                    </li>
                                @endforeach
                            </ul>
                            <ul class="space-y-2.5">
                                @foreach ($package->excluded ?? [] as $item)
                                    <li class="flex items-start gap-2 text-sm" style="color: var(--p-grey);">
                                        <svg class="shrink-0 mt-0.5" width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="#d34b4b" stroke-width="2"><path d="M5 5l10 10M15 5L5 15"/></svg>
                                        {{ $item }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                {{-- Map --}}
                @if ($package->map_embed)
                    <div class="mb-10">
                        <h2 class="section-title !text-xl">Tour's Location</h2>
                        <div class="rounded-xl overflow-hidden">
                            {!! $package->map_embed !!}
                        </div>
                    </div>
                @endif

                {{-- Reviews --}}
                <div class="mb-10" id="reviews">
                    <div class="flex items-center justify-between mb-6 flex-wrap gap-3">
                        <h2 class="section-title !text-xl mb-0">Customer Reviews</h2>
                        <button type="button" id="write-review-btn" class="btn-brand text-sm px-5 py-2 rounded-lg">Write a Review</button>
                    </div>

                    @if ($package->rating_count > 0)
                        <div class="flex items-center gap-4 mb-8 p-5 rounded-xl" style="background: var(--p-light-grey);">
                            <div class="text-center shrink-0 px-4">
                                <div class="font-poppins text-4xl font-bold leading-none" style="color: var(--p-navy);">{{ number_format($package->rating, 1) }}</div>
                                <div class="flex items-center justify-center gap-0.5 mt-1.5">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg width="13" height="13" viewBox="0 0 20 20" fill="{{ $i <= round($package->rating) ? '#f59e0b' : '#d1d5db' }}"><path d="M10 1.5l2.6 5.4 5.9.7-4.3 4.1 1.1 5.9L10 14.8l-5.3 2.8 1.1-5.9-4.3-4.1 5.9-.7z"/></svg>
                                    @endfor
                                </div>
                                <div class="text-xs mt-1" style="color: var(--p-grey);">{{ $package->rating_count }} {{ Str::plural('review', $package->rating_count) }}</div>
                            </div>
                        </div>
                    @endif

                    <div class="space-y-6 mb-8" id="reviews-list">
                        @forelse ($package->approvedReviews as $review)
                            <div class="border-b pb-6 last:border-0 last:pb-0" style="border-color: var(--p-light-grey);">
                                <div class="flex items-start justify-between mb-2 flex-wrap gap-2">
                                    <div class="flex items-center gap-2">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full text-sm font-semibold shrink-0" style="background: var(--p-navy); color: white;">{{ strtoupper(substr($review->reviewer_name, 0, 1)) }}</span>
                                        <div>
                                            <div class="font-poppins font-semibold text-sm" style="color: var(--p-navy);">{{ $review->reviewer_name }}</div>
                                            <div class="flex items-center gap-1 mt-0.5">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <svg width="11" height="11" viewBox="0 0 20 20" fill="{{ $i <= round($review->rating) ? '#f59e0b' : '#e5e7eb' }}"><path d="M10 1.5l2.6 5.4 5.9.7-4.3 4.1 1.1 5.9L10 14.8l-5.3 2.8 1.1-5.9-4.3-4.1 5.9-.7z"/></svg>
                                                @endfor
                                                <span class="text-xs ml-1" style="color: var(--p-grey);">{{ number_format($review->rating, 1) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-xs shrink-0" style="color: var(--p-grey);">{{ $review->created_at->format('d M Y') }}</span>
                                </div>
                                @if ($review->title)
                                    <div class="font-poppins font-semibold text-sm mb-1" style="color: var(--p-navy);">{{ $review->title }}</div>
                                @endif
                                <p class="text-sm leading-relaxed" style="color: var(--p-grey);">{{ $review->comment }}</p>
                            </div>
                        @empty
                            <div class="text-center py-8" style="color: var(--p-grey);">
                                <svg class="mx-auto mb-3" width="36" height="36" viewBox="0 0 20 20" fill="#d1d5db"><path d="M10 1.5l2.6 5.4 5.9.7-4.3 4.1 1.1 5.9L10 14.8l-5.3 2.8 1.1-5.9-4.3-4.1 5.9-.7z"/></svg>
                                <p class="text-sm">No reviews yet. Be the first to share your experience!</p>
                            </div>
                        @endforelse
                    </div>

                    <div id="review-form-container" class="hidden">
                        <form action="{{ route('packages.review.store', $package) }}" method="POST" class="space-y-4 p-6 rounded-xl" style="background: var(--p-light-grey);">
                            @csrf
                            @include('partials.honeypot')
                            <h3 class="font-poppins font-semibold text-base" style="color: var(--p-navy);">Share Your Experience</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs mb-1 font-medium" style="color: var(--p-navy);">Your Name *</label>
                                    <input type="text" name="reviewer_name" value="{{ old('reviewer_name') }}" required class="field-input-p w-full" placeholder="John Doe">
                                </div>
                                <div>
                                    <label class="block text-xs mb-1 font-medium" style="color: var(--p-navy);">Email Address *</label>
                                    <input type="email" name="reviewer_email" value="{{ old('reviewer_email') }}" required class="field-input-p w-full" placeholder="john@example.com">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs mb-1 font-medium" style="color: var(--p-navy);">Rating *</label>
                                <div class="flex items-center gap-1" id="star-input">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <button type="button" data-value="{{ $i }}" class="star-btn focus:outline-none">
                                            <svg width="28" height="28" viewBox="0 0 20 20" fill="#e5e7eb"><path d="M10 1.5l2.6 5.4 5.9.7-4.3 4.1 1.1 5.9L10 14.8l-5.3 2.8 1.1-5.9-4.3-4.1 5.9-.7z"/></svg>
                                        </button>
                                    @endfor
                                    <span id="rating-display" class="ml-2 text-sm font-medium" style="color: var(--p-grey);"></span>
                                </div>
                                <input type="hidden" name="rating" id="rating-value" value="{{ old('rating') }}">
                                @error('rating') <p class="text-xs mt-1" style="color: #ef4444;">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs mb-1 font-medium" style="color: var(--p-navy);">Review Title</label>
                                <input type="text" name="title" value="{{ old('title') }}" class="field-input-p w-full" placeholder="Summarize your experience (optional)">
                            </div>
                            <div>
                                <label class="block text-xs mb-1 font-medium" style="color: var(--p-navy);">Your Review *</label>
                                <textarea name="comment" rows="4" required class="field-input-p w-full" placeholder="Tell others about your experience...">{{ old('comment') }}</textarea>
                                @error('comment') <p class="text-xs mt-1" style="color: #ef4444;">{{ $message }}</p> @enderror
                            </div>
                            <div class="flex items-center gap-3">
                                <button type="submit" class="btn-brand px-6 py-2 rounded-lg text-sm">Submit Review</button>
                                <button type="button" id="cancel-review-btn" class="text-sm px-4 py-2 rounded-lg" style="color: var(--p-grey); border: 1px solid var(--p-light-grey);">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div>
                <div class="card-p p-6 mb-6 sticky top-24">
                    <div class="flex items-center justify-between mb-5 pb-5" style="border-bottom: 1px solid var(--p-light-grey);">
                        <div>
                            <div class="text-xs" style="color: var(--p-grey);">From</div>
                            <div class="font-poppins font-bold text-2xl" style="color: var(--p-navy);">
                                {{ $package->price ? '₹'.number_format($package->price) : 'Enquire' }}
                            </div>
                        </div>
                        @if ($package->rating > 0)
                            <div class="star-rating text-xs">
                                <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor"><path d="M10 1.5l2.6 5.4 5.9.7-4.3 4.1 1.1 5.9L10 14.8l-5.3 2.8 1.1-5.9-4.3-4.1 5.9-.7z"/></svg>
                                {{ number_format($package->rating, 1) }}
                            </div>
                        @endif
                    </div>

                    <h3 class="font-poppins font-semibold mb-4" style="color: var(--p-navy);">Enquire About This Package</h3>

                    @if ($errors->any())
                        <div class="rounded-lg px-3 py-2 text-xs mb-4" style="background: #fbeae9; color: #b3261e;">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('packages.enquire', $package) }}" class="space-y-3">
                        @csrf
                        @include('partials.honeypot')
                        <div>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Your Name*" required class="field-input-p">
                        </div>
                        <div>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Your Email*" required class="field-input-p">
                        </div>
                        <div>
                            <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Phone Number" class="field-input-p">
                        </div>
                        <div>
                            <textarea name="message" rows="3" placeholder="Your Message" class="field-input-p">{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" class="btn-brand w-full">Send Enquiry</button>
                    </form>
                </div>

                <div class="card-p p-6 mb-6">
                    <h4 class="font-poppins font-semibold mb-3" style="color: var(--p-navy);">Owner</h4>
                    <div class="text-sm" style="color: var(--p-navy);">{{ $settings->site_name ?? config('app.name') }}</div>
                    <p class="text-xs mt-1" style="color: var(--p-grey);">Verified travel operator</p>
                </div>

                <div class="card-p p-6 mb-6">
                    <h4 class="font-poppins font-semibold mb-3" style="color: var(--p-navy);">Information Contact</h4>
                    <dl class="space-y-3 text-sm">
                        @if ($settings->email)
                            <div>
                                <dt class="text-xs" style="color: var(--p-grey);">Email</dt>
                                <dd style="color: var(--p-navy);">{{ $settings->email }}</dd>
                            </div>
                        @endif
                        @if ($settings->phone)
                            <div>
                                <dt class="text-xs" style="color: var(--p-grey);">Phone</dt>
                                <dd style="color: var(--p-navy);">{{ $settings->phone }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>

                @if ($related->isNotEmpty())
                    <div class="card-p p-6">
                        <h4 class="font-poppins font-semibold mb-4" style="color: var(--p-navy);">Related Packages</h4>
                        <div class="space-y-4">
                            @foreach ($related as $item)
                                <a href="{{ route('packages.show', $item) }}" class="flex gap-3 items-center group">
                                    <div class="w-16 h-16 rounded-lg overflow-hidden shrink-0" style="background: var(--p-light-grey);">
                                        @if ($item->images->first())
                                            <img src="{{ \Illuminate\Support\Facades\Storage::url($item->images->first()->image_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <div class="text-sm font-medium truncate group-hover:opacity-70" style="color: var(--p-navy);">{{ $item->title }}</div>
                                        <div class="text-xs" style="color: var(--p-grey);">{{ $item->price ? '₹'.number_format($item->price) : 'Enquire' }}</div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script nonce="{{ request()->attributes->get('cspNonce') }}">
        var writeBtn = document.getElementById('write-review-btn');
        var cancelBtn = document.getElementById('cancel-review-btn');
        var formContainer = document.getElementById('review-form-container');

        if (writeBtn) {
            writeBtn.addEventListener('click', function () {
                formContainer.classList.remove('hidden');
                writeBtn.classList.add('hidden');
                formContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
            });
        }

        if (cancelBtn) {
            cancelBtn.addEventListener('click', function () {
                formContainer.classList.add('hidden');
                if (writeBtn) writeBtn.classList.remove('hidden');
            });
        }

        @if (old('comment') || $errors->any())
            (function () {
                if (formContainer) formContainer.classList.remove('hidden');
                if (writeBtn) writeBtn.classList.add('hidden');
            })();
        @endif

        var starBtns = document.querySelectorAll('.star-btn');
        var ratingValue = document.getElementById('rating-value');
        var ratingDisplay = document.getElementById('rating-display');
        var labels = ['', 'Poor', 'Fair', 'Good', 'Very Good', 'Excellent'];

        function setStars(value) {
            if (!ratingValue) return;
            ratingValue.value = value;
            if (ratingDisplay) ratingDisplay.textContent = labels[value] || '';
            starBtns.forEach(function (btn, idx) {
                var svg = btn.querySelector('svg');
                svg.setAttribute('fill', idx < value ? '#f59e0b' : '#e5e7eb');
            });
        }

        starBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                setStars(parseInt(this.dataset.value, 10));
            });
            btn.addEventListener('mouseenter', function () {
                var val = parseInt(this.dataset.value, 10);
                starBtns.forEach(function (b, idx) {
                    var svg = b.querySelector('svg');
                    svg.setAttribute('fill', idx < val ? '#fcd34d' : '#e5e7eb');
                });
            });
            btn.addEventListener('mouseleave', function () {
                setStars(parseInt(ratingValue.value, 10) || 0);
            });
        });

        if (ratingValue && ratingValue.value) {
            setStars(parseInt(ratingValue.value, 10));
        }
    </script>
@endpush
