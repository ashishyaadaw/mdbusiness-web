<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load('userProfile');

        $matters = $user->matters()->with('matterController')->get();

        $statusCounts = $matters->countBy(fn ($matter) => $matter->matterController->status ?? 'pending');

        $unreadNotifications = Notification::where('user_id', $user->id)->unread()->count();

        return view('pages.account.dashboard', [
            'title' => 'My Dashboard',
            'isSearchBar' => false,
            'user' => $user,
            'statusCounts' => $statusCounts,
            'recentMatters' => $matters->sortByDesc('created_at')->take(5),
            'unreadNotifications' => $unreadNotifications,
        ]);
    }
}
