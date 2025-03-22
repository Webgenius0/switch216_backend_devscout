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

class RestaurantController extends Controller
{

    public function index(Request $request)
    {

        $RestaurantService = CMS::where('page', Page::RestaurantPage)->where('section', Section::RestaurantBanner)->first();

    
        return view('backend.layouts.cms.restaurant_page.banner.index', compact('RestaurantService'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        try {

            $RestaurantBanner = CMS::where('page', Page::RestaurantPage)
            ->where('section', Section::RestaurantBanner)
            ->first();
            
            if ($request->hasFile('background_image')) {
                if ($RestaurantBanner && $RestaurantBanner->background_image && file_exists(public_path($RestaurantBanner->background_image))) {
                    Helper::fileDelete(public_path($RestaurantBanner->background_image));
                }

                $validatedData['background_image'] = Helper::fileUpload($request->file('background_image'), 'restaurant_bgImage', time() . '_' . getFileName($request->file('background_image')));
            }

            CMS::updateOrCreate(
                [
                    'page' => Page::RestaurantPage->value,
                    'section' => Section::RestaurantBanner->value,
                ],
                $validatedData
            );
            flash()->success('Banner Updated Successfully');
            return redirect()->route('cms.restaurant_page.banner');
        } catch (Exception $e) {
            Log::error("CarController::update" . $e->getMessage());
            flash()->error('Banner not Updated Successfully');
            return redirect()->back();
        }
    }
}
