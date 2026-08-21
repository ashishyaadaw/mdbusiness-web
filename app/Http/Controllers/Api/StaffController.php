<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Matters\Matter;
use App\Models\User;

class StaffController extends Controller
{
    /**
     * Matters awaiting staff review.
     */
    public function index()
    {
        $pendingMatters = Matter::with(['matterCreator', 'matterController'])
            ->whereHas('matterController', function ($query) {
                $query->where('status', 'pending');
            })
            ->latest()
            ->paginate(15);

        return response()->json(
            [
                'status' => true,
                'data' => $pendingMatters->items(),
                'pagination' => [
                    'current_page' => $pendingMatters->currentPage(),
                    'last_page' => $pendingMatters->lastPage(),
                    'total' => $pendingMatters->total(),
                ],
            ],
            200,
        );
    }

    public function verifyUser(User $user)
    {
        $user->update(['is_verified' => true]);

        return response()->json(
            [
                'status' => true,
                'message' => 'User verified successfully.',
                'data' => $user,
            ],
            200,
        );
    }
}
