<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Enums\Page;
use App\Enums\SecondSection;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\CMS;
use App\Services\Web\Frontend\CmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomePageController extends Controller
{
    protected CmsService $cmsService;
    public function __construct(CmsService $cmsService)
    {
        $this->cmsService = $cmsService;
    }
    // /**
    //  * Homepage of the frontend.
    //  *
    //  * @return \Illuminate\Contracts\View\View
    //  */
    // public function index(Request $request)
    // {
    //     DB::enableQueryLog();
    //     // $query = CMS::where('page', Page::HomePage)->where('status', 'active');
    //     $data = CMS::where('page', Page::HomePage)->where('status', 'active')->latest()->get();
    //     // foreach (SecondSection::getMap() as $key => $section) {
    //     //     $cms[$key] = (clone $query)->where('section', $key)->latest()->take($section['item'])->{$section['type']}();
    //     // }
    //     // Log all executed queries
    //     // $banner = $data->where('section', 'banner')->take(10);
    //     // $service_container = $data->where('section', 'service_container')->first();
    //     // $process_container = $data->where('section', 'process_container')->first();
    //     // $plat_form_work_container = $data->where('section', 'plat_form_work_container')->first();
    //     // $provider_work_container = $data->where('section', 'provider_work_container')->first();
    //     // $review_user_container = $data->where('section', 'review_user_container')->first();
    //     // $review_provider_container = $data->where('section', 'review_provider_container')->first();
    //     // $faq_container = $data->where('section', 'faq_container')->first();
    //     // $service_container_content = $data->where('section', 'service_container_content')->take(5);
    //     // $process_container_content = $data->where('section', 'process_container_content')->take(3);
    //     // $plat_form_work_container_content = $data->where('section', 'plat_form_work_container_content')->take(3);
    //     // $faq_container_content = $data->where('section', 'faq_container_content')->take(3);
    //     Log::info(DB::getQueryLog());
    //     // dd($cms);
    //     return view("frontend.layouts.home.index", compact('data'));
    // }

    public function index()
    {
        // Fetch CMS data for the homepage
        $cms = $this->cmsService->get();
        $categories = Category::with('subCategories')->where("status", 'active')->get();
        // cities name
        $cities = City::where('status', 'active')->pluck('name');
        // Return the view with optimized data
        return view("frontend.layouts.home.index", compact('cms', 'categories', 'cities'));
    }

    // public function serchingStatic(Request $request)
    // {
    //     $validateData = $request->validate([
    //         'location' => 'nullable|string|max:255',
    //         'category' => 'nullable|string|max:255',
    //         // 'sub_category_id' => 'nullable|integer|exists:sub_categories,id',
    //         // 'date' => 'nullable|date',
    //         // 'is_emergency' => 'nullable|boolean',
    //         'rating' => 'nullable|integer',
    //     ]);
    //     // dd($validateData);
    //     return to_route('service.sub_category', ['id' => $validateData['category'], 'location' => $validateData['location'] ?? null]);
    //     // return redirect()->route('service.emergency', [
    //     //     'category' => $validateData['category'] ?? null, // Default to 'Real' if category is not provided
    //     //     'location' => $validateData['location'] ?? null,
    //     //     'rating' => $validateData['rating'] ?? null,
    //     // ]);

    // }

    public function serchingStatic(Request $request)
    {
        $validateData = $request->validate([
            'location' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            // 'rating' => 'nullable|integer',
        ]);

        // Lowercase the category to make matching case-insensitive
        $categoryName = strtolower($validateData['category'] ?? '');

        if ($categoryName === '3') {
            return to_route('service.car', ['location' => $validateData['location'] ?? null]);
        } elseif ($categoryName === '2') {
            return to_route('service.restaurant', ['location' => $validateData['location'] ?? null]);
        } elseif ($categoryName === '1') {
            return to_route('service.real_state', ['location' => $validateData['location'] ?? null]);
        }

        // Default if not a static category
        return to_route('service.sub_category', ['id' => $validateData['category'], 'location' => $validateData['location'] ?? null]);
    }

}
