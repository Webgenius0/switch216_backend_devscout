<?php

namespace App\Http\Controllers\Web\Backend;

use Exception;
use App\Models\Rank;
use App\Models\User;
use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Services\Web\Backend\ProviderRankService;

class RankController extends Controller
{
    protected $providerRankService;

    // Inject the service into the controller
    public function __construct(ProviderRankService $providerRankService)
    {
        $this->providerRankService = $providerRankService;
    }
    // The index method to get the ranking by userId


    public function index(Request $request)
    {



        $Ranks = User::where('role', 'contractor')->get();
        
        if ($request->ajax()) {

            // $data = Rank::with('user')->latest();

            $data = User::where('role', 'contractor')
            ->where('booking', true) // Replace 'true' with the appropriate value
            ->where('status', 'active') // Replace 'active' with the desired status
            ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user', function ($data) {
                    return $data->user ? $data->user->name : 'N/A';
                })
                ->rawColumns(['name'])
                ->make(true);
        }
        return view("backend.layouts.ranking_provider.index", compact("Ranks"));
    }



    // public function index(Request $request)
    // {

    //     $contractors = User::where('role', 'contractor')->where('status', 'active')->get();
    //     dd($contractors);

    //     $Ranks = User::where('role', 'contractor')->get();

    //     if ($request->ajax()) {
    //         $data = User::where('role', 'contractor')
    //             ->withCount(['bookings as completed_services' => function ($query) {
    //                 $query->where('status', 'completed'); // Count bookings with status 'completed'
    //             }])
    //             ->where('status', 'active') // For users' active status
    //             ->get();
    //         dd($data);

    //         return DataTables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('user', function ($data) {
    //                 return $data->name; // Assuming the contractor's name is stored in 'name'
    //             })
    //             ->addColumn('completed_services', function ($data) {
    //                 return $data->completed_services; // Count of completed bookings
    //             })
    //             ->rawColumns(['user', 'completed_services'])
    //             ->make(true);
    //     }

    //     return view("backend.layouts.ranking_provider.index", compact("Ranks"));
    // }

    // The update method to update the ranking
    public function update($userId)
    {
        try {
            // Use the service method to update the ranking
            $ranking = $this->providerRankService->updateRanking($userId);

            if (!$ranking) {
                return response()->json(['message' => 'User ranking not found or not updated'], 404);
            }

            return response()->json(['message' => 'Ranking updated successfully', 'data' => $ranking]);
        } catch (Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }


    //  status


}
