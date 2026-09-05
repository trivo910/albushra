@csrf
@if ($page->exists)
    @method('PUT')
@endif

<div class="panel p-6 max-w-4xl">

    <div class="form-section">
        <div class="form-section-title">Basic info</div>
        <div>
            <label class="field-label">Title</label>
            <input type="text" name="title" value="{{ old('title', $page->title) }}" required class="field-input">
        </div>

        <div class="mt-4">
            <label class="field-label">
                Slug
                @if ($page->exists)
                    <span class="font-normal" style="color: var(--color-text-faint);">— locked, public URLs must not change</span>
                @endif
            </label>
            <input type="text" name="slug" value="{{ old('slug', $page->slug) }}"
                   @if ($page->exists) readonly @endif
                   placeholder="{{ $page->exists ? '' : 'auto-generated from title if left blank' }}"
                   class="field-input">
        </div>

        <div class="mt-4">
            <label class="field-label">Featured image</label>
            @if ($page->featured_image)
                <img src="{{ \Illuminate\Support\Facades\Storage::url($page->featured_image) }}" alt=""
                     class="h-24 mb-2 object-cover" style="border-radius: var(--radius-sm); border: 1px solid var(--color-border);">
            @endif
            <input type="file" name="featured_image" accept="image/*" class="text-sm">
        </div>
    </div>

    <div class="form-section">
        <div class="form-section-title">Content</div>
        <textarea name="content" id="content-editor" rows="10" class="field-input">{{ old('content', $page->content) }}</textarea>
    </div>

    <div class="form-section">
        <div class="form-section-title">SEO</div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="field-label">Meta title</label>
                <input type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" class="field-input">
            </div>
            <div>
                <label class="field-label">Meta description</label>
                <input type="text" name="meta_description" value="{{ old('meta_description', $page->meta_description) }}" class="field-input">
            </div>
        </div>
    </div>

    <div class="form-section flex items-center">
        <button type="submit" class="btn btn-primary">
            {{ $page->exists ? 'Save changes' : 'Create page' }}
        </button>
        <a href="{{ route('admin.pages.index') }}" class="btn-link-muted ml-4">Cancel</a>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script nonce="{{ request()->attributes->get('cspNonce') }}">
        ClassicEditor.create(document.querySelector('#content-editor')).catch(console.error);
    </script>
@endpush
