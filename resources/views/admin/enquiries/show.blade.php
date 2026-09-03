@extends('admin.layouts.app')

@section('title', 'Enquiry Details')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.enquiries.index') }}" class="text-sm text-gray-600 hover:text-gray-900">&larr; Back to enquiries</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 max-w-4xl">
        <div class="lg:col-span-2 bg-white rounded-lg shadow p-6 space-y-4">
            <div>
                <div class="text-xs text-gray-400 uppercase">Name</div>
                <div class="font-medium">{{ $enquiry->name }}</div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <div class="text-xs text-gray-400 uppercase">Email</div>
                    <div>{{ $enquiry->email }}</div>
                </div>
                <div>
                    <div class="text-xs text-gray-400 uppercase">Phone</div>
                    <div>{{ $enquiry->phone ?? '—' }}</div>
                </div>
            </div>
            <div>
                <div class="text-xs text-gray-400 uppercase">Type</div>
                <div class="capitalize">{{ $enquiry->type }}</div>
            </div>
            @if ($enquiry->package)
                <div>
                    <div class="text-xs text-gray-400 uppercase">Package</div>
                    <div>{{ $enquiry->package->title }}</div>
                </div>
            @endif
            <div>
                <div class="text-xs text-gray-400 uppercase">Message</div>
                <div class="whitespace-pre-line">{{ $enquiry->message ?? '—' }}</div>
            </div>
            <div>
                <div class="text-xs text-gray-400 uppercase">Received</div>
                <div>{{ $enquiry->created_at->format('d M Y, H:i') }}</div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <form method="POST" action="{{ route('admin.enquiries.update', $enquiry) }}" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium mb-1">Status</label>
                    <select name="status" class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
                        <option value="new" @selected($enquiry->status === 'new')>New</option>
                        <option value="contacted" @selected($enquiry->status === 'contacted')>Contacted</option>
                        <option value="closed" @selected($enquiry->status === 'closed')>Closed</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-gray-900 text-white rounded px-4 py-2 text-sm font-medium hover:bg-gray-800">
                    Update Status
                </button>
            </form>
        </div>
    </div>
@endsection
