<?php

namespace App\Http\Controllers\Web\Frontend\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Services\Web\Frontend\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after:today', // Ensure it's a valid future date
        ]);

        // Check if the user already has a booking for this service within the last 24 hours
        $existingBooking = Booking::where('user_id', $this->user->id)
            ->where('service_id', $validatedData['service_id'])
            ->where('booking_date', '>=', now()->subDay()) // Check for last 24 hours
            ->exists();

        if ($existingBooking) {
            return response()->json([
                'success' => false,
                'message' => 'You already have a booking for this service within the last 24 hours.'
            ], 400);
        }

        try {
            // Create booking
            $booking = Booking::create([
                'user_id' => auth()->id(), // Get the authenticated user
                'service_id' => $validatedData['service_id'],
                'booking_date' => $validatedData['booking_date'],
                'status' => 'pending', // Default status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Booking created successfully.',
                'data' => $booking
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
