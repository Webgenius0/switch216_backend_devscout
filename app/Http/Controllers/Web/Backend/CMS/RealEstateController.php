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


class RealEstateController extends Controller
{
    public function index(Request $request)
    {

        $RealEstateService = CMS::where('page', Page::RealEstatePage)->where('section', Section::RealEstateBanner)->first();

        return view('backend.layouts.cms.realEstate_page.banner.index', compact('RealEstateService'));
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
            $data = CMS::where('page', Page::RealEstatePage)
                ->where('section', Section::RealEstateBanner)
                ->first();

            if ($request->hasFile('background_image')) {
                if ($data && $data->background_image && file_exists(public_path($data->background_image))) {
                    Helper::fileDelete(public_path($data->background_image));
                }
                $validatedData['background_image'] = Helper::fileUpload($request->file('background_image'), 'realEstate_bgImage', time() . '_' . getFileName($request->file('background_image')));
            }

            CMS::updateOrCreate(
                [
                    'page' => Page::RealEstatePage->value,
                    'section' => Section::RealEstateBanner->value,
                ],
                $validatedData
            );
            flash()->success('Banner Updated Successfully');
            return redirect()->route('cms.RealEstate_page.banner');
        } catch (Exception $e) {
            Log::error("CarController::update" . $e->getMessage());
            flash()->error('Banner not Updated Successfully');
            return redirect()->back();
        }
    }
}
