<?php

use App\Http\Controllers\Api\MenuController;
use Illuminate\Support\Facades\Route;

Route::apiResource('menus', MenuController::class);

// List menus for a city
Route::get('menus/{city}/all-menus', [MenuController::class, 'getMenus']);

Route::get('menus/{city}/{menuCategories}/all-menus', [MenuController::class, 'getMenusByCategory']);

Route::get('menus/{city}/all-menu-categories', [MenuController::class, 'getMenuCategories']);
Route::put('menus/categories/{menuCategories}/update', [MenuController::class, 'updateMenuCategory']);
Route::delete('menus/categories/{menuCategories}/delete', [MenuController::class, 'deleteMenuCategory']);

Route::post('menus/category/{city}/create', [MenuController::class, 'addMenuCategory']);