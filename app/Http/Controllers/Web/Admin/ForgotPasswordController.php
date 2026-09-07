<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\PhoneVerificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    protected const SESSION_PHONE_KEY = 'admin_reset_phone';

    public function __construct(protected PhoneVerificationService $verificationService) {}

    public function showRequest()
    {
        return view('admin.forgot-password');
    }

    public function sendOtp(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string',
        ]);

        $user = $this->dashboardUser($validated['phone']);

        if (! $user) {
            return back()->withErrors(['phone' => 'No admin/staff account was found for that phone number.'])->onlyInput('phone');
        }

        $status = $this->verificationService->canSendOtp($validated['phone']);

        if (! $status['allowed']) {
            return back()
                ->withErrors(['phone' => 'Please wait '.$status['seconds_left'].'s before requesting another OTP.'])
                ->onlyInput('phone');
        }

        try {
            $this->verificationService->createAndSendOtp($validated['phone'], $user->username);
        } catch (\Exception $e) {
            return back()->withErrors(['phone' => 'Failed to send OTP. Please try again shortly.'])->onlyInput('phone');
        }

        $request->session()->put(self::SESSION_PHONE_KEY, $validated['phone']);

        return redirect()->route('admin.password.reset.show')->with('status', 'OTP sent. It is valid for 5 minutes.');
    }

    public function showReset(Request $request)
    {
        if (! $request->session()->has(self::SESSION_PHONE_KEY)) {
            return redirect()->route('admin.password.request');
        }

        return view('admin.reset-password', ['phone' => $request->session()->get(self::SESSION_PHONE_KEY)]);
    }

    public function reset(Request $request)
    {
        $phone = $request->session()->get(self::SESSION_PHONE_KEY);

        if (! $phone) {
            return redirect()->route('admin.password.request');
        }

        $validated = $request->validate([
            'otp' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = $this->dashboardUser($phone);

        if (! $user) {
            $request->session()->forget(self::SESSION_PHONE_KEY);

            return redirect()->route('admin.password.request')->withErrors(['phone' => 'Account no longer available.']);
        }

        $result = $this->verificationService->verifyOtp($phone, $validated['otp']);

        if ($result['status'] !== 'success') {
            return back()->withErrors(['otp' => $result['message']]);
        }

        $user->update(['password' => Hash::make($validated['password'])]);
        $request->session()->forget(self::SESSION_PHONE_KEY);

        return redirect()->route('login')->with('status', 'Password reset. Please sign in with your new password.');
    }

    private function dashboardUser(string $phone): ?User
    {
        return User::where('phone', $phone)->whereIn('role', ['admin', 'staff'])->first();
    }
}
