<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::prefix('jobs')->name('jobs.')->group(function () {

    // Foreign Jobs Section
    Route::prefix('foreign')->name('foreign.')->group(function () {
        Route::get('/search', [JobController::class, 'foreignSearch'])->name('search');
        Route::get('/visa-help', [JobController::class, 'visaHelp'])->name('visa');
        Route::get('/teach-abroad', [JobController::class, 'teachAbroad'])->name('teach');
        Route::get('/gulf-jobs', [JobController::class, 'gulfJobs'])->name('gulf');
        Route::get('/europe-tech', [JobController::class, 'europeTech'])->name('europe');
        Route::get('/nursing', [JobController::class, 'nursing'])->name('nursing');
    });

    // Nearby Jobs Section
    Route::prefix('nearby')->name('nearby.')->group(function () {
        Route::get('/sarkari', [JobController::class, 'sarkari'])->name('sarkari');
        Route::get('/private', [JobController::class, 'private'])->name('private');
        Route::get('/remote', [JobController::class, 'remote'])->name('remote');
        Route::get('/skilled-trades', [JobController::class, 'trades'])->name('trades');
        Route::get('/part-time', [JobController::class, 'partTime'])->name('part-time');
        Route::get('/delivery', [JobController::class, 'delivery'])->name('delivery');
    });
});
