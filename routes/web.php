<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
// --- Main Pages ---
Route::get('/', [PageController::class, 'index'])->name('home');

// Pass isSearchBar as false for pages that don't need it
Route::view('/about', 'pages.about', ['isSearchBar' => false])->name('about');

// --- Services ---
Route::prefix('services')->group(function () {
    Route::view('/', 'pages.services.index', ['isSearchBar' => true])->name('services');
    Route::view('/web-development', 'pages.services.web-dev', ['isSearchBar' => false])->name('services.web-dev');
    // ... repeat for others
});

// --- Legal (Fixed from Route::view to Route::get) ---
Route::prefix('legal')->group(function () {
    // Legal pages usually have search disabled
    Route::get('/privacy-policy', [PageController::class, 'privacy'])->defaults('isSearchBar', false)->name('privacy');
    Route::get('/terms-of-service',[PageController::class, 'terms'])->defaults('isSearchBar', false)->name('terms');
    Route::get('/refund-policy', [PageController::class, 'refund'])->defaults('isSearchBar', false)->name('refund');
    Route::get('/deletion-request', [PageController::class, 'deletion'])->defaults('isSearchBar', false)->name('deletion');
    // ...
});

// --- Actions ---
Route::view('/contact', 'pages.contact', ['isSearchBar' => false])->name('contact');
use App\Http\Controllers\AccountDeletionController;

// Web portal for deletion (Required for Google Play Console)
Route::get('/legal/request-deletion', [AccountDeletionController::class, 'showForm'])->name('deletion');

// Handle the deletion request submission
Route::post('/legal/request-deletion', [AccountDeletionController::class, 'processRequest'])->name('deletion.submit');