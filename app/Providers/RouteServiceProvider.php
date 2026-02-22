<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::middleware('web')
            ->group(base_path('routes/services.php'));

        Route::middleware('web')
            ->group(base_path('routes/jobs.php'));

        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/menus_api.php'));
            
        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/city_api.php'));
    }
}