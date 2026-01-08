<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsPhoneVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->phone_verified_at) {
            // Return a JSON response for APIs
            return response()->json(['message' => 'Your phone number is not verified.'], 403);

            // Or redirect for web
            // return redirect()->route('phone.verify.notice');
        }

        return $next($request);
    }
}
