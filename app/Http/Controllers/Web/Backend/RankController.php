<?php

namespace App\Http\Controllers\Web\Backend;

use Exception;
use App\Models\Rank;
use App\Models\User;
use App\Models\Review;

use App\Models\Booking;
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

    public function index(Request $request)
    {
        try {
            // Fetch all contractors (users with the role 'contractor')
            // $Ranks = User::where('role', 'contractor')->get();

            if ($request->ajax()) {
                // Fetch contractors with their completed jobs count and calculate rating
                $data = Booking::where('status', '=','completed')
                    ->get();

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function ($data) {
                        return $data->name; 
                    })
                    ->addColumn('rank', function ($data) {
                        // Define progress based on completed jobs
                        if ($data->completed_jobs_count >= 5) {
                            return 'Gold'; 
                        } elseif ($data->completed_jobs_count >= 20) {
                            return 'Pro'; 
                        } elseif ($data->completed_jobs_count >= 50) {
                            return 'Expert Pro';
                        }
                        return 'Silver'; 
                    })
                    ->addColumn('progress', function ($data) {
                        return $data->completed_jobs_count; 
                    })
                    ->addColumn('average_rating', function ($data) {
                        // Calculate the average rating based on the number of completed jobs
                        if ($data->completed_jobs_count >= 20) {
                            return 4.8; 
                        } elseif ($data->completed_jobs_count >= 5) {
                            return 4.5; 
                        }
                        return 0;
                    })
                    ->addColumn('response_rate', function ($data) {
                     
                        if ($data->completed_jobs_count >= 5) {
                            return '50%';
                        } elseif ($data->completed_jobs_count >= 20) {
                            return '60%';
                        } elseif ($data->completed_jobs_count >= 50) { 
                            return '80%';
                        }
                        return '0%'; 
                    })
                    ->rawColumns(['name', 'progress', 'average_rating', 'rank', 'response_rate'])
                    ->make(true);
            }

            return view("backend.layouts.ranking_provider.index");
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ], 500);
        }
    }


}
