<?php

namespace App\Http\Middleware;

use App\Models\NotificationHistory;
use App\Models\User;
use App\Providers\FCMService;
use Auth;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Log;
use Symfony\Component\HttpFoundation\Response;

class ProcessNotification
{
    protected $notificationService;

    public function __construct(FCMService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    // The "ON" logic (Before/During request)
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Logic BEFORE the controller runs
        // e.g., Log request, Validate specific headers

        $response = $next($request); // Pass request to the Controller

        // 2. Logic AFTER controller but BEFORE sending to browser

        return $response;
    }

    // The "AFTER" logic (After response is sent to user)
    public function terminate(Request $request, Response $response): void
    {
        // 1. Extract the JSON content from the response object
        $content = $response->getContent();

        // 2. Decode the JSON string into an associative array
        $responseData = json_decode($content, true);

        // 3. Check if the required keys exist to prevent errors
        if (isset($responseData['data']['profile_id']) && isset($responseData['mode'])) {

            // Call your method (Ensure this method exists inside this Middleware class)
            $this->sendNotification($responseData['data']['profile_id'], $responseData['mode']);
        }
    }

    public function sendNotification($target_user_id, $type)
    {
        try {
            $sender = Auth::user();
            // Ensure sender profile is loaded efficiently
            $sender->loadMissing('profile');

            $receiver = User::find($target_user_id);

            // 2. Prevent Self-Notification
            if ($sender->id === $receiver->id) {
                return response()->json(['success' => false, 'message' => 'Cannot notify self'], 400);
            }

            // 3. Define Content (Using PHP 8 Match Expression)
            $senderName = $sender->profile?->full_name ?? 'A user'; // Null coalescence in case name is missing

            [$title, $body] = match ($type) {
                'sent-interest' => ['New Interest Received', "$senderName has sent you an interest."],
                'accepted-interest' => ['Interest Accepted', "Congratulations! $senderName accepted your interest."],
                'profile_visit' => ['Profile Visitor', "$senderName recently visited your profile."],
                'shortlist' => ['You were Shortlisted', "$senderName has added you to their shortlist."],
                default => ['New Notification', "You have a new update from $senderName"],
            };

            // 4. Save to Database
            $notification = NotificationHistory::create([
                'user_id' => $receiver->id,
                'sender_id' => $sender->id,
                'type' => $type,
                'title' => $title,
                'body' => $body,
                'data' => json_encode(['route_id' => $sender->id]),
            ]);

            // 5. Send FCM Push Notification
            // CRITICAL FIX: Use the $receiver's token, not the hardcoded string
            if (! empty($receiver->userServiceKey)) {
                try {
                    $this->notificationService->sendFCMNotification(
                        $receiver->userServiceKey->fcm_key, // Dynamically passed token
                        $title,
                        $body,
                        [
                            'type' => $type,
                            'sender_id' => (string) $sender->id,
                            'route_id' => (string) $sender->id, // Often useful for deep linking
                        ]
                    );
                } catch (Exception $fcmError) {
                    // Log silently so the API response remains successful (since DB record was created)
                    Log::error("FCM Send Error for User {$receiver->id}: ".$fcmError->getMessage());
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Notification processed successfully.',
                'data' => $notification,
            ], 200);

        } catch (Exception $e) {
            Log::error('Notification Controller Error: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while sending notification.',
                // Only show detailed error in local/debug environment
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }
}
