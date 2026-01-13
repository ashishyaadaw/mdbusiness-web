<?php

namespace App\Http\Controllers\Api;

use App\Events\Login;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckerAppLoginRequest;
use App\Models\User;
use App\Models\UserServiceKey;
use App\Services\AuthService;
use App\Services\PhoneVerificationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    protected $verificationService;
    protected $authService;

    public function __construct(PhoneVerificationService $verificationService, AuthService $authService)
    {
        $this->verificationService = $verificationService;
        $this->authService = $authService;
    }

    private const OTP_COOLDOWN_SECONDS = 60;

    private const OTP_EXPIRE_MINUTES = 5;

    /**
     * Smart Login: Handles both Registration (Auto) and Login via OTP.
     */
    public function getProfile(Request $request)
    {
        // Get the authenticated user
        $user = $request->user();

        // CHECK: If user is not logged in, return JSON error immediately
        if (! $user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        // Ensure the profile relationship is loaded
        $user->load('appUserProfile');

        return response()->json([
            'message' => 'Profile retrieved successfully.',
            'user' => $user,
        ], 200);
    }

    public function getProfiles(Request $request)
    {
        // 1. Use paginate(perPage) instead of get()
        // This automatically reads the ?page parameter from the request
        $perPage = 15;
        $paginatedUsers = User::with('appUserProfile')
            ->latest() // Optional: Show newest users first
            ->paginate($perPage);

        // 2. Use the through() method on the paginator to flatten data
        // This preserves the pagination meta-data (total, current_page, etc.)
        $paginatedUsers->getCollection()->transform(function ($user) {
            $userData = $user->toArray();

            // Flatten the full_name to the top level
            $userData['full_name'] = $user->appUserProfile->full_name ?? null;

            // Clean up the relationship key
            unset($userData['app_user_profile']); 

            return $userData;
        });

        return response()->json([
            'message' => 'Profiles retrieved successfully.',
            'users' => $paginatedUsers->items(), // The actual user list for Flutter
            'pagination' => [
                'total' => $paginatedUsers->total(),
                'current_page' => $paginatedUsers->currentPage(),
                'last_page' => $paginatedUsers->lastPage(),
                'has_more' => $paginatedUsers->hasMorePages(),
            ],
        ]);
    }

    public function smartLogin(Request $request)
    {
        // 1. Basic Validation
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|min:10',
            'otp' => 'nullable|string|min:4|max:6',
            'full_name' => 'nullable|string|min:3|max:40',
            'fcm_key' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $phone = $request->phone;
        $user = User::where('phone', $phone)->first();

        // ==========================================
        // FLOW A: REQUEST OTP (No OTP provided)
        // ==========================================
        if (! $request->filled('otp')) {

            // If user does not exist, Auto-Register them
            if (! $user) {
                $username = $this->generateUniqueUsername();

                $user = User::create([
                    'username' => $username,
                    'phone' => $phone,
                    'password' => Hash::make(Str::random(16)),
                ]);

                $user->appUserProfile()->create([
                    'full_name' => $request->full_name ?? 'Member',
                ]);
            }

            return $this->sendOTP($user->id);
        }

        // ==========================================
        // FLOW B: VERIFY OTP (OTP provided)
        // ==========================================

        if (! $user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        // 1. Check validity
        if (! $user->remember_token || ! Hash::check($request->otp, $user->remember_token)) {
            return response()->json(['message' => 'Invalid OTP'], 401);
        }

        // 2. Check expiration
        if (Carbon::parse($user->updated_at)->addMinutes(self::OTP_EXPIRE_MINUTES)->isPast()) {
            $user->remember_token = null;
            $user->save();

            return response()->json(['message' => 'OTP has expired.'], 401);
        }

        // 3. Success: Clear OTP

        if ($request->filled('full_name')) {

            $user->appUserProfile()->update([
                'full_name' => $request->full_name ?? 'Member',
            ]);
        }

        $user->remember_token = null;
        $user->save();

        // 4. Update FCM if provided
        if ($request->filled('fcm_key')) {
            UserServiceKey::updateOrCreate(
                ['user_id' => $user->id],
                ['fcm_key' => $request->fcm_key]
            );
        }

        // 5. Generate Token
        $token = $user->createToken('auth_token')->plainTextToken;
        $user->load('appUserProfile');

        return response()->json([
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
            'is_new_user' => $user->wasRecentlyCreated,
        ]);
    }
    public function checkerAppLogin(CheckerAppLoginRequest $request)
    {
        $user = User::where("phone", $request->phone)->first();

    if (!$request->filled("otp")) {
        $user = $this->authService->findOrCreateUser($request->phone, $request->full_name);
        return $this->checkerAppLoginOtp($user->id);
    }

        

        // ==========================================
        // FLOW B: VERIFY OTP (OTP provided)
        // ==========================================

        if (! $user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        // 1. Check validity
        if (! $user->remember_token || ! Hash::check($request->otp, $user->remember_token)) {
            return response()->json(['message' => 'Invalid OTP'], 401);
        }

        // 2. Check expiration
        if (Carbon::parse($user->updated_at)->addMinutes(self::OTP_EXPIRE_MINUTES)->isPast()) {
            $user->remember_token = null;
            $user->save();

            return response()->json(['message' => 'OTP has expired.'], 401);
        }

        // 3. Success: Clear OTP

        if ($request->filled('full_name')) {

            $user->appUserProfile()->update([
                'full_name' => $request->full_name ?? 'Member',
            ]);
        }

        $user->remember_token = null;
        $user->save();

        // 4. Update FCM if provided
        if ($request->filled('fcm_key')) {
            UserServiceKey::updateOrCreate(
                ['user_id' => $user->id],
                ['fcm_key' => $request->fcm_key]
            );
        }

        // 5. Generate Token
        $token = $user->createToken('auth_token')->plainTextToken;
        $user->load('appUserProfile');

        return response()->json([
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
            'is_new_user' => $user->wasRecentlyCreated,
        ]);
    }

    /**
     * Standard Registration (Preserved)
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:10|min:10|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $username = $this->generateUniqueUsername();

        $user = User::create([
            'username' => $username,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        $user->appUserProfile()->create([
            'full_name' => $request->name,
        ]);

        $user->load('appUserProfile');
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Registration successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 201);
    }

    /**
     * Update the authenticated user's profile.
     */
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        // ADDED: Explicit check. If $user is null, return 401 JSON instead of redirecting or crashing.
        if (! $user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'full_name' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            // 1. Update basic User table fields
            if ($request->has('email')) {
                $user->email = $request->email;
                $user->save();
            }

            // 2. Update or Create the AppUserProfile
            $user->appUserProfile()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'full_name' => $request->input('full_name', $user->appUserProfile->full_name ?? null),
                ]
            );

            $user->load('appUserProfile');

            return response()->json([
                'message' => 'Profile updated successfully.',
                'user' => $user,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update profile.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // --- HELPER FUNCTIONS ---

    private function generateUniqueUsername()
    {
        $username = null;
        do {
            $randomNumber = random_int(100000000, 999999999);
            $generatedUsername = 'MDM'.$randomNumber;
            if (! User::where('username', $generatedUsername)->exists()) {
                $username = $generatedUsername;
            }
        } while ($username === null);

        return $username;
    }

    private function sendOTP($userId)
    {
        $user = User::find($userId);

        if ($user->remember_token && Carbon::parse($user->updated_at)->addSeconds(self::OTP_COOLDOWN_SECONDS)->isFuture()) {
            $secondsLeft = Carbon::parse($user->updated_at)->addSeconds(self::OTP_COOLDOWN_SECONDS)->diffInSeconds(Carbon::now());

            return response()->json([
                'message' => 'Please wait before requesting a new OTP.',
                'resend_in' => $secondsLeft,
            ], 429);
        }

        $otp = random_int(1000, 9999);
        $user->remember_token = Hash::make($otp);
        $user->updated_at = Carbon::now();
        $user->save();

        try {
            $otp = $this->verificationService->sendSmsApi($user->phone, $otp, $user->username);

            return response()->json([
                'message' => 'OTP sent successfully.',
                // 'debug_otp' => $otp, // Comment out for production
            ], 200);

        } catch (\Exception $e) {
            // \Log::error('Failed to send OTP: '.$e->getMessage());

            return response()->json(['message' => 'Failed to send OTP.'], 500);
        }
    }
    private function checkerAppLoginOtp($userId)
    {
        $user = User::find($userId);

        if ($user->remember_token && Carbon::parse($user->updated_at)->addSeconds(self::OTP_COOLDOWN_SECONDS)->isFuture()) {
            $secondsLeft = Carbon::parse($user->updated_at)->addSeconds(self::OTP_COOLDOWN_SECONDS)->diffInSeconds(Carbon::now());

            return response()->json([
                'message' => 'Please wait before requesting a new OTP.',
                'resend_in' => $secondsLeft,
            ], 429);
        }

        $otp = random_int(100000, 999999);
        $user->remember_token = Hash::make($otp);
        $user->updated_at = Carbon::now();
        $user->save();

        try {
            $otp = $this->verificationService->sendSmsApi($user->phone, $otp, $user->username);

            return response()->json([
                'message' => 'OTP sent successfully.',
                // 'debug_otp' => $otp, // Comment out for production
            ], 200);

        } catch (\Exception $e) {
            // \Log::error('Failed to send OTP: '.$e->getMessage());

            return response()->json(['message' => 'Failed to send OTP.'], 500);
        }
    }
}
