<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        return view('faqs.index', [
            'faqs' => Faq::where('show_on_home', false)->orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }
}
