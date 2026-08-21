<?php

use App\Http\Controllers\Api\PhoneVerificationController;
use Illuminate\Support\Facades\Route;

Route::post('/otp/send', [PhoneVerificationController::class, 'sendPhoneOtp']);
Route::post('/otp/verify', [PhoneVerificationController::class, 'verifyPhoneOtp']);
