<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendOtpRequest;
use App\Http\Requests\VerifyOtpRequest;
use App\Services\PhoneVerificationService;
use Illuminate\Http\JsonResponse;

class PhoneVerificationController extends Controller
{
    protected $verificationService;

    public function __construct(PhoneVerificationService $verificationService)
    {
        $this->verificationService = $verificationService;
    }

    public function sendPhoneOtp(SendOtpRequest $request): JsonResponse
    {
        $phone = $request->phone;
        $username = $request->username ?? 'User';

        // 1. Check Cooldown
        $status = $this->verificationService->canSendOtp($phone);
        if (! $status['allowed']) {
            return response()->json([
                'message' => 'Please wait before requesting a new OTP.',
                'resend_in' => $status['seconds_left'],
            ], 429);
        }

        // 2. Attempt to create and send
        try {
            $otp = $this->verificationService->createAndSendOtp($phone, $username);

            return response()->json([
                'message' => 'OTP sent successfully.',
                'resend_in' => 60,
                'testing_otp' => $otp, // Remove in production
            ], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to send OTP. Please try again later.'], 500);
        }
    }

    public function verifyPhoneOtp(VerifyOtpRequest $request): JsonResponse
    {
        // Logic is delegated to the service
        $result = $this->verificationService->verifyOtp($request->phone, $request->otp);

        if ($result['status'] === 'success') {
            return response()->json(['message' => $result['message']], 200);
        }

        return response()->json(['message' => $result['message']], $result['code']);
    }
}
