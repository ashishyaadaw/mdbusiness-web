<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserServiceKey;
use App\Providers\FCMService; // Import the service
use Illuminate\Http\Request;
use Validator;

class NotificationController extends Controller
{
    protected $fcmService;

    // Inject the service through the constructor
    public function __construct(FCMService $fcmService)
    {
        $this->fcmService = $fcmService;
    }

    public function notify(Request $request)
    {
        // Example data - in a real app, these would come from $request or your DB
        $fcmToken = $request->input('fcm_token');
        $title = 'Hello!';
        $body = 'This is a test notification.';
        $data = ['key' => 'value'];

        $result = $this->fcmService->sendFCMNotification($fcmToken, $title, $body, $data);

        if (isset($result['error'])) {
            return response()->json(['success' => false, 'message' => $result['error']], 500);
        }

        return response()->json([
            'success' => true,
            'response' => $result,
        ]);
    }

    /**
     * Store or Update the FCM Token for the authenticated user
     */
    public function updateToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fcm_key' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $token = UserServiceKey::updateOrCreate(
            ['user_id' => auth()->id()],
            ['fcm_key' => $request->fcm_key]
        );

        return response()->json([
            'message' => 'FCM token updated successfully.',
            'data' => $token,
        ], 200);
    }

    /**
     * Get notification history for the user
     */
    public function index()
    {
        $notifications = Notification::where('user_id', auth()->id())
            // ->where('type', '!=', 'general')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $notifications->items(),
        ]);
    }

    /**
     * Mark a specific notification as read
     */
    public function markAsRead($id)
    {
        $notification = Notification::where('user_id', auth()->id())->findOrFail($id);

        $notification->markAsRead();

        return response()->json([
            'message' => 'Notification marked as read.',
            'unread_count' => Notification::where('user_id', auth()->id())->unread()->count(),
        ]);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllRead()
    {
        Notification::where('user_id', auth()->id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json(['message' => 'All notifications marked as read.']);
    }

    /**
     * Create and Send a notification to a specific user or all users
     */
    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'nullable|exists:users,id', // null means send to everyone
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'type' => 'string',
            'data' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->only(['title', 'body', 'type', 'data']);

        if ($request->has('user_id')) {
            // Send to single user
            $notification = Notification::create(array_merge($data, ['user_id' => $request->user_id]));
            $fcmToken = $notification->user->getFcmKeyToken();
          

            $result = $this->fcmService->sendFCMNotification($fcmToken, $data['title'], $data['body'], $data);

            if (isset($result['error'])) {
                return response()->json(['success' => false, 'message' => $result['error']], 500);
            }
        } else {
            // Logic for "Send to All" - typically handled via a Background Job
            User::chunk(200, function ($users) use ($data) {
                foreach ($users as $user) {
                    Notification::create(array_merge($data, ['user_id' => $user->id]));
                }
            });
        }

        return response()->json(['message' => 'Notification(s) created successfully.']);
    }

    /**
     * Delete a specific notification record
     */
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return response()->json(['message' => 'Notification deleted.']);
    }

    /**
     * Bulk delete all notifications for a specific user
     */
    public function clearUserNotifications($userId)
    {
        Notification::where('user_id', $userId)->delete();

        return response()->json(['message' => "Cleared all notifications for User #$userId."]);
    }
}