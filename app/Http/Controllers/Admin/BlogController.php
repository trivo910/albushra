<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\SortsTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogRequest;
use App\Http\Requests\Admin\UpdateBlogRequest;
use App\Models\Blog;
use App\Services\SeoAnalyzer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BlogController extends Controller
{
    use SortsTable;

    public function index(Request $request): View
    {
        $query = Blog::query();

        $sortState = $this->applySort($query, $request, ['title', 'status', 'published_at'], 'created_at');

        return view('admin.blogs.index', [
            'blogs' => $query->paginate(15)->withQueryString(),
            'sort' => $sortState['sort'],
            'direction' => $sortState['direction'],
        ]);
    }

    public function create(): View
    {
        return view('admin.blogs.create', [
            'blog' => new Blog(),
        ]);
    }

    public function store(StoreBlogRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('blogs', 'public');
        }

        Blog::create($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post created successfully.');
    }

    public function edit(Blog $blog): View
    {
        return view('admin.blogs.edit', [
            'blog' => $blog,
        ]);
    }

    public function update(UpdateBlogRequest $request, Blog $blog): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('featured_image')) {
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('blogs', 'public');
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post updated successfully.');
    }

    public function seoPreview(Request $request, SeoAnalyzer $seoAnalyzer): JsonResponse
    {
        $data = $request->validate([
            'focus_keyword' => ['nullable', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
        ]);

        return response()->json($seoAnalyzer->analyze($data));
    }

    public function destroy(Blog $blog): RedirectResponse
    {
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post deleted successfully.');
    }
}
