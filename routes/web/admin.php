<?php

use App\Http\Controllers\Web\Admin\AuthController;
use App\Http\Controllers\Web\Admin\CityController;
use App\Http\Controllers\Web\Admin\CountryController;
use App\Http\Controllers\Web\Admin\DashboardController;
use App\Http\Controllers\Web\Admin\ForgotPasswordController;
use App\Http\Controllers\Web\Admin\HomeContentController;
use App\Http\Controllers\Web\Admin\MatterController;
use App\Http\Controllers\Web\Admin\MenuCategoryController;
use App\Http\Controllers\Web\Admin\MenuController;
use App\Http\Controllers\Web\Admin\StateController;
use App\Http\Controllers\Web\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->group(function () {
        // Named "login" (not "admin.login") so Laravel's default `auth`
        // middleware redirect-to-login behaviour (Route::has('login')) works.
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
        Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

        Route::get('/forgot-password', [ForgotPasswordController::class, 'showRequest'])->name('admin.password.request');
        Route::post('/forgot-password', [ForgotPasswordController::class, 'sendOtp'])
            ->middleware('throttle:6,1')
            ->name('admin.password.otp');
        Route::get('/reset-password', [ForgotPasswordController::class, 'showReset'])->name('admin.password.reset.show');
        Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])
            ->middleware('throttle:10,1')
            ->name('admin.password.reset');

        Route::middleware(['auth', 'role:admin,staff'])->name('admin.')->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

            Route::get('/users', [UserController::class, 'index'])->name('users.index');
            Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
            Route::post('/users/{user}/verify', [UserController::class, 'toggleVerified'])->name('users.verify');
            Route::post('/users/{user}/role', [UserController::class, 'updateRole'])
                ->middleware('role:admin')
                ->name('users.role');

            Route::get('/matters', [MatterController::class, 'index'])->name('matters.index');
            Route::get('/matters/{matter}', [MatterController::class, 'show'])->name('matters.show');
            Route::get('/matters/{matter}/edit', [MatterController::class, 'edit'])->name('matters.edit');
            Route::put('/matters/{matter}', [MatterController::class, 'update'])->name('matters.update');
            Route::post('/matters/{matter}/status', [MatterController::class, 'updateStatus'])->name('matters.status');
            Route::post('/matters/{matter}/reorder', [MatterController::class, 'reorder'])->name('matters.reorder');
            Route::delete('/matters/{matter}', [MatterController::class, 'destroy'])->name('matters.destroy');

            Route::get('/home', [HomeContentController::class, 'index'])->name('home.index');

            Route::get('/home/slides/create', [HomeContentController::class, 'createSlide'])->name('home.slides.create');
            Route::post('/home/slides', [HomeContentController::class, 'storeSlide'])->name('home.slides.store');
            Route::get('/home/slides/{slide}/edit', [HomeContentController::class, 'editSlide'])->name('home.slides.edit');
            Route::put('/home/slides/{slide}', [HomeContentController::class, 'updateSlide'])->name('home.slides.update');
            Route::post('/home/slides/{slide}/reorder', [HomeContentController::class, 'reorderSlide'])->name('home.slides.reorder');
            Route::delete('/home/slides/{slide}', [HomeContentController::class, 'destroySlide'])->name('home.slides.destroy');

            Route::get('/home/cards/create', [HomeContentController::class, 'createCard'])->name('home.cards.create');
            Route::post('/home/cards', [HomeContentController::class, 'storeCard'])->name('home.cards.store');
            Route::get('/home/cards/{card}/edit', [HomeContentController::class, 'editCard'])->name('home.cards.edit');
            Route::put('/home/cards/{card}', [HomeContentController::class, 'updateCard'])->name('home.cards.update');
            Route::post('/home/cards/{card}/reorder', [HomeContentController::class, 'reorderCard'])->name('home.cards.reorder');
            Route::delete('/home/cards/{card}', [HomeContentController::class, 'destroyCard'])->name('home.cards.destroy');

            Route::get('/menu-categories', [MenuCategoryController::class, 'index'])->name('menu-categories.index');
            Route::get('/menu-categories/create', [MenuCategoryController::class, 'create'])->name('menu-categories.create');
            Route::post('/menu-categories', [MenuCategoryController::class, 'store'])->name('menu-categories.store');
            Route::get('/menu-categories/{menuCategory}/edit', [MenuCategoryController::class, 'edit'])->name('menu-categories.edit');
            Route::put('/menu-categories/{menuCategory}', [MenuCategoryController::class, 'update'])->name('menu-categories.update');
            Route::post('/menu-categories/{menuCategory}/reorder', [MenuCategoryController::class, 'reorder'])->name('menu-categories.reorder');
            Route::delete('/menu-categories/{menuCategory}', [MenuCategoryController::class, 'destroy'])->name('menu-categories.destroy');

            Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
            Route::get('/menus/create', [MenuController::class, 'create'])->name('menus.create');
            Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
            Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
            Route::put('/menus/{menu}', [MenuController::class, 'update'])->name('menus.update');
            Route::post('/menus/{menu}/reorder', [MenuController::class, 'reorder'])->name('menus.reorder');
            Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');

            Route::get('/cities', [CityController::class, 'index'])->name('cities.index');
            Route::get('/cities/create', [CityController::class, 'create'])->name('cities.create');
            Route::post('/cities', [CityController::class, 'store'])->name('cities.store');
            Route::get('/cities/{city}/edit', [CityController::class, 'edit'])->name('cities.edit');
            Route::put('/cities/{city}', [CityController::class, 'update'])->name('cities.update');
            Route::post('/cities/{city}/reorder', [CityController::class, 'reorder'])->name('cities.reorder');
            Route::delete('/cities/{city}', [CityController::class, 'destroy'])->name('cities.destroy');

            Route::get('/states', [StateController::class, 'index'])->name('states.index');
            Route::get('/states/create', [StateController::class, 'create'])->name('states.create');
            Route::post('/states', [StateController::class, 'store'])->name('states.store');
            Route::get('/states/{state}/edit', [StateController::class, 'edit'])->name('states.edit');
            Route::put('/states/{state}', [StateController::class, 'update'])->name('states.update');
            Route::delete('/states/{state}', [StateController::class, 'destroy'])->name('states.destroy');

            Route::get('/countries', [CountryController::class, 'index'])->name('countries.index');
            Route::get('/countries/create', [CountryController::class, 'create'])->name('countries.create');
            Route::post('/countries', [CountryController::class, 'store'])->name('countries.store');
            Route::get('/countries/{country}/edit', [CountryController::class, 'edit'])->name('countries.edit');
            Route::put('/countries/{country}', [CountryController::class, 'update'])->name('countries.update');
            Route::delete('/countries/{country}', [CountryController::class, 'destroy'])->name('countries.destroy');
        });
    });