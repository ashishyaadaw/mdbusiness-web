<?php

use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::prefix('services')->name('services.')->group(function () {
    // Dynamic route that handles all categories
    Route::get('/{category}', [ServiceController::class, 'show'])->name('show');
});
