@extends('admin.layouts.app')

@section('title', 'FAQs')

@section('content')
    <div class="mb-5 flex justify-end">
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">
            New FAQ
        </a>
    </div>

    <div class="panel overflow-hidden">
        @if ($faqs->isEmpty())
            <div class="empty-state">
                <div class="empty-state-title">No FAQs yet</div>
                <div class="empty-state-hint">Common questions and answers for pilgrims will appear here.</div>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th class="w-16">Order</th>
                            <th>Question</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($faqs as $index => $faq)
                            <tr>
                                <td>
                                    <div class="flex flex-col gap-0.5">
                                        <form action="{{ route('admin.faqs.move-up', $faq) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn-link-muted {{ $index === 0 ? 'invisible' : '' }}" title="Move up">↑</button>
                                        </form>
                                        <form action="{{ route('admin.faqs.move-down', $faq) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn-link-muted {{ $index === $faqs->count() - 1 ? 'invisible' : '' }}" title="Move down">↓</button>
                                        </form>
                                    </div>
                                </td>
                                <td>
                                    <div class="font-medium">{{ $faq->question }}</div>
                                    <div class="text-xs mt-0.5" style="color: var(--color-text-faint);">{{ Str::limit($faq->answer, 100) }}</div>
                                </td>
                                <td class="text-right whitespace-nowrap">
                                    <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn-link-muted">Edit</a>
                                    <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Delete this FAQ?');">
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
@endsection
