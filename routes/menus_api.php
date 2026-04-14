<?php

use App\Http\Controllers\Api\MenuController;
use Illuminate\Support\Facades\Route;

Route::apiResource('menus', MenuController::class);

// List menus for a city
Route::get('menus/{city}/all-menus', [MenuController::class, 'getMenus']);

Route::get('menus/{city}/{menuCategories}/all-menus', [MenuController::class, 'getMenusByCategory']);

Route::get('menus/{city}/all-menu-categories', [MenuController::class, 'getMenuCategories']);

// Post routes to get menu categories for a city (for admin) and apply filters if needed
Route::post('menus/{city}/all-menu-categories', [MenuController::class, 'getMenuCategoriesWithFilters']);


Route::put('menus/categories/{menuCategories}/update', [MenuController::class, 'updateMenuCategory']);
Route::delete('menus/categories/{menuCategories}/delete', [MenuController::class, 'deleteMenuCategory']);

Route::post('menus/category/{city}/create', [MenuController::class, 'addMenuCategory']);