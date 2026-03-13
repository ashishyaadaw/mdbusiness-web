<?php

use App\Http\Controllers\Api\MatterController;
use Illuminate\Support\Facades\Route;

Route::prefix('matters')->group(function () {

    // For Matters
    Route::post('create', [MatterController::class, 'create'])->middleware('auth:sanctum');

    Route::post('create/{city}/{menu}', [MatterController::class, 'createWithCityAndMenu'])->middleware('auth:sanctum');

    Route::get('all-matters', [MatterController::class, 'getMatters']);

    Route::get('{menu}/{city}/all-matters', [
        MatterController::class,
        'getMattersByMenuAndCity',
    ]);

    Route::get('{user}/all-matters', [
        MatterController::class,
        'getMattersByUser',
    ]);
    Route::get('/my-matters', [
        MatterController::class,
        'getMyMatters',
    ])->middleware('auth:sanctum');

    Route::delete('/{matter}', [
        MatterController::class,
        'destroyMyMatter',
    ])->middleware('auth:sanctum');

});
