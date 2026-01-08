<?php

namespace App\Events;

use App\Models\User; // Import your User model
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserProfileViewed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The user whose profile was viewed.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
