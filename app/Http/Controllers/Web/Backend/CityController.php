<?php

namespace App\Http\Controllers\Web\Backend;

use Exception;
use App\Enums\Page;
use App\Models\City;
use App\Enums\Section;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cities = City::all();
        if ($request->ajax()) {
            $data = City::latest()->get();
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
                    return '<div class="action-wrapper d-flex justify-content-center">
                        <a type="button" href="javascript:void(0)"
                                class="ps-0 border-0 bg-transparent lh-1 position-relative top-2 p-2"
                                data-bs-toggle="modal" data-bs-target="#EditCityContainer" onclick="viewModel(' . $data->id . ')" ><i class="material-symbols-outlined fs-16 text-body">edit</i>
                            </a>
                        <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete" onclick="deleteRecord(event,' . $data->id . ')">
                        <i class="material-symbols-outlined fs-16 text-danger">delete</i>
                        </button>
             
                </div>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('backend.layouts.city.index',compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);
    
        City::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);
    
        return response()->json(['success' => true, 'message' => 'City added successfully!']);
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
        $city = City::find($id);
    
        if (!$city) {
            return response()->json(['success' => false, 'message' => 'City not found'], 404);
        }
    
        return response()->json(['success' => true, 'data' => $city]);
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, City $city)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'status' => 'required|in:active,inactive',
    ]);

    try {
        // Update fields using the $city model directly
        $city->update($validatedData);

        return response()->json([
            "success" => true,
            "message" => "City Updated Successfully",
        ]);
    } catch (Exception $e) {
        Log::error("CityController::update - " . $e->getMessage());

        return response()->json([
            "success" => false,
            "message" => "City Container Content not Updated"
        ]);
    }
}


    public function status($id){

        $data = City::find($id);
        // check here BookingRequest hotel_id === identifyHotel
        if (empty($data)) {
            return response()->json([
                "success" => false,
                "message" => "City not found."
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
            'message' => 'City status changed successfully.'
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $data = City::findOrFail($id);
        if (empty($data)) {
            return response()->json([
                "success" => false,
                "message" => "City not found."
            ], 404);
        }

        $data->delete();

        return response()->json([
            "success" => true,
            "message" => "City deleted successfully."
        ]);
    }
}
