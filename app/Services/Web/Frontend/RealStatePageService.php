<?php

namespace App\Services\Web\Frontend;

use App\Models\Category;
use App\Models\SubCategory;
use Exception;
use App\Models\Booking;
use App\Models\Review;
use App\Models\Service;
use Illuminate\Support\Facades\Log;

class RealStatePageService
{
     /**
     * Fetch all resources.
     *
     * @return mixed
     */
    public function index()
    {
        try {
            $real_state_service = Service::with(['user', 'RealStateService'])->where('category_id', 1)->where("status", 'active')->latest()->take('6')->get();
            $realStateServiceSubCategorys = SubCategory::where('category_id', 1)->where("status", 'active')->get();
            $data = [
                'real_state_service' => $real_state_service,
                'realStateServiceSubCategorys' => $realStateServiceSubCategorys,
            ];
            return $data;
        } catch (Exception $e) {
            Log::error('RealStatePageService::index' . $e->getMessage());
            throw $e;
        }
    }
    /**
     * Fetch all resources.
     *
     * @return mixed
     */
    public function realStateList()
    {
        try {
            $services = Service::with(['user', 'RealStateService'])->where("status", 'active')->latest()->get();
            return $services;
        } catch (Exception $e) {
            Log::error('RealStatePageService::index' . $e->getMessage());
            throw $e;
        }
    }

}