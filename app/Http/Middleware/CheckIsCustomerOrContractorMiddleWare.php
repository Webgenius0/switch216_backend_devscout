<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIsCustomerOrContractorMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Check if user is authenticated and has the correct role
        if ($user && ($user->role === 'customer' || $user->role === 'contractor')) {
            // Update 'last_seen' timestamp if user is authenticated
            $user->update(['last_seen' => Carbon::now()]);

            return $next($request);
        }

        // If the user is not authorized or doesn't have the required role
        return abort(404, 'Unauthorized action.');
    }
}
