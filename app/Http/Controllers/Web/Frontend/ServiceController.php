<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    public function categoryList()
    {
        try {
            $categories = Category::where('status', 'active')->get();
            return view("frontend.layouts.service.category", compact('categories'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function subCategoryList($id)
    {
        try {
            $category = Category::with(['subCategories'])->findOrFail($id);
            return view("frontend.layouts.service.sub_category", compact('category'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back();
        }
    }

}
