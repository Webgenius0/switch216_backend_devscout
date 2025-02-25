<?php

namespace App\Services\Web\Frontend;

use Exception;
use App\Enums\Page;
use App\Models\CMS;
use App\Enums\Section;
use App\Models\Review;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Category;
use App\Models\SubCategory;
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
            $restaurantBanner = CMS::where('page', Page::RestaurantPage)->where('section', Section::RestaurantBanner)->first();
            $restaurant_service = Service::with(['user', 'RealStateService'])->where('category_id', 2)->where("status", 'active')->latest()->take('6')->get();
            $restaurantServiceSubCategorys = SubCategory::where('category_id', 2)->where("status", 'active')->get();
            $data = [
                'restaurant_service' => $restaurant_service,
                'restaurantServiceSubCategorys' => $restaurantServiceSubCategorys,
                'restaurantBanner' => $restaurantBanner
            ];
            return $data;
        } catch (Exception $e) {
            Log::error('RestaurantPageService::index' . $e->getMessage());
            throw $e;
        }
    }
}