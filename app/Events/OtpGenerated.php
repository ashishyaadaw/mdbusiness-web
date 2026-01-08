<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OtpGenerated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;

    public string $otp;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\User  $user  The user receiving the OTP.
     * @param  string  $otp  The plain-text OTP (not the hash).
     */
    public function __construct(User $user, string $otp)
    {
        $this->user = $user;
        $this->otp = $otp;
    }
}
