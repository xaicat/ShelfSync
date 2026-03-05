<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Check if the user is authenticated
        // 2. Check if the authenticated user has the 'admin' role
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request); // Allow access to the admin route
        }

        // Redirect non-admin users to the home page with an error message
        return redirect()->route('home')->with('error', 'You do not have administrative access to this area.');
    }
}