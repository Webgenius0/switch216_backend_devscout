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

 class HomePageAdvertisementContainerController extends Controller{


    public function index($id = null)
    {
        $data = $id ? CMS::findOrFail($id) : null;
        return view('backend.layouts.cms.home_page.advertisement_container.index', compact('data'));
    }

    // update main Process container
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    

        try {
            $AdContainer = CMS::where('page', Page::HomePage)
                ->where('section', Section::AdvertisementContainer)
                ->first();

            if ($request->hasFile('image')) {
                if ($AdContainer && $AdContainer->image && file_exists(public_path($AdContainer->image))) {
                    Helper::fileDelete(public_path($AdContainer->image));
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
            flash()->success('Review container update successfully');
            return redirect()->back();
        } catch (Exception $e) {
            Log::error("HomePageReviewContainerController::ReviewUserContainerUpdate" . $e->getMessage());
            flash()->error('Review container not update successfully');
            return redirect()->back();
        }
    }
    
 }