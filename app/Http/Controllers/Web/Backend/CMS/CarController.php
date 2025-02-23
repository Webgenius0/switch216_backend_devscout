<?php

namespace App\Http\Controllers\Web\Backend\CMS;

use Exception;
use App\Enums\Page;
use App\Models\CMS;
use App\Enums\Section;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;


class CarController extends Controller{


    public function index(Request $request){

        if ($request->ajax()) {
            $data = CMS::where('page', Page::HomePage)->where('section', Section::Banner)->latest();
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
                         <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit" onclick="window.location.href=\'' . route('cms.car_page.banner.edit', $data->id) . '\'">
                         <i class="material-symbols-outlined fs-16 text-body">edit</i>
                        </button>
                        <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete" onclick="deleteRecord(event,' . $data->id . ')">
                        <i class="material-symbols-outlined fs-16 text-danger">delete</i>
                        </button>
             
                </div>';
                })
                ->rawColumns(['background_image', 'status', 'action'])
                ->make(true);
        }
        
        return view('backend.layouts.cms.car_page.banner.index');
    }

    public function create(){
        return view('backend.layouts.cms.car_page.banner.create');
    }

    public function edit(string $id){
        $data = CMS::findOrFail($id); // Fetch the banner by ID
    return view('backend.layouts.cms.car_page.banner.edit', compact('data'));

    }

     // Corresponding store methods to handle form submissions
    public function store(Request $request){
        $validatedData = $request->validate([
            'sub_title' => 'required|string|max:255',
            'sub_description' => 'required|string|max:255',
            'background_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            if ($request->hasFile('background_image')) {
                $validatedData['background_image'] = Helper::fileUpload($request->file('background_image'), 'bg_banner', time() . '_' . getFileName($request->file('background_image')));
            }
            $validatedData['page'] = Page::HomePage->value;
            $validatedData['section'] = Section::Banner->value;
            CMS::Create($validatedData);
            flash()->success('Banner created successfully');
            return redirect()->route('cms.car_page.banner');
        } catch (Exception $e) {
            Log::error("CarController::store" . $e->getMessage());
            flash()->error('Banner not created successfully');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'sub_title' => 'required|string|max:255',
            'sub_description' => 'required|string|max:255',
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

        if (!empty($data->background_image)) {
            Helper::fileDelete(public_path($data->background_image));
        }

        $data->delete();

        return response()->json([
            "success" => true,
            "message" => "Item deleted successfully."
        ]);
    }

}