<?php

namespace App\Listeners;

use App\Events\MatrimonialProfileStatusChange;
use App\Services\StaffNotifier;

class SendMatrimonialProfileApprovedAlert
// implements ShouldQueue
{
    // use InteractsWithQueue;

    public function __construct(protected StaffNotifier $notifier) {}

    public function handle(MatrimonialProfileStatusChange $event): void
    {
        $user = $event->user;
        $status = strtolower($event->status);
        $fullName = $user->getFullName();
        $prefLang = $user->getPreferredLang();

        app()->setLocale($prefLang ?? 'hi');

        // Fetch translated strings using the __ helper
        $title = __("notifications.status_titles.{$status}");

        // If status doesn't exist in translation, fallback to default
        if ($title === "notifications.status_titles.{$status}") {
            $title = __('notifications.status_titles.default');
            $body = __('notifications.status_messages.default', [
                'name' => $fullName,
                'status' => $status,
            ]);
        } else {
            $body = __("notifications.status_messages.{$status}", [
                'name' => $fullName,
            ]);
        }

        $data = [
            'type' => 'matrimonial_status_change',
            'status' => $status,
            'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
        ];

        $this->notifier->notifyUser($user, $title, $body, 'matrimonial_status_change', $data);
    }
}
