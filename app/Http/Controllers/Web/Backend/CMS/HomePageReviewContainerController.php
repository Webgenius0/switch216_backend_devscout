<?php

namespace App\Http\Controllers\Web\Backend\CMS;

use App\Enums\Page;
use App\Enums\Section;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomePageReviewContainerController extends Controller
{

    public function index(Request $request)
    {
        $ReviewUserContainer = CMS::where('page', Page::HomePage)->where('section', Section::ReviewUserContainer)->first();
        $ReviewProviderContainer = CMS::where('page', Page::HomePage)->where('section', Section::ReviewProviderContainer)->first();
        return view("backend.layouts.cms.home_page.review_container.index", compact("ReviewUserContainer", "ReviewProviderContainer"));
    }

    // update main Process container
    public function ReviewUserContainerUpdate(Request $request)
    {
        $validatedData = $request->validate(
            [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
            ]
        );

        try {

            $ReviewUserContainer = CMS::where('page', Page::HomePage)
                ->where('section', Section::ReviewUserContainer)
                ->first();
            CMS::updateOrCreate(
                [
                    'page' => Page::HomePage->value,
                    'section' => Section::ReviewUserContainer->value,
                ],
                $validatedData
            );
            flash()->success('Review container update successfully');
            return redirect()->route('cms.home_page.review_container.index');
        } catch (Exception $e) {
            Log::error("HomePageReviewContainerController::ReviewUserContainerUpdate" . $e->getMessage());
            flash()->error('Review container not update successfully');
            return redirect()->route('cms.home_page.review_container.index');
        }
    }
    // update main Process container
    public function ReviewProviderContainerUpdate(Request $request)
    {
        $validatedData = $request->validate(
            [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
            ]
        );

        try {
            $ReviewProviderContainer = CMS::where('page', Page::HomePage)
                ->where('section', Section::ReviewProviderContainer)
                ->first();

            CMS::updateOrCreate(
                [
                    'page' => Page::HomePage->value,
                    'section' => Section::ReviewProviderContainer->value,
                ],
                $validatedData
            );
            flash()->success('Review container update successfully');
            return redirect()->route('cms.home_page.review_container.index');
        } catch (Exception $e) {
            Log::error("HomePageReviewContainerController::ReviewProviderContainerUpdate" . $e->getMessage());
            flash()->error('Review container not update successfully');
            return redirect()->route('cms.home_page.review_container.index');
        }
    }
}
