<?php

namespace App\Http\Controllers\Web\Frontend\Contractor;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Services\Web\Frontend\AppointmentService;
use App\Services\Web\Frontend\BookingService;
use Exception;
use Illuminate\Console\View\Components\Confirm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppointmentContactorController extends Controller
{
    protected $appointmentService;
    protected $user;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
        $this->user = Auth::user();
    }

    public function index(Request $request)
    {
        $bookings = $this->appointmentService->index();
        return view('frontend.dashboard.contractor.layouts.booking.index', compact('bookings'));
    }

    public function confirmBooking(string $bookingId)
    {
        try {
            $this->appointmentService->confirmBooking($bookingId);
            flash()->success('Your booking has been confirmed successfully.');
            return redirect()->back();
        } catch (Exception $e) {
            flash()->error('Something went wrong!: '. $e->getMessage());
            return redirect()->back();
        }
    }
    public function cancleBooking(string $bookingId)
    {
        try {
            $this->appointmentService->cancleBooking($bookingId);
            flash()->success('Your booking has been cancelled successfully.');
            return redirect()->back();
        } catch (Exception $e) {
            flash()->error('Something went wrong!: ' . $e->getMessage());
            return redirect()->back();
        }
    }
    public function markAsComplete($bookingId)
    {
        try {
            $this->appointmentService->markAsComplete($bookingId);
            flash()->success('Booking marked as completed successfully request Sent.');
            return redirect()->back();
        } catch (Exception $e) {
            flash()->error('Something went wrong!: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
