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
        // $booking= $this->bookingService->getAll();
        $bookings = Booking::where("user_id", $this->user->id)->latest()->get();
        return view("frontend.dashboard.customer.layouts.booking.index", compact("bookings"));
    }
    public function getAllBooking()
    {
        try {
            $bookings = Booking::where("user_id", $this->user->id)->latest()->get();
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
        // dd($request->all());
        // Validate request data
        $validatedData = $request->validate([
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after:now', // Ensure it's a valid future date
        ]);
        // dd($validatedData);
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
            return response()->json([
                'success' => false,
                'message' => 'You already have a booking on this date.'
            ], 400);
        }

        try {
            // Create the booking
            $booking = Booking::create([
                'user_id' => $this->user->id,
                'service_id' => $serviceId,
                'booking_date' => $bookingDate,
                'status' => 'pending', // Default status
            ]);

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


    public function reSchedule(Request $request)
    {
        // Validate request
        $validatedData = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'booking_date' => 'required|date|after:now', // Ensure future date
        ]);

        // Find the booking
        $booking = Booking::where('id', $validatedData['booking_id'])
            ->where('user_id', auth()->id()) // Ensure user owns the booking
            ->first();

        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Booking not found.'
            ], 404);
        }

        // Prevent rescheduling if booking is confirmed
        if ($booking->status === 'confirmed') {
            return response()->json([
                'success' => false,
                'message' => 'You cannot reschedule a confirmed booking.'
            ], 400);
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

        try {
            // Store the reschedule request (instead of updating directly)
            $booking->update([
                'status' => 'pending_reschedule', // New status for reschedule request
                'reschedule_booking_date' => $validatedData['booking_date'], // Store requested date
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Your reschedule request has been sent.',
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


    public function cancelBooking(string $bookingId)
    {
        try {
            // dd($bookingId);
            // Find the booking
            $booking = Booking::where('id', $bookingId)
                ->where('user_id', auth()->id()) // Ensure user owns the booking
                ->first();

            if (!$booking) {
                return response()->json([
                    'success' => false,
                    'message' => 'Booking not found.'
                ], 404);
            }

            // Prevent cancellation on the same day as the booking
            if ($booking->booking_date->isToday()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You cannot cancel a booking on the runnig day.'
                ], 404);
            }
            // Cancel the booking
            $booking->update([
                'status' => 'cancelled',
            ]);
            // dd($booking);
            flash()->success('Your booking has been cancelled successfully.');
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
            ->where('user_id', auth()->id()) // Ensure user owns the booking
            ->first();

        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Booking not found.'
            ], 404);
        }

        // Check if the booking date has passed
        if ($booking->booking_date->isFuture()) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot mark this booking as complete before the booking date.'
            ], 400);
        }

        try {
            // Mark booking as complete
            $booking->update([
                'status' => 'completed',
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

    public function givenReview(Request $request)
    {
        // Validate the review input
        $validatedData = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:500',
        ]);
        try {
            DB::beginTransaction();
            // Find the booking
            $booking = Booking::where('id', $validatedData['booking_id'])
                ->where('user_id', auth()->id())
                ->where('status', 'completed') // Only completed bookings can be reviewed
                ->first();

            if (!$booking) {
                return response()->json([
                    'success' => false,
                    'message' => 'You can only review completed bookings.',
                ], 400);
            }

            // Check if a review already exists for this booking
            $existingReview = Review::where('user_id', auth()->id())
                ->where('service_id', $booking->service_id)
                ->exists();

            if ($existingReview) {
                return response()->json([
                    'success' => false,
                    'message' => 'You have already submitted a review for this booking.',
                ], 400);
            }

            // Create the review
            Review::create([
                'service_id' => $booking->service_id,
                'user_id' => auth()->id(),
                'contactor_id' => $booking->service->user_id,
                'booking_id' => $booking->id,
                'rating' => $validatedData['rating'],
                'review' => $validatedData['review'],
            ]);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Review submitted successfully.',
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
