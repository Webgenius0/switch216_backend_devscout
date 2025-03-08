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

class ProviderRegisterPageController extends Controller
{

    public function index(Request $request)
    {
        
        $ServiceRegisterContainer = CMS::where('page', Page::ServiceRegisterPage)->where('section', Section::ServiceRegisterContainer)->first();

        if ($request->ajax()) {
            $data = CMS::where('page', Page::ServiceRegisterPage)->where('section', Section::ServiceRegisterImageContainer)->latest();
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('image', function ($data) {
                    return '<img src="' . asset($data->image) . '" class="wh-40 rounded-3" alt="user">';
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
                                data-bs-toggle="modal" data-bs-target="#EditProviderContainer" onclick="viewModel(' . $data->id . ')" ><i class="material-symbols-outlined fs-16 text-body">edit</i>
                            </a>
                        <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete" onclick="deleteRecord(event,' . $data->id . ')">
                        <i class="material-symbols-outlined fs-16 text-danger">delete</i>
                        </button>
             
                </div>';
                })
                ->rawColumns(['image', 'status', 'action'])
                ->make(true);
        }

        return view('backend.layouts.cms.provider_register_page.service_container.index', compact('ServiceRegisterContainer'));
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


             if ($ServiceRegisterContainer) {
                    $ServiceRegisterContainer->update($validatedData);
                }else{
                    CMS::updateOrCreate(
                        [
                            'page' => Page::ServiceRegisterPage->value,
                            'section' => Section::ServiceRegisterContainer->value,
                        ],
                        $validatedData
                    );

                }

            flash()->success('Service container update successfully');
            return redirect()->route('cms.service_page.container.index');
        } catch (Exception $e) {
            Log::error("ServiceRegisterPageContainerController::ProcessContainerUpdate" . $e->getMessage());
            flash()->error('Process container not update successfully');
            return redirect()->route('cms.service_page.container.index');
        }
    }


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            if ($request->hasFile('image')) {
                $validatedData['image'] = Helper::fileUpload($request->file('image'), 'provider_register_image', time() . '_' . getFileName($request->file('image')));
            }
            $validatedData['page'] = Page::ServiceRegisterPage->value;
            $validatedData['section'] = Section::ServiceRegisterImageContainer->value;

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
        return view("backend.layouts.cms.provider_register_page.service_container.edit", compact("data"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $data = CMS::findOrFail($id);

            if ($request->hasFile('image')) {
                if ($data->image) {
                    Helper::fileDelete(public_path($data->image));
                }
                $imagePath = Helper::fileUpload($request->file('image'), 'provider_register_image', time());

                $data->image = $imagePath;
            }

            $data->save();

            return response()->json([
                "success" => true,
                "message" => "Service Container Content Updated Successfully",
                "image_url" => asset($data->image)
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
