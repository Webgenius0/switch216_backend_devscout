<?php
namespace App\Http\Controllers\Web\Backend\CMS;

use Exception;
use App\Enums\Page;
use App\Models\CMS;
use App\Enums\Section;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProviderPageWorkContainerController extends Controller{

   public function index(Request $request){

    $RegisterProviderWorkContainer = CMS::where('page', Page::ServiceRegisterPage)->where('section', Section::ProviderWorkContainer)->first();

    return view('backend.layouts.cms.provider_register_page.provider_work_container.index',compact('RegisterProviderWorkContainer'));
   }

   public function update(Request $request)
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

           $ProviderWorkContainer = CMS::where('page', Page::ServiceRegisterPage)
               ->where('section', Section::ProviderWorkContainer)
               ->first();

           if ($request->hasFile('image')) {
               if ($ProviderWorkContainer && $ProviderWorkContainer->image && file_exists(public_path($ProviderWorkContainer->image))) {
                   Helper::fileDelete(public_path($ProviderWorkContainer->image));
               }
               $validatedData['image'] = Helper::fileUpload($request->file('image'), 'provider_work_video', time() . '_' . getFileName($request->file('image')));
           }
           CMS::updateOrCreate(
               [
                   'page' => Page::ServiceRegisterPage->value,
                   'section' => Section::ProviderWorkContainer->value,
               ],
               $validatedData
           );
           flash()->success('Provider container update successfully');
           return redirect()->route('cms.provider_page.work.index');
       } catch (Exception $e) {
           Log::error("HomePagePlatFormWorkContainerController::PlatFormWorkContainerUpdate" . $e->getMessage());
           flash()->error('Provider container not update successfully');
           return redirect()->route('cms.provider_page.work.index');
       }
   }
}
