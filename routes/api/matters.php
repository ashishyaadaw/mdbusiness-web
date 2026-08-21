<?php

use App\Http\Controllers\Api\MatterController;
use Illuminate\Support\Facades\Route;

Route::prefix('matters')->group(function () {

    // For Matters
    Route::post('create', [MatterController::class, 'create'])->middleware('auth:sanctum');

    Route::post('create/{city}/{menu}', [MatterController::class, 'createWithCityAndMenu']);

    Route::get('all-matters', [MatterController::class, 'getMatters']);
    Route::get('all-matters-by-tags', [MatterController::class, 'getMattersByTags']);

    Route::get('admin/{menu}/{city}/all-matters', [MatterController::class, 'getMattersByMenuAndCityByAdmin']);
    Route::get('admin/pending/all-matters', [MatterController::class, 'getAllPendingMatters']);

    Route::get('{menu}/{city}/all-matters', [MatterController::class, 'getMattersByMenuAndCity']);

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
    ]);
    Route::put('/{matter}', [
        MatterController::class,
        'update',
    ]);

    Route::put('/user/update/{matter}', [
        MatterController::class,
        'updateMatter',
    ])->middleware('auth:sanctum');

    Route::post('/{matter}/activate', [
        MatterController::class,
        'activateMatterByUser',
    ])->middleware('auth:sanctum');

    Route::post('/{matter}/inactivate', [
        MatterController::class,
        'inactivateMatterByUser',
    ])->middleware('auth:sanctum');

    // NOTE: previously registered twice, with the first copy pointing at a
    // non-existent 'reorder-auth' method, which made this route always
    // fatal-error before ever reaching the real 'reorder' implementation.
    Route::post('/reorder', [MatterController::class, 'reorder'])->middleware('auth:sanctum');
});
