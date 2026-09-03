@extends('admin.layouts.app')

@section('title', 'Enquiry details')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.enquiries.index') }}" class="btn-link-muted">&larr; Back to enquiries</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 max-w-4xl">
        <div class="lg:col-span-2 panel p-6 space-y-4">
            <div>
                <div class="text-xs mb-1" style="color: var(--color-text-faint);">Name</div>
                <div class="font-medium">{{ $enquiry->name }}</div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <div class="text-xs mb-1" style="color: var(--color-text-faint);">Email</div>
                    <div>{{ $enquiry->email }}</div>
                </div>
                <div>
                    <div class="text-xs mb-1" style="color: var(--color-text-faint);">Phone</div>
                    <div>{{ $enquiry->phone ?? '—' }}</div>
                </div>
            </div>
            <div>
                <div class="text-xs mb-1" style="color: var(--color-text-faint);">Type</div>
                <div class="capitalize">{{ $enquiry->type }}</div>
            </div>
            @if ($enquiry->package)
                <div>
                    <div class="text-xs mb-1" style="color: var(--color-text-faint);">Package</div>
                    <div>{{ $enquiry->package->title }}</div>
                </div>
            @endif
            <div>
                <div class="text-xs mb-1" style="color: var(--color-text-faint);">Message</div>
                <div class="whitespace-pre-line">{{ $enquiry->message ?? '—' }}</div>
            </div>
            <div>
                <div class="text-xs mb-1" style="color: var(--color-text-faint);">Received</div>
                <div style="color: var(--color-text-muted);">{{ $enquiry->created_at->format('d M Y, H:i') }}</div>
            </div>
        </div>

        <div class="panel p-6">
            <form method="POST" action="{{ route('admin.enquiries.update', $enquiry) }}" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="field-label">Status</label>
                    <select name="status" class="field-input">
                        <option value="new" @selected($enquiry->status === 'new')>New</option>
                        <option value="contacted" @selected($enquiry->status === 'contacted')>Contacted</option>
                        <option value="closed" @selected($enquiry->status === 'closed')>Closed</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-full">
                    Update status
                </button>
            </form>
        </div>
    </div>
@endsection
