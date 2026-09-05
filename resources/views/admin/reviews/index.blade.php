@extends('admin.layouts.app')

@section('title', 'Reviews')

@php
    $statusFilters = ['all', 'approved'];
    $currentStatus = request()->get('status', 'all');
@endphp

@section('content')
    <div class="mb-5 flex gap-2 items-center">
        @foreach ($statusFilters as $status)
            <a href="{{ route('admin.reviews.index', ['status' => $status === 'all' ? null : $status]) }}"
               class="filter-tab {{ $currentStatus === $status ? 'filter-tab-active' : '' }}">
                {{ ucfirst($status) }}
            </a>
        @endforeach
    </div>

    <div id="bulk-bar" class="hidden mb-4 flex items-center gap-3 p-3 rounded" style="background: var(--color-surface); border: 1px solid var(--color-border);">
        <span class="text-sm" style="color: var(--color-text-muted);">
            <span id="selected-count">0</span> selected
        </span>
        <button type="submit" form="bulk-form" class="btn-link-danger text-sm">Delete selected</button>
    </div>

    <div class="panel overflow-hidden">
        @if ($reviews->isEmpty())
            <div class="empty-state">
                <div class="empty-state-title">No reviews found</div>
                <div class="empty-state-hint">
                    Customer reviews submitted on the public site will show up here.
                </div>
            </div>
        @else
            <form id="bulk-form" method="POST" action="{{ route('admin.reviews.bulk-destroy') }}">
                @csrf
                <div class="overflow-x-auto">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th class="w-8">
                                    <input type="checkbox" id="select-all" class="rounded" style="border-color: var(--color-border-strong);">
                                </th>
                                @include('admin.partials.sortable-th', ['field' => 'rating', 'label' => 'Rating'])
                                <th>Reviewer</th>
                                <th>Package</th>
                                <th>Comment</th>
                                @include('admin.partials.sortable-th', ['field' => 'status', 'label' => 'Status'])
                                @include('admin.partials.sortable-th', ['field' => 'created_at', 'label' => 'Date'])
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reviews as $review)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="ids[]" value="{{ $review->id }}"
                                               class="row-checkbox rounded" style="border-color: var(--color-border-strong);">
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-1">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg width="12" height="12" viewBox="0 0 20 20"
                                                     fill="{{ $i <= round($review->rating) ? '#f59e0b' : '#e5e7eb' }}">
                                                    <path d="M10 1.5l2.6 5.4 5.9.7-4.3 4.1 1.1 5.9L10 14.8l-5.3 2.8 1.1-5.9-4.3-4.1 5.9-.7z"/>
                                                </svg>
                                            @endfor
                                            <span class="ml-1 text-xs">{{ number_format($review->rating, 1) }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="font-medium">{{ $review->reviewer_name }}</div>
                                        <div class="text-xs" style="color: var(--color-text-faint);">{{ $review->reviewer_email }}</div>
                                    </td>
                                    <td>
                                        @if ($review->package)
                                            <a href="{{ route('packages.show', $review->package) }}" target="_blank"
                                               class="text-sm hover:opacity-70" style="color: var(--color-text-muted);">
                                                {{ \Illuminate\Support\Str::limit($review->package->title, 30) }}
                                            </a>
                                        @else
                                            <span style="color: var(--color-text-faint);">—</span>
                                        @endif
                                    </td>
                                    <td style="max-width: 240px;">
                                        @if ($review->title)
                                            <div class="text-sm font-medium" style="color: var(--color-text);">{{ $review->title }}</div>
                                        @endif
                                        <div class="text-xs" style="color: var(--color-text-muted);">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($review->comment), 80) }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $review->status }}">{{ ucfirst($review->status) }}</span>
                                    </td>
                                    <td style="color: var(--color-text-muted);">
                                        <div class="text-xs">{{ $review->created_at->format('d M Y') }}</div>
                                        <div class="text-xs">{{ $review->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="text-right whitespace-nowrap">
                                        {{-- Inline delete (uses the global data-delete-url handler in resources/js/app.js so it
                                             can live inside the bulk form without nested-form HTML issues). --}}
                                        <button type="button"
                                                class="btn-link-danger"
                                                data-delete-url="{{ route('admin.reviews.destroy', $review) }}"
                                                data-delete-token="{{ csrf_token() }}">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        @endif
    </div>

    <div class="mt-4">
        {{ $reviews->links() }}
    </div>
@endsection

@push('scripts')
    <script nonce="{{ request()->attributes->get('cspNonce') }}">
        const selectAll = document.getElementById('select-all');
        if (selectAll) {
            selectAll.addEventListener('change', function () {
                document.querySelectorAll('.row-checkbox').forEach(cb => cb.checked = this.checked);
                updateBulkBar();
            });
        }
        document.querySelectorAll('.row-checkbox').forEach(cb => cb.addEventListener('change', updateBulkBar));

        function updateBulkBar() {
            const checked = document.querySelectorAll('.row-checkbox:checked').length;
            const counter = document.getElementById('selected-count');
            const bar = document.getElementById('bulk-bar');
            if (counter) counter.textContent = checked;
            if (bar) bar.classList.toggle('hidden', checked === 0);
        }

        const bulkForm = document.getElementById('bulk-form');
        if (bulkForm) {
            bulkForm.addEventListener('submit', function (e) {
                if (!confirm('Delete ' + document.querySelectorAll('.row-checkbox:checked').length + ' review(s)?')) {
                    e.preventDefault();
                }
            });
        }
    </script>
@endpush