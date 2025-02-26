<?php

namespace App\Services\Web\Frontend;

use App\Models\Booking;
use App\Models\Service;
use App\Notifications\BookingNotification;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingContactorService
{
    protected $user;

    /**
     * BookingContactorService constructor.
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

    /**
     * Confirm a booking if it exists and the date has not passed.
     *
     * This method searches for a booking by its ID, ensuring the booking
     * is not already completed, cancelled, confirmed, or request_completed.
     * It also verifies that the authenticated user is associated with the
     * service linked to the booking. If the booking is found and the booking
     * date has not passed, the status is updated to 'confirmed'.
     *
     * @param string $bookingId The ID of the booking to be confirmed.
     * @return Booking The confirmed booking.
     * @throws Exception If booking not found or date has passed.
     */

    public function confirmBooking(string $bookingId)
    {
        try {
            DB::beginTransaction();
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
            $this->sendAdminNotification($booking, 'Appointment Confirmation');
            DB::commit();
            return $booking;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Cancel a booking if it exists and meets the criteria.
     *
     * This method searches for a booking by its ID, ensuring the booking
     * has a status of either 'pending', 'confirmed', or 'pending_reschedule'.
     * It also verifies that the authenticated user is associated with the
     * service linked to the booking. If the booking is found, it checks that
     * the booking is not being canceled on the same day if the status is confirmed.
     * If these conditions are met, the booking status is updated to 'cancelled'.
     *
     * @param string $bookingId The ID of the booking to be cancelled.
     * @return Booking The cancelled booking.
     * @throws Exception If booking not found or cancellation criteria not met.
     */

    public function cancleBooking(string $bookingId)
    {
        try {
            DB::beginTransaction();
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
            $this->sendAdminNotification($booking, 'Appointment Cancelled');
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
     * This method will first verify that the booking exists and that the
     * authenticated user is associated with the service linked to the booking.
     * It also checks that the booking status is 'confirmed', and that the
     * booking date has already passed. If all these criteria are met, the
     * booking status is updated to 'request_completed'.
     *
     * @param string $bookingId The ID of the booking to be marked as completed.
     * @return Booking The updated booking.
     * @throws Exception If booking not found or criteria not met.
     */
    public function markAsComplete($bookingId)
    {
        try {
            DB::beginTransaction();
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
            $this->sendAdminNotification($booking, 'Appointment Completed Request');
            DB::commit();
            return $booking;

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
        $customer = $booking->user; // Prevents null errors
        if (!$customer) {
            Log::warning('No customer found for appointment ID: ' . $booking->id);
            return;
        }
        $notificationData = [
            'title' => $type,
            'message' => $this->getNotificationMessage($type, $booking),
            'url' => route('contractor.booking.index'),
            'type_id' => $booking->id,
            'type' => 'Booking Notification',
            'thumbnail' => asset('backend/admin/assets/images/appointment_notification.png' ?? ''),
        ];

        $customer->notify(new BookingNotification($notificationData));
        Log::info('Notification sent to Customer: ' . $customer->name);

    }

    private function getNotificationMessage($type, $booking)
    {
        // You can add more message types as required
        switch ($type) {
            case 'Appointment Confirmation':
                return "Your booking for {$booking->service->title} has been confirmed. Please review the details.";
            case 'Appointment Cancelled':
                return 'A appointment for your service: "' . $booking->service->title . '" has been cancelled. Check the details.';
            case 'Appointment Completed Request':
                return 'The appointment for your service: "' . $booking->service->title . '" has been marked as completed request. View the appointment now!';

            default:
                return 'A new Appointment action has occurred for your service. Please review the details.';
        }
    }
}