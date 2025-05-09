<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Web\Frontend\RealStatePageService;
use App\Services\Web\Frontend\RestaurantPageService;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Services\Web\Frontend\EmergencyPageService;
use Exception;
use Illuminate\Support\Facades\Log;

class RestaurantPageController extends Controller
{
    protected $restaurantPageService;

    public function __construct(RestaurantPageService $restaurantPageService)
    {
        $this->restaurantPageService = $restaurantPageService;
    }
    /**
     * Car Service Page.
     */
    public function index(Request $request)
    {
        try {
            $locations = $request->query('location') ?? null;
            $data = $this->restaurantPageService->index();
            return view('frontend.layouts.restaurant_service.index', compact('data', 'locations'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Lists all car services.
     **/
    public function restaurantList(Request $request)
    {
        try {
            $categories = Category::with('subCategories')->where("status", 'active')->get();
            $services = $this->restaurantPageService->index();
            return view("frontend.layouts.restaurant_service.list", compact('categories', 'services'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back();
        }
    }

}
