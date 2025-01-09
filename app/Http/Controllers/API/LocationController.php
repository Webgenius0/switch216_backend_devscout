<?php

namespace App\Http\Controllers\API;

use App\Events\LocationUpdatedEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    public function updateLocation(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
        try {

            $locationData = [
                'user_id' => $request->user_id,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ];

            // Broadcast the location update
            broadcast(new LocationUpdatedEvent($locationData));

            return response()->json([
                'status' => true,
                'message' => 'Location updated successfully',
                'code' => 201,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 0);
        }
    }
}
