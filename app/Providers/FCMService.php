<?php

namespace App\Providers;

use Google\Auth\Credentials\ServiceAccountCredentials;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FCMService
{
    public function sendFCMNotification($fcmToken, $title, $body, $data = [])
    {
        // 1. Get the Service Account Credentials
        $credentialPath = storage_path('app/firebase_credentials.json');

        if (! file_exists($credentialPath)) {
            return ['error' => 'Firebase credentials file not found.'];
        }

        // 2. Authenticate with Google
        // We read the file manually just to grab the project_id automatically
        $jsonKey = json_decode(file_get_contents($credentialPath), true);
        $projectId = $jsonKey['project_id'];

        $credentials = new ServiceAccountCredentials(
            'https://www.googleapis.com/auth/firebase.messaging',
            $credentialPath
        );

        // Fetch the OAuth 2.0 Token
        // This returns an array: ['access_token' => '...', 'expires_in' => ...]
        $tokenData = $credentials->fetchAuthToken();
        $accessToken = $tokenData['access_token'];

        // 3. Build the HTTP v1 Request
        $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

        $payload = [
            'message' => [
                'token' => $fcmToken,
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                ],
                // 'data' must be an object of strings, so we cast values to string if needed
                'data' => array_map('strval', $data),
            ],
        ];

        // 4. Send the Request using Laravel HTTP Client
        $response = Http::withToken($accessToken)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post($url, $payload);

        // Optional: Log errors for debugging
        if ($response->failed()) {
            Log::error('FCM Send Error: '.$response->body());
        }

        return $response->json();
    }
}
