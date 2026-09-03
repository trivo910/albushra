@extends('admin.layouts.app')

@section('title', 'Pages')

@section('content')
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.pages.create') }}"
           class="bg-gray-900 text-white rounded px-4 py-2 text-sm font-medium hover:bg-gray-800">
            + New Page
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="text-left text-gray-500 border-b border-gray-100 bg-gray-50">
                <tr>
                    <th class="px-5 py-3">Title</th>
                    <th class="px-5 py-3">Slug</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pages as $page)
                    <tr class="border-b border-gray-50">
                        <td class="px-5 py-3 font-medium">{{ $page->title }}</td>
                        <td class="px-5 py-3 text-gray-500">/{{ $page->slug }}</td>
                        <td class="px-5 py-3 text-right space-x-3">
                            <a href="{{ route('admin.pages.edit', $page) }}" class="text-gray-600 hover:text-gray-900">Edit</a>
                            <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Delete this page?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-5 py-6 text-center text-gray-400">No pages yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $pages->links() }}
    </div>
@endsection
