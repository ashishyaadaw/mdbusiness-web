<?php

use App\Http\Middleware\CheckRole;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
        $middleware->alias([
            'role' => CheckRole::class,
        ]);

        // Admin/staff guests are sent to the admin login page; everyone else
        // hitting a protected consumer web page (my-matters, profile, etc.)
        // is sent to the regular account login instead.
        $middleware->redirectGuestsTo(fn ($request) => $request->is('admin*')
            ? route('login')
            : route('account.login'));
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
