<?php

namespace App\Http\Middleware;

use App\Models\SubcriptionPackage;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\ContractorSubscription;

class CheckContractorSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $checkSubcriptionPakageActive = SubcriptionPackage::where('status', 'active')->first();
        if (!$checkSubcriptionPakageActive) {
            return $next($request);
        }
        $user = Auth::user();
        // If the user is not authorized, redirect or abort
        if ($user->role !== 'contractor') {
            return $next($request);
        }
        // Check if the user has an active subscription
        $subscriptions = ContractorSubscription::where('contractor_id', $user->id)
            ->where('status', 'active')
            ->where('end_date', '>=', now())
            ->get();

        $hasActiveDays = false;
        // Check if the user has any active days
        foreach ($subscriptions as $sub) {
            if (Carbon::parse($sub->end_date)->isFuture()) {
                $hasActiveDays = true;
                break;
            }
        }
        // If the user has no active days, redirect or abort
        if (!$hasActiveDays) {
            flash()->error('Your subscription has expired. Please renew to continue.');
            return redirect()->route('contractor.subscription.index');
        }
        // If the user has active days, continue
        return $next($request);
    }
}
