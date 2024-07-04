<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            // Redirect to login page if not authenticated
            return redirect()->route('login');
        }

        // Check if the authenticated user has the required role
        $user = Auth::user();
        if ($user->role !== $role) {
            // Redirect to an unauthorized page or abort with 403
            return abort(403, 'Unauthorized access');
        }

        // Proceed to the next middleware or controller
        return $next($request);
    }
}
