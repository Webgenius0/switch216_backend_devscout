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


class CarController extends Controller{


    public function index(Request $request)
    {
        $CarService = CMS::firstOrCreate(
            [
                'page' => Page::CarPage, 
                'section' => Section::CarBanner
            ], 
            [
                'title' => '', 
                'description' => '', 
                'background_image' => null
            ]
        );
    
        return view('backend.layouts.cms.car_page.banner.index', compact('CarService'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        try {
            $data = CMS::findOrFail($id);
            if ($request->hasFile('background_image')) {
                if ($data && $data->background_image && file_exists(public_path($data->background_image))) {
                    Helper::fileDelete(public_path($data->background_image));
                }
                $validatedData['background_image'] = Helper::fileUpload($request->file('background_image'), 'bg_banner', time() . '_' . getFileName($request->file('background_image')));
            }

            // dd($data);

            $data->update($validatedData);
            flash()->success('Banner Updated Successfully');
            return redirect()->route('cms.car_page.banner');
        } catch (Exception $e) {
            Log::error("CarController::update" . $e->getMessage());
            flash()->error('Banner not Updated Successfully');
            return redirect()->back();
        }
    }


}