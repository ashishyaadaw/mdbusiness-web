<?php

namespace App\Listeners;

use App\Events\OtpGenerated;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendOtpNotification
{
    /**
     * Handle the event.
     */
    public function handle(OtpGenerated $event): void
    {
        // Get data from the event
        $user = $event->user;
        $otp = $event->otp;
        $phoneNumber = $user->phone;
        $username = $user->username; // Get username from user object

        try {
            $apiUrl = env('SMS_API_URL');
            $apiKey = env('SMS_API_KEY');
            $senderId = env('SMS_SENDER_ID');

            if (! $apiUrl || ! $apiKey || ! $senderId) {
                // Log an error if credentials are not set
                Log::error('SMS API credentials are not set in .env file.');

                // Stop execution. Retrying won't help if config is missing.
                return;
            }

            $response = Http::withHeaders([
                'Authorization' => $apiKey, // Using the key directly as requested
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post($apiUrl, [
                'route' => 'dlt',
                'sender_id' => $senderId,
                'message' => '201904', // This looks like a template ID
                'variables_values' => ''.$username.'|'.$otp.'|',
                'schedule_time' => null,
                'flash' => 0,
                'numbers' => $phoneNumber,
            ]);

            // Check if the request was unsuccessful
            if ($response->failed()) {
                // Throw an exception to be caught below
                $response->throw();
            }

            // Log success
            Log::info('SMS OTP sent successfully to: '.$phoneNumber);

            // I removed the `$verification->save();` line from your code,
            // as the user's `otp_hash` was already saved in the AuthController
            // before this event was dispatched.

        } catch (RequestException $e) {
            // Catch HTTP-specific errors (e.g., 4xx, 5xx responses)
            Log::error('SMS sending failed (HTTP Error): '.$e->getMessage(), [
                'status' => $e->response->status(),
                'response' => $e->response->body(),
            ]);

            // Re-throw the exception. This tells the queue to
            // retry the job later, which is what we want for failed API calls.
            throw $e;
        } catch (\Exception $e) {
            // Catch other general errors (e.g., connection timeout)
            Log::error('SMS sending failed (General Error): '.$e->getMessage());

            // Re-throw to signal failure to the queue
            throw $e;
        }
    }
}
