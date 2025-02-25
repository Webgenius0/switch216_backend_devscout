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

class ProviderRegisterPageController extends Controller{

    public function index(){
        $ServiceRegisterContainer = CMS::firstOrCreate(
            [
                'page' => Page::ServiceRegisterPage, 
                'section' => Section::ServiceRegisterContainer
            ], 
            [
                'title' => '', 
                'description' => '', 
                'button_text' => null
            ]
        );

        return view('backend.layouts.cms.provider_register_page.service_container.index',compact('ServiceRegisterContainer'));
    }

    // update main Process container
    public function ServiceContainerUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'button_text' => 'required|string',
        ]);

        try {

            $ServiceRegisterContainer = CMS::where('page', Page::ServiceRegisterPage)
                ->where('section', Section::ServiceRegisterContainer)
                ->first();

            CMS::updateOrCreate(
                [
                    'page' => Page::ServiceRegisterPage->value,
                    'section' => Section::ServiceRegisterContainer->value,
                ],
                $validatedData
            );

            flash()->success('Service container update successfully');
            return redirect()->route('cms.service_page.container');
        } catch (Exception $e) {
            Log::error("ServiceRegisterPageContainerController::ProcessContainerUpdate" . $e->getMessage());
            flash()->error('Process container not update successfully');
            return redirect()->route('cms.service_page.container');
        }
    }





    
}