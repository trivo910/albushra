@csrf
@if ($blog->exists)
    @method('PUT')
@endif

<div class="panel p-6 max-w-4xl">

    <div class="form-section">
        <div class="form-section-title">Basic info</div>
        <div>
            <label class="field-label">Title</label>
            <input type="text" name="title" value="{{ old('title', $blog->title) }}" required class="field-input">
        </div>

        @if ($blog->exists)
            <div class="mt-4">
                <label class="field-label">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $blog->slug) }}" required class="field-input">
            </div>
        @endif

        <div class="mt-4">
            <label class="field-label">Featured image</label>
            @if ($blog->featured_image)
                <img src="{{ \Illuminate\Support\Facades\Storage::url($blog->featured_image) }}" alt=""
                     class="h-24 mb-2 object-cover" style="border-radius: var(--radius-sm); border: 1px solid var(--color-border);">
            @endif
            <input type="file" name="featured_image" accept="image/*" class="text-sm">
        </div>
    </div>

    <div class="form-section">
        <div class="form-section-title">Content</div>
        <textarea name="content" id="content-editor" rows="10" class="field-input">{{ old('content', $blog->content) }}</textarea>
    </div>

    <div class="form-section">
        <div class="form-section-title">Publishing</div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="field-label">Status</label>
                <select name="status" class="field-input">
                    <option value="draft" @selected(old('status', $blog->status) === 'draft')>Draft</option>
                    <option value="published" @selected(old('status', $blog->status) === 'published')>Published</option>
                </select>
            </div>
            <div>
                <label class="field-label">Published at</label>
                <input type="datetime-local" name="published_at"
                       value="{{ old('published_at', optional($blog->published_at)->format('Y-m-d\TH:i')) }}"
                       class="field-input">
            </div>
        </div>
    </div>

    <div class="form-section">
        <div class="form-section-title">SEO</div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="field-label">Meta title</label>
                <input type="text" name="meta_title" value="{{ old('meta_title', $blog->meta_title) }}" class="field-input">
            </div>
            <div>
                <label class="field-label">Meta description</label>
                <input type="text" name="meta_description" value="{{ old('meta_description', $blog->meta_description) }}" class="field-input">
            </div>
        </div>
    </div>

    <div class="form-section flex items-center">
        <button type="submit" class="btn btn-primary">
            {{ $blog->exists ? 'Save changes' : 'Publish post' }}
        </button>
        <a href="{{ route('admin.blogs.index') }}" class="btn-link-muted ml-4">Cancel</a>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script nonce="{{ request()->attributes->get('cspNonce') }}">
        ClassicEditor.create(document.querySelector('#content-editor')).catch(console.error);
    </script>
@endpush
