<?php

namespace App\Listeners;

use App\Events\MatrimonialProfileStatusChange;
use App\Providers\FCMService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendNewMatrimonialProfileAddedAlert implements ShouldQueue
{
    use InteractsWithQueue;

    protected $fcmService;

    public function __construct(FCMService $fcmService)
    {
        $this->fcmService = $fcmService;
    }

    /**
     * Handle the event.
     */
    public function handle(MatrimonialProfileStatusChange $event): void
    {
        $user = $event->user;
        $status = strtolower($event->status);
        $fcmToken = $user->getFcmKeyToken();
        $fullName = $user->getFullName();
        $prefLang = $user->getPreferredLang();

        // Set locale based on user preference, default to Hindi as per your request
        app()->setLocale($prefLang ?? 'hi');

        if ($fcmToken) {
            $titleKey = "notifications.status_titles.{$status}";
            $bodyKey = "notifications.status_messages.{$status}";

            // Fetch translated title
            $title = __($titleKey);

            // Fallback logic if the status key doesn't exist in translation files
            if ($title === $titleKey) {
                $title = __('profile.newProfileCreatedTitle');
                $body = __('profile.newProfileCreatedBody', [
                    'name' => $fullName,
                    'status' => $status,
                ]);
            } else {
                $body = __($bodyKey, ['name' => $fullName]);
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
        } else {
            Log::warning("Could not send status notification: User ID {$user->id} has no FCM token.");
        }
    }
}
