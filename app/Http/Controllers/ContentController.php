<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Page;
use Illuminate\View\View;

class ContentController extends Controller
{
    public function show(string $slug): View
    {
        $blog = Blog::where('slug', $slug)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->first();

        if ($blog) {
            return view('blog.show', [
                'blog' => $blog,
                'related' => Blog::where('status', 'published')
                    ->where('id', '!=', $blog->id)
                    ->latest('published_at')
                    ->limit(3)
                    ->get(),
            ]);
        }

        $page = Page::where('slug', $slug)->firstOrFail();

        return view('pages.show', [
            'page' => $page,
        ]);
    }
}
