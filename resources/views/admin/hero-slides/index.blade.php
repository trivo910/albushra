@extends('admin.layouts.app')

@section('title', 'Hero Slider')

@section('content')
    <div class="panel p-6 mb-6 max-w-2xl">
        <div class="form-section-title">Upload slides</div>
        <div class="field-hint mb-4">These images rotate in the homepage hero banner, in the order shown below. Recommended: wide landscape photos, 1600px+ wide.</div>
        <form method="POST" action="{{ route('admin.hero-slides.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="field-label">Images</label>
                <input type="file" name="images[]" accept="image/*" multiple required class="text-sm">
            </div>
            <div>
                <label class="field-label">Caption / alt text (applied to all uploaded images)</label>
                <input type="text" name="caption" value="{{ old('caption') }}" class="field-input">
            </div>
            <button type="submit" class="btn btn-primary">
                Upload
            </button>
        </form>
    </div>

    @if ($slides->isEmpty())
        <div class="panel empty-state">
            <div class="empty-state-title">No hero slides yet</div>
            <div class="empty-state-hint">Upload at least one image above — until then, the homepage hero shows a plain background.</div>
        </div>
    @else
        <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach ($slides as $index => $slide)
                <div class="panel overflow-hidden">
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($slide->image_path) }}" alt="{{ $slide->caption }}"
                         class="h-28 w-full object-cover">
                    <div class="p-2 text-xs truncate" style="color: var(--color-text-muted);">{{ $slide->caption ?? '—' }}</div>
                    <div class="flex items-center justify-between px-2 pb-2">
                        <div class="flex gap-2">
                            <form action="{{ route('admin.hero-slides.move-up', $slide) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-link-muted text-xs {{ $index === 0 ? 'invisible' : '' }}" title="Move up">↑</button>
                            </form>
                            <form action="{{ route('admin.hero-slides.move-down', $slide) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-link-muted text-xs {{ $index === $slides->count() - 1 ? 'invisible' : '' }}" title="Move down">↓</button>
                            </form>
                        </div>
                        <form action="{{ route('admin.hero-slides.destroy', $slide) }}" method="POST"
                              data-confirm="Delete this slide?">
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
