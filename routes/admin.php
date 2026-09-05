<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PackageImageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('admin.guest')->group(function () {
        Route::get('login', [AuthController::class, 'create'])->name('login');
        Route::post('login', [AuthController::class, 'store'])->name('login.store')->middleware('throttle:admin-login');
    });

    Route::middleware('admin.auth')->group(function () {
        Route::post('logout', [AuthController::class, 'destroy'])->name('logout');
        Route::get('dashboard', DashboardController::class)->name('dashboard');

        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

        Route::get('hero-slides', [HeroSlideController::class, 'index'])->name('hero-slides.index');
        Route::post('hero-slides', [HeroSlideController::class, 'store'])->name('hero-slides.store');
        Route::delete('hero-slides/{heroSlide}', [HeroSlideController::class, 'destroy'])->name('hero-slides.destroy');
        Route::post('hero-slides/{heroSlide}/move-up', [HeroSlideController::class, 'moveUp'])->name('hero-slides.move-up');
        Route::post('hero-slides/{heroSlide}/move-down', [HeroSlideController::class, 'moveDown'])->name('hero-slides.move-down');

        Route::post('blogs/seo-preview', [BlogController::class, 'seoPreview'])->name('blogs.seo-preview');
        Route::resource('blogs', BlogController::class)->except(['show']);

        Route::resource('packages', PackageController::class)->except(['show']);
        Route::delete('package-images/{image}', [PackageImageController::class, 'destroy'])->name('package-images.destroy');

        Route::post('pages/seo-preview', [PageController::class, 'seoPreview'])->name('pages.seo-preview');
        Route::resource('pages', PageController::class)->except(['show']);

        Route::resource('faqs', FaqController::class)->except(['show']);
        Route::post('faqs/{faq}/move-up', [FaqController::class, 'moveUp'])->name('faqs.move-up');
        Route::post('faqs/{faq}/move-down', [FaqController::class, 'moveDown'])->name('faqs.move-down');

        Route::resource('enquiries', EnquiryController::class)->only(['index', 'show', 'update']);

        Route::resource('reviews', ReviewController::class)->only(['index', 'destroy']);
        Route::post('reviews/bulk-destroy', [ReviewController::class, 'bulkDestroy'])->name('reviews.bulk-destroy');

        Route::get('gallery', [GalleryController::class, 'index'])->name('gallery.index');
        Route::post('gallery', [GalleryController::class, 'store'])->name('gallery.store');
        Route::delete('gallery/{image}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
        Route::post('gallery/{image}/move-up', [GalleryController::class, 'moveUp'])->name('gallery.move-up');
        Route::post('gallery/{image}/move-down', [GalleryController::class, 'moveDown'])->name('gallery.move-down');
    });
});
