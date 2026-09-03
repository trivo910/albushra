@csrf
@if ($page->exists)
    @method('PUT')
@endif

<div class="bg-white rounded-lg shadow p-6 space-y-6 max-w-4xl">
    <div>
        <label class="block text-sm font-medium mb-1">Title</label>
        <input type="text" name="title" value="{{ old('title', $page->title) }}" required
               class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">
            Slug
            @if ($page->exists)
                <span class="text-xs text-gray-400 font-normal">(locked — public URLs must not change)</span>
            @endif
        </label>
        <input type="text" name="slug" value="{{ old('slug', $page->slug) }}"
               @if ($page->exists) readonly @endif
               placeholder="{{ $page->exists ? '' : 'auto-generated from title if left blank' }}"
               class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500 {{ $page->exists ? 'bg-gray-100 text-gray-500 cursor-not-allowed' : '' }}">
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Content</label>
        <textarea name="content" id="content-editor" rows="10"
                  class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">{{ old('content', $page->content) }}</textarea>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Meta Title</label>
            <input type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}"
                   class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Meta Description</label>
            <input type="text" name="meta_description" value="{{ old('meta_description', $page->meta_description) }}"
                   class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
        </div>
    </div>

    <div>
        <button type="submit" class="bg-gray-900 text-white rounded px-5 py-2 text-sm font-medium hover:bg-gray-800">
            {{ $page->exists ? 'Update Page' : 'Create Page' }}
        </button>
        <a href="{{ route('admin.pages.index') }}" class="ml-2 text-sm text-gray-600 hover:text-gray-900">Cancel</a>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#content-editor')).catch(console.error);
    </script>
@endpush
