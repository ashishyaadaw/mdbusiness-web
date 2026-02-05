<?php

use App\Http\Controllers\AccountDeletionController;
use App\Http\Controllers\AdvertiseController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Main Landing
Route::get('/', [PageController::class, 'index'])->name('home');

// Legal & Compliance
Route::prefix('legal')->name('legal.')->group(function () {
    Route::view('/privacy-policy', 'pages.legal.privacy')->name('privacy');
    Route::view('/refund-policy', 'pages.legal.refund')->name('refund');
    Route::view('/terms-and-condition', 'pages.legal.terms')->name('terms');
    Route::get('/request-deletion', [AccountDeletionController::class, 'showForm'])->name('deletion');
    Route::post('/request-deletion', [AccountDeletionController::class, 'processRequest'])->name('deletion.submit');
});

// Advertise & Business Listing
Route::prefix('advertise')->name('advertise.')->group(function () {
    Route::get('/list-your-business', [AdvertiseController::class, 'businessListing'])->name('business.listing');
    Route::get('/advertise-with-us', [AdvertiseController::class, 'businessWithUs'])->name('business.withus');
});

Route::view('/contact', 'pages.contact')->name('contact');
