@extends('admin.layouts.app')

@section('title', 'Enquiries')

@section('content')
    <div class="mb-4 flex gap-2">
        <a href="{{ route('admin.enquiries.index') }}"
           class="px-3 py-1.5 rounded text-sm {{ $currentType === '' ? 'bg-gray-900 text-white' : 'bg-white text-gray-600 border border-gray-200' }}">
            All
        </a>
        <a href="{{ route('admin.enquiries.index', ['type' => 'booking']) }}"
           class="px-3 py-1.5 rounded text-sm {{ $currentType === 'booking' ? 'bg-gray-900 text-white' : 'bg-white text-gray-600 border border-gray-200' }}">
            Booking
        </a>
        <a href="{{ route('admin.enquiries.index', ['type' => 'contact']) }}"
           class="px-3 py-1.5 rounded text-sm {{ $currentType === 'contact' ? 'bg-gray-900 text-white' : 'bg-white text-gray-600 border border-gray-200' }}">
            Contact
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="text-left text-gray-500 border-b border-gray-100 bg-gray-50">
                <tr>
                    <th class="px-5 py-3">Name</th>
                    <th class="px-5 py-3">Contact</th>
                    <th class="px-5 py-3">Type</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3">Received</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($enquiries as $enquiry)
                    <tr class="border-b border-gray-50">
                        <td class="px-5 py-3 font-medium">{{ $enquiry->name }}</td>
                        <td class="px-5 py-3 text-gray-500">
                            <div>{{ $enquiry->email }}</div>
                            <div>{{ $enquiry->phone }}</div>
                        </td>
                        <td class="px-5 py-3 capitalize">{{ $enquiry->type }}</td>
                        <td class="px-5 py-3">
                            <span class="inline-block rounded-full px-2 py-0.5 text-xs
                                {{ match($enquiry->status) {
                                    'new' => 'bg-amber-100 text-amber-700',
                                    'contacted' => 'bg-blue-100 text-blue-700',
                                    'closed' => 'bg-gray-100 text-gray-600',
                                } }}">
                                {{ ucfirst($enquiry->status) }}
                            </span>
                        </td>
                        <td class="px-5 py-3">{{ $enquiry->created_at->format('d M Y, H:i') }}</td>
                        <td class="px-5 py-3 text-right">
                            <a href="{{ route('admin.enquiries.show', $enquiry) }}" class="text-gray-600 hover:text-gray-900">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-6 text-center text-gray-400">No enquiries found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $enquiries->links() }}
    </div>
@endsection
