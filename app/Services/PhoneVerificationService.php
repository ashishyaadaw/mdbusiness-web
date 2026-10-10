<?php

namespace App\Services;

use App\Models\PhoneVerification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PhoneVerificationService
{
    public function canSendOtp($phone, $cooldownSeconds = 60)
    {
        $verification = PhoneVerification::where('phone', $phone)->first();

        if ($verification && $verification->updated_at->addSeconds($cooldownSeconds)->isFuture()) {
            return [
                'allowed' => false,
                'seconds_left' => $verification->updated_at->addSeconds($cooldownSeconds)->diffInSeconds(Carbon::now()),
            ];
        }

        return ['allowed' => true];
    }

    public function createAndSendOtp($phone, $username, $appSignKey = null)
    {
        $otp = rand(1000, 9999);
        $expiresAt = Carbon::now()->addMinutes(5);

        // Update DB
        $verification = PhoneVerification::updateOrCreate(
            ['phone' => $phone],
            [
                'otp_code' => Hash::make($otp),
                'otp_expires_at' => $expiresAt,
            ]
        );

        // Send SMS
        // $sent = $this->sendSmsApi($phone, $otp, $username);
        $sent = $this->sendSmsOTPApiWithAppSignKey($phone, $otp, $appSignKey);

        if (! $sent) {
            throw new \Exception('Failed to send SMS via provider.');
        }

        return $otp; // Return plain OTP for testing (optional)
    }

    public function verifyOtp($phone, $otpInput)
    {
        $verification = PhoneVerification::where('phone', $phone)->latest()->first();

        if (! $verification) {
            return ['status' => 'error', 'message' => 'No OTP request found for this number.', 'code' => 404];
        }

        if ($verification->otp_expires_at < now()) {
            return ['status' => 'error', 'message' => 'OTP has expired.', 'code' => 400];
        }

        if (Hash::check($otpInput, $verification->otp_code)) {
            $verification->delete(); // Consume OTP

            return ['status' => 'success', 'message' => 'Phone verified successfully!'];
        }

        return ['status' => 'error', 'message' => 'Invalid OTP', 'code' => 400];
    }

    /**
     * Handles the external API call
     */
    /**
     * The DLT template (SMS_MESSAGE_ID) is now:
     *   Your verification code is {#NUM#}. Do not share this code with anyone.
     *   {#VAR#}-ONE ADVERTISERS
     * so the variables must be "otp|app_sign_key". $username is no longer
     * part of the message; kept so existing callers don't change.
     */
    public function sendSmsApi($phone, $otp, $username = null)
    {
        return $this->sendSmsOTPApiWithAppSignKey($phone, $otp, null);
    }

    /**
     * Old name-first template ("name|otp"); unused while SMS_MESSAGE_ID points
     * at the OTP + app sign key template.
     */
    private function sendSmsApiWithName($phone, $otp, $username)
    {
        $apiUrl = env('SMS_API_URL');
        $apiKey = env('SMS_API_KEY');
        $senderId = env('SMS_SENDER_ID');
        $messageId = env('SMS_MESSAGE_ID');

        if (! $apiUrl || ! $apiKey || ! $senderId || ! $messageId) {
            Log::error('SMS API credentials are not set in .env file.');

            return false;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post($apiUrl, [
                'route' => 'dlt',
                'sender_id' => $senderId,
                'message' => $messageId,
                'variables_values' => $username.'|'.$otp.'|',
                'flash' => 0,
                'numbers' => $phone,
            ]);

            return $response->successful();
        } catch (\Exception $e) {
            Log::error('SMS Sending Failed: '.$e->getMessage());

            return false;
        }
    } 
    /**
     * $appsignkey is the Android app's 11-character SMS Retriever hash, which
     * lets the app autofill the OTP. Falls back to SMS_APP_SIGN_KEY (the Play
     * Store build's hash) when the client doesn't send one.
     */
    public function sendSmsOTPApiWithAppSignKey($phone, $otp, $appsignkey = null)
    {
        $appsignkey = $appsignkey ?: env('SMS_APP_SIGN_KEY', '');
        $apiUrl = env('SMS_API_URL');
        $apiKey = env('SMS_API_KEY');
        $senderId = env('SMS_SENDER_ID');
        $messageId = env('SMS_MESSAGE_ID');

        if (! $apiUrl || ! $apiKey || ! $senderId || ! $messageId) {
            Log::error('SMS API credentials are not set in .env file.');

            return false;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post($apiUrl, [
                'route' => 'dlt',
                'sender_id' => $senderId,
                'message' => $messageId,
                'variables_values' => $otp.'|'.$appsignkey.'|',
                'flash' => 0,
                'numbers' => $phone,
            ]);

            return $response->successful();
        } catch (\Exception $e) {
            Log::error('SMS Sending Failed: '.$e->getMessage());

            return false;
        }
    }
}