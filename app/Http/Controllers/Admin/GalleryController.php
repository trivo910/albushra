<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGalleryImageRequest;
use App\Models\GalleryImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        return view('admin.gallery.index', [
            'images' => GalleryImage::orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function store(StoreGalleryImageRequest $request): RedirectResponse
    {
        $nextSort = (int) GalleryImage::max('sort_order') + 1;

        foreach ($request->file('images') as $file) {
            GalleryImage::create([
                'image_path' => $file->store('gallery', 'public'),
                'caption' => $request->input('caption'),
                'sort_order' => $nextSort++,
            ]);
        }

        return redirect()->route('admin.gallery.index')->with('success', 'Images uploaded successfully.');
    }

    public function destroy(GalleryImage $image): RedirectResponse
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Image deleted.');
    }

    public function moveUp(GalleryImage $image): RedirectResponse
    {
        $previous = GalleryImage::where('sort_order', '<', $image->sort_order)
            ->orderByDesc('sort_order')
            ->first();

        if ($previous) {
            $this->swapSortOrder($image, $previous);
        }

        return redirect()->route('admin.gallery.index');
    }

    public function moveDown(GalleryImage $image): RedirectResponse
    {
        $next = GalleryImage::where('sort_order', '>', $image->sort_order)
            ->orderBy('sort_order')
            ->first();

        if ($next) {
            $this->swapSortOrder($image, $next);
        }

        return redirect()->route('admin.gallery.index');
    }

    private function swapSortOrder(GalleryImage $a, GalleryImage $b): void
    {
        [$aOrder, $bOrder] = [$a->sort_order, $b->sort_order];

        $a->update(['sort_order' => $bOrder]);
        $b->update(['sort_order' => $aOrder]);
    }
}
