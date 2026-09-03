@php
    $thumb = $package->images->first();
@endphp
<div class="card-p flex flex-col">
    <a href="{{ route('packages.show', $package) }}" class="block h-48 overflow-hidden shrink-0">
        @if ($thumb)
            <img src="{{ \Illuminate\Support\Facades\Storage::url($thumb->image_path) }}" alt="{{ $package->title }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full flex items-center justify-center" style="background: var(--p-light-grey);">
                <span class="text-xs" style="color: var(--p-grey);">{{ $package->title }}</span>
            </div>
        @endif
    </a>
    <div class="p-5 flex flex-col flex-1">
        @if ($package->rating > 0)
            <div class="star-rating mb-2 text-xs">
                @for ($i = 1; $i <= 5; $i++)
                    <svg width="13" height="13" viewBox="0 0 20 20" fill="{{ $i <= round($package->rating) ? 'currentColor' : '#e5e7eb' }}"><path d="M10 1.5l2.6 5.4 5.9.7-4.3 4.1 1.1 5.9L10 14.8l-5.3 2.8 1.1-5.9-4.3-4.1 5.9-.7z"/></svg>
                @endfor
                <span class="ml-1" style="color: var(--p-grey);">{{ number_format($package->rating, 1) }}</span>
            </div>
        @endif
        <h3 class="font-poppins font-semibold mb-2 leading-snug">
            <a href="{{ route('packages.show', $package) }}" style="color: var(--p-navy);" class="hover:opacity-70">{{ $package->title }}</a>
        </h3>
        <div class="flex items-center gap-4 text-xs mb-4" style="color: var(--p-grey);">
            @if ($package->duration)
                <span class="flex items-center gap-1">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--p-primary)" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
                    {{ $package->duration }}
                </span>
            @endif
            @if ($package->group_size)
                <span class="flex items-center gap-1">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--p-primary)" stroke-width="1.8"><circle cx="9" cy="8" r="3"/><path d="M2 20c0-3.3 3.1-6 7-6s7 2.7 7 6"/></svg>
                    {{ $package->group_size }}
                </span>
            @endif
        </div>
        <div class="mt-auto flex items-center justify-between pt-4" style="border-top: 1px solid var(--p-light-grey);">
            <span class="font-poppins font-semibold text-lg" style="color: var(--p-navy);">
                {{ $package->price ? '₹'.number_format($package->price) : 'Enquire' }}
            </span>
            <a href="{{ route('packages.show', $package) }}" class="btn-brand !py-2 !px-4 !text-xs">BOOK NOW</a>
        </div>
    </div>
</div>
