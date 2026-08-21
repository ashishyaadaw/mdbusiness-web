<?php

use App\Http\Controllers\Api\PromoAdsController;
use Illuminate\Support\Facades\Route;

Route::get('/promoAds/{ad_id}', [PromoAdsController::class, 'show']);

Route::middleware(['auth:sanctum', 'role:admin'])
    ->prefix('admin')
    ->group(function () {
        Route::apiResource('ads', PromoAdsController::class);
    });
