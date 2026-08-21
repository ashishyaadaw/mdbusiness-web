<?php

use App\Http\Controllers\Api\TransactionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/transactions', [TransactionController::class, 'index']);
    Route::post('/user/transactions', [TransactionController::class, 'store']);
});
