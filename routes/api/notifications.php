<?php

use App\Http\Controllers\Api\NotificationController;
use Illuminate\Support\Facades\Route;

Route::post('/notify', [NotificationController::class, 'notify']);

Route::middleware('auth:sanctum')->group(function () {
    // Token Management
    Route::post('/notifications/token', [NotificationController::class, 'updateToken']);

    // Notification History
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::patch('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead']);
});

// NOTE: not role-restricted yet in the original implementation — any authenticated
// user can currently call these. Preserved as-is; tighten to role:admin separately.
Route::middleware('auth:sanctum')
    ->prefix('admin')
    ->group(function () {
        Route::post('/notifications/send', [NotificationController::class, 'send']);
        Route::delete('/notifications/{id}', [NotificationController::class, 'destroy']);
        Route::delete('/notifications/user/{userId}', [NotificationController::class, 'clearUserNotifications']);
    });
