<?php

use App\Http\Controllers\Api\MenuController;
use Illuminate\Support\Facades\Route;

Route::apiResource('menus', MenuController::class);

// List menus for a city
Route::get('menus/{city}/all-menus', [MenuController::class, 'getMenus']);

Route::get('menus/{city}/all-menu-categories', [MenuController::class, 'getMenuCategories']);
