<?php

use App\Http\Controllers\Web\Admin\AuthController;
use App\Http\Controllers\Web\Admin\DashboardController;
use App\Http\Controllers\Web\Admin\ForgotPasswordController;
use App\Http\Controllers\Web\Admin\MatterController;
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
        });
    });