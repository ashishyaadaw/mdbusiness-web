<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// --- Main Pages ---
Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::view('/about', 'pages.about')->name('about');

// --- Services ---
// --- Services & Sub-topics ---
Route::prefix('services')->group(function () {
    Route::view('/', 'pages.services.index')->name('services');

    // Updated & New Service Routes
    Route::view('/web-development', 'pages.services.web-dev')->name('services.web-dev');
    Route::view('/mobile-app-development', 'pages.services.app-dev')->name('services.app-dev');
    Route::view('/ecommerce-solutions', 'pages.services.e-com')->name('services.e-com');
    Route::view('/ui-ux-design', 'pages.services.ui-ux')->name('services.ui-ux');
    
    Route::view('/digital-marketing', 'pages.services.marketing')->name('services.marketing');
    Route::view('/seo-optimization', 'pages.services.seo')->name('services.seo');
});

// --- Digital Solutions (Submenu items) ---
Route::prefix('solutions')->group(function () {
    Route::view('/proptech', 'pages.solutions.proptech')->name('solutions.proptech');
    Route::view('/artificial-intelligence', 'pages.solutions.ai')->name('solutions.ai');
    Route::view('/business-automation', 'pages.solutions.automation')->name('solutions.automation');
});

// --- Resources & Blog ---
Route::view('/blog', 'pages.blog')->name('blog');
Route::view('/case-studies', 'pages.case-studies')->name('case-studies');

// --- Legal ---
Route::prefix('legal')->group(function () {
    Route::view('/privacy-policy', 'pages.legal.privacy')->name('privacy');
    Route::view('/terms-of-service', 'pages.legal.terms')->name('terms');
    Route::view('/refund-policy', 'pages.legal.refund')->name('refund');
    Route::view('/shipping-policy', 'pages.legal.shipping')->name('shipping');
});

// --- Actions ---
Route::view('/contact', 'pages.contact')->name('contact');
Route::post('/contact-submit', [ContactController::class, 'submit'])->name('contact.submit');
Route::view('/get-started', 'pages.get-started')->name('get-started');