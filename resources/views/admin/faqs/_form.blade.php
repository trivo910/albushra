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

        <label class="flex items-center gap-2 text-sm pt-4" style="color: var(--color-text-muted);">
            <input type="hidden" name="show_on_home" value="0">
            <input type="checkbox" name="show_on_home" value="1" style="border-color: var(--color-border-strong);"
                   @checked(old('show_on_home', $faq->show_on_home ?? true))>
            Show on home page
        </label>
    </div>

    <div class="form-section flex items-center">
        <button type="submit" class="btn btn-primary">
            {{ $faq->exists ? 'Save changes' : 'Create FAQ' }}
        </button>
        <a href="{{ route('admin.faqs.index') }}" class="btn-link-muted ml-4">Cancel</a>
    </div>
</div>
