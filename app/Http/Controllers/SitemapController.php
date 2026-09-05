<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Package;
use App\Models\Page;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = collect([
            ['loc' => route('home'), 'lastmod' => now()],
            ['loc' => route('packages.index'), 'lastmod' => now()],
            ['loc' => route('packages.category', 'hajj'), 'lastmod' => now()],
            ['loc' => route('packages.category', 'umrah'), 'lastmod' => now()],
            ['loc' => route('blog.index'), 'lastmod' => now()],
            ['loc' => route('faqs.index'), 'lastmod' => now()],
            ['loc' => route('gallery.index'), 'lastmod' => now()],
            ['loc' => route('contact.index'), 'lastmod' => now()],
        ]);

        Package::where('status', 'published')->get(['slug', 'updated_at'])->each(function ($package) use ($urls) {
            $urls->push(['loc' => route('packages.show', $package), 'lastmod' => $package->updated_at]);
        });

        Blog::where('status', 'published')->get(['slug', 'updated_at'])->each(function ($blog) use ($urls) {
            $urls->push(['loc' => route('blog.show', $blog), 'lastmod' => $blog->updated_at]);
        });

        Page::all(['slug', 'updated_at'])->each(function ($page) use ($urls) {
            $urls->push(['loc' => route('pages.show', $page), 'lastmod' => $page->updated_at]);
        });

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200)->header('Content-Type', 'text/xml');
    }
}
