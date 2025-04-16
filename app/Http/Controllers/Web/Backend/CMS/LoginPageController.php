<?php

namespace App\Http\Controllers\Web\Backend\CMS;

use view;
use Exception;
use App\Enums\Page;
use App\Models\CMS;
use App\Enums\Section;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class LoginPageController extends Controller
{
    public function index(Request $request)
    {
        $LoginVideoContainer = CMS::where('page', Page::LoginPage)->where('section', Section::LoginVideoContainer)->first();

        return view("backend.layouts.cms.login_page.index", compact("LoginVideoContainer"));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function VideoUpdate(Request $request)
    {
        $validatedData = $request->validate(
            [
                'image' => 'required|file|mimetypes:video/mp4',
            ],
            [
                'image' => 'The video must be a file of type: mp4.',
                'image.required' => 'The video is required.',
            ]
        );

        try {

            $LoginVideoContainer = CMS::where('page', Page::LoginPage)
                ->where('section', Section::LoginVideoContainer)
                ->first();

            if ($request->hasFile('image')) {
                if ($LoginVideoContainer && $LoginVideoContainer->image && file_exists(public_path($LoginVideoContainer->image))) {
                    Helper::fileDelete(public_path($LoginVideoContainer->image));
                }
                $validatedData['image'] = Helper::fileUpload($request->file('image'), 'LoginVideoContainer', time() . '_' . getFileName($request->file('image')));
            }
            CMS::updateOrCreate(
                [
                    'page' => Page::LoginPage->value,
                    'section' => Section::LoginVideoContainer->value,
                ],
                $validatedData
            );
            flash()->success('Login page video update successfully');
            return redirect()->route('cms.login_page.login_page_video.index');
        } catch (Exception $e) {
            Log::error("LoginPageController::VideoUpdate - " . $e->getMessage());
            flash()->error('Login page video not update successfully');
            return redirect()->route('cms.login_page.login_page_video.index');
        }
    }
}
