<?php

namespace App\Console\Commands;

use App\Models\Booking;
use Illuminate\Console\Command;
use Carbon\Carbon;

class AutoCompleteBookings extends Command
{
    protected $signature = 'booking:complete';
    protected $description = 'Automatically mark bookings as completed after 24 hours of the booking date.';

    public function handle()
    {
        $bookings = Booking::where('status', 'confirmed')
            ->where('booking_date', '<', Carbon::now()->subDay()) // Check bookings older than 24 hours
            ->update(['status' => 'completed']);

        $this->info("Completed {$bookings} bookings.");
    }
}
