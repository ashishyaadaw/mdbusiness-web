<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Matters\Matter;
use App\Models\Matters\MatterController as MatterStatus;
use App\Models\Menu;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Date;

class DashboardController extends Controller
{
    public function index()
    {
        $mattersByStatus = MatterStatus::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $kpis = [
            'total_users' => User::count(),
            'total_matters' => Matter::count(),
            'pending_matters' => (int) ($mattersByStatus['pending'] ?? 0),
            'matters_by_status' => $mattersByStatus,
            'total_cities' => City::count(),
            'total_menus' => Menu::count(),
            'total_transactions' => Transaction::count(),
            'revenue' => (float) Transaction::where('status', 'success')->sum('amount'),
        ];

        $signupTrend = $this->dailyTrend(User::query());
        $matterTrend = $this->dailyTrend(Matter::query());

        $recentMatters = Matter::with(['matterCreator', 'controller'])
            ->latest()
            ->take(8)
            ->get();

        $recentUsers = User::with('userProfile')
            ->latest()
            ->take(8)
            ->get();

        return view('admin.dashboard', compact('kpis', 'signupTrend', 'matterTrend', 'recentMatters', 'recentUsers'));
    }

    /**
     * Count of rows per day for the last 30 days, zero-filled for empty days.
     */
    private function dailyTrend($query): array
    {
        $from = Date::now()->subDays(29)->startOfDay();

        $counts = $query
            ->where('created_at', '>=', $from)
            ->selectRaw('DATE(created_at) as day, count(*) as total')
            ->groupBy('day')
            ->pluck('total', 'day');

        $trend = [];
        for ($i = 0; $i < 30; $i++) {
            $day = $from->copy()->addDays($i)->toDateString();
            $trend[$day] = (int) ($counts[$day] ?? 0);
        }

        return $trend;
    }
}
