<?php

namespace App\Http\Controllers\Web\Frontend\Customer;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Review;
use App\Services\Web\Frontend\BookingService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingCustomerController extends Controller
{
    protected $bookingService;
    protected $user;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
        $this->user = Auth::user();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = $this->bookingService->index();
        return view("frontend.dashboard.customer.layouts.booking.index", compact("bookings"));
    }
    /**
     * Fetch all bookings data
     */
    public function getAllBooking()
    {
        try {
            $bookings = $this->bookingService->getAllBooking();
            return Helper::jsonResponse(true, 'Bookings data fatced successfully', 200, $bookings);
        } catch (Exception $e) {
            Log::error('BookingCustomerController::getAllBooking-' . $e->getMessage());
            return Helper::jsonErrorResponse('some things went wrong', 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after:now', // Ensure it's a valid future date
        ]);
        try {
            $booking = $this->bookingService->store($validatedData);
            return response()->json([
                'success' => true,
                'message' => 'Booking created successfully.',
                'data' => $booking
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Handle a request to reschedule an existing booking.
     *
     * Validates the incoming request to ensure the booking ID exists and the new booking date is in the future.
     * Calls the BookingService to process the rescheduling, returning a JSON response indicating the success or failure
     * of the operation, along with any relevant data or error messages.
     *
     * @param \Illuminate\Http\Request $request The incoming request containing the booking details.
     * @return \Illuminate\Http\JsonResponse The response indicating the result of the reschedule operation.
     */
    public function reSchedule(Request $request)
    {
        // Validate request
        $validatedData = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'booking_date' => 'required|date|after:now', // Ensure future date
        ]);
        try {
            $booking = $this->bookingService->reSchedule($validatedData);
            return response()->json([
                'success' => true,
                'message' => 'Your reschedule request has been sent.',
                'data' => $booking
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Cancel an existing booking.
     *
     * Attempts to cancel the booking identified by the given booking ID.
     * If successful, a success message is flashed and the user is redirected back.
     * If an error occurs, an error message is flashed and the user is redirected back.
     *
     * @param string $bookingId The ID of the booking to be cancelled.
     * @return \Illuminate\Http\RedirectResponse Redirects back to the previous page.
     */

    public function cancelBooking(string $bookingId)
    {
        try {
            $this->bookingService->cancelBooking($bookingId);
            flash()->success('Your booking has been cancelled successfully.');
            return redirect()->back();
        } catch (Exception $e) {
            flash()->error('Something went wrong!');
            return redirect()->back();
        }
    }


    /**
     * Mark a booking as complete.
     *
     * Attempts to mark the booking identified by the given booking ID as complete.
     * If successful, a JSON response indicating success is returned along with the updated booking data.
     * If an error occurs, a JSON response with an error message is returned.
     *
     * @param int $bookingId The ID of the booking to be marked as complete.
     * @return \Illuminate\Http\JsonResponse The response indicating the result of the operation.
     */

    public function markAsComplete($bookingId)
    {
        try {
            $booking = $this->bookingService->markAsComplete($bookingId);
            return response()->json([
                'success' => true,
                'message' => 'Booking marked as completed successfully.',
                'data' => $booking
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Handles a request to leave a review for a booking.
     *
     * Validates the incoming request to ensure the booking ID exists and the review input is valid.
     * Calls the BookingService to process the review, returning a JSON response indicating the success or failure
     * of the operation, along with any relevant data or error messages.
     *
     * @param \Illuminate\Http\Request $request The incoming request containing the booking details.
     * @return \Illuminate\Http\JsonResponse The response indicating the result of the review operation.
     */
    public function givenReview(Request $request)
    {
        // Validate the review input
        $validatedData = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:500',
        ]);
        try {
            $this->bookingService->givenReview($validatedData);
            return response()->json([
                'success' => true,
                'message' => 'Review submitted successfully.',
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
