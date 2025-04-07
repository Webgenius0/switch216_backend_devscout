<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\SubcriptionPackage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Exception;

class SubcriptionPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $subscriptionPakages = SubcriptionPakage::get();
        // dd($subscriptionPakages);
        if ($request->ajax()) {
            $data = SubcriptionPackage::latest()->get();

            // Debugging: Check if data is fetched correctly
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($data) {
                    return '<div class="form-check form-switch">
                        <input onclick="changeStatus(event,' . $data->id . ')" type="checkbox" class="form-check-input" style="border-radius: 25rem;width:40px" ' . ($data->status == "active" ? 'checked' : '') . '>
                    </div>';
                })
                ->addColumn('action', function ($data) {
                    return '<div class="action-wrapper d-flex justify-content-center">
                        <a type="button" href="' . route("subcription_pakage.edit", $data->id) . '" class="ps-0 border-0 bg-transparent lh-1 position-relative top-2 p-2"><i class="material-symbols-outlined fs-16 text-body">edit</i></a>
                        <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete"
                            onclick="deleteRecord(event,' . $data->id . ')">
                            <i class="material-symbols-outlined fs-16 text-danger">delete</i>
                        </button>
                    </div>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view("backend.layouts.subcription_pakage.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("backend.layouts.subcription_pakage.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|unique:subcription_packages,title',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'days' => 'required|numeric',
            'button_text' => 'required|string',
        ]);

        try {
            SubcriptionPackage::create($validatedData);
            flash()->success('Pakage created successfully');
            return redirect()->route('subcription_pakage.index');
        } catch (Exception $e) {
            Log::error('SubcriptionPackageController::store ' . $e->getMessage());
            flash()->error($e->getMessage());
            return redirect()->route('subcription_pakage.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // try {
        //     $data = SubcriptionPakage::findOrFail($id);
        //     return view("backend.layouts.subcription_pakage.show", compact("data"));
        // } catch (Exception $e) {
        //     Log::error('SubcriptionPackageController::show ' . $e->getMessage());
        //     flash()->error($e->getMessage());
        //     return redirect()->back();
        // }
        flash()->error('Something went wrong. Please try again later');
            return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $data = SubcriptionPackage::findOrFail($id);
            return view("backend.layouts.subcription_pakage.edit", compact("data"));
        } catch (Exception $e) {
            Log::error('SubcriptionPackageController::edit ' . $e->getMessage());
            flash()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $validatedData = $request->validate([
            'title' => 'required|string|max:255|unique:subcription_packages,title,' . $id,
            'price' => 'required|numeric',
            'description' => 'required|string',
            'days' => 'required|numeric',
            'button_text' => 'required|string',
        ]);
        try {
            $data = SubcriptionPackage::findOrFail($id);
            $data->update($validatedData);
            flash()->success('Pakage updated successfully');
            return redirect()->route('subcription_pakage.index');
        } catch (Exception $e) {
            Log::error('SubcriptionPackageController::update ' . $e->getMessage());
            flash()->error($e->getMessage());
            return redirect()->route('subcription_pakage.index');
        }
    }

      /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = SubcriptionPackage::findOrFail($id);
        // check if the category exists
        // Prevent deletion of specific categories
        if (in_array($data->name, ['Buy a Car', 'Rent a Car', 'Rent a Home', 'Buy a Home', 'Local Cuisine', 'Snaks', 'Pizza'])) {
            return response()->json([
                "success" => false,
                "message" => "This Sub category cannot be deleted."
            ], 403);
        }
        // delete the category
        if (!empty($data->thumbnail) && $data->thumbnail !== 'uploads/category/demo_pic.jpg') {
            Helper::fileDelete(public_path($data->thumbnail));
        }
        $data->delete();

        return response()->json([
            "success" => true,
            "message" => "Item deleted successfully."
        ]);
    }

    /**
     * Change the status of the specified resource from storage.
     */
    public function status(Request $request, $id)
    {
        $data = SubcriptionPackage::find($id);

        // check if the category exists
        if (empty($data)) {
            return response()->json([
                "success" => false,
                "message" => "Item not found."
            ], 404);
        }

        // toggle status of the category
        if ($data->status == 'active') {
            $data->status = 'inactive';
        } else {
            $data->status = 'active';
        }

        // save the changes
        $data->save();
        return response()->json([
            'success' => true,
            'message' => 'Item status changed successfully.'
        ]);
    }
}
