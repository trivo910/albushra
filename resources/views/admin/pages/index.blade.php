@extends('admin.layouts.app')

@section('title', 'Pages')

@section('content')
    <div class="mb-5 flex justify-end">
        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
            New page
        </a>
    </div>

    <div class="panel overflow-hidden">
        @if ($pages->isEmpty())
            <div class="empty-state">
                <div class="empty-state-title">No pages yet</div>
                <div class="empty-state-hint">Static pages like About Us or Privacy Policy will appear here.</div>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>SEO</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pages as $page)
                            <tr>
                                <td class="font-medium">{{ $page->title }}</td>
                                <td style="color: var(--color-text-muted);">/{{ $page->slug }}</td>
                                <td>
                                    @if ($page->seo_score_label && $page->seo_score_label !== 'none')
                                        @php
                                            $seoBadgeClass = match ($page->seo_score_label) {
                                                'good' => 'badge-published',
                                                'ok' => 'badge-draft',
                                                default => 'badge-danger',
                                            };
                                        @endphp
                                        <span class="badge {{ $seoBadgeClass }}">{{ $page->seo_score }}/100</span>
                                    @else
                                        <span class="text-xs" style="color: var(--color-text-faint);">—</span>
                                    @endif
                                </td>
                                <td class="text-right whitespace-nowrap">
                                    <a href="{{ route('admin.pages.edit', $page) }}" class="btn-link-muted">Edit</a>
                                    <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="inline"
                                          data-confirm="Delete this page?">
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
        {{ $pages->links() }}
    </div>
@endsection
