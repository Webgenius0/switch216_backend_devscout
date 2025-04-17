<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Web\Frontend\RealStatePageService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    protected $realStatePageService;

    public function __construct(RealStatePageService $realStatePageService)
    {
        $this->realStatePageService = $realStatePageService;
    }
    public function categoryList()
    {

        try {
            $data = $this->realStatePageService->index();
            $categories = Category::where('status', 'active')->get();
            return view("frontend.layouts.service.category", compact('categories', 'data'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function subCategoryList($id, Request $request)
    {
        try {
            $data = $this->realStatePageService->index();
            $locations = $request->query('location') ?? null;
            $category = Category::with(['subCategories'])->findOrFail($id);
            return view("frontend.layouts.service.sub_category", compact('category', 'locations', 'data'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back();
        }
    }

}
