<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CarService;
use App\Services\Web\Frontend\CarPageService;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Service;
use App\Services\Web\Frontend\EmergencyPageService;
use Exception;
use Illuminate\Support\Facades\Log;

class CarPageController extends Controller
{
    protected $carPageService;

    public function __construct(CarPageService $carPageService)
    {
        $this->carPageService = $carPageService;
    }
    /**
     * Car Service Page.
     */
    public function index(Request $request)
    {
        try {
            $data = $this->carPageService->index();
            // dd($carServicesSubCategorys);
            // dd($data);
            return view('frontend.layouts.car_service.index', compact('data'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back();
        }
    }
    /**
     * Lists all car services.
     **/
    public function carList(Request $request)
    {
        try {
            $categories = Category::with('subCategories')->where("status", 'active')->get();
            $services = $this->carPageService->index();
            return view("frontend.layouts.car_service.list", compact('categories', 'services'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    // public function show($id)
    // {
    //     try {
    //         $service = $this->emergencyService->show($id);
    //         $categoryNames = $this->emergencyService->getContactorCategoryList($service->user_id);
    //         $ServiceTitleWithDescription = $this->emergencyService->ServiceTitleWithDescription($service->user_id);
    //         $ContactorReviews = $this->emergencyService->ContactorReview($service->user_id);

    //         $ContactorProfileCounter = $this->emergencyService->ContactorProfileCounter($service->user_id);
    //         // dd($ContactorProfileCounter);
    //         return view("frontend.layouts.service.show", compact("service", "categoryNames", "ServiceTitleWithDescription", "ContactorReviews", "ContactorProfileCounter"));
    //     } catch (Exception $e) {
    //         Log::error($e->getMessage());
    //         return redirect()->back();
    //     }
    // }

}
