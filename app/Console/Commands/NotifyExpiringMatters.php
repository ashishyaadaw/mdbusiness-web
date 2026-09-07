<?php

namespace App\Console\Commands;

use App\Models\Matters\MatterController;
use App\Services\StaffNotifier;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Date;

class NotifyExpiringMatters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'matters:notify-expiring {--days=3 : Notify posts expiring within this many days}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an FCM reminder to owners whose active post is about to expire';

    public function handle(StaffNotifier $notifier): int
    {
        $withinDays = (int) $this->option('days');

        $expiring = MatterController::query()
            ->where('status', 'active')
            ->whereNull('expiry_notified_at')
            ->whereNotNull('valid_until')
            ->whereBetween('valid_until', [Date::now(), Date::now()->addDays($withinDays)])
            ->with('matter.matterCreator')
            ->get();

        $count = 0;

        foreach ($expiring as $controller) {
            $matter = $controller->matter;
            $owner = $matter?->matterCreator;

            if (! $matter || ! $owner) {
                continue;
            }

            $notifier->notifyUser(
                $owner,
                'Your Post is Expiring Soon',
                "Hi, your post \"{$matter->title}\" expires on {$controller->valid_until->format('d M Y')}. Renew it to stay visible.",
                'matter_expiring_soon',
                [
                    'matter_id' => $matter->id,
                    'valid_until' => $controller->valid_until->toIso8601String(),
                    'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                ],
            );

            $controller->update(['expiry_notified_at' => now()]);
            $count++;
        }

        $this->info("Notified {$count} matter owner(s) about upcoming expiry.");

        return self::SUCCESS;
    }
}
