<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        return view('blog.index', [
            'blogs' => Blog::where('status', 'published')
                ->whereNotNull('published_at')
                ->where('published_at', '<=', now())
                ->latest('published_at')
                ->paginate(9),
        ]);
    }

    public function show(Blog $blog): View
    {
        abort_unless($blog->status === 'published', 404);

        return view('blog.show', [
            'blog' => $blog,
            'related' => Blog::where('status', 'published')
                ->where('id', '!=', $blog->id)
                ->latest('published_at')
                ->limit(3)
                ->get(),
        ]);
    }
}
