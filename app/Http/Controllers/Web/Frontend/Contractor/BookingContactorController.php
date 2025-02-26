<?php

namespace App\Http\Controllers\Web\Frontend\Contractor;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Services\Web\Frontend\BookingContactorService;
use App\Services\Web\Frontend\BookingService;
use Exception;
use Illuminate\Console\View\Components\Confirm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingContactorController extends Controller
{
    protected $bookingContactorService;
    protected $user;

    /**
     * BookingContactorController constructor.
     *
     * @param BookingContactorService $bookingContactorService The service instance to handle booking operations.
     *
     * Initialize the booking contactor service and set the authenticated user.
     */

    public function __construct(BookingContactorService $bookingContactorService)
    {
        $this->bookingContactorService = $bookingContactorService;
        $this->user = Auth::user();
    }

    /**
     * Display a listing of the bookings.
     *
     * @param Request $request The HTTP request instance.
     * @return \Illuminate\View\View The view displaying the list of bookings.
     */

    public function index(Request $request)
    {
        $bookings = $this->bookingContactorService->index();
        return view('frontend.dashboard.contractor.layouts.booking.index', compact('bookings'));
    }

    /**
     * Confirm a booking.
     *
     * This method will call the BookingContactorService to confirm a booking.
     * The booking ID is required and must exist in the bookings table.
     * The method will return a redirect response to the previous route with a success message
     * if the booking is confirmed successfully, otherwise it will return the same response
     * with an error message.
     *
     * @param string $bookingId The ID of the booking to be confirmed.
     * @return \Illuminate\Http\RedirectResponse The response with a success or error message.
     */
    public function confirmBooking(string $bookingId)
    {
        try {
            $this->bookingContactorService->confirmBooking($bookingId);
            flash()->success('Your booking has been confirmed successfully.');
            return redirect()->back();
        } catch (Exception $e) {
            flash()->error('Something went wrong!: '. $e->getMessage());
            return redirect()->back();
        }
    }
    /**
     * Cancel a booking.
     *
     * This method will call the BookingContactorService to cancel a booking.
     * The booking ID is required and must exist in the bookings table.
     * The method will return a redirect response to the previous route with a success message
     * if the booking is cancelled successfully, otherwise it will return the same response
     * with an error message.
     *
     * @param string $bookingId The ID of the booking to be cancelled.
     * @return \Illuminate\Http\RedirectResponse The response with a success or error message.
     */
    public function cancleBooking(string $bookingId)
    {
        try {
            $this->bookingContactorService->cancleBooking($bookingId);
            flash()->success('Your booking has been cancelled successfully.');
            return redirect()->back();
        } catch (Exception $e) {
            flash()->error('Something went wrong!: ' . $e->getMessage());
            return redirect()->back();
        }
    }
    /**
     * Mark a booking as completed.
     *
     * This method will call the BookingContactorService to mark a booking as completed.
     * The booking ID is required and must exist in the bookings table.
     * The method will return a redirect response to the previous route with a success message
     * if the booking is marked as completed successfully, otherwise it will return the same response
     * with an error message.
     *
     * @param string $bookingId The ID of the booking to be marked as completed.
     * @return \Illuminate\Http\RedirectResponse The response with a success or error message.
     */
    public function markAsComplete($bookingId)
    {
        try {
            $this->bookingContactorService->markAsComplete($bookingId);
            flash()->success('Booking marked as completed successfully request Sent.');
            return redirect()->back();
        } catch (Exception $e) {
            flash()->error('Something went wrong!: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
