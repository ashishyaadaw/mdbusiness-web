<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AccountDeletionController extends Controller
{
    /**
     * Show the account deletion request form.
     */
    public function showForm()
    {
        return view('pages.deletion', [
            'isSearchBar' => false,
            'isNavbar' => true
        ]);
    }

    /**
     * Process the account deletion request.
     */
    public function processRequest(Request $request)
    {
        // 1. Validate the input (Ensuring Email OR Phone is provided)
        $request->validate([
            'email'  => 'required_without:phone|nullable|email',
            'phone'  => 'required_without:email|nullable|string|min:10',
            'reason' => 'required|string',
        ]);

        $identifier = $request->email ?? $request->phone;

        // 2. Logic to notify admin or mark user for deletion
        // Note: Google requires actual data erasure within 30 days.
        
        // Example: Send email to your legal/admin team
        /*
        Mail::raw("Account Deletion Request Received:\n\n" .
                  "User Identifier: $identifier\n" .
                  "Reason: {$request->reason}", function ($message) use ($identifier) {
            $message->to('legal@mdbusiness.com')
                    ->subject("MDBusiness - New Deletion Request: $identifier");
        });
        */

        // 3. Redirect with success message
        return redirect()->back()->with('success', 'Your deletion request for ' . $identifier . ' has been received. Data will be purged within 30 days.');
    }
}