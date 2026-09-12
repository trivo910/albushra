<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
// Route::get('/packages/{category}', [PackageController::class, 'category'])
Route::get('{category}', [PackageController::class, 'category'])
    ->where('category', 'hajj|umrah')
    ->name('packages.category');
Route::get('/st-tour/{package:slug}', [PackageController::class, 'show'])->name('packages.show');
Route::post('/st-tour/{package:slug}/enquire', [PackageController::class, 'enquire'])->name('packages.enquire')->middleware('throttle:public-form');
Route::post('/st-tour/{package:slug}/review', [ReviewController::class, 'store'])->name('packages.review.store')->middleware('throttle:public-form');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', function (string $slug) {
    return redirect()->route('content.show', $slug, 301);
})->where('slug', '[^/]+');

Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store')->middleware('throttle:public-form');

Route::view('/about-us', 'about.index')->name('about');
Route::view('/hajj-packages-from-bangalore-2027', 'pages.hajj-packages-from-bangalore-2027')
    ->name('hajj-packages.bangalore-2027');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', function () {
    $lines = [
        'User-agent: *',
        'Disallow: /admin',
        'Sitemap: '.route('sitemap'),
    ];

    return Response::make(implode("\n", $lines), 200)->header('Content-Type', 'text/plain');
})->name('robots');

Route::get('/{slug}', [ContentController::class, 'show'])->name('content.show');
