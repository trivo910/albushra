@php
    $isActive = $sort === $field;
    $nextDirection = $isActive && $direction === 'asc' ? 'desc' : 'asc';
    $url = request()->fullUrlWithQuery(['sort' => $field, 'direction' => $nextDirection]);
@endphp
<th>
    <a href="{{ $url }}" class="sort-link">
        {{ $label }}
        @if ($isActive)
            <span aria-hidden="true">{{ $direction === 'asc' ? '↑' : '↓' }}</span>
        @endif
    </a>
</th>
