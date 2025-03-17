<?php

namespace App\Console\Commands;


use Exception;
use App\Models\Rank;
use App\Models\User;
use App\Models\Review;
use App\Models\Booking;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateServiceProviderRank extends Command
{
    protected $signature = 'rank:update-providers';
    protected $description = 'Update service provider ranks based on completed jobs, rating, and response rate';


    public function handle()
    {
        try {
            // Fetch all contractors (users with the role 'contractor')
            $contractors = User::where('role', 'contractor')->get();
    
            foreach ($contractors as $contractor) {
                // Count completed jobs for this contractor
                $completedJobs = Booking::where('user_id', $contractor->id)
                                        ->where('status', 'completed')
                                        ->count();
    
                // Calculate the average rating for this contractor
                $averageRating = Rank::where('user_id', $contractor->id)->avg('rating') ?? 0;
    
                // Calculate response rate dynamically
                $responseRate = $this->calculateResponseRate($completedJobs);
    
                // Determine the rank of the contractor
                $newRank = $this->determineRank($completedJobs, $averageRating);
    
                //create the rank record for this contractor
                Rank::updateOrCreate(
                    ['user_id' => $contractor->id],
                    [
                        'completed_jobs' => $completedJobs,
                        'average_rating' => $averageRating,
                        'response_rate' => $responseRate,
                        'rank' => $newRank
                    ]
                );
            }
    
            $this->info('Service provider ranks updated successfully!');
    
        } catch (Exception $e) {
            Log::error('Error updating ranks: ' . $e->getMessage());
        }
    }
    

    private function determineRank($completedJobs, $averageRating)
    {
        if ($completedJobs >= 50) {
            return 'Expert Pro';
        } elseif ($completedJobs >= 20) {
            return 'Pro';
        } elseif ($completedJobs >= 5) {
            return 'Gold';
        }
        return 'Silver';
    }
    
    private function calculateResponseRate($completedJobs)
    {
        if ($completedJobs >= 50) {
            return '80%';
        } elseif ($completedJobs >= 20) {
            return '60%';
        } elseif ($completedJobs >= 5) {
            return '50%';
        }
        return '0%';
    }
    
}
