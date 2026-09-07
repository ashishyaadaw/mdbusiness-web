<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Carries the matter's id/title as plain scalars, not the Eloquent model —
 * this event is dispatched right before the matter row is deleted, and its
 * listener is queued, so by the time it runs the row no longer exists and
 * SerializesModels' re-fetch-by-id would throw ModelNotFoundException.
 */
class MatterDeletedByUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public int $matterId,
        public string $matterTitle,
        public ?User $user
    ) {}
}
