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

class HomePageProcessContainerController extends Controller
{
    public function index(Request $request)
    {
        $ProcessContainer = CMS::where('page', Page::HomePage)->where('section', Section::ProcessContainer)->first();
        // dd($banner);
        if ($request->ajax()) {
            $data = CMS::where('page', Page::HomePage)->where('section', Section::ProcessContainerContent)->latest();
            return DataTables::of($data)
                ->addIndexColumn()
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
                                data-bs-toggle="modal" data-bs-target="#EditProcessContainer" onclick="viewModel(' . $data->id . ')" ><i class="material-symbols-outlined fs-16 text-body">edit</i>
                            </a>
                        <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete" onclick="deleteRecord(event,' . $data->id . ')">
                        <i class="material-symbols-outlined fs-16 text-danger">delete</i>
                        </button>
             
                </div>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view("backend.layouts.cms.home_page.process_container.index", compact("ProcessContainer"));
    }

    public function create()
    {
        // return view("backend.layouts.cms.home_page.process_container.create");
        flash()->warning('not found this page');
        return back();
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        try {

            $validatedData['page'] = Page::HomePage->value;
            $validatedData['section'] = Section::ProcessContainerContent->value;
            CMS::Create($validatedData);
            return response()->json([
                "success" => true,
                "message" => "Process Container Content created successfully"
            ]);
        } catch (Exception $e) {
            Log::error("HomePageController::store" . $e->getMessage());
            return response()->json([
                "success" => false,
                "message" => "Process Container Content not create"
            ]);
        }
    }
    // update main Process container
    public function ProcessContainerUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'button_text' => 'required|string|max:15',
        ]);

        try {

            $ProcessContainer = CMS::where('page', Page::HomePage)
                ->where('section', Section::ProcessContainer)
                ->first();

            if ($request->hasFile('image')) {
                if ($ProcessContainer && $ProcessContainer->image && file_exists(public_path($ProcessContainer->image))) {
                    Helper::fileDelete(public_path($ProcessContainer->image));
                }
                $validatedData['image'] = Helper::fileUpload($request->file('image'), 'ProcessContainer', time() . '_' . getFileName($request->file('image')));
            }
            CMS::updateOrCreate(
                [
                    'page' => Page::HomePage->value,
                    'section' => Section::ProcessContainer->value,
                ],
                $validatedData
            );
            flash()->success('Process container update successfully');
            return redirect()->route('cms.home_page.process_container.index');
        } catch (Exception $e) {
            Log::error("HomePageProcessContainerController::ProcessContainerUpdate" . $e->getMessage());
            flash()->error('Process container not update successfully');
            return redirect()->route('cms.home_page.process_container.index');
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = CMS::findOrFail($id);
        return view("backend.layouts.cms.home_page.process_container.edit", compact("data"));
    }

    public function show(string $id)
    {
        flash()->warning('not found this page');
        return back();
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        try {
            $data = CMS::findOrFail($id);
            $data->update($validatedData);
            return response()->json([
                "success" => true,
                "message" => "Process Container Content Updated Successfully"
            ]);
        } catch (Exception $e) {
            Log::error("HomePageProcessContainerController::update" . $e->getMessage());
            return response()->json([
                "success" => false,
                "message" => "Process Container Content not Update"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = CMS::findOrFail($id);
        // check here BookingRequest hotel_id === identifyHotel
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

    public function status(Request $request, $id)
    {

        $data = CMS::find($id);
        // check here BookingRequest hotel_id === identifyHotel
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
            'message' => 'Item status changed successfully.'
        ]);
    }
}
