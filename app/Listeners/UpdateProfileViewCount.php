<?php

namespace App\Listeners;

use App\Events\UserProfileViewed; // <-- Automatically added by the command
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateProfileViewCount // You can implement ShouldQueue here for performance
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(UserProfileViewed $event)
    {
        // Access the user from the event
        $user = $event->user;

        // Run your logic.
        // Assumes you have a 'profile' relationship and a 'view_count' column.
        if ($user->profile) {
            $user->profile->increment('view_count');
        }
    }
}
