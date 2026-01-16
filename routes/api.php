<?php

use App\Http\Controllers\Api\AdController;
use App\Http\Controllers\Api\Admin\ReligionDataController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PhoneVerificationController;
use App\Http\Controllers\Api\PromoAdsController;
use App\Http\Controllers\Api\StaffController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes for authentication
Route::post('/login/smart', [AuthController::class, 'smartLogin']);
Route::post('/admin/login', [AuthController::class, 'checkerAppLogin']);
Route::post('/user/profile/exists', [AuthController::class, 'userExists']);

// Protected routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/user/profile', [AuthController::class, 'getProfile']);
    Route::put('/user/profile', [AuthController::class, 'updateProfile']);
    // You can add more protected routes here (e.g., search, connect, etc.)

    Route::post('ads', [AdController::class, 'createNewAds']);
    Route::put('ad/{ad}', [AdController::class, 'updateAd']);
    Route::put('ad/{ad}/status', [AdController::class, 'changeAdStatus']);
    Route::delete('ad/{ad}', [AdController::class, 'deleteAd']);
    Route::get('ads', [AdController::class, 'myAds']);

    Route::get('/user/transactions', [TransactionController::class, 'index']);
    Route::post('/user/transactions', [TransactionController::class, 'store']);
});

// Phone Verification
Route::post('/otp/send', [PhoneVerificationController::class, 'sendPhoneOtp']);
Route::post('/otp/verify', [
    PhoneVerificationController::class,
    'verifyPhoneOtp',
]);
// Notify App User
Route::post('/notify', [NotificationController::class, 'notify']);

// Prefix routes with 'v1' for good versioning practice
Route::prefix('v1')->group(function () {
    // Get all religions
    Route::get('/religions', [ReligionDataController::class, 'allReligions']);
    Route::get('/religions/{religion}/castes', [
        ReligionDataController::class,
        'castesForReligion',
    ]);

    // ADMIN ONLY ROUTES
    Route::post('/religions', [ReligionDataController::class, 'storeReligion']);
    Route::post('/religions/{religion}/castes', [
        ReligionDataController::class,
        'storeCaste',
    ]);
});

// Prefix routes with 'v1' for good versioning practice
Route::prefix('v2')->group(function () {
    // Route::apiResource('ads', AdController::class);
    // Route::post('ads', [AdController::class, 'createNewAds']);
    Route::get('ads', [AdController::class, 'getAds']);
    Route::get('ads/{category}/profiles/{gender?}', [
        AdController::class,
        'getAdsByCategory',
    ]);
});

// --- ADMIN ROUTES ---
Route::middleware(['auth:sanctum', 'role:admin'])
    ->prefix('admin')
    ->group(function () {
        // Religion Management (Moved from public v1)
        Route::post('/religions', [
            ReligionDataController::class,
            'storeReligion',
        ]);
        Route::post('/religions/{religion}/castes', [
            ReligionDataController::class,
            'storeCaste',
        ]);

        // Add other admin-only tasks
        Route::get('/dashboard-stats', [AdminController::class, 'getStats']);

        // Get App User
        Route::get('/user/profiles', [AuthController::class, 'getProfiles']);

        // To get all profiles
        Route::post('/user/ads/profiles', [
            AdController::class,
            'getAdsProfiles',
        ]);
        Route::put('/user/ad/{ad}/status', [
            AdController::class,
            'updateAdProfileStatus',
        ]);

        // Public Test Route
        Route::get('/hi', function () {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'API is working',
                    'data' => null,
                ],
                200,
            );
        });

        Route::apiResource('ads', PromoAdsController::class);
    });

Route::get('/promoAds/{ad_id}', [PromoAdsController::class, 'show']);
// --- STAFF ROUTES ---
Route::middleware(['auth:sanctum', 'role:admin,staff'])
    ->prefix('staff')
    ->group(function () {
        // Staff can view things, maybe update ads, but not delete everything
        Route::get('/reports', [StaffController::class, 'index']);
        Route::put('/verify-user/{user}', [
            StaffController::class,
            'verifyUser',
        ]);
    });
