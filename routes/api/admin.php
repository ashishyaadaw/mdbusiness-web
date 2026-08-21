<?php

use App\Http\Controllers\Api\AdminController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'role:admin'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/dashboard-stats', [AdminController::class, 'getStats']);

        // Simple connectivity check
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
    });
