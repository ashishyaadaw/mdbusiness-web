<?php

namespace App\Listeners;

use App\Events\MatterDeletedByUser;
use App\Services\StaffNotifier;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyStaffOfMatterDeletion implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct(protected StaffNotifier $notifier) {}

    public function handle(MatterDeletedByUser $event): void
    {
        $ownerName = $event->user?->getFullName() ?? $event->user?->username ?? 'A user';

        $title = 'Post Deleted';
        $body = "{$ownerName} deleted their post \"{$event->matterTitle}\".";

        $this->notifier->notifyStaffAndAdmins($title, $body, 'matter_deleted', [
            'matter_id' => $event->matterId,
            'title' => $event->matterTitle,
            'user_id' => $event->user?->id,
            'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
        ]);
    }
}
