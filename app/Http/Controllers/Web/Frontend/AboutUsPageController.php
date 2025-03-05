<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Web\Frontend\AboutUsService;
use Exception;
use Illuminate\Support\Facades\Log;

class AboutUsPageController extends Controller
{
    protected $aboutUsService;

    public function __construct(AboutUsService $aboutUsService)
    {
        $this->aboutUsService = $aboutUsService;
    }
    /**
     * About Service Page.
     */
    public function index(Request $request)
    {
        try {
            $data = $this->aboutUsService->index();
            // dd($carServicesSubCategorys);
            // dd($data);
            return view('frontend.layouts.about.index', compact('data'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back();
        }
    }

}