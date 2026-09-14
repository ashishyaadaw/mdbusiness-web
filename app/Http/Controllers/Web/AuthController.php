<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\PhoneVerificationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * OTP login for the consumer web area — the same phone-first, OTP-verified
 * flow the app uses (Api\AuthController::smartLogin), just issuing a
 * session instead of a Sanctum token. There is no separate password/
 * registration form: a phone number that doesn't exist yet is
 * auto-registered the moment its first OTP is requested, exactly like the
 * app does, so "login" and "sign up" are the same flow here too.
 */
class AuthController extends Controller
{
    private const OTP_COOLDOWN_SECONDS = 60;

    private const OTP_EXPIRE_MINUTES = 5;

    public function __construct(private PhoneVerificationService $verificationService) {}

    public function showLogin(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('account.dashboard');
        }

        if ($request->boolean('reset')) {
            $request->session()->forget('otp_phone');

            return redirect()->route('account.login');
        }

        return view('pages.account.login', [
            'title' => 'Log In',
            'phone' => $request->session()->get('otp_phone'),
        ]);
    }

    public function requestOtp(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string|min:10|max:15',
            'full_name' => 'nullable|string|min:3|max:60',
        ]);

        $phone = $validated['phone'];
        $user = User::where('phone', $phone)->first();

        if (! $user) {
            $user = User::create([
                'username' => $this->generateUniqueUsername(),
                'phone' => $phone,
                'password' => Hash::make(Str::random(16)),
            ]);

            $user->userProfile()->create([
                'full_name' => $validated['full_name'] ?? 'Member',
            ]);
        }

        if (
            $user->remember_token &&
            Carbon::parse($user->updated_at)->addSeconds(self::OTP_COOLDOWN_SECONDS)->isFuture()
        ) {
            $secondsLeft = (int) ceil(now()->diffInSeconds(
                Carbon::parse($user->updated_at)->addSeconds(self::OTP_COOLDOWN_SECONDS)
            ));

            $request->session()->put('otp_phone', $phone);

            return back()
                ->withErrors(['otp' => "Please wait {$secondsLeft}s before requesting another OTP."])
                ->withInput();
        }

        $otp = (string) random_int(1000, 9999);

        $user->forceFill([
            'remember_token' => Hash::make($otp),
            'updated_at' => now(),
        ])->save();

        $fullName = $user->userProfile?->full_name ?? $user->username;
        $this->verificationService->sendSmsApi($user->phone, $otp, $fullName);

        $request->session()->put('otp_phone', $phone);

        return redirect()->route('account.login')->with('status', 'An OTP has been sent to your phone.');
    }

    public function verifyOtp(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string',
            'otp' => 'required|string|min:4|max:6',
        ]);

        $user = User::where('phone', $validated['phone'])->first();

        if (! $user || ! $user->remember_token || ! Hash::check($validated['otp'], $user->remember_token)) {
            $request->session()->put('otp_phone', $validated['phone']);

            return back()->withErrors(['otp' => 'Invalid OTP.']);
        }

        if (Carbon::parse($user->updated_at)->addMinutes(self::OTP_EXPIRE_MINUTES)->isPast()) {
            $user->forceFill(['remember_token' => null])->save();

            $request->session()->forget('otp_phone');

            return redirect()->route('account.login')
                ->withErrors(['otp' => 'That OTP has expired. Please request a new one.']);
        }

        $user->forceFill(['remember_token' => null])->save();

        Auth::login($user);
        $request->session()->regenerate();
        $request->session()->forget('otp_phone');

        return redirect()->intended(route('account.dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    private function generateUniqueUsername(): string
    {
        do {
            $username = 'MDM'.random_int(100000000, 999999999);
        } while (User::where('username', $username)->exists());

        return $username;
    }
}
