<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use App\Providers\FCMService;
use Illuminate\Support\Facades\Log;

/**
 * Persists an in-app Notification row and, when the recipient has an FCM
 * token on file, sends the matching push. Shared by the matter lifecycle
 * listeners so each one doesn't repeat the same fan-out/persist logic.
 */
class StaffNotifier
{
    public function __construct(protected FCMService $fcmService) {}

    public function notifyUser(User $user, string $title, string $body, string $type, array $data = []): void
    {
        Notification::create([
            'user_id' => $user->id,
            'title' => $title,
            'body' => $body,
            'type' => $type,
            'data' => $data,
        ]);

        $fcmToken = $user->getFcmKeyToken();

        if (! $fcmToken) {
            return;
        }

        try {
            $this->fcmService->sendFCMNotification($fcmToken, $title, $body, array_merge($data, ['type' => $type]));
        } catch (\Exception $e) {
            Log::error("FCM Notification failed for User ID {$user->id}: ".$e->getMessage());
        }
    }

    /**
     * Fan the same notification out to every admin/staff user.
     */
    public function notifyStaffAndAdmins(string $title, string $body, string $type, array $data = []): void
    {
        User::whereIn('role', ['admin', 'staff'])
            ->with('userServiceKey')
            ->chunk(100, function ($staff) use ($title, $body, $type, $data) {
                foreach ($staff as $member) {
                    $this->notifyUser($member, $title, $body, $type, $data);
                }
            });
    }
}
