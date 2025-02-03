<?php

namespace App\Console\Commands;

use App\Models\ContractorRanking;
use App\Services\Web\Backend\ContractorRankingService;
use Illuminate\Console\Command;

class UpdateContractorRanking extends Command
{
    protected $signature = 'contractor:rank-update';
    protected $description = 'Update contractor rankings based on completed services and ratings';

    protected $rankingService;

    public function __construct(ContractorRankingService $rankingService)
    {
        parent::__construct();
        $this->rankingService = $rankingService;
    }

    public function handle()
    {
        $this->info('Updating contractor rankings...');

        $contractors = ContractorRanking::all();

        foreach ($contractors as $contractor) {
            $this->rankingService->updateRanking($contractor->user_id);
        }

        $this->info('Contractor rankings updated successfully.');
        logger()->info('Contractor rankings updated successfully.');
    }
}
