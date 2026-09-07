<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Requires the server's Laravel scheduler cron entry
// (`* * * * * php artisan schedule:run`) to actually fire.
Schedule::command('matters:notify-expiring')->daily();
