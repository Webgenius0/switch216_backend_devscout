<?php

namespace App\Services\Web\Frontend;

use App\Models\Booking;
use App\Models\Service;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AppointmentService
{

    protected $user;

    /**
     * AppointmentService constructor.
     *
     * Initialize the user from the auth session.
     */
    public function __construct()
    {
        $this->user = Auth::user();
    }
    /**
     * Fetch all resources.
     *
     * @return mixed
     */
    public function index()
    {
        try {
            $services = Service::where('user_id', $this->user->id)->get();
            $bookings = Booking::whereIn('service_id', $services->pluck('id'))->latest()->get();
            return $bookings;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function confirmBooking(string $bookingId)
    {
        try {
            // Find the booking
            $booking = Booking::where('id', $bookingId)
                ->whereNotIn('status', ['completed', 'cancelled', 'confirmed', 'request_completed'])

                ->with([
                    'service' => function ($query) {
                        $query->where('user_id', $this->user->id);
                    }
                ])
                ->first();
            if (!$booking) {
                throw new Exception('Booking not found.', 404);
            }
            // Check if booking date has passed
            if (Carbon::parse($booking->booking_date)->isPast()) {
                throw new Exception('Booking date has already passed.', 400);
            }
            // Cancel the booking
            $booking->update([
                'status' => 'confirmed',
            ]);

            return $booking;
        } catch (Exception $e) {
            throw $e;
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
                throw new Exception('Booking Not Found', 404);
            }
            // Prevent cancellation on the same day as the booking
            if ($booking->booking_date->isToday() && $booking->status === 'confirmed') {
                throw new Exception('You cannot cancel a booking on the running day.', 400);
            }
            // Cancel the booking
            $booking->update([
                'status' => 'cancelled',
            ]);

            return $booking;
        } catch (Exception $e) {
            throw $e;
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
                throw new Exception('Booking Not Found', 404);
            }
            // Check if the booking date has passed
            if ($booking->booking_date->isFuture()) {
                throw new Exception('You cannot mark this booking as complete before the booking date.', 404);
            }
            // Mark booking as complete
            $booking->update([
                'status' => 'request_completed',
            ]);
            return $booking;

        } catch (Exception $e) {
            throw $e;
        }
    }

}