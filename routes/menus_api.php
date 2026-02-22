<?php

use App\Http\Controllers\Api\MenuController;
use Illuminate\Support\Facades\Route;

Route::apiResource('menus', MenuController::class);
