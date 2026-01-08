<?php

namespace App\Providers;

use App\Events\Login;
use App\Events\OtpGenerated;
use App\Events\UserProfileViewed;
use App\Listeners\SendLoginAlert;
use App\Listeners\UpdateProfileViewCount;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Login::class => [
            SendLoginAlert::class,
        ],
        UserProfileViewed::class => [
            UpdateProfileViewCount::class,
        ],
        OtpGenerated::class => [
            SendOtpNotification::class,
        ],
    ];

    // ... rest of the file
}
