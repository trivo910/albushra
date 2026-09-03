@csrf
@if ($faq->exists)
    @method('PUT')
@endif

<div class="bg-white rounded-lg shadow p-6 space-y-6 max-w-2xl">
    <div>
        <label class="block text-sm font-medium mb-1">Question</label>
        <input type="text" name="question" value="{{ old('question', $faq->question) }}" required
               class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Answer</label>
        <textarea name="answer" rows="5" required
                  class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">{{ old('answer', $faq->answer) }}</textarea>
    </div>

    <div>
        <button type="submit" class="bg-gray-900 text-white rounded px-5 py-2 text-sm font-medium hover:bg-gray-800">
            {{ $faq->exists ? 'Update FAQ' : 'Create FAQ' }}
        </button>
        <a href="{{ route('admin.faqs.index') }}" class="ml-2 text-sm text-gray-600 hover:text-gray-900">Cancel</a>
    </div>
</div>
