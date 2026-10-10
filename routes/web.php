<?php

use App\Http\Controllers\Web\AccountDeletionController;
use App\Http\Controllers\Web\AdvertiseController;
use App\Http\Controllers\Web\AppLinkController;
use App\Http\Controllers\Web\PageController;
use Illuminate\Support\Facades\Route;

// App links: https://mdbusiness.in/app/... opens the MD Business app when
// installed, otherwise the store. See config/applinks.php.
// Stateless: no session/cookies needed, and every link click would
// otherwise create a session row.
Route::withoutMiddleware([
    \Illuminate\Cookie\Middleware\EncryptCookies::class,
    \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
    \Illuminate\Session\Middleware\StartSession::class,
    \Illuminate\View\Middleware\ShareErrorsFromSession::class,
    \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
])->group(function () {
    Route::get('/.well-known/assetlinks.json', [AppLinkController::class, 'assetLinks']);
    Route::get('/.well-known/apple-app-site-association', [AppLinkController::class, 'appleAppSiteAssociation']);
    Route::get('/app/{path?}', [AppLinkController::class, 'open'])
        ->where('path', '.*')
        ->name('app.open');
});

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

// Admin/Staff back-office dashboard
require __DIR__.'/web/admin.php';

// Consumer web area (public browsing + account/listing management)
require __DIR__.'/web/account.php';