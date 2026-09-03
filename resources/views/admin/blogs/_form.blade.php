@csrf
@if ($blog->exists)
    @method('PUT')
@endif

<div class="bg-white rounded-lg shadow p-6 space-y-6 max-w-4xl">
    <div>
        <label class="block text-sm font-medium mb-1">Title</label>
        <input type="text" name="title" value="{{ old('title', $blog->title) }}" required
               class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
    </div>

    @if ($blog->exists)
        <div>
            <label class="block text-sm font-medium mb-1">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $blog->slug) }}" required
                   class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
        </div>
    @endif

    <div>
        <label class="block text-sm font-medium mb-1">Featured Image</label>
        @if ($blog->featured_image)
            <img src="{{ \Illuminate\Support\Facades\Storage::url($blog->featured_image) }}" alt="" class="h-24 rounded mb-2 object-cover">
        @endif
        <input type="file" name="featured_image" accept="image/*"
               class="w-full text-sm">
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Content</label>
        <textarea name="content" id="content-editor" rows="10"
                  class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">{{ old('content', $blog->content) }}</textarea>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Status</label>
            <select name="status" class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
                <option value="draft" @selected(old('status', $blog->status) === 'draft')>Draft</option>
                <option value="published" @selected(old('status', $blog->status) === 'published')>Published</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Published At</label>
            <input type="datetime-local" name="published_at"
                   value="{{ old('published_at', optional($blog->published_at)->format('Y-m-d\TH:i')) }}"
                   class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Meta Title</label>
            <input type="text" name="meta_title" value="{{ old('meta_title', $blog->meta_title) }}"
                   class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Meta Description</label>
            <input type="text" name="meta_description" value="{{ old('meta_description', $blog->meta_description) }}"
                   class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
        </div>
    </div>

    <div>
        <button type="submit" class="bg-gray-900 text-white rounded px-5 py-2 text-sm font-medium hover:bg-gray-800">
            {{ $blog->exists ? 'Update Post' : 'Create Post' }}
        </button>
        <a href="{{ route('admin.blogs.index') }}" class="ml-2 text-sm text-gray-600 hover:text-gray-900">Cancel</a>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#content-editor')).catch(console.error);
    </script>
@endpush
