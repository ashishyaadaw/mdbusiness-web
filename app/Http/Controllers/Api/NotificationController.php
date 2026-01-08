<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\FCMService; // Import the service
use Illuminate\Http\Request;

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
}
