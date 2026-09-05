@extends('admin.layouts.app')

@section('title', 'Packages')

@section('content')
    <div class="mb-5 flex justify-end">
        <a href="{{ route('admin.packages.create') }}" class="btn btn-primary">
            New package
        </a>
    </div>

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
                            @include('admin.partials.sortable-th', ['field' => 'title', 'label' => 'Title'])
                            @include('admin.partials.sortable-th', ['field' => 'category', 'label' => 'Category'])
                            @include('admin.partials.sortable-th', ['field' => 'price', 'label' => 'Price'])
                            @include('admin.partials.sortable-th', ['field' => 'status', 'label' => 'Status'])
                            <th>Reviews</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($packages as $package)
                            <tr>
                                <td>
                                    <div class="font-medium">
                                        {{ $package->title }}
                                        @if ($package->is_featured)
                                            <span class="badge badge-neutral ml-1">Featured</span>
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

    <div class="mt-4">
        {{ $packages->links() }}
    </div>
@endsection
