<?php

namespace App\Http\Controllers\Web\Frontend\Contractor;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Services\Web\Frontend\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingContactorController extends Controller
{
    protected $bookingService;
    protected $user;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
        $this->user = Auth::user();
    }

    public function index(Request $request)
    {
        $services = Service::where('user_id', Auth::user()->id)->get();
        $bookings = Booking::whereIn('service_id', $services->pluck('id'))->get();

        return view('frontend.dashboard.contractor.layouts.booking.index', compact('bookings'));
    }
}
