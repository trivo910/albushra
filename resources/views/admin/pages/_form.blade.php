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
        <div class="mb-4">
            <label class="field-label">Focus keyword</label>
            <input type="text" id="focus-keyword-input" name="focus_keyword"
                   value="{{ old('focus_keyword', $page->focus_keyword) }}" class="field-input">
            <p class="field-hint">The main phrase this page should rank for. Drives the analysis below.</p>
        </div>
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

    <div class="form-section">
        <div class="form-section-title">SEO analysis</div>
        <div class="mb-3 flex items-center gap-2">
            <span id="seo-score-badge" class="badge" style="display:none;"></span>
            <span id="seo-analysis-placeholder" class="text-sm" style="color: var(--color-text-muted);">
                Enter a focus keyword above to see on-page SEO analysis.
            </span>
        </div>
        <ul id="seo-checklist" class="space-y-1.5 text-sm"></ul>
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
    (function () {
        let contentEditor = null;

        ClassicEditor.create(document.querySelector('#content-editor')).then((editor) => {
            contentEditor = editor;
            editor.model.document.on('change:data', scheduleAnalysis);
        }).catch(console.error);

        const focusKeywordInput = document.querySelector('#focus-keyword-input');
        const titleInput = document.querySelector('input[name="title"]');
        const slugInput = document.querySelector('input[name="slug"]');
        const metaTitleInput = document.querySelector('input[name="meta_title"]');
        const metaDescriptionInput = document.querySelector('input[name="meta_description"]');

        const checklistEl = document.querySelector('#seo-checklist');
        const badgeEl = document.querySelector('#seo-score-badge');
        const placeholderEl = document.querySelector('#seo-analysis-placeholder');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        function slugify(value) {
            return value.toLowerCase().trim()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-+|-+$)/g, '');
        }

        let debounceTimer = null;
        function scheduleAnalysis() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(runAnalysis, 600);
        }

        async function runAnalysis() {
            const focusKeyword = focusKeywordInput.value.trim();

            if (!focusKeyword) {
                checklistEl.innerHTML = '';
                badgeEl.style.display = 'none';
                placeholderEl.style.display = '';
                return;
            }

            const payload = {
                focus_keyword: focusKeyword,
                title: titleInput.value,
                slug: slugInput ? slugInput.value : slugify(titleInput.value),
                meta_title: metaTitleInput.value,
                meta_description: metaDescriptionInput.value,
                content: contentEditor ? contentEditor.getData() : '',
            };

            try {
                const response = await window.axios.post('{{ route('admin.pages.seo-preview') }}', payload, {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                });
                renderAnalysis(response.data);
            } catch (error) {
                console.error(error);
            }
        }

        function renderAnalysis(data) {
            placeholderEl.style.display = 'none';
            badgeEl.style.display = '';

            const labels = { good: 'Good', ok: 'OK', poor: 'Needs work' };
            const badgeClasses = { good: 'badge-published', ok: 'badge-draft', poor: 'badge-danger' };
            badgeEl.textContent = `${labels[data.label] ?? data.label} · ${data.score}/100`;
            badgeEl.className = `badge ${badgeClasses[data.label] ?? 'badge-neutral'}`;

            const statusColors = { good: 'var(--status-published-text)', ok: 'var(--status-draft-text)', bad: 'var(--color-danger)' };

            checklistEl.innerHTML = data.checks.map((check) => {
                const icon = check.status === 'good' ? '✓' : check.status === 'ok' ? '⚠' : '✗';
                const color = statusColors[check.status] ?? 'var(--color-text-muted)';
                return `<li class="flex items-start gap-2"><span style="color:${color}; font-weight:600;">${icon}</span><span>${check.message}</span></li>`;
            }).join('');
        }

        [focusKeywordInput, titleInput, slugInput, metaTitleInput, metaDescriptionInput].forEach((el) => {
            if (el) el.addEventListener('input', scheduleAnalysis);
        });
    })();
    </script>
@endpush
