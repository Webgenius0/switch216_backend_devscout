<?php


namespace App\Http\Controllers\Web\Backend\CMS;

use App\Enums\Page;
use App\Enums\Section;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class HomePageAdvertisementContainerController extends Controller
{

    public function index(Request $request)
    {
        $AdContainer = CMS::where('page', Page::HomePage)->where('section', Section::AdvertisementContainer)->first();


        return view('backend.layouts.cms.home_page.advertisement_container.index', compact('AdContainer'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'link_url' => 'required|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        try {
            $data = CMS::where('page', Page::HomePage)
            ->where('section', Section::AdvertisementContainer)
            ->first();

            if ($request->hasFile('image')) {
                if ($data && $data->image && file_exists(public_path($data->image))) {
                    Helper::fileDelete(public_path($data->image));
                }
                $validatedData['image'] = Helper::fileUpload($request->file('image'), 'advertisement_image', time() . '_' . getFileName($request->file('image')));
            }

                CMS::updateOrCreate(
                [
                    'page' => Page::HomePage->value,
                    'section' => Section::AdvertisementContainer->value,
                ],
                $validatedData
            );
            flash()->success('Banner Updated Successfully');
            return redirect()->route('cms.home_page.advertisement_container.index');
        } catch (Exception $e) {
            Log::error("CarController::update" . $e->getMessage());
            flash()->error('Banner not Updated Successfully');
            return redirect()->back();
        }
    }
}
