<?php

use App\Http\Controllers\Api\MatterController;
use Illuminate\Support\Facades\Route;

Route::prefix('matters')->group(function () {

    // For Matters
    Route::post('create', [MatterController::class, 'create'])->middleware('auth:sanctum');

    Route::post('create/{city}/{menu}', [MatterController::class, 'createWithCityAndMenu']);

    Route::get('all-matters', [MatterController::class, 'getMatters']);

    Route::get('admin/{menu}/{city}/all-matters', [MatterController::class, 'getMattersByMenuAndCityByAdmin']);
    
    Route::get('{menu}/{city}/all-matters', [MatterController::class, 'getMattersByMenuAndCity']);

    Route::get('{user}/all-matters', [
        MatterController::class,
        'getMattersByUser',
    ]);
    Route::get('/my-matters', [
        MatterController::class,
        'getMyMatters'
    ])->middleware('auth:sanctum');

    Route::delete('/{matter}', [
        MatterController::class,
        'destroyMyMatter'
    ]);
    Route::put('/{matter}', [
        MatterController::class,
        'update'
    ]);

    Route::put('/user/update/{matter}', [
        MatterController::class,
        'updateMatter'
    ])->middleware('auth:sanctum');

    
    Route::post('/{matter}/activate', [
        MatterController::class,
        'activateMatterByUser'
    ])->middleware('auth:sanctum');
    
    Route::post('/{matter}/inactivate', [
        MatterController::class,
        'inactivateMatterByUser'
    ])->middleware('auth:sanctum');

});