<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreHeroSlideRequest;
use App\Models\HeroSlide;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class HeroSlideController extends Controller
{
    public function index(): View
    {
        return view('admin.hero-slides.index', [
            'slides' => HeroSlide::orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function store(StoreHeroSlideRequest $request): RedirectResponse
    {
        $nextSort = (int) HeroSlide::max('sort_order') + 1;

        foreach ($request->file('images') as $file) {
            HeroSlide::create([
                'image_path' => $file->store('hero-slides', 'public'),
                'caption' => $request->input('caption'),
                'sort_order' => $nextSort++,
            ]);
        }

        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide(s) uploaded successfully.');
    }

    public function destroy(HeroSlide $heroSlide): RedirectResponse
    {
        Storage::disk('public')->delete($heroSlide->image_path);
        $heroSlide->delete();

        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide deleted.');
    }

    public function moveUp(HeroSlide $heroSlide): RedirectResponse
    {
        $previous = HeroSlide::where('sort_order', '<', $heroSlide->sort_order)
            ->orderByDesc('sort_order')
            ->first();

        if ($previous) {
            $this->swapSortOrder($heroSlide, $previous);
        }

        return redirect()->route('admin.hero-slides.index');
    }

    public function moveDown(HeroSlide $heroSlide): RedirectResponse
    {
        $next = HeroSlide::where('sort_order', '>', $heroSlide->sort_order)
            ->orderBy('sort_order')
            ->first();

        if ($next) {
            $this->swapSortOrder($heroSlide, $next);
        }

        return redirect()->route('admin.hero-slides.index');
    }

    private function swapSortOrder(HeroSlide $a, HeroSlide $b): void
    {
        [$aOrder, $bOrder] = [$a->sort_order, $b->sort_order];

        $a->update(['sort_order' => $bOrder]);
        $b->update(['sort_order' => $aOrder]);
    }
}
