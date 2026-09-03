@csrf
@if ($faq->exists)
    @method('PUT')
@endif

<div class="panel p-6 max-w-2xl">
    <div class="form-section">
        <div>
            <label class="field-label">Question</label>
            <input type="text" name="question" value="{{ old('question', $faq->question) }}" required class="field-input">
        </div>

        <div class="mt-4">
            <label class="field-label">Answer</label>
            <textarea name="answer" rows="5" required class="field-input">{{ old('answer', $faq->answer) }}</textarea>
        </div>
    </div>

    <div class="form-section flex items-center">
        <button type="submit" class="btn btn-primary">
            {{ $faq->exists ? 'Save changes' : 'Create FAQ' }}
        </button>
        <a href="{{ route('admin.faqs.index') }}" class="btn-link-muted ml-4">Cancel</a>
    </div>
</div>
