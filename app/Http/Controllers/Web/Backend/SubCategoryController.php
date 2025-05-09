<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the units with DataTables support.
     */
    public function index(Request $request)
    {
        $Categories = Category::get();
        if ($request->ajax()) {
            $data = SubCategory::with('category')->latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('category', function ($data) {
                    return $data->category->name;
                })
                ->addColumn('thumbnail', function ($data) {
                    return '<img src="' . asset($data->thumbnail) . '" class="wh-40 rounded-3" alt="no image found">';
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
                                data-bs-toggle="modal" data-bs-target="#EditSubCategory" onclick="viewModel(' . $data->id . ')" ><i class="material-symbols-outlined fs-16 text-body">edit</i>
                            </a>
                        <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete" onclick="deleteRecord(event,' . $data->id . ')">
                        <i class="material-symbols-outlined fs-16 text-danger">delete</i>
                        </button>
             
                </div>';
                })
                ->rawColumns(['category', 'thumbnail', 'status', 'action'])
                ->make(true);
        }
        return view("backend.layouts.sub_category.index", compact("Categories"));
    }
    /**
     * Show the form for creating a new data.
     */
    public function create()
    {
        // return view("backend.layouts.category.create");
        flash()->warning('not found this page');
        return back();
    }
    /**
     * Store a newly created data in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|unique:sub_categories,name',
            'description' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // dd($validatedData);
        try {
            if ($request->hasFile('thumbnail')) {
                $validatedData['thumbnail'] = Helper::fileUpload($request->file('thumbnail'), 'category', time() . '_' . getFileName($request->file('thumbnail')));
            }
            SubCategory::Create($validatedData);
            return response()->json([
                "success" => true,
                "message" => "Sub Category created successfully"
            ]);
        } catch (Exception $e) {
            Log::error("SubCategoryController::store" . $e->getMessage());
            return response()->json([
                "success" => false,
                "message" => "sub Category not create"
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Categories = Category::get();
        $data = SubCategory::findOrFail($id);
        return view("backend.layouts.sub_category.edit", compact("data", "Categories"));
    }
    /**
     * Display the specified resource.
     */
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
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|unique:sub_categories,name,' . $id,
            'description' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        try {
            $data = SubCategory::findOrFail($id);
            if (in_array($data->name, ['Buy a Car', 'Rent a Car', 'Rent a Home', 'Buy a Home', 'Local Cuisine', 'Snaks', 'Pizza'])) {
                unset($validatedData['name']); // Prevent updating `name`
                unset($validatedData['category_id']); // Prevent updating `category_id`
            }
            if ($request->hasFile('thumbnail')) {
                if ($data && $data->thumbnail && file_exists(public_path($data->thumbnail))) {
                    Helper::fileDelete(public_path($data->thumbnail));
                }
                $validatedData['thumbnail'] = Helper::fileUpload($request->file('thumbnail'), 'SubCategory', time() . '_' . getFileName($request->file('thumbnail')));
            }
            $data = SubCategory::findOrFail($id);
            $data->update($validatedData);

            return response()->json([
                "success" => true,
                "message" => " Sub Category Updated Successfully"
            ]);
        } catch (Exception $e) {
            Log::error("SubCategoryController::update" . $e->getMessage());
            return response()->json([
                "success" => false,
                "message" => "Sub Category not Update"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = SubCategory::findOrFail($id);
            // check if the category exists
            // Prevent deletion of specific categories
            // if (in_array($data->name, ['Buy a Car', 'Rent a Car', 'Rent a Home', 'Buy a Home', 'Local Cuisine', 'Snaks', 'Pizza'])) {
            //     return response()->json([
            //         "success" => false,
            //         "message" => "This Sub category cannot be deleted."
            //     ], 403);
            // }
            // delete the category
            if (!empty($data->thumbnail) && $data->thumbnail !== 'uploads/category/demo_pic.jpg') {
                Helper::fileDelete(public_path($data->thumbnail));
            }
            $data->delete();

            return response()->json([
                "success" => true,
                "message" => "Item deleted successfully."
            ]);
        } catch (Exception $e) {
            Log::error('SubCategoryController::destroy-' . $e->getMessage());
            return response()->json([
                "success" => false,
                "message" => "Something went wrong."
            ], 404);
        }
    }

    /**
     * Change the status of the specified resource from storage.
     */
    public function status(Request $request, $id)
    {
        $data = SubCategory::find($id);

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
