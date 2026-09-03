@extends('admin.layouts.app')

@section('title', 'Packages')

@section('content')
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.packages.create') }}"
           class="bg-gray-900 text-white rounded px-4 py-2 text-sm font-medium hover:bg-gray-800">
            + New Package
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="text-left text-gray-500 border-b border-gray-100 bg-gray-50">
                <tr>
                    <th class="px-5 py-3">Title</th>
                    <th class="px-5 py-3">Category</th>
                    <th class="px-5 py-3">Price</th>
                    <th class="px-5 py-3">Rating</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($packages as $package)
                    <tr class="border-b border-gray-50">
                        <td class="px-5 py-3">
                            <div class="font-medium">
                                {{ $package->title }}
                                @if ($package->is_featured)
                                    <span class="ml-1 text-xs text-amber-600">★ Featured</span>
                                @endif
                            </div>
                            <div class="text-xs text-gray-400">/{{ $package->slug }}</div>
                        </td>
                        <td class="px-5 py-3 uppercase text-xs">{{ $package->category }}</td>
                        <td class="px-5 py-3">{{ $package->price ? '₹'.number_format($package->price) : '—' }}</td>
                        <td class="px-5 py-3">{{ $package->rating }}</td>
                        <td class="px-5 py-3">
                            <span class="inline-block rounded-full px-2 py-0.5 text-xs {{ $package->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ ucfirst($package->status) }}
                            </span>
                        </td>
                        <td class="px-5 py-3 text-right space-x-3">
                            <a href="{{ route('admin.packages.edit', $package) }}" class="text-gray-600 hover:text-gray-900">Edit</a>
                            <form action="{{ route('admin.packages.destroy', $package) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Delete this package?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-6 text-center text-gray-400">No packages yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $packages->links() }}
    </div>
@endsection
