@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-5">
            <div class="text-sm text-gray-500">Packages</div>
            <div class="text-2xl font-semibold">{{ $packageCount }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-5">
            <div class="text-sm text-gray-500">Blog Posts</div>
            <div class="text-2xl font-semibold">{{ $blogCount }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-5">
            <div class="text-sm text-gray-500">New Enquiries</div>
            <div class="text-2xl font-semibold">{{ $newEnquiryCount }}</div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="px-5 py-4 border-b border-gray-200 font-medium">Recent Enquiries</div>
        <table class="w-full text-sm">
            <thead class="text-left text-gray-500 border-b border-gray-100">
                <tr>
                    <th class="px-5 py-2">Name</th>
                    <th class="px-5 py-2">Type</th>
                    <th class="px-5 py-2">Status</th>
                    <th class="px-5 py-2">Received</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recentEnquiries as $enquiry)
                    <tr class="border-b border-gray-50">
                        <td class="px-5 py-3">{{ $enquiry->name }}</td>
                        <td class="px-5 py-3 capitalize">{{ $enquiry->type }}</td>
                        <td class="px-5 py-3 capitalize">{{ $enquiry->status }}</td>
                        <td class="px-5 py-3">{{ $enquiry->created_at->diffForHumans() }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-6 text-center text-gray-400">No enquiries yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
