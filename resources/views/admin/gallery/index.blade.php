@extends('admin.layouts.app')

@section('title', 'Gallery')

@section('content')
    <div class="bg-white rounded-lg shadow p-6 mb-6 max-w-2xl">
        <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Upload Images</label>
                <input type="file" name="images[]" accept="image/*" multiple required class="w-full text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Caption (applied to all uploaded images)</label>
                <input type="text" name="caption" value="{{ old('caption') }}"
                       class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
            </div>
            <button type="submit" class="bg-gray-900 text-white rounded px-5 py-2 text-sm font-medium hover:bg-gray-800">
                Upload
            </button>
        </form>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-4">
        @forelse ($images as $index => $image)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <img src="{{ \Illuminate\Support\Facades\Storage::url($image->image_path) }}" alt="{{ $image->caption }}"
                     class="h-28 w-full object-cover">
                <div class="p-2 text-xs text-gray-500 truncate">{{ $image->caption ?? '—' }}</div>
                <div class="flex items-center justify-between px-2 pb-2">
                    <div class="flex gap-1">
                        <form action="{{ route('admin.gallery.move-up', $image) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-gray-400 hover:text-gray-800 text-xs {{ $index === 0 ? 'invisible' : '' }}" title="Move up">▲</button>
                        </form>
                        <form action="{{ route('admin.gallery.move-down', $image) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-gray-400 hover:text-gray-800 text-xs {{ $index === $images->count() - 1 ? 'invisible' : '' }}" title="Move down">▼</button>
                        </form>
                    </div>
                    <form action="{{ route('admin.gallery.destroy', $image) }}" method="POST"
                          onsubmit="return confirm('Delete this image?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 text-xs">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-400 py-10">No gallery images yet.</div>
        @endforelse
    </div>
@endsection
