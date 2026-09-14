<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Auth::user()->transactions()
            ->orderByDesc('transaction_date')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('pages.account.transactions', [
            'title' => 'My Transactions',
            'isSearchBar' => false,
            'transactions' => $transactions,
        ]);
    }
}
