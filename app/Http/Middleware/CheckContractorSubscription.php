<?php

namespace App\Http\Middleware;

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
        $user = Auth::user();
        $subscriptions = ContractorSubscription::where('contractor_id', $user->id)
            ->where('status', 'active')
            ->where('end_date', '>=', now())
            ->get();

        $hasActiveDays = false;

        foreach ($subscriptions as $sub) {
            if (Carbon::parse($sub->end_date)->isFuture()) {
                $hasActiveDays = true;
                break;
            }
        }

        if (!$hasActiveDays) {
            flash()->error('Your subscription has expired. Please renew to continue.');
            return redirect()->route('contractor.subscription.index');
        }

        return $next($request);
    }
}
