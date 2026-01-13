<?php
namespace App\Services;

use App\Models\User;
use App\Models\UserServiceKey;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
  
class AuthService
{
    public function findOrCreateUser(string $phone, ?string $fullName): User
    {
        $user = User::where("phone", $phone)->first();

        if (!$user) {
            $user = User::create([
                "username" => Str::random(10), // Or your custom unique generator
                "phone" => $phone,
                "password" => Hash::make(Str::random(16)),
            ]);

            $user->appUserProfile()->create([
                "full_name" => $fullName ?? "Member",
            ]);
        }
        return $user;
    }

    public function verifyOtp(User $user, string $otp): bool
    {
        if (
            !$user->remember_token ||
            !Hash::check($otp, $user->remember_token)
        ) {
            return false;
        }

        $isExpired = Carbon::parse($user->updated_at)
            ->addMinutes(config("auth.otp_expire_minutes", 5))
            ->isPast();

        if ($isExpired) {
            $user->update(["remember_token" => null]);
            return false;
        }

        return true;
    }

    public function finalizeLogin(User $user, array $data): string
    {
        // Update Profile
        if (!empty($data["full_name"])) {
            $user
                ->appUserProfile()
                ->update(["full_name" => $data["full_name"]]);
        }

        // Update FCM
        if (!empty($data["fcm_key"])) {
            UserServiceKey::updateOrCreate(
                ["user_id" => $user->id],
                ["fcm_key" => $data["fcm_key"]],
            );
        }

        $user->update(["remember_token" => null]);
        return $user->createToken("auth_token")->plainTextToken;
    }
}
