<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // 1. Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'service' => 'required|string',
            'message' => 'required|min:10',
        ]);

        // 2. Send Email logic
        // For now, we'll just return a JSON response for your jQuery AJAX
        try {
            // Mail::to('info@websamsya.com')->send(new \App\Mail\ContactMail($validated));
            Mail::to('websamsya@gmail.com')->send(new ContactMail($validated));

            return response()->json([
                'success' => true,
                'message' => 'Your message has been received!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.',
            ], 500);
        }
    }
}
