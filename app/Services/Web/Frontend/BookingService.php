<?php

namespace App\Services\Web\Frontend;

use App\Helpers\Helper;
use App\Models\Booking;
use App\Models\Review;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingService
{
    protected $user;

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
            $bookings = Booking::where("user_id", $this->user->id)->latest()->get();
            return $bookings;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Store a new resource.
     *
     * @param array $validatedData
     * @return mixed
     */
    public function store(array $validatedData)
    {
        try {
            $bookingDate = $validatedData['booking_date'];
            $serviceId = $validatedData['service_id'];

            // Check if the user already has a booking for this service within the last 24 hours
            // $existingBooking = Booking::where('user_id', $this->user->id)
            //     ->where('service_id', $serviceId)
            //     ->where('booking_date', '>=', now()->subDay()) // Check for last 24 hours
            //     ->exists();

            // if ($existingBooking) {
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'You already have a booking for this service within the last 24 hours.'
            //     ], 400);
            // }

            // Check if the user has already booked ANY service on the same date
            $sameDateBooking = Booking::where('user_id', $this->user->id)
                ->where('service_id', $serviceId)
                ->whereDate('booking_date', $bookingDate) // Check if any booking exists on the same date
                ->exists();

            if ($sameDateBooking) {
                throw new Exception('You already have a booking on this date.',400);
            }

            // Create the booking
            $booking = Booking::create([
                'user_id' => $this->user->id,
                'service_id' => $serviceId,
                'booking_date' => $bookingDate,
                'status' => 'pending', // Default status
            ]);
            return $booking;
            // Logic to store a new resource
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAllBooking()
    {
        try {
            $bookings = Booking::where("user_id", $this->user->id)->latest()->get();
            return $bookings;
        } catch (Exception $e) {
            throw $e;
        }
    }


    public function reSchedule($validatedData)
    {
        try {
            // Find the booking
            $booking = Booking::where('id', $validatedData['booking_id'])
                ->where('user_id', $this->user->id) // Ensure user owns the booking
                ->first();

            if (!$booking) {
                throw new Exception('Booking not found.',404);
            }

            // Prevent rescheduling if booking is confirmed
            if ($booking->status === 'confirmed') {
                throw new Exception('You cannot reschedule a confirmed booking.',403);
            }

            // Check if user already has a booking on the new date
            // $existingBooking = Booking::where('user_id', auth()->id())
            //     ->whereDate('booking_date', $validatedData['booking_date'])
            //     ->exists();

            // if ($existingBooking) {
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'You already have a booking on this date.'
            //     ], 400);
            // }

            // Store the reschedule request (instead of updating directly)
            $booking->update([
                'status' => 'pending_reschedule', // New status for reschedule request
                'reschedule_booking_date' => $validatedData['booking_date'], // Store requested date
                'booking_date' => $validatedData['booking_date'], // Store requested date
            ]);
            return $booking;
        } catch (Exception $e) {
            throw $e;
        }
    }


    public function cancelBooking(string $bookingId)
    {
        try {
            // Find the booking
            $booking = Booking::where('id', $bookingId)
                ->where('user_id', auth()->id()) // Ensure user owns the booking
                ->first();

            if (!$booking) {
                throw new Exception('Booking not found.',404);
            }

            // Prevent cancellation on the same day as the booking
            if ($booking->booking_date->isToday()) {
                throw new Exception('You cannot cancel a booking on the runnig day.',400);
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
                ->where('user_id', $this->user->id)
                ->first();

            if (!$booking) {
                throw new Exception('Booking not found.',404);
            }

            // Check if the booking date has passed and if booking status === confirmed
            if ($booking->booking_date->isFuture() || $booking->status !== 'confirmed') {
                throw new Exception('You cannot mark this booking as complete before the booking date or if the booking status is not confirmed.',400);
            }

            // Mark booking as complete
            $booking->update([
                'status' => 'completed',
            ]);
            return $booking;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function givenReview($validatedData)
    {
        try {
            DB::beginTransaction();
            // Find the booking
            $booking = Booking::where('id', $validatedData['booking_id'])
                ->where('user_id', $this->user->id)
                ->where('status', 'completed') // Only completed bookings can be reviewed
                ->first();

            if (!$booking) {
                throw new Exception('You can only review completed bookings.',400);
            }

            // Check if a review already exists for this booking
            // Check if a review already exists for this booking
            $existingReview = Review::where('user_id', $this->user->id)
                ->where('service_id', $booking->service_id)
                ->where('booking_id', $booking->id)
                ->exists();

            if ($existingReview) {
                throw new Exception('You have already submitted a review for this booking.',400);
            }

            // Create the review
            $review=Review::create([
                'service_id' => $booking->service_id,
                'user_id' => $this->user->id,
                'contactor_id' => $booking->service->user_id,
                'booking_id' => $booking->id,
                'rating' => $validatedData['rating'],
                'review' => $validatedData['review'],
            ]);
            DB::commit();
            return $review;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

}