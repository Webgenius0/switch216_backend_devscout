<?php

namespace App\Services\Web\Frontend;

use App\Models\Category;
use App\Models\SubCategory;
use Exception;
use App\Models\Booking;
use App\Models\Review;
use App\Models\Service;
use Illuminate\Support\Facades\Log;

class RestaurantPageService
{
    /**
     * Fetch all resources.
     *
     * @return mixed
     */
    public function index()
    {
        try {
            $restaurant_service = Service::with(['user'])->where('category_id', 2)->where("status", 'active')->latest()->take('6')->get();
            $restaurantServiceSubCategorys = SubCategory::where('category_id', 2)->where("status", 'active')->get();
            $data = [
                'restaurant_service' => $restaurant_service,
                'restaurantServiceSubCategorys' => $restaurantServiceSubCategorys,
            ];
            return $data;
        } catch (Exception $e) {
            Log::error('RestaurantPageService::index' . $e->getMessage());
            throw $e;
        }
    }


    /**
     * Fetch all resources.
     *
     * @return mixed
     */
    public function restaurantList()
    {
        try {
            $services = Service::with(['user'])->where("status", 'active')->latest()->get();
            return $services;
        } catch (Exception $e) {
            Log::error('RestaurantPageService::index' . $e->getMessage());
            throw $e;
        }
    }
}