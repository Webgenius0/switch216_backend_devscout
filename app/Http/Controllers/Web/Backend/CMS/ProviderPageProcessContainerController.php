<?php
namespace App\Http\Controllers\Web\Backend\CMS;

use Exception;
use App\Enums\Page;
use App\Models\CMS;
use App\Enums\Section;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class ProviderPageProcessContainerController extends Controller{
    
    public function index(Request $request){


        $ProviderProcessContainer = CMS::where('page', Page::ServiceRegisterPage)->where('section', Section::ProviderProcessContainer)->first();


        if ($request->ajax()) {
            $data = CMS::where('page', Page::ServiceRegisterPage)->where('section', Section::ProviderProcessImageContainer)->latest();
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('background_image', function ($data) {
                    return '<img src="' . asset($data->background_image) . '" class="wh-40 rounded-3" alt="user">';
                })
                ->addColumn('status', function ($data) {
                    $status = '<div class="form-check form-switch">';
                    $status .= '<input onclick="changeStatus(event,' . $data->id . ')" type="checkbox" class="form-check-input" style="border-radius: 25rem;width:40px"' . $data->id . '" name="status"';

                    if ($data->status == "active") {
                        $status .= ' checked';
                    }

                    $status .= '>';
                    $status .= '</div>';

                    return $status;
                })
                ->addColumn('action', function ($data) {
                    return '<div class="action-wrapper">
                        <a type="button" href="javascript:void(0)"
                                class="ps-0 border-0 bg-transparent lh-1 position-relative top-2"
                                data-bs-toggle="modal" data-bs-target="#EditProviderProcessContainer" onclick="viewModel(' . $data->id . ')" ><i class="material-symbols-outlined fs-16 text-body">edit</i>
                            </a>
                        <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete" onclick="deleteRecord(event,' . $data->id . ')">
                        <i class="material-symbols-outlined fs-16 text-danger">delete</i>
                        </button>
             
                </div>';
                })
                ->rawColumns(['background_image', 'status', 'action'])
                ->make(true);
        }


        return view('backend.layouts.cms.provider_register_page.process_container.index', compact('ProviderProcessContainer'));
    }

    public function ProcessContainerUpdate(Request $request){

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'button_text' => 'required|string',
        ]);

        try {

            $ProviderProcessContainer = CMS::where('page', Page::ServiceRegisterPage)
                ->where('section', Section::ProviderProcessContainer)
                ->first();


             if ($ProviderProcessContainer) {
                    $ProviderProcessContainer->update($validatedData);
                }else{
                    CMS::updateOrCreate(
                        [
                            'page' => Page::ServiceRegisterPage->value,
                            'section' => Section::ProviderProcessContainer->value,
                        ],
                        $validatedData
                    );

                }

            flash()->success('Service container update successfully');
            return redirect()->route('cms.provider_page.process.index');
        } catch (Exception $e) {
            Log::error("ServiceRegisterPageContainerController::ProcessContainerUpdate" . $e->getMessage());
            flash()->error('Process container not update successfully');
            return redirect()->route('cms.provider_page.process.index');
        }
        
    }


    // public function show(Request $request){

    //     $ProviderProcessImageContainer = CMS::where('page', Page::ServiceRegisterPage)->where('section', Section::ProviderProcessImageContainer)->first();
    //     // dd($banner);
    //     if ($request->ajax()) {
    //         $data = CMS::where('page', Page::ServiceRegisterPage)->where('section', Section::ProviderProcessImageContainer)->latest();
    //         return DataTables::of($data)
    //             ->addIndexColumn()

    //             ->addColumn('background_image', function ($data) {
    //                 return '<img src="' . asset($data->background_image) . '" class="wh-40 rounded-3" alt="user">';
    //             })
    //             ->addColumn('status', function ($data) {
    //                 $status = '<div class="form-check form-switch">';
    //                 $status .= '<input onclick="changeStatus(event,' . $data->id . ')" type="checkbox" class="form-check-input" style="border-radius: 25rem;width:40px"' . $data->id . '" name="status"';

    //                 if ($data->status == "active") {
    //                     $status .= ' checked';
    //                 }

    //                 $status .= '>';
    //                 $status .= '</div>';

    //                 return $status;
    //             })
    //             ->addColumn('action', function ($data) {
    //                 return '<div class="action-wrapper">
    //                     <a type="button" href="javascript:void(0)"
    //                             class="ps-0 border-0 bg-transparent lh-1 position-relative top-2"
    //                             data-bs-toggle="modal" data-bs-target="#EditProviderProcessContainer" onclick="viewModel(' . $data->id . ')" ><i class="material-symbols-outlined fs-16 text-body">edit</i>
    //                         </a>
    //                     <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete" onclick="deleteRecord(event,' . $data->id . ')">
    //                     <i class="material-symbols-outlined fs-16 text-danger">delete</i>
    //                     </button>
             
    //             </div>';
    //             })
    //             ->rawColumns(['background_image', 'status', 'action'])
    //             ->make(true);
    //     }
    //     return view("backend.layouts.cms.provider_register_page.process_container.index", compact("ProviderProcessImageContainer"));

    // }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'sub_title' => 'required|string|max:50',
            'sub_description' => 'required|string|max:100',
            'background_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            if ($request->hasFile('background_image')) {
                $validatedData['background_image'] = Helper::fileUpload($request->file('background_image'), 'provider_process_bg_image', time() . '_' . getFileName($request->file('background_image')));
            }
            $validatedData['page'] = Page::ServiceRegisterPage->value;
            $validatedData['section'] = Section::ProviderProcessImageContainer->value;

            CMS::Create($validatedData);

            return response()->json([
                "success" => true,
                "message" => "Content Updated Successfully"
            ]);
        } catch (Exception $e) {
            Log::error("ProviderRegisterController::store" . $e->getMessage());
            flash()->error('Banner not created successfully');
            return redirect()->back();
        }
    }

    public function edit(string $id)
    {
        $data = CMS::findOrFail($id);
        return view("backend.layouts.cms.provider_register_page.process_container.edit", compact("data"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'sub_title' => 'required|string|max:50',
            'sub_description' => 'required|string|max:100',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        try {
            $data = CMS::findOrFail($id);
    
            if ($request->hasFile('background_image')) {
                if (!empty($data->background_image)) {
                    Helper::fileDelete(public_path($data->background_image));
                }
                $imagePath = Helper::fileUpload($request->file('background_image'), 'provider_process_bg_image', time());
                $data->background_image = $imagePath;
            }
    
            $data->update([
                'sub_title' => $validatedData['sub_title'],
                'sub_description' => $validatedData['sub_description'],
            ]);
    
            return response()->json([
                "success" => true,
                "message" => "Service Container Content Updated Successfully",
                "image_url" => asset($data->background_image),
            ]);
        } catch (Exception $e) {
            Log::error("ProviderRegisterController::update - " . $e->getMessage());
    
            return response()->json([
                "success" => false,
                "message" => "Service Container Content not Updated"
            ]);
        }
    }
    

    public function status(Request $request, $id)
    {

        $data = CMS::find($id);
        if (empty($data)) {
            return response()->json([
                "success" => false,
                "message" => "Item not found."
            ], 404);
        }

        if ($data->status == 'active') {
            $data->status = 'inactive';
        } else {
            $data->status = 'active';
        }

        $data->save();
        return response()->json([
            'success' => true,
            'message' => 'Image status changed successfully.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = CMS::findOrFail($id);
        if (empty($data)) {
            return response()->json([
                "success" => false,
                "message" => "Item not found."
            ], 404);
        }

        if (!empty($data->image)) {
            Helper::fileDelete(public_path($data->image));
        }

        $data->delete();

        return response()->json([
            "success" => true,
            "message" => "Item deleted successfully."
        ]);
    }
    
}
