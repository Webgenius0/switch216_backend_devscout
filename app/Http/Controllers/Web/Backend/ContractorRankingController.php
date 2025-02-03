<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Services\Web\Backend\ContractorRankingService;
use Exception;
use Illuminate\Http\Request;

class ContractorRankingController extends Controller
{
    protected $rankingService;
    public function __construct(ContractorRankingService $rankingService)
    {
        $this->rankingService = $rankingService;
    }

    public function show($userId)
    {
        try {
            $ranking = $this->rankingService->getRankingByUserId($userId);

            if (!$ranking) {
                return response()->json(['message' => 'Ranking not found'], 404);
            }

            return response()->json($ranking);
        } catch (Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    public function update($userId)
    {
        try {
            $ranking = $this->rankingService->updateRanking($userId);

            if (!$ranking) {
                return response()->json(['message' => 'User ranking not found'], 404);
            }
            return response()->json(['message' => 'Ranking updated successfully', 'data' => $ranking]);
        } catch (Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }
}
