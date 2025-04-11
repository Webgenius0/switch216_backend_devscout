<?php

namespace App\Services\Web\Frontend;

use App\Models\ContractorSubscription;
use App\Models\SubcriptionPackage;
use Exception;
use Illuminate\Support\Facades\Auth;

class ContractorSubcriptionService
{
    /**
     * Fetch all resources.
     *
     * @return mixed
     */
    public function index()
    {
        try {
            $subcription = ContractorSubscription::with('package')->where('status', 'active')->where('contractor_id', Auth::user()->id)->get();
            return $subcription;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getPakeges()
    {
        try {
            return SubcriptionPackage::where('status', 'active')->get();
        } catch (Exception $e) {
            throw $e;
        }
    }

}