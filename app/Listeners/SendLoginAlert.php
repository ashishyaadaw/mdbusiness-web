<?php

namespace App\Listeners;

use App\Events\Login as EventsLogin;
use App\Mail\LoginAlert;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail; // Import the Mail facade

class SendLoginAlert implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    public function handle(EventsLogin $event)
    {
        // $event->user contains the user model that just logged in
        if ($event->user) {
            Mail::to($event->user->email)->send(new LoginAlert($event->user));
        }
    }
}
