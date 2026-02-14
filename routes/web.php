<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\ContactController;

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Pricing page
Route::get('/pricing', [PricingController::class, 'index'])->name('pricing');

// Contact page
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
