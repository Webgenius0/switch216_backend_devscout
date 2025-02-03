<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class EmergencyPageController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::with('subCategories')->where("status", 'active')->get();
        $services = Service::with(['user'])->where("status", 'active')->latest()->get();
        // dd($services);
        return view("frontend.layouts.emergency.index", compact('services', 'categories'));
    }

    public function show($id)
    {
        //
    }

}
