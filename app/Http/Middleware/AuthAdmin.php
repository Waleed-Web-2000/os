<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session; 

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Check if the user's status is active
            if ($user->status !== 'ACTIVE') {
                Session::flush();
                return redirect()->route('login')->with('error', 'Your account is deactivated. Please contact support.');
            }

            // Check user type for admin or user
            if ($user->utype === 'ADM') {
                return $next($request); 
            } elseif ($user->utype === 'USR') {
                return redirect()->route('home'); // Allow user access
            } else {
                Session::flush();
                return redirect()->route('login')->with('error', 'Access denied. Unauthorized user type.');
            }
        }

        return redirect()->route('login');
    }
}
