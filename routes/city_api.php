<?php

use App\Http\Controllers\Api\CityController;
use Illuminate\Support\Facades\Route;

Route::apiResource('cities', CityController::class);
// List menus for a city
Route::get('cities/{city}/menus', [CityController::class, 'getMenus']);

// Assign a menu to a city
Route::post('cities/{city}/menus', [CityController::class, 'attachMenu']);