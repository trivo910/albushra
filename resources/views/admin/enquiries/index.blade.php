@extends('admin.layouts.app')

@section('title', 'Enquiries')

@section('content')
    <div class="mb-5 flex gap-2">
        <a href="{{ route('admin.enquiries.index') }}"
           class="filter-tab {{ $currentType === '' ? 'filter-tab-active' : '' }}">
            All
        </a>
        <a href="{{ route('admin.enquiries.index', ['type' => 'booking']) }}"
           class="filter-tab {{ $currentType === 'booking' ? 'filter-tab-active' : '' }}">
            Booking
        </a>
        <a href="{{ route('admin.enquiries.index', ['type' => 'contact']) }}"
           class="filter-tab {{ $currentType === 'contact' ? 'filter-tab-active' : '' }}">
            Contact
        </a>
    </div>

    <div class="panel overflow-hidden">
        @if ($enquiries->isEmpty())
            <div class="empty-state">
                <div class="empty-state-title">No enquiries yet</div>
                <div class="empty-state-hint">
                    @if ($currentType)
                        No {{ $currentType }} enquiries have come in yet.
                    @else
                        Booking and contact enquiries submitted on the public site will show up here.
                    @endif
                </div>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead>
                        <tr>
                            @include('admin.partials.sortable-th', ['field' => 'name', 'label' => 'Name'])
                            <th>Contact</th>
                            @include('admin.partials.sortable-th', ['field' => 'type', 'label' => 'Type'])
                            @include('admin.partials.sortable-th', ['field' => 'status', 'label' => 'Status'])
                            @include('admin.partials.sortable-th', ['field' => 'created_at', 'label' => 'Received'])
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enquiries as $enquiry)
                            <tr>
                                <td class="font-medium">{{ $enquiry->name }}</td>
                                <td style="color: var(--color-text-muted);">
                                    <div>{{ $enquiry->email }}</div>
                                    <div>{{ $enquiry->phone }}</div>
                                </td>
                                <td class="capitalize">{{ $enquiry->type }}</td>
                                <td>
                                    <span class="badge badge-{{ $enquiry->status }}">{{ ucfirst($enquiry->status) }}</span>
                                </td>
                                <td style="color: var(--color-text-muted);">{{ $enquiry->created_at->format('d M Y, H:i') }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin.enquiries.show', $enquiry) }}" class="btn-link-muted">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div class="mt-4">
        {{ $enquiries->links() }}
    </div>
@endsection
