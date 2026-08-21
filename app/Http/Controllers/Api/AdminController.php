<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Matters\Matter;
use App\Models\Matters\MatterController as MatterStatus;
use App\Models\Menu;
use App\Models\Transaction;
use App\Models\User;

class AdminController extends Controller
{
    public function getStats()
    {
        $mattersByStatus = MatterStatus::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return response()->json(
            [
                'status' => true,
                'data' => [
                    'total_users' => User::count(),
                    'total_matters' => Matter::count(),
                    'matters_by_status' => $mattersByStatus,
                    'total_cities' => City::count(),
                    'total_menus' => Menu::count(),
                    'total_transactions' => Transaction::count(),
                    'successful_transactions_amount' => (float) Transaction::where('status', 'success')->sum('amount'),
                ],
            ],
            200,
        );
    }
}
