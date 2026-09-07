<?php

namespace App\Events;

use App\Models\Matters\Matter;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewMatterSubmittedForReview
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Matter $matter,
        public bool $isEdit = false
    ) {}
}
