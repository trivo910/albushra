@extends('admin.layouts.app')

@section('title', 'Packages')

@section('content')
    <div class="mb-5 flex justify-end">
        <a href="{{ route('admin.packages.create') }}" class="btn btn-primary">
            New package
        </a>
    </div>

    @if ($packages->isNotEmpty())
        <div class="mb-4 flex items-center justify-between gap-4 text-sm" style="color: var(--color-text-muted);">
            <p>Drag packages into the order you want them to appear publicly.</p>
            <span id="package-order-status" aria-live="polite"></span>
        </div>
    @endif

    <div class="panel overflow-hidden">
        @if ($packages->isEmpty())
            <div class="empty-state">
                <div class="empty-state-title">No packages yet</div>
                <div class="empty-state-hint">Create your first Hajj or Umrah package to get started.</div>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Order</th>
                            @include('admin.partials.sortable-th', ['field' => 'title', 'label' => 'Title'])
                            @include('admin.partials.sortable-th', ['field' => 'category', 'label' => 'Category'])
                            @include('admin.partials.sortable-th', ['field' => 'price', 'label' => 'Price'])
                            @include('admin.partials.sortable-th', ['field' => 'status', 'label' => 'Status'])
                            <th>Reviews</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="package-order-list" data-reorder-url="{{ route('admin.packages.reorder') }}">
                        @foreach ($packages as $package)
                            <tr draggable="{{ $isManualOrder ? 'true' : 'false' }}" data-package-id="{{ $package->id }}" class="package-order-row">
                                <td>
                                    <button type="button" class="package-drag-handle" title="Drag to reorder" aria-label="Drag {{ $package->title }} to reorder" {{ $isManualOrder ? '' : 'disabled' }}>
                                        <span aria-hidden="true">⋮⋮</span>
                                    </button>
                                </td>
                                <td>
                                    <div class="font-medium">
                                        {{ $package->title }}
                                        @if ($package->is_featured)
                                            <span class="badge badge-neutral ml-1">Featured</span>
                                        @endif
                                        @if ($package->is_trending)
                                            <span class="badge badge-neutral ml-1">Trending</span>
                                        @endif
                                    </div>
                                    <div class="text-xs" style="color: var(--color-text-faint);">/{{ $package->slug }}</div>
                                </td>
                                <td class="capitalize" style="color: var(--color-text-muted);">{{ $package->category }}</td>
                                <td>{{ $package->price ? '₹'.number_format($package->price) : '—' }}</td>
                                <td>
                                    @if ($package->rating_count > 0)
                                        <div class="flex items-center gap-1">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg width="11" height="11" viewBox="0 0 20 20"
                                                     fill="{{ $i <= round($package->rating) ? '#f59e0b' : '#e5e7eb' }}">
                                                    <path d="M10 1.5l2.6 5.4 5.9.7-4.3 4.1 1.1 5.9L10 14.8l-5.3 2.8 1.1-5.9-4.3-4.1 5.9-.7z"/>
                                                </svg>
                                            @endfor
                                        </div>
                                        <div class="text-xs mt-0.5" style="color: var(--color-text-muted);">{{ $package->rating_count }} {{ Str::plural('review', $package->rating_count) }}</div>
                                    @else
                                        <span style="color: var(--color-text-faint);">—</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-{{ $package->status }}">{{ ucfirst($package->status) }}</span>
                                </td>
                                <td class="text-right whitespace-nowrap">
                                    <a href="{{ route('admin.packages.edit', $package) }}" class="btn-link-muted">Edit</a>
                                    <form action="{{ route('admin.packages.destroy', $package) }}" method="POST" class="inline"
                                          data-confirm="Delete this package?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-link-danger ml-3">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

@endsection

@push('scripts')
    @if ($isManualOrder && $packages->count() > 1)
        <script nonce="{{ request()->attributes->get('cspNonce') }}">
        (() => {
            const list = document.querySelector('#package-order-list');
            const status = document.querySelector('#package-order-status');
            let draggedRow = null;

            list?.querySelectorAll('.package-order-row').forEach((row) => {
                row.addEventListener('dragstart', () => {
                    draggedRow = row;
                    row.classList.add('is-dragging');
                });

                row.addEventListener('dragend', () => {
                    row.classList.remove('is-dragging');
                    draggedRow = null;
                });

                row.addEventListener('dragover', (event) => {
                    event.preventDefault();
                    if (!draggedRow || draggedRow === row) return;

                    const rect = row.getBoundingClientRect();
                    const insertAfter = event.clientY > rect.top + rect.height / 2;
                    list.insertBefore(draggedRow, insertAfter ? row.nextSibling : row);
                });
            });

            list?.addEventListener('drop', async (event) => {
                event.preventDefault();
                const order = [...list.querySelectorAll('[data-package-id]')].map((row) => row.dataset.packageId);
                status.textContent = 'Saving...';

                try {
                    const response = await fetch(list.dataset.reorderUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify({ order }),
                    });

                    if (!response.ok) {
                        const error = await response.json().catch(() => ({}));
                        throw new Error(error.message || 'Unable to save order');
                    }
                    status.textContent = 'Order saved';
                    setTimeout(() => { status.textContent = ''; }, 2000);
                } catch (error) {
                    status.textContent = error.message || 'Could not save order. Refresh and try again.';
                }
            });
        })();
        </script>
    @endif
@endpush
