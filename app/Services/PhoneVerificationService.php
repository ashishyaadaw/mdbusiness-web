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

    public function createAndSendOtp($phone, $username)
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
        $sent = $this->sendSmsApi($phone, $otp, $username);

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
    public function sendSmsApi($phone, $otp, $username)
    {
        $apiUrl = env('SMS_API_URL');
        $apiKey = env('SMS_API_KEY');
        $senderId = env('SMS_SENDER_ID');

        if (! $apiUrl || ! $apiKey || ! $senderId) {
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
                'message' => '201904',
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
}
