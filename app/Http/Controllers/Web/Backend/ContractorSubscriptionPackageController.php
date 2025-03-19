<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContractorSubscriptionPackage;
use App\Services\Web\Backend\ContractorRankingService;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Http\Request;

class ContractorSubscriptionPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ContractorSubscriptionPackage::latest()->get();
    
            // Debugging: Check if data is fetched correctly
            if ($data->isEmpty()) {
                return response()->json(['error' => 'No data found'], 400);
            }
    
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($data) {
                    return '<div class="form-check form-switch">
                        <input onclick="changeStatus(event,' . $data->id . ')" type="checkbox" class="form-check-input" style="border-radius: 25rem;width:40px" ' . ($data->status == "active" ? 'checked' : '') . '>
                    </div>';
                })
                ->addColumn('action', function ($data) {
                    return '<div class="action-wrapper d-flex justify-content-center">
                        <a type="button" href="javascript:void(0)" class="ps-0 border-0 bg-transparent lh-1 position-relative top-2 p-2"
                            data-bs-toggle="modal" data-bs-target="#EditSubscriptionContainer" onclick="viewModel(' . $data->id . ')" >
                            <i class="material-symbols-outlined fs-16 text-body">edit</i>
                        </a>
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
    
        return view('backend.layouts.subscription_package.index');
    }
    


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'button_text' => 'required|string',
            'button_link' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        ContractorSubscriptionPackage::create([
            'title' => $request->title,
            'price' => $request->price,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'status' => $request->status,
        ]);

        return response()->json(['success' => true, 'message' => 'Subscription added successfully!']);
    }

    /**
     * Display the specified resource.
     */
    // public function show(City $city)
    // {

    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $subscription = ContractorSubscriptionPackage::find($id);

        if (!$subscription) {
            return response()->json(['success' => false, 'message' => 'Subscription not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $subscription]);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, ContractorSubscriptionPackage $ContractorSubscriptionPackage)
    // {
    //     // Validate the incoming request data
    //     $validatedData = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'price' => 'required|numeric',
    //         'description' => 'required|string',
    //         'button_text' => 'required|string',
    //         'button_link' => 'required|string',
    //     ]);

    //     try {
    //         // Update fields using the $city model directly
    //         $ContractorSubscriptionPackage->update($validatedData);

    //         return response()->json([
    //             "success" => true,
    //             "message" => "ContractorSubscriptionPackage Updated Successfully",
    //         ]);
    //     } catch (Exception $e) {
    //         Log::error("ContractorSubscriptionPackage::update - " . $e->getMessage());

    //         return response()->json([
    //             "success" => false,
    //             "message" => "ContractorSubscriptionPackage Container Content not Updated"
    //         ]);
    //     }
    // }
    
    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'required|string',
        'button_text' => 'required|string',
        'button_link' => 'required|string',
        'status' => 'required|in:active,inactive',
    ]);

    $package = ContractorSubscriptionPackage::findOrFail($id);
    $package->update($validated);

    return response()->json([
        'success' => true,
        'message' => 'Subscription updated successfully!'
    ]);
}


    public function status($id)
    {

        $data = ContractorSubscriptionPackage::find($id);
        // check here BookingRequest hotel_id === identifyHotel
        if (empty($data)) {
            return response()->json([
                "success" => false,
                "message" => "ContractorSubscriptionPackage not found."
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
            'message' => 'ContractorSubscriptionPackage status changed successfully.'
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $data = ContractorSubscriptionPackage::findOrFail($id);
        if (empty($data)) {
            return response()->json([
                "success" => false,
                "message" => "ContractorSubscriptionPackage not found."
            ], 404);
        }

        $data->delete();

        return response()->json([
            "success" => true,
            "message" => "ContractorSubscriptionPackage deleted successfully."
        ]);
    }
}
