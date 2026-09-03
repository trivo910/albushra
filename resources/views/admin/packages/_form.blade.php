@csrf
@if ($package->exists)
    @method('PUT')
@endif

<div class="bg-white rounded-lg shadow p-6 space-y-6 max-w-4xl">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title', $package->title) }}" required
                   class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Category</label>
            <select name="category" class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
                <option value="hajj" @selected(old('category', $package->category) === 'hajj')>Hajj</option>
                <option value="umrah" @selected(old('category', $package->category) === 'umrah')>Umrah</option>
            </select>
        </div>
    </div>

    @if ($package->exists)
        <div>
            <label class="block text-sm font-medium mb-1">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $package->slug) }}" required
                   class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Price</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $package->price) }}"
                   class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Duration</label>
            <input type="text" name="duration" value="{{ old('duration', $package->duration) }}" placeholder="e.g. 10 Days / 9 Nights"
                   class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Rating (0-5)</label>
            <input type="number" step="0.1" min="0" max="5" name="rating" value="{{ old('rating', $package->rating) }}"
                   class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Tour Type</label>
            <input type="text" name="tour_type" value="{{ old('tour_type', $package->tour_type) }}"
                   class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Group Size</label>
            <input type="text" name="group_size" value="{{ old('group_size', $package->group_size) }}"
                   class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Languages</label>
            <input type="text" name="languages" value="{{ old('languages', $package->languages) }}"
                   class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Description</label>
        <textarea name="description" id="description-editor" rows="8"
                  class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">{{ old('description', $package->description) }}</textarea>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium mb-2">Included</label>
            <div data-repeatable-list data-name="included">
                <div data-repeatable-rows class="space-y-2"></div>
                <button type="button" data-add-row class="mt-2 text-sm text-gray-600 hover:text-gray-900">+ Add Item</button>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium mb-2">Excluded</label>
            <div data-repeatable-list data-name="excluded">
                <div data-repeatable-rows class="space-y-2"></div>
                <button type="button" data-add-row class="mt-2 text-sm text-gray-600 hover:text-gray-900">+ Add Item</button>
            </div>
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Map Embed (iframe / HTML)</label>
        <textarea name="map_embed" rows="3"
                  class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500 font-mono text-xs">{{ old('map_embed', $package->map_embed) }}</textarea>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-end">
        <div>
            <label class="block text-sm font-medium mb-1">Status</label>
            <select name="status" class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
                <option value="draft" @selected(old('status', $package->status) === 'draft')>Draft</option>
                <option value="published" @selected(old('status', $package->status) === 'published')>Published</option>
            </select>
        </div>
        <label class="flex items-center gap-2 text-sm">
            <input type="hidden" name="is_featured" value="0">
            <input type="checkbox" name="is_featured" value="1" class="rounded border-gray-300"
                   @checked(old('is_featured', $package->is_featured))>
            Featured Package
        </label>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Meta Title</label>
            <input type="text" name="meta_title" value="{{ old('meta_title', $package->meta_title) }}"
                   class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Meta Description</label>
            <input type="text" name="meta_description" value="{{ old('meta_description', $package->meta_description) }}"
                   class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
        </div>
    </div>

    @if ($package->exists && $package->images->isNotEmpty())
        <div>
            <label class="block text-sm font-medium mb-2">Current Gallery Images</label>
            <div class="grid grid-cols-3 sm:grid-cols-6 gap-3">
                @foreach ($package->images as $image)
                    <div class="relative">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($image->image_path) }}" alt=""
                             class="h-20 w-full object-cover rounded">
                        <form action="{{ route('admin.package-images.destroy', $image) }}" method="POST"
                              onsubmit="return confirm('Remove this image?');" class="absolute top-1 right-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center hover:bg-red-700">
                                &times;
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div>
        <label class="block text-sm font-medium mb-1">Add Gallery Images</label>
        <input type="file" name="images[]" accept="image/*" multiple class="w-full text-sm">
    </div>

    <div>
        <button type="submit" class="bg-gray-900 text-white rounded px-5 py-2 text-sm font-medium hover:bg-gray-800">
            {{ $package->exists ? 'Update Package' : 'Create Package' }}
        </button>
        <a href="{{ route('admin.packages.index') }}" class="ml-2 text-sm text-gray-600 hover:text-gray-900">Cancel</a>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#description-editor')).catch(console.error);

        function initRepeatableList(container) {
            const name = container.dataset.name;
            const rowsWrapper = container.querySelector('[data-repeatable-rows]');
            const addButton = container.querySelector('[data-add-row]');

            function addRow(value = '') {
                const row = document.createElement('div');
                row.className = 'flex gap-2';
                row.innerHTML = `
                    <input type="text" name="${name}[]" value="${value.replace(/"/g, '&quot;')}"
                           class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500 text-sm">
                    <button type="button" data-remove-row class="text-red-600 hover:text-red-800 text-sm px-2">&times;</button>
                `;
                row.querySelector('[data-remove-row]').addEventListener('click', () => row.remove());
                rowsWrapper.appendChild(row);
            }

            addButton.addEventListener('click', () => addRow());

            return addRow;
        }

        document.querySelectorAll('[data-repeatable-list]').forEach((container) => {
            const name = container.dataset.name;
            const addRow = initRepeatableList(container);
            const values = name === 'included' ? @json(old('included', $package->included ?? [])) : @json(old('excluded', $package->excluded ?? []));

            if (values.length) {
                values.forEach((value) => addRow(value));
            } else {
                addRow();
            }
        });
    </script>
@endpush
