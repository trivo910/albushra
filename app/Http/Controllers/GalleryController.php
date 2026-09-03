<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        return view('gallery.index', [
            'images' => GalleryImage::orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }
}
