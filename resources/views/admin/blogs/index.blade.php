@extends('admin.layouts.app')

@section('title', 'Blog')

@section('content')
    <div class="mb-5 flex justify-end">
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
            New post
        </a>
    </div>

    <div class="panel overflow-hidden">
        @if ($blogs->isEmpty())
            <div class="empty-state">
                <div class="empty-state-title">No blog posts yet</div>
                <div class="empty-state-hint">Write your first post to start filling the blog.</div>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead>
                        <tr>
                            @include('admin.partials.sortable-th', ['field' => 'title', 'label' => 'Title'])
                            @include('admin.partials.sortable-th', ['field' => 'status', 'label' => 'Status'])
                            @include('admin.partials.sortable-th', ['field' => 'published_at', 'label' => 'Published'])
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $blog)
                            <tr>
                                <td>
                                    <div class="font-medium">{{ $blog->title }}</div>
                                    <div class="text-xs" style="color: var(--color-text-faint);">/{{ $blog->slug }}</div>
                                </td>
                                <td>
                                    <span class="badge badge-{{ $blog->status }}">{{ ucfirst($blog->status) }}</span>
                                </td>
                                <td style="color: var(--color-text-muted);">{{ $blog->published_at?->format('d M Y') ?? '—' }}</td>
                                <td class="text-right whitespace-nowrap">
                                    <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn-link-muted">Edit</a>
                                    <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="inline"
                                          data-confirm="Delete this blog post?">
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
        {{ $blogs->links() }}
    </div>
@endsection
