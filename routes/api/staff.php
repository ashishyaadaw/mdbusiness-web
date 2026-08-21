<?php

use App\Http\Controllers\Api\StaffController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'role:admin,staff'])
    ->prefix('staff')
    ->group(function () {
        // Staff can view things, maybe update ads, but not delete everything
        Route::get('/reports', [StaffController::class, 'index']);
        Route::put('/verify-user/{user}', [StaffController::class, 'verifyUser']);
    });
