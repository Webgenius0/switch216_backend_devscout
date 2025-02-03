<?php

use App\Console\Commands\UpdateContractorRanking;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Schedule::command(UpdateContractorRanking::class)->everyMinute();

// Schedule::call(UpdateContractorRanking::class)->everyFifteenSeconds();

Schedule::call( function () {
    logger()->info('test it');
})->everySecond();