<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user()->load('userProfile');

        return view('pages.account.profile', [
            'title' => 'My Profile',
            'isSearchBar' => false,
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'preferred_lang' => 'required|in:en,hi',
        ]);

        Auth::user()->userProfile()->updateOrCreate(
            ['user_id' => Auth::id()],
            $validated,
        );

        return back()->with('status', 'Profile updated.');
    }
}
