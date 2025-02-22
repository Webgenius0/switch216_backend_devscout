<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Web\Frontend\RealStatePageService;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Services\Web\Frontend\EmergencyPageService;
use Exception;
use Illuminate\Support\Facades\Log;

class RealEstateServiceController extends Controller
{
    protected $realStatePageService;

    public function __construct(RealStatePageService $realStatePageService)
    {
        $this->realStatePageService = $realStatePageService;
    }
    /**
     * Car Service Page.
     */
    public function index(Request $request)
    {
        try {
            $data = $this->realStatePageService->index();
            return view('frontend.layouts.real_state_service.index', compact('data'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back();
        }
    }
    /**
     * Lists all car services.
     **/
    public function realStateList(Request $request)
    {
        try {
            $categories = Category::with('subCategories')->where("status", 'active')->get();
            $services = $this->realStatePageService->index();
            return view("frontend.layouts.real_state_service.list", compact('categories', 'services'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back();
        }
    }
}
