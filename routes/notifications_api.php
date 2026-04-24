<?php

use App\Http\Controllers\Api\NotificationController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->group(function () {
    // Token Management
    Route::post('/notifications/token', [NotificationController::class, 'updateToken']);
    
    // Notification History
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::patch('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead']);
});


// TODO: Admin routes for sending notifications to users
// use ,'admin' middleware and prefix with 'admin' to restrict access to admins only

Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    // Admin Notification Management
    Route::post('/notifications/send', [NotificationController::class, 'send']);
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy']);
    Route::delete('/notifications/user/{userId}', [NotificationController::class, 'clearUserNotifications']);
});