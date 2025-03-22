<?php

namespace App\Http\Controllers\Web\Backend\CMS;

use Exception;
use App\Enums\Page;
use App\Models\CMS;
use App\Enums\Section;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;


class CarPageController extends Controller{

    public function index(Request $request)
    {

        $CarService = CMS::where('page', Page::CarPage)->where('section', Section::CarBanner)->first();

        // dd('CarService');
    
        return view('backend.layouts.cms.car_page.banner.index', compact('CarService'));
    }
    

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request)
    {
        $validatedData = $request->validate(
            [
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'background_image' => 'The Background Image Must Be Input ',
           
            ]
        );
 
        try {
 
            $CarBanner = CMS::where('page', Page::CarPage)
                ->where('section', Section::CarBanner)
                ->first();
 
            if ($request->hasFile('background_image')) {
                if ($CarBanner && $CarBanner->background_image && file_exists(public_path($CarBanner->background_image))) {
                    Helper::fileDelete(public_path($CarBanner->background_image));
                }
                $validatedData['background_image'] = Helper::fileUpload($request->file('background_image'), 'bg_banner', time() . '_' . getFileName($request->file('background_image')));
            }
            CMS::updateOrCreate(
                [
                    'page' => Page::CarPage->value,
                    'section' => Section::CarBanner->value,
                ],
                $validatedData
            );
            flash()->success('Provider container update successfully');
            return redirect()->route('cms.car_page.banner.index');
        } catch (Exception $e) {
            Log::error("HomePagePlatFormWorkContainerController::PlatFormWorkContainerUpdate" . $e->getMessage());
            flash()->error('Provider container not update successfully');
            return redirect()->route('cms.car_page.banner.index');
        }
    }


}