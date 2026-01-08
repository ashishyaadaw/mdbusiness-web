<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    //
    public function index(Request $request)
    {
        try {
            $user = Auth::user();

            // 1. Check if user is authenticated
            if (! $user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized access',
                ], 401);
            }

            // 2. Fetch Transactions
            // Using $user->transactions() leverages the Eloquent relationship
            $transactions = $user->transactions()
                ->latest()
                ->get();

            return response()->json([
                'status' => 'success',
                'count' => $transactions->count(),
                'data' => $transactions,
            ], 200);

        } catch (\Exception $e) {
            // 3. Log the error for the developer
            Log::error('Transaction Fetch Error: '.$e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong while fetching transactions.',
                // Only include 'debug' in local environment for security
                'debug' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    public function store(Request $request)
    {
        // 1. Define Validation Rules
        $validator = Validator::make($request->all(), [
            'txnId' => 'required|string|unique:transactions,transaction_reference',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'status' => 'required|in:success,failed,pending',
            'paymentMethod' => 'required|string',
        ]);

        // 2. Return Errors if Validation Fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        // 3. Persist to Database
        try {
            DB::beginTransaction();

            $transaction = Transaction::create([
                'user_id' => $request->user()->id, // Auth user
                'transaction_reference' => $request->txnId,         // Mapping "id" from Flutter
                'title' => $request->title,
                'amount' => $request->amount,
                'transaction_date' => $request->date,
                'status' => $request->status,
                'payment_method' => $request->paymentMethod,
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Transaction recorded successfully',
                'data' => $transaction,
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to store transaction',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
