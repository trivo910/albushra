<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PackageImageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('admin.guest')->group(function () {
        Route::get('login', [AuthController::class, 'create'])->name('login');
        Route::post('login', [AuthController::class, 'store'])->name('login.store');
    });

    Route::middleware('admin.auth')->group(function () {
        Route::post('logout', [AuthController::class, 'destroy'])->name('logout');
        Route::get('dashboard', DashboardController::class)->name('dashboard');

        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

        Route::resource('blogs', BlogController::class)->except(['show']);

        Route::resource('packages', PackageController::class)->except(['show']);
        Route::delete('package-images/{image}', [PackageImageController::class, 'destroy'])->name('package-images.destroy');

        Route::resource('pages', PageController::class)->except(['show']);

        Route::resource('faqs', FaqController::class)->except(['show']);
        Route::post('faqs/{faq}/move-up', [FaqController::class, 'moveUp'])->name('faqs.move-up');
        Route::post('faqs/{faq}/move-down', [FaqController::class, 'moveDown'])->name('faqs.move-down');

        Route::resource('enquiries', EnquiryController::class)->only(['index', 'show', 'update']);
    });
});
