<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Rank;
use App\Models\User;
use App\Models\Booking;
use App\Models\Review;

class UpdateServiceProviderRank extends Command
{
    protected $signature = 'rank:update-providers';
    protected $description = 'Update service provider ranks based on completed jobs, rating, and response rate';

    public function handle()
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

        $this->info('Service provider ranks updated successfully!');
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
