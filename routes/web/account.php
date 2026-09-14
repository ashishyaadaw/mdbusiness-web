<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\BrowseController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\MyMatterController;
use App\Http\Controllers\Web\NotificationController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Consumer Web Routes
|--------------------------------------------------------------------------
|
| Browser-facing equivalent of the app API (routes/api/*.php): public
| browsing of cities/menus/matters, plus a session-authenticated area for
| the same `users` accounts the app uses (Sanctum there, session here) to
| register/login, post & manage their own listings, and view their
| profile/transactions/notifications. Purely additive — none of this
| touches routes/api/*.php or routes/web/admin.php.
|
*/

// Public browsing — read-only, mirrors CityController/MenuController/
// MatterController's public "active only" endpoints.
Route::prefix('browse')->name('browse.')->group(function () {
    Route::get('/', [BrowseController::class, 'index'])->name('index');
    Route::get('/search', [BrowseController::class, 'search'])->name('search');
    // Must stay ahead of /{city} — a literal 3-segment path competing with
    // /{city}/{menu} below; registration order decides which one matches.
    Route::get('/category/{menu}', [BrowseController::class, 'category'])->name('category');
    Route::get('/{city}', [BrowseController::class, 'city'])->name('city');
    Route::get('/{city}/{menu}', [BrowseController::class, 'matters'])->name('matters');
});

Route::get('/listings/{matter}', [BrowseController::class, 'show'])->name('listings.show');

// Guest auth — OTP only (no password login/registration). A phone that
// doesn't exist yet is auto-registered the moment its first OTP is
// requested, same as the app's smartLogin.
Route::get('/login', [AuthController::class, 'showLogin'])->name('account.login');
Route::post('/login/otp', [AuthController::class, 'requestOtp'])
    ->middleware('throttle:6,1')
    ->name('account.login.otp');
Route::post('/login/otp/verify', [AuthController::class, 'verifyOtp'])
    ->middleware('throttle:10,1')
    ->name('account.login.verify');

// Signed-in consumer area
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('account.logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('account.dashboard');

    Route::get('/my-matters', [MyMatterController::class, 'index'])->name('account.matters.index');
    Route::get('/my-matters/create', [MyMatterController::class, 'create'])->name('account.matters.create');
    Route::post('/my-matters', [MyMatterController::class, 'store'])->name('account.matters.store');
    Route::get('/my-matters/{matter}/edit', [MyMatterController::class, 'edit'])->name('account.matters.edit');
    Route::put('/my-matters/{matter}', [MyMatterController::class, 'update'])->name('account.matters.update');
    Route::delete('/my-matters/{matter}', [MyMatterController::class, 'destroy'])->name('account.matters.destroy');
    Route::post('/my-matters/{matter}/activate', [MyMatterController::class, 'activate'])->name('account.matters.activate');
    Route::post('/my-matters/{matter}/inactivate', [MyMatterController::class, 'inactivate'])->name('account.matters.inactivate');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('account.profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('account.profile.update');

    Route::get('/transactions', [TransactionController::class, 'index'])->name('account.transactions.index');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('account.notifications.index');
    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'read'])->name('account.notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'readAll'])->name('account.notifications.readAll');
});
