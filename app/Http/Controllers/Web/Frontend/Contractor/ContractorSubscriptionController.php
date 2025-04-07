<?php

namespace App\Http\Controllers\Web\Frontend\Contractor;

use App\Http\Controllers\Controller;
use App\Models\ContractorSubscription;
use App\Models\SubcriptionPackage;
use App\Services\Web\Frontend\ContractorSubcriptionService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ContractorSubscriptionController extends Controller
{
    protected $contractorSubcriptionService;
    protected $user;

    public function __construct(ContractorSubcriptionService $contractorSubcriptionService)
    {
        $this->contractorSubcriptionService = $contractorSubcriptionService;
        $this->user = Auth::user();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcriptions = $this->contractorSubcriptionService->index();
        return view('frontend.dashboard.contractor.layouts.subcription.index', compact('subcriptions'));
    }

    public function getPakeges()
    {
        try {
            $pakesges = $this->contractorSubcriptionService->getPakeges();
            return view('frontend.dashboard.contractor.layouts.subcription.package', compact('pakesges'));
        } catch (Exception $e) {
            Log::error('ContractorSubscriptionController::getPakeges' . $e->getMessage());
            flash()->error('Something went wrong');
            return redirect()->back();
        }
    }

    public function makeSubscribe(Request $request, int $packageId)
    {
        // $request->validate([
        //     'subscription_package_id' => 'required|exists:subcription_packages,id',
        //     'amount_paid' => 'required|numeric|min:0',
        //     'payment_status' => 'required|in:pending,completed,failed',
        // ]);

        $user = Auth::user(); // Get logged-in contractor

        $package = SubcriptionPackage::findOrFail($packageId);
        dd($package);
        // Get active subscription for the same package
        $existingSubscription = ContractorSubscription::where('contractor_id', $user->id)
            ->where('subscription_package_id', $package->id)
            ->where('status', 'active')
            ->latest()
            ->first();

        $startDate = Carbon::today();
        $daysToAdd = (int) $package->days;

        if ($existingSubscription) {
            // Extend end date if already subscribed
            $startDate = Carbon::parse($existingSubscription->end_date)->greaterThan(Carbon::today())
                ? Carbon::parse($existingSubscription->end_date)
                : Carbon::today();
        }

        $endDate = $startDate->copy()->addDays($daysToAdd);

        // Create or update subscription
        $subscription = ContractorSubscription::updateOrCreate(
            [
                'contractor_id' => $user->id,
                'subscription_package_id' => $package->id,
            ],
            [
                'amount_paid' => $request->amount_paid,
                'payment_status' => $request->payment_status,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'status' => 'active',
            ]
        );



        return response()->json(['message' => 'Subscription updated successfully!', 'subscription' => $subscription]);
    }
}
