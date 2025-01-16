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
class HomePageProviderWorkContainerController extends Controller
{

    public function index(Request $request)
    {
        $ProviderWorkContainer = CMS::where('page', Page::HomePage)->where('section', Section::ProviderWorkContainer)->first();
        return view("backend.layouts.cms.home_page.provider_work_container.index", compact("ProviderWorkContainer"));
    }

    // update main Process container
    public function ProviderWorkContainerUpdate(Request $request)
    {
        $validatedData = $request->validate(
            [
                'title' => 'required|string|max:255',
                'button_text' => 'required|string|max:20',
                'description' => 'required|string',
                'image' => 'required|file|mimetypes:video/mp4',
            ],
            [
                'image' => 'The video must be a file of type: mp4.',
                'image.required' => 'The video is required.',
            ]
        );

        try {

            $ProviderWorkContainer = CMS::where('page', Page::HomePage)
                ->where('section', Section::ProviderWorkContainer)
                ->first();

            if ($request->hasFile('image')) {
                if ($ProviderWorkContainer && $ProviderWorkContainer->image && file_exists(public_path($ProviderWorkContainer->image))) {
                    Helper::fileDelete(public_path($ProviderWorkContainer->image));
                }
                $validatedData['image'] = Helper::fileUpload($request->file('image'), 'ProviderWorkContainer', time() . '_' . getFileName($request->file('image')));
            }
            CMS::updateOrCreate(
                [
                    'page' => Page::HomePage->value,
                    'section' => Section::ProviderWorkContainer->value,
                ],
                $validatedData
            );
            flash()->success('Provider container update successfully');
            return redirect()->route('cms.home_page.provider_work_container.index');
        } catch (Exception $e) {
            Log::error("HomePagePlatFormWorkContainerController::PlatFormWorkContainerUpdate" . $e->getMessage());
            flash()->error('Provider container not update successfully');
            return redirect()->route('cms.home_page.provider_work_container.index');
        }
    }

}
