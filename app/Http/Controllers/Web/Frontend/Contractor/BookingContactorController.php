<?php

namespace App\Http\Controllers\Web\Frontend\Contractor;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Services\Web\Frontend\BookingService;
use Exception;
use Illuminate\Console\View\Components\Confirm;
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


    public function confirmBooking(string $bookingId)
    {
        try {
            // Find the booking
            $booking = Booking::where('id', $bookingId)
                ->whereNotIn('status', ['completed', 'cancelled', 'confirmed', 'request_completed'])
                ->with([
                    'service' => function ($query) {
                        $query->where('user_id', $this->user->id); // Use Auth::user()->id instead
                    }
                ])
                ->first();
            if (!$booking) {
                flash()->error('Something went wrong!');
                return redirect()->back();
            }
            // Cancel the booking
            $booking->update([
                'status' => 'confirmed',
            ]);
            flash()->success('Your booking has been confirmed successfully.');
            return redirect()->back();
        } catch (Exception $e) {
            flash()->error('Something went wrong!');
            return redirect()->back();
        }
    }
    public function cancleBooking(string $bookingId)
    {
        try {
            // Find the booking
            $booking = Booking::where('id', $bookingId)
                ->whereIn('status', ['pending', 'confirmed', 'pending_reschedule'])
                ->with([
                    'service' => function ($query) {
                        $query->where('user_id', $this->user->id); // Use Auth::user()->id instead
                    }
                ])
                ->first();
            if (!$booking) {
                flash()->error('Something went wrong!');
                return redirect()->back();
            }
            // Prevent cancellation on the same day as the booking
            if ($booking->booking_date->isToday() && $booking->status === 'confirmed') {
                flash()->error('You cannot cancel a booking on the running day.');
                return redirect()->back();
            }
            // Cancel the booking
            $booking->update([
                'status' => 'cancelled',
            ]);
            flash()->success('Your booking has been cancelled successfully.');
            return redirect()->back();
        } catch (Exception $e) {
            flash()->error('Something went wrong!' . $e->getMessage());
            return redirect()->back();
        }
    }
    public function markAsComplete($bookingId)
    {
        try {
            // Find the booking
            $booking = Booking::where('id', $bookingId)
                ->where('status', 'confirmed')
                ->with([
                    'service' => function ($query) {
                        $query->where('user_id', $this->user->id); // Use Auth::user()->id instead
                    }
                ])
                ->first();
            if (!$booking) {

            }

            // Check if the booking date has passed
            if ($booking->booking_date->isFuture()) {
                flash()->error('You cannot mark this booking as complete before the booking date.');
                return redirect()->back();
            }


            // Mark booking as complete
            $booking->update([
                'status' => 'request_completed',
            ]);
            flash()->success('Booking marked as completed successfully request Sent.');
            return redirect()->back();

        } catch (Exception $e) {
            flash()->error('Something went wrong!' . $e->getMessage());
            return redirect()->back();
        }
    }
}
