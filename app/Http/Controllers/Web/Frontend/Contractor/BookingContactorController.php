<?php

namespace App\Http\Controllers\Web\Frontend\Contractor;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Services\Web\Frontend\BookingService;
use Exception;
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
                ->where('status', 'pending')
                ->orWhere('status', 'pending_reschedule')
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
    public function markAsComplete($bookingId)
    {
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
            flash()->error('Something went wrong!');
            return redirect()->back();
        }

        // Check if the booking date has passed
        if ($booking->booking_date->isFuture()) {
            flash()->error('You cannot mark this booking as complete before the booking date.');
            return redirect()->back();
        }

        try {
            // Mark booking as complete
            $booking->update([
                'status' => 'request_completed',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Booking marked as completed successfully.',
                'data' => $booking
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
