@extends('admin.layouts.app')

@section('title', 'Blog Posts')

@section('content')
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.blogs.create') }}"
           class="bg-gray-900 text-white rounded px-4 py-2 text-sm font-medium hover:bg-gray-800">
            + New Post
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="text-left text-gray-500 border-b border-gray-100 bg-gray-50">
                <tr>
                    <th class="px-5 py-3">Title</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3">Published</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($blogs as $blog)
                    <tr class="border-b border-gray-50">
                        <td class="px-5 py-3">
                            <div class="font-medium">{{ $blog->title }}</div>
                            <div class="text-xs text-gray-400">/{{ $blog->slug }}</div>
                        </td>
                        <td class="px-5 py-3">
                            <span class="inline-block rounded-full px-2 py-0.5 text-xs {{ $blog->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ ucfirst($blog->status) }}
                            </span>
                        </td>
                        <td class="px-5 py-3">{{ $blog->published_at?->format('d M Y') ?? '—' }}</td>
                        <td class="px-5 py-3 text-right space-x-3">
                            <a href="{{ route('admin.blogs.edit', $blog) }}" class="text-gray-600 hover:text-gray-900">Edit</a>
                            <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Delete this blog post?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-6 text-center text-gray-400">No blog posts yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $blogs->links() }}
    </div>
@endsection
