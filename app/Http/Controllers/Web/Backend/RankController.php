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
            $Ranks = User::where('role', 'contractor')->get();

            if ($request->ajax()) {
                // Fetch contractors with their completed jobs count and calculate rating
                $data = User::where('role', 'contractor')
                    ->withCount(['completedJobs as completed_jobs_count' => function ($query) {
                        $query->where('status', 'completed');
                    }])
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

            return view("backend.layouts.ranking_provider.index", compact("Ranks"));
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ], 500);
        }
    }


    public function updateServiceProviderRanks()
    {
        $serviceProviders = User::whereHas('services')->get(); // Get all service providers

        foreach ($serviceProviders as $provider) {
            $completedJobs = Booking::where('contactor_id', $provider->id)
                ->where('status', 'completed')
                ->count();

            $averageRating = Review::where('contactor_id', $provider->id)
                ->avg('rating');

            $responseRate = $this->calculateResponseRate($provider);

            $newRank = $this->determineRank($completedJobs, $averageRating, $responseRate);

            // Update rank
            Rank::updateOrCreate(
                ['contactor_id' => $provider->id],
                [
                    'completed_jobs' => $completedJobs,
                    'average_rating' => $averageRating ?? 0,
                    'response_rate' => $responseRate,
                    'rank' => $newRank
                ]
            );
        }

        return response()->json(['message' => 'Service provider ranks updated successfully!']);
    }

    private function calculateResponseRate($provider)
    {
        $totalBookings = Booking::where('contactor_id', $provider->id)->count();
        $responses = Booking::where('contactor_id', $provider->id)
            ->whereIn('status', ['confirmed', 'completed'])
            ->count();

        return $totalBookings > 0 ? ($responses / $totalBookings) * 100 : 0;
    }

    private function determineRank($completedJobs, $averageRating, $responseRate)
    {
        if ($completedJobs >= 50 && $averageRating >= 4.8 && $responseRate >= 80) {
            return 'Expert Pro';
        } elseif ($completedJobs >= 20 && $averageRating >= 4.8 && $responseRate >= 60) {
            return 'Pro';
        } elseif ($completedJobs >= 5 && $averageRating >= 4.5) {
            return 'Gold';
        } else {
            return 'Silver';
        }
    }
}
