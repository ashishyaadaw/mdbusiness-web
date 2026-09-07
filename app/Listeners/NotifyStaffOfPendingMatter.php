<?php

namespace App\Listeners;

use App\Events\NewMatterSubmittedForReview;
use App\Services\StaffNotifier;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyStaffOfPendingMatter implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct(protected StaffNotifier $notifier) {}

    public function handle(NewMatterSubmittedForReview $event): void
    {
        $matter = $event->matter;
        $ownerName = $matter->matterCreator?->getFullName() ?? $matter->matterCreator?->username ?? 'A user';

        $title = $event->isEdit ? 'Post Edited — Review Needed' : 'New Post — Review Needed';
        $body = "{$ownerName} ".($event->isEdit ? 'edited' : 'submitted')." \"{$matter->title}\" and it is now pending review.";

        $this->notifier->notifyStaffAndAdmins($title, $body, 'matter_pending_review', [
            'matter_id' => $matter->id,
            'title' => $matter->title,
            'user_id' => $matter->user_id,
            'is_edit' => $event->isEdit,
            'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
        ]);
    }
}
