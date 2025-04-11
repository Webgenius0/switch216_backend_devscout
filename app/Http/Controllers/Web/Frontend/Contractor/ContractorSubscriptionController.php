<?php

namespace App\Http\Controllers\Web\Frontend\Contractor;

use App\Http\Controllers\Controller;
use App\Services\Web\Frontend\ContractorSubcriptionService;
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

    /**
     * Display a listing of all the subscription packages
     */
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

}
