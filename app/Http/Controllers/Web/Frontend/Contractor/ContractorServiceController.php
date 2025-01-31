<?php

namespace App\Http\Controllers\Web\Frontend\Contractor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use App\Models\SubCategory;
use App\Services\Web\Frontend\ContractorServiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use Exception;

use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class ContractorServiceController extends Controller
{
    protected $ContractorServiceService;
    protected $user;
    public function __construct(ContractorServiceService $ContractorServiceService)
    {
        $this->ContractorServiceService = $ContractorServiceService;
        $this->user = Auth::user();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $services = $this->ContractorServiceService->index();

            if ($request->ajax()) {
                $data = $services;
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('cover_image', function ($data) {
                        return '<img src="' . asset($data->cover_image) . '" class="wh-40 rounded-3" alt="no image found" height="100" width="100">';
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
                        
                        <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete" onclick="deleteRecord(event,' . $data->id . ')">
                        <svg data-v-14c8c335="" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2 lucide-icon customizable"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path><line x1="10" x2="10" y1="11" y2="17"></line><line x1="14" x2="14" y1="11" y2="17"></line></svg>
                        </button>
             
                </div>';
                    })
                    ->rawColumns(['cover_image', 'status', 'action'])
                    ->make(true);
            }
            // <a type="button" href="javascript:void(0)"
            //     class="ps-0 border-0 bg-transparent lh-1 position-relative top-2"
            //     data-bs-toggle="modal" data-bs-target="#EditCategory" onclick="viewModel(' . $data->id . ')" ><svg data-v-14c8c335="" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil lucide-icon customizable"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"></path><path d="m15 5 4 4"></path></svg>
            // </a>
            return view('frontend.dashboard.contractor.layouts.services.index', compact('services'));
        } catch (Exception $e) {
            Log::error('ContractorServiceController::index-' . $e->getMessage());
            flash()->error('Something went wrong. Please try again later');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $categories = Category::where('status', 'active')->with('subCategories')->get();
            return view('frontend.dashboard.contractor.layouts.services.create', compact('categories'));
        } catch (Exception $e) {
            Log::error('ContractorServiceController::create-' . $e->getMessage());
            flash()->error('Something went wrong. Please try again later');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:sub_categories,id',
            'is_emergency' => 'required|boolean',
            'type' => 'required|in:sell,rent,event,single',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'gallery_images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'gallery_images' => 'required',
        ]);
        try {
            $this->ContractorServiceService->store($validatedData);
            flash()->success('Service added successfully!');
            return redirect()->route('contractor.services.index');

        } catch (Exception $e) {
            Log::error('ContractorServiceController::store-' . $e->getMessage());
            flash()->error('Something went wrong');
            return redirect()->back();
        }
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        flash()->warning('not found this page');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        flash()->warning('not found this page');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->ContractorServiceService->destroy($id);
            return response()->json([
                "success" => true,
                "message" => "Item deleted successfully."
            ]);
        } catch (Exception $e) {
            Log::error('ContractorServiceController::destroy-' . $e->getMessage());
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
        try {
            $this->ContractorServiceService->status($id);
            return response()->json([
                'success' => true,
                'message' => 'Item status changed successfully.'
            ]);
        } catch (Exception $e) {
            Log::error('ContractorServiceController::status-' . $e->getMessage());
            return response()->json([
                "success" => false,
                "message" => "Something went wrong."
            ], 404);
        }
    }
}
