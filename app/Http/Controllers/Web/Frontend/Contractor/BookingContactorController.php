<?php

namespace App\Http\Controllers\Web\Frontend\Contractor;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingContactorController extends Controller
{
    public function index(Request $request)
    {
        // $services = Service::where('user_id', Auth::user()->id())->get();

        // $booking = Booking::whereIn("service_id", $services->pluck('id'))->get();
        return view("frontend.dashboard.contractor.layouts.booking.index");
    }
}
