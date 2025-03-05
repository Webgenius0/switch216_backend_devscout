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

class AboutUsPageController extends Controller
{
    public function index(Request $request)
    {
        $AboutContainer = CMS::firstOrCreate(
            [
                'page' => Page::AboutPage,
                'section' => Section::AboutContainer
            ],
            [
                'title' => '',
                'description' => '',
                'image' => null
            ]
        );
        return view("backend.layouts.cms.about_page.about_us_container.index", compact("AboutContainer"));
    }

    // update main service container
    public function AboutContainerUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {

            $AboutContainer = CMS::where('page', Page::AboutPage)
                ->where('section', Section::AboutContainer)
                ->first();

            if ($request->hasFile('image')) {
                if ($AboutContainer && $AboutContainer->image && file_exists(public_path($AboutContainer->image))) {
                    Helper::fileDelete(public_path($AboutContainer->image));
                }
                $validatedData['image'] = Helper::fileUpload($request->file('image'), 'aboutImage', time() . '_' . getFileName($request->file('image')));
            }
            $data =  CMS::updateOrCreate(
                [
                    'page' => Page::AboutPage->value,
                    'section' => Section::AboutContainer->value,
                ],
                $validatedData
            );

            
            $data->update($validatedData);

            flash()->success('Service container update successfully');
            return redirect()->route('cms.home_page.about_us_container.index');
        } catch (Exception $e) {
            Log::error("HomePageServiceContainerController::ServiceContainerUpdate" . $e->getMessage());
            flash()->error('Service container not update successfully');
            return redirect()->route('cms.home_page.about_us_container.index');
        }
    }


    public function show(Request $request)
    {

        $AboutServiceContainer = CMS::where('page', Page::AboutPage)->where('section', Section::AboutServiceContainer)->first();
        if ($request->ajax()) {
            $data = CMS::where('page', Page::AboutPage)->where('section', Section::AboutServiceContainer)->latest();
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
                                data-bs-toggle="modal" data-bs-target="#EditAboutContainer" onclick="viewModel(' . $data->id . ')" ><i class="material-symbols-outlined fs-16 text-body">edit</i>
                            </a>
                        <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete" onclick="deleteRecord(event,' . $data->id . ')">
                        <i class="material-symbols-outlined fs-16 text-danger">delete</i>
                        </button>
             
                </div>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view("backend.layouts.cms.home_page.about_us_container.index", compact("AboutServiceContainer"));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        try {

            $validatedData['page'] = Page::AboutPage->value;
            $validatedData['section'] = Section::AboutServiceContainer->value;

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
        return view("backend.layouts.cms.home_page.about_us_container.edit", compact("data"));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        try {
            $data = CMS::findOrFail($id);

            // Update fields
            $data->update($validatedData);

            return response()->json([
                "success" => true,
                "message" => "Service Container Content Updated Successfully",
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
