@extends('admin.layouts.app')

@section('title', 'FAQs')

@section('content')
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.faqs.create') }}"
           class="bg-gray-900 text-white rounded px-4 py-2 text-sm font-medium hover:bg-gray-800">
            + New FAQ
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="text-left text-gray-500 border-b border-gray-100 bg-gray-50">
                <tr>
                    <th class="px-5 py-3 w-16">Order</th>
                    <th class="px-5 py-3">Question</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($faqs as $index => $faq)
                    <tr class="border-b border-gray-50">
                        <td class="px-5 py-3">
                            <div class="flex flex-col gap-0.5">
                                <form action="{{ route('admin.faqs.move-up', $faq) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-gray-400 hover:text-gray-800 {{ $index === 0 ? 'invisible' : '' }}" title="Move up">▲</button>
                                </form>
                                <form action="{{ route('admin.faqs.move-down', $faq) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-gray-400 hover:text-gray-800 {{ $index === $faqs->count() - 1 ? 'invisible' : '' }}" title="Move down">▼</button>
                                </form>
                            </div>
                        </td>
                        <td class="px-5 py-3">
                            <div class="font-medium">{{ $faq->question }}</div>
                            <div class="text-xs text-gray-400 line-clamp-1">{{ Str::limit($faq->answer, 100) }}</div>
                        </td>
                        <td class="px-5 py-3 text-right space-x-3">
                            <a href="{{ route('admin.faqs.edit', $faq) }}" class="text-gray-600 hover:text-gray-900">Edit</a>
                            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Delete this FAQ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-5 py-6 text-center text-gray-400">No FAQs yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
