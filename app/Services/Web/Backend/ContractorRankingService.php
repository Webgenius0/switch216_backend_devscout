<?php

namespace App\Services\Web\Backend;

use App\Models\ContractorRanking;
use App\Models\Service;
use Exception;
use Illuminate\Support\Facades\Log;

class ContractorRankingService
{
    public function getRankingByUserId($userId)
    {
        try {
            $ranking = ContractorRanking::where('user_id', $userId)->first();
            if ($ranking && $ranking->user->role !== 'contractor') {
                return false;
            }
            return $ranking;
        } catch (Exception $e) {
            Log::error('ContractorRankingService::getRankingByUserId' . $e->getMessage());
            throw $e;
        }
    }
    public function updateRanking($userId)
    {
        $ranking = ContractorRanking::where('user_id', $userId)->first();
        if ($ranking && $ranking->user->role !== 'contractor') {
            return false;
        }

        if (!$ranking) {
            return false;
        }

        $completedServices = Service::where('user_id', $userId)
            ->where('status', 'completed')
            ->count();

        $averageRating = Service::where('user_id', $userId)
            ->whereNotNull('rating')
            ->avg('rating');

        $totalResponses = 100; // Example value
        $successfulResponses = 70; // Example value
        $responseRate = $totalResponses ? ($successfulResponses / $totalResponses) * 100 : 0;

        if ($completedServices >= 50 && $averageRating >= 4.8 && $responseRate >= 80) {
            $rank = 'Expert Pro';
        } elseif ($completedServices >= 20 && $averageRating >= 4.8 && $responseRate >= 60) {
            $rank = 'Pro';
        } elseif ($completedServices >= 5 && $averageRating >= 4.5) {
            $rank = 'Gold';
        } else {
            $rank = 'Silver';
        }

        $ranking->update([
            'completed_services' => $completedServices,
            'average_rating' => round($averageRating, 2),
            'response_rate' => round($responseRate, 2),
            'rank' => $rank,
        ]);

        return $ranking;
    }

}