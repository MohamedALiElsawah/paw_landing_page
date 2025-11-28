<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClinicController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\PetPostController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ContactSubmissionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SEOManagementController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\SitemapController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [HomeController::class, 'contact'])->name('contact.submit');
Route::get('/locale/{locale}', [HomeController::class, 'changeLocale'])->name('locale.change');

// SEO Routes
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes (Protected by auth middleware)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Clinics
    Route::resource('clinics', ClinicController::class);

    // Services
    Route::resource('services', ServiceController::class);

    // Stores
    Route::resource('stores', StoreController::class);

    // Pet Posts
    Route::resource('petposts', PetPostController::class);

    // Reviews
    Route::resource('reviews', ReviewController::class);

    // Partners
    Route::resource('partners', PartnerController::class);

    // Contact Submissions
    Route::resource('contactsubmissions', ContactSubmissionController::class);
    Route::post('contactsubmissions/{contactsubmission}/mark-read', [ContactSubmissionController::class, 'markAsRead'])->name('contactsubmissions.mark-read');
    Route::post('contactsubmissions/{contactsubmission}/mark-unread', [ContactSubmissionController::class, 'markAsUnread'])->name('contactsubmissions.mark-unread');

    // Settings
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

    // Banners
    Route::resource('banners', BannerController::class);
    Route::put('banners/{banner}/toggle-status', [BannerController::class, 'toggleStatus'])->name('banners.toggle-status');
    Route::put('banners/{banner}/set-default', [BannerController::class, 'setDefault'])->name('banners.set-default');

    // SEO Management
    Route::prefix('seo')->name('seo.')->group(function () {
        Route::get('/', [SEOManagementController::class, 'index'])->name('index');
        Route::put('/', [SEOManagementController::class, 'update'])->name('update');
        Route::post('regenerate', [SEOManagementController::class, 'regenerate'])->name('regenerate');
        Route::get('preview-sitemap', [SEOManagementController::class, 'previewSitemap'])->name('preview-sitemap');
        Route::get('preview-robots', [SEOManagementController::class, 'previewRobots'])->name('preview-robots');
        Route::get('analytics', [SEOManagementController::class, 'analytics'])->name('analytics');
    });
});
