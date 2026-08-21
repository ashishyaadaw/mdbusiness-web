<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

// Public
Route::post('/login/smart', [AuthController::class, 'smartLogin']);
Route::post('/admin/login', [AuthController::class, 'checkerAppLogin']);
Route::post('/user/profile/exists', [AuthController::class, 'userExists']);
Route::get('/admin/user/profiles', [AuthController::class, 'getProfiles']);

// Protected
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/user/profile', [AuthController::class, 'getProfile']);
    Route::put('/user/profile', [AuthController::class, 'updateProfile']);
});
