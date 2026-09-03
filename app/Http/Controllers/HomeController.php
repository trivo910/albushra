<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Package;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('home', [
            'hajjPackages' => Package::with('images')
                ->where('status', 'published')
                ->where('category', 'hajj')
                ->orderByDesc('is_featured')
                ->latest()
                ->limit(3)
                ->get(),
            'umrahPackages' => Package::with('images')
                ->where('status', 'published')
                ->where('category', 'umrah')
                ->orderByDesc('is_featured')
                ->latest()
                ->limit(3)
                ->get(),
            'faqs' => Faq::orderBy('sort_order')->limit(8)->get(),
        ]);
    }
}
