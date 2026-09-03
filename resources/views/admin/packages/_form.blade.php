@csrf
@if ($package->exists)
    @method('PUT')
@endif

<div class="panel p-6 max-w-4xl">

    <div class="form-section">
        <div class="form-section-title">Basic info</div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="field-label">Title</label>
                <input type="text" name="title" value="{{ old('title', $package->title) }}" required class="field-input">
            </div>
            <div>
                <label class="field-label">Category</label>
                <select name="category" class="field-input">
                    <option value="hajj" @selected(old('category', $package->category) === 'hajj')>Hajj</option>
                    <option value="umrah" @selected(old('category', $package->category) === 'umrah')>Umrah</option>
                </select>
            </div>
        </div>

        @if ($package->exists)
            <div class="mt-4">
                <label class="field-label">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $package->slug) }}" required class="field-input">
            </div>
        @endif

        <div class="mt-4">
            <label class="field-label">Description</label>
            <textarea name="description" id="description-editor" rows="8" class="field-input">{{ old('description', $package->description) }}</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4 items-end">
            <div>
                <label class="field-label">Status</label>
                <select name="status" class="field-input">
                    <option value="draft" @selected(old('status', $package->status) === 'draft')>Draft</option>
                    <option value="published" @selected(old('status', $package->status) === 'published')>Published</option>
                </select>
            </div>
            <label class="flex items-center gap-2 text-sm pb-2" style="color: var(--color-text-muted);">
                <input type="hidden" name="is_featured" value="0">
                <input type="checkbox" name="is_featured" value="1" style="border-color: var(--color-border-strong);"
                       @checked(old('is_featured', $package->is_featured))>
                Feature this package
            </label>
        </div>
    </div>

    <div class="form-section">
        <div class="form-section-title">Pricing &amp; duration</div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="field-label">Price</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $package->price) }}" class="field-input">
            </div>
            <div>
                <label class="field-label">Duration</label>
                <input type="text" name="duration" value="{{ old('duration', $package->duration) }}" placeholder="e.g. 10 Days / 9 Nights" class="field-input">
            </div>
            <div>
                <label class="field-label">Rating (0–5)</label>
                <input type="number" step="0.1" min="0" max="5" name="rating" value="{{ old('rating', $package->rating) }}" class="field-input">
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
            <div>
                <label class="field-label">Tour type</label>
                <input type="text" name="tour_type" value="{{ old('tour_type', $package->tour_type) }}" class="field-input">
            </div>
            <div>
                <label class="field-label">Group size</label>
                <input type="text" name="group_size" value="{{ old('group_size', $package->group_size) }}" class="field-input">
            </div>
            <div>
                <label class="field-label">Languages</label>
                <input type="text" name="languages" value="{{ old('languages', $package->languages) }}" class="field-input">
            </div>
        </div>
        <div class="mt-4">
            <label class="field-label">Map embed (iframe / HTML)</label>
            <textarea name="map_embed" rows="3" class="field-input field-input-mono">{{ old('map_embed', $package->map_embed) }}</textarea>
        </div>
    </div>

    <div class="form-section">
        <div class="form-section-title">Images</div>

        @if ($package->exists && $package->images->isNotEmpty())
            <div class="grid grid-cols-3 sm:grid-cols-6 gap-3 mb-4">
                @foreach ($package->images as $image)
                    <div class="relative">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($image->image_path) }}" alt=""
                             class="h-20 w-full object-cover rounded" style="border-radius: var(--radius-sm); border: 1px solid var(--color-border);">
                        <form action="{{ route('admin.package-images.destroy', $image) }}" method="POST"
                              data-confirm="Remove this image?" class="absolute top-1 right-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-white text-xs rounded-full w-5 h-5 flex items-center justify-center"
                                    style="background: var(--color-danger);">
                                &times;
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif

        <label class="field-label">Add gallery images</label>
        <input type="file" name="images[]" accept="image/*" multiple class="text-sm">
        <div class="field-hint">JPG or PNG, up to 4MB each. New images are appended to the gallery above.</div>
    </div>

    <div class="form-section">
        <div class="form-section-title">Inclusions</div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="field-label">Included</label>
                <div data-repeatable-list data-name="included">
                    <div data-repeatable-rows class="space-y-2"></div>
                    <button type="button" data-add-row class="btn-link-muted mt-2">+ Add item</button>
                </div>
            </div>
            <div>
                <label class="field-label">Excluded</label>
                <div data-repeatable-list data-name="excluded">
                    <div data-repeatable-rows class="space-y-2"></div>
                    <button type="button" data-add-row class="btn-link-muted mt-2">+ Add item</button>
                </div>
            </div>
        </div>
    </div>

    <div class="form-section">
        <div class="form-section-title">SEO</div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="field-label">Meta title</label>
                <input type="text" name="meta_title" value="{{ old('meta_title', $package->meta_title) }}" class="field-input">
            </div>
            <div>
                <label class="field-label">Meta description</label>
                <input type="text" name="meta_description" value="{{ old('meta_description', $package->meta_description) }}" class="field-input">
            </div>
        </div>
    </div>

    <div class="form-section flex items-center">
        <button type="submit" class="btn btn-primary">
            {{ $package->exists ? 'Save changes' : 'Create package' }}
        </button>
        <a href="{{ route('admin.packages.index') }}" class="btn-link-muted ml-4">Cancel</a>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script nonce="{{ request()->attributes->get('cspNonce') }}">
        ClassicEditor.create(document.querySelector('#description-editor')).catch(console.error);

        function initRepeatableList(container) {
            const name = container.dataset.name;
            const rowsWrapper = container.querySelector('[data-repeatable-rows]');
            const addButton = container.querySelector('[data-add-row]');

            function addRow(value = '') {
                const row = document.createElement('div');
                row.className = 'flex gap-2';
                row.innerHTML = `
                    <input type="text" name="${name}[]" value="${value.replace(/"/g, '&quot;')}" class="field-input">
                    <button type="button" data-remove-row class="btn-link-danger px-1">&times;</button>
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
