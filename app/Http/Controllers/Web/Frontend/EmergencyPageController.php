<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use App\Services\Web\Frontend\EmergencyPageService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EmergencyPageController extends Controller
{
    protected $emergencyService;

    public function __construct(EmergencyPageService $emergencyService)
    {
        $this->emergencyService = $emergencyService;
    }
    public function index(Request $request)
    {
        try {
            // $serching_category_id = $request->category_id;
            // $serching_location = $request->location;
            // $serching_sub_category_id = $request->sub_category_id;
            // $serching_date = $request->date;
            // $serching_is_emergency = $request->is_emergency;
            // $serching_rating = $request->rating;

            $categories = Category::with('subCategories')->where("status", 'active')->get();
            $services = $this->emergencyService->index();
            // dd($services);
            return view("frontend.layouts.emergency.index", compact('categories', 'services'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function show($id)
    {
        try {

            $service = $this->emergencyService->show($id);
            $categoryNames = $this->emergencyService->getContactorCategoryList($service->user_id);
            $ServiceTitleWithDescription = $this->emergencyService->ServiceTitleWithDescription($service->user_id);
            $ContactorReviews = $this->emergencyService->ContactorReview($service->user_id);

            $ContactorProfileCounter = $this->emergencyService->ContactorProfileCounter($service->user_id);
            // dd($ContactorProfileCounter);
            return view("frontend.layouts.service.show", compact("service", "categoryNames", "ServiceTitleWithDescription", "ContactorReviews", "ContactorProfileCounter"));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back();
        }
    }


}
