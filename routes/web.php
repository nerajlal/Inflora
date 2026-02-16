<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InfluencerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// --- Original Public Pages ---
Route::get('/join-as-influencer', [HomeController::class, 'index'])->name('home'); // Renamed route purpose
Route::get('/pricing', [PricingController::class, 'index'])->name('pricing');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// --- Influencer Marketplace Routes ---

// Browse & Profile (Public)
Route::get('/', [InfluencerController::class, 'index'])->name('influencer.index'); // New Root
Route::get('/influencers/{id}', [InfluencerController::class, 'show'])->name('influencer.show');



// Dashboard (Role-based)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // User Profile Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Influencer Routes
    Route::middleware('influencer')->prefix('influencer')->name('influencer.')->group(function () {
        Route::get('/profile/create', [InfluencerController::class, 'create'])->name('create');
        Route::post('/profile', [InfluencerController::class, 'store'])->name('store');
        Route::get('/profile/edit', [InfluencerController::class, 'edit'])->name('edit');
        Route::put('/profile', [InfluencerController::class, 'update'])->name('update');
        
        // Service Management
        Route::resource('services', ServiceController::class)->except(['show']);
        Route::post('/services/{id}/toggle-status', [ServiceController::class, 'toggleStatus'])->name('services.toggle-status');
        
        // Order Management (Influencer View)
        Route::get('/orders/manage', [OrderController::class, 'index'])->name('orders.manage');
        Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
        Route::post('/orders/{id}/deliver', [OrderController::class, 'uploadDeliverable'])->name('orders.upload-deliverable');
    });

    // Customer Routes
    Route::middleware('customer')->group(function () {
        // Order Placement
        Route::get('/orders/create/{service}', [OrderController::class, 'create'])->name('orders.create');
        Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
        Route::post('/orders/{id}/approve', [OrderController::class, 'approve'])->name('orders.approve');
        Route::post('/orders/{id}/revision', [OrderController::class, 'requestRevision'])->name('orders.request-revision');
        
        // Reviews
        Route::post('/orders/{id}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    });

    // Shared Order View (Customer & Influencer)
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

    // Favorites
    Route::post('/influencer/{id}/favorite', [InfluencerController::class, 'toggleFavorite'])->name('influencer.favorite');
});

require __DIR__.'/auth.php';
