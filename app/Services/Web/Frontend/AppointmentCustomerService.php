<?php

namespace App\Services\Web\Frontend;

use App\Helpers\Helper;
use App\Models\Booking;
use App\Models\Review;
use App\Models\User;
use App\Notifications\AppoinmentNotification;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppointmentCustomerService
{
    protected $user;

    /**
     * Set the user property.
     *
     * @return void
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
            DB::beginTransaction();
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
                throw new Exception('You already have a booking on this date.', 400);
            }

            // Create the booking
            $booking = Booking::create([
                'user_id' => $this->user->id,
                'service_id' => $serviceId,
                'booking_date' => $bookingDate,
                'status' => 'pending', // Default status
            ]);
            // Send notification to admins
            $this->sendAdminNotification($booking, 'New Booking Alert!');
            DB::commit();
            return $booking;
            // Logic to store a new resource
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Fetch all bookings for the current user.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllBooking()
    {
        try {
            $bookings = Booking::where("user_id", $this->user->id)->latest()->get();
            return $bookings;
        } catch (Exception $e) {
            throw $e;
        }
    }



    /**
     * Reschedule an existing booking.
     *
     * Validates the incoming request to ensure the booking ID exists and the user owns it.
     * Prevents rescheduling if the booking is confirmed.
     * Checks if the user already has a booking on the new date, preventing double-booking.
     * Stores the reschedule request with the new date in the booking table.
     *
     * @param array $validatedData The validated request data containing the booking ID and new date.
     * @return Booking The updated booking with the new status and requested date.
     * @throws Exception If booking not found, or criteria not met.
     */
    public function reSchedule($validatedData)
    {
        try {
            DB::beginTransaction();
            // Find the booking
            $booking = Booking::where('id', $validatedData['booking_id'])
                ->where('user_id', $this->user->id) // Ensure user owns the booking
                ->first();

            if (!$booking) {
                throw new Exception('Booking not found.', 404);
            }

            // Prevent rescheduling if booking is confirmed
            if ($booking->status === 'confirmed') {
                throw new Exception('You cannot reschedule a confirmed booking.', 403);
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
            $this->sendAdminNotification($booking, 'Booking Rescheduled');
            DB::commit();
            return $booking;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    /**
     * Cancel a booking.
     *
     * Validates the incoming booking ID to ensure the booking exists and the user owns it.
     * Prevents cancellation on the same day as the booking.
     * Updates the booking status to 'cancelled'.
     *
     * @param string $bookingId The ID of the booking to be cancelled.
     * @return Booking The updated booking.
     * @throws Exception If booking not found, or criteria not met.
     */
    public function cancelBooking(string $bookingId)
    {
        try {
            DB::beginTransaction();
            // Find the booking
            $booking = Booking::where('id', $bookingId)
                ->where('user_id', auth()->id()) // Ensure user owns the booking
                ->first();

            if (!$booking) {
                throw new Exception('Booking not found.', 404);
            }

            // Prevent cancellation on the same day as the booking
            if ($booking->booking_date->isToday()) {
                throw new Exception('You cannot cancel a booking on the runnig day.', 400);
            }
            // Cancel the booking
            $booking->update([
                'status' => 'cancelled',
            ]);
            $this->sendAdminNotification($booking, 'Booking Cancelled');
            DB::commit();
            return $booking;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }




    /**
     * Mark a booking as completed.
     *
     * Validates the incoming booking ID to ensure the booking exists and the user owns it.
     * Checks if the booking date has passed and if the booking status is 'confirmed'.
     * Updates the booking status to 'completed'.
     *
     * @param string $bookingId The ID of the booking to be marked as completed.
     * @return Booking The updated booking.
     * @throws Exception If booking not found, or criteria not met.
     */
    public function markAsComplete($bookingId)
    {
        try {
            DB::beginTransaction();
            // Find the booking
            $booking = Booking::where('id', $bookingId)
                ->where('user_id', $this->user->id)
                ->first();

            if (!$booking) {
                throw new Exception('Booking not found.', 404);
            }

            // Check if the booking date has passed and if booking status === confirmed
            if ($booking->booking_date->isFuture() || $booking->status !== 'confirmed') {
                throw new Exception('You cannot mark this booking as complete before the booking date or if the booking status is not confirmed.', 400);
            }

            // Mark booking as complete
            $booking->update([
                'status' => 'completed',
            ]);
            $this->sendAdminNotification($booking, 'Booking Completed');
            DB::commit();
            return $booking;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    /**
     * Submit a review for a completed booking.
     *
     * This function validates that the booking is completed and the user owns it.
     * It checks if a review already exists for the booking, preventing duplicate reviews.
     * If the criteria are met, it creates a new review for the booking and persists it to the database.
     * The function uses a database transaction to ensure atomicity.
     *
     * @param array $validatedData The validated data containing booking ID, rating, and review content.
     * @return Review The newly created review.
     * @throws Exception If booking is not found, already reviewed, or any other validation fails.
     */

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
                throw new Exception('You can only review completed bookings.', 400);
            }

            // Check if a review already exists for this booking
            $existingReview = Review::where('user_id', $this->user->id)
                ->where('service_id', $booking->service_id)
                ->where('booking_id', $booking->id)
                ->exists();

            if ($existingReview) {
                throw new Exception('You have already submitted a review for this booking.', 400);
            }

            // Create the review
            $review = Review::create([
                'service_id' => $booking->service_id,
                'user_id' => $this->user->id,
                'contactor_id' => $booking->service->user_id,
                'booking_id' => $booking->id,
                'rating' => $validatedData['rating'],
                'review' => $validatedData['review'],
            ]);
            $this->sendAdminNotification($booking, 'Review Submitted');
            DB::commit();
            return $review;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    /**
     * Send a notification to the contractor (admin) associated with the booking's service.
     *
     * The notification is sent using the AppoinmentNotification class and contains the booking ID.
     * The notification is sent when the booking is created or updated.
     *
     * @param Booking $booking The booking object for which the notification should be sent.
     * @return void
     */
    private function sendAdminNotification(Booking $booking, $type = 'New Booking Alert!')
    {
        $contactor = optional($booking->service)->user; // Prevents null errors

        if (!$contactor) {
            Log::warning('No contractor found for booking ID: ' . $booking->id);
            return;
        }
        $notificationData = [
            'title' => $type,
            'message' => $this->getNotificationMessage($type, $booking),
            'url' => route('contractor.booking.index'),
            'type_id' => $booking->id,
            'type' => 'Booking Notification',
            'thumbnail' => asset('backend/admin/assets/images/booking_notification.png' ?? ''),
        ];

        $contactor->notify(new AppoinmentNotification($notificationData));
        Log::info('Notification sent to contactor: ' . $contactor->name);

    }

    private function getNotificationMessage($type, $booking)
    {
        // You can add more message types as required
        switch ($type) {
            case 'New Booking Alert!':
                return 'A new booking has been made for your service: "' . $booking->service->title . '". Check the details now!';
            case 'Booking Rescheduled':
                return 'The booking for your service: "' . $booking->service->title . '" has been rescheduled. Check the new details!';
            case 'Booking Cancelled':
                return 'A booking for your service: "' . $booking->service->title . '" has been cancelled. Check the details.';
            case 'Booking Completed':
                return 'The booking for your service: "' . $booking->service->title . '" has been marked as completed. View the booking now!';
            case 'Review Submitted':
                return 'A review has been submitted for your service: "' . $booking->service->title . '". Check it out now!';
            default:
                return 'A new booking action has occurred for your service. Please review the details.';
        }
    }
}