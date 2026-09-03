@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-px mb-7 panel overflow-hidden" style="background: var(--color-border);">
        <div class="p-5" style="background: var(--color-surface);">
            <div class="text-sm" style="color: var(--color-text-muted);">Packages</div>
            <div class="text-2xl font-semibold mt-1">{{ $packageCount }}</div>
        </div>
        <div class="p-5" style="background: var(--color-surface);">
            <div class="text-sm" style="color: var(--color-text-muted);">Blog posts</div>
            <div class="text-2xl font-semibold mt-1">{{ $blogCount }}</div>
        </div>
        <div class="p-5" style="background: var(--color-surface);">
            <div class="text-sm" style="color: var(--color-text-muted);">New enquiries</div>
            <div class="text-2xl font-semibold mt-1">{{ $newEnquiryCount }}</div>
        </div>
    </div>

    <div class="panel overflow-hidden">
        <div class="px-5 py-3.5 border-b text-sm font-semibold" style="border-color: var(--color-border);">Recent enquiries</div>
        @if ($recentEnquiries->isEmpty())
            <div class="empty-state">
                <div class="empty-state-title">No enquiries yet</div>
                <div class="empty-state-hint">Booking and contact enquiries submitted on the public site will show up here.</div>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Received</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentEnquiries as $enquiry)
                            <tr>
                                <td class="font-medium">{{ $enquiry->name }}</td>
                                <td class="capitalize">{{ $enquiry->type }}</td>
                                <td>
                                    <span class="badge badge-{{ $enquiry->status }}">{{ ucfirst($enquiry->status) }}</span>
                                </td>
                                <td style="color: var(--color-text-muted);">{{ $enquiry->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
