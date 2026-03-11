<?php

use App\Http\Controllers\Api\MatterController;
use Illuminate\Support\Facades\Route;

Route::prefix('matters')->group(function () {

    // For Matters
    Route::get('all-matters', [MatterController::class, 'getMatters']);

    Route::get('{menu}/{city}/all-matters', [
        MatterController::class,
        'getMattersByMenuAndCity',
    ]);

});
