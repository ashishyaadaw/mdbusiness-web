<?php

namespace App\Listeners;

use App\Events\MatrimonialProfileStatusChange;
use App\Providers\FCMService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendMatrimonialProfileApprovedAlert
// implements ShouldQueue
{
    // use InteractsWithQueue;

    protected $fcmService;

    public function __construct(FCMService $fcmService)
    {
        $this->fcmService = $fcmService;
    }

    public function handle(MatrimonialProfileStatusChange $event): void
    {
        $user = $event->user;
        $status = strtolower($event->status);
        $fcmToken = $user->getFcmKeyToken();
        $fullName = $user->getFullName();
        $prefLang = $user->getPreferredLang();

        app()->setLocale($prefLang ?? 'hi');

        if ($fcmToken) {
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

            try {
                $this->fcmService->sendFCMNotification($fcmToken, $title, $body, $data);
            } catch (\Exception $e) {
                Log::error("FCM Notification failed for User ID {$user->id}: ".$e->getMessage());
            }
        }
    }
}
