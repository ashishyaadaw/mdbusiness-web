<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Handle Registration
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string|unique:users,phone',
            'password' => 'required|string|confirmed',
        ]);
        $username = $this->generateUniqueUsername();

        $user = User::create([
            'username' => $username,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        $user->appUserProfile()->create([
            'full_name' => $request->name,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    // Handle Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'phone' => 'required|phone',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['phone' => 'The provided credentials do not match our records.']);
    }

    // Handle Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

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
}