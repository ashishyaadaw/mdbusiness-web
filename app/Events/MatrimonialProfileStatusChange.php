<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MatrimonialProfileStatusChange
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public $user, public $status
    ) {
        $this->user = $user;
        $this->status = $status;
    }
}
