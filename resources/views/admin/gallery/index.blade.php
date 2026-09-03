@extends('admin.layouts.app')

@section('title', 'Gallery')

@section('content')
    <div class="panel p-6 mb-6 max-w-2xl">
        <div class="form-section-title">Upload images</div>
        <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="field-label">Images</label>
                <input type="file" name="images[]" accept="image/*" multiple required class="text-sm">
            </div>
            <div>
                <label class="field-label">Caption (applied to all uploaded images)</label>
                <input type="text" name="caption" value="{{ old('caption') }}" class="field-input">
            </div>
            <button type="submit" class="btn btn-primary">
                Upload
            </button>
        </form>
    </div>

    @if ($images->isEmpty())
        <div class="panel empty-state">
            <div class="empty-state-title">No gallery images yet</div>
            <div class="empty-state-hint">Upload photos above to build the site gallery.</div>
        </div>
    @else
        <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach ($images as $index => $image)
                <div class="panel overflow-hidden">
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($image->image_path) }}" alt="{{ $image->caption }}"
                         class="h-28 w-full object-cover">
                    <div class="p-2 text-xs truncate" style="color: var(--color-text-muted);">{{ $image->caption ?? '—' }}</div>
                    <div class="flex items-center justify-between px-2 pb-2">
                        <div class="flex gap-2">
                            <form action="{{ route('admin.gallery.move-up', $image) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-link-muted text-xs {{ $index === 0 ? 'invisible' : '' }}" title="Move up">↑</button>
                            </form>
                            <form action="{{ route('admin.gallery.move-down', $image) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-link-muted text-xs {{ $index === $images->count() - 1 ? 'invisible' : '' }}" title="Move down">↓</button>
                            </form>
                        </div>
                        <form action="{{ route('admin.gallery.destroy', $image) }}" method="POST"
                              onsubmit="return confirm('Delete this image?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-link-danger text-xs">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
