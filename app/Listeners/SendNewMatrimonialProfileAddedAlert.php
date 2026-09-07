<?php

namespace App\Listeners;

use App\Events\NewMatrimonialProfileAdded;
use App\Services\StaffNotifier;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNewMatrimonialProfileAddedAlert implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct(protected StaffNotifier $notifier) {}

    /**
     * Handle the event.
     */
    public function handle(NewMatrimonialProfileAdded $event): void
    {
        $user = $event->user;
        $status = strtolower($event->status);
        $fullName = $user->getFullName();
        $prefLang = $user->getPreferredLang();

        // Set locale based on user preference, default to Hindi as per your request
        app()->setLocale($prefLang ?? 'hi');

        $titleKey = "notifications.status_titles.{$status}";
        $bodyKey = "notifications.status_messages.{$status}";

        $title = __($titleKey);
        $body = __($bodyKey, ['name' => $fullName]);

        // Fallback if the status has no dedicated translation
        if ($title === $titleKey) {
            $title = __('notifications.status_titles.default');
            $body = __('notifications.status_messages.default', ['name' => $fullName, 'status' => $status]);
        }

        $data = [
            'status' => $status,
            'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
        ];

        $this->notifier->notifyUser($user, $title, $body, 'new_matter_submitted', $data);
    }
}
