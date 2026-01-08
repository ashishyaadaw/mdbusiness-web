<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// 1. The Landing Page (Welcome)
Route::get('/', function () {
    return view('welcome');
});

// 2. The Dashboard Route (Protected by 'auth' middleware)
// This is where users go after logging in.
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. Authentication Routes
// Note: If you installed Laravel Breeze, these are usually handled by:
// require __DIR__.'/auth.php';
//
// If you haven't installed an auth package yet, use these placeholders
// so the "Login" and "Register" buttons appear on your landing page.

if (! Route::has('login')) {
    Route::get('/login', function () {
        return view('auth.login'); // You need to create resources/views/auth/login.blade.php
    })->name('login');
}

if (! Route::has('register')) {
    Route::get('/register', function () {
        return view('auth.register'); // You need to create resources/views/auth/register.blade.php
    })->name('register');
}

// Optional: Profile routes if you are building the edit profile section
Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Add these to routes/web.php to prevent 405 Method Not Allowed errors during UI testing
Route::post('/login', function () {
    return redirect('/dashboard');
})->name('login.submit');

Route::post('/register', function () {
    return redirect('/dashboard');
})->name('register.submit');

// Terms and Conditions
Route::get('/terms-and-conditions', function () {
    return view('legal.terms_n_conditions');
})->name('pages.terms');

Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/child-safety-policy', [PageController::class, 'childSafety'])->name('childsafety');
Route::get('/request-account-deletion', [PageController::class, 'deletion'])->name('deletion');

// Authentication Actions
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
