<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Exception;
use Illuminate\Support\Facades\Auth;

class UserAddressController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Get 'per_page' from the request or default to 1000
            $per_page = $request->has('per_page') ? $request->per_page : 1000;
            // Retrieve all addresses for the authenticated user
            $userAddresses = UserAddress::where('user_id', Auth::user()->id)->latest()
                ->select('id', 'building', 'floor', 'apartment', 'description', 'latitude', 'longitude', 'is_current', 'address_type')
                ->paginate($per_page);
            return Helper::jsonResponse(true, 'User addresses retrieved successfully.', 200, $userAddresses, true);

        } catch (\Exception $e) {
            return Helper::jsonErrorResponse('Failed to retrieve user addresses', 403);
        }
    }
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'address_line1' => 'nullable|string|max:255',
            'building' => 'required|string|max:255',
            'apartment' => 'nullable|string|max:255',
            'floor' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'address_type' => 'nullable|in:home,work,other', // Address type can be home, work, or other
            'is_current' => 'nullable|boolean', // If present, should be a boolean value (true/false)
        ]);
        try {

            if (Auth::user()->role !== "customer") {
                return Helper::jsonErrorResponse('Failed to create address', 403);
            }
            
            if (($request->address_type === 'home' || $request->address_type === 'work') && $request->is_current === true) {
                // Set all previous home or work addresses to false for the current user
                UserAddress::where('user_id', Auth::user()->id)
                    ->where(function ($query) use ($request) {
                        $query->where('address_type', 'home')
                            ->orWhere('address_type', 'work');
                    })
                    ->update(['is_current' => false]);
            }
            $validatedData['user_id'] = Auth::user()->id;

            // Store the validated data in the database
            $userAddress = UserAddress::create($validatedData);
            $userAddress->makeHidden(['user_id', 'address_line1','address_line2', 'location', 'created_at', 'updated_at']);

            return Helper::jsonResponse(true, 'Address successfully created.', 201, $userAddress);

        } catch (\Exception $e) {
            return Helper::jsonErrorResponse('Failed to create address'. $e->getMessage(), 403);
        }

    }

    public function show(string $id)
    {
        try {
            // Retrieve the specific address for the authenticated user
            $userAddress = UserAddress::select('id', 'building', 'floor', 'apartment', 'description', 'latitude', 'longitude', 'is_current', 'address_type')
                ->findOrFail($id);

            // If no User addresses is found, return a not found error
            if (!$userAddress) {
                return Helper::jsonErrorResponse('User addresses not found', 404);
            }
            return Helper::jsonResponse(true, 'User addresses retrieved successfully.', 200, $userAddress);

        } catch (\Exception $e) {
            return Helper::jsonErrorResponse('Failed to retrieve user addresses', 403);
        }
    }
    public function update(Request $request, $id)
    {
        // Validate the request
        $validatedData = $request->validate([
            'address_line1' => 'nullable|string|max:255',
            'building' => 'required|string|max:255',
            'apartment' => 'nullable|string|max:255',
            'floor' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'address_type' => 'nullable|in:home,work,other', // Address type can be home, work, or other
            'is_current' => 'nullable|boolean', // If present, should be a boolean value (true/false)
        ]);

        try {
            // Find the address by ID
            $userAddress = UserAddress::find($id);
            // If no User addresses is found, return a not found error
            if (!$userAddress) {
                return Helper::jsonErrorResponse('User addresses not found', 404);
            }
            // Check if we are updating to a 'home' or 'work' address and set the previous addresses to false
            if (($request->address_type === 'home' || $request->address_type === 'work') && $request->is_current === true) {
                // Set all previous home or work addresses to false for the current user
                UserAddress::where('user_id', Auth::user()->id)
                    ->where(function ($query) use ($request) {
                        $query->where('address_type', 'home')
                            ->orWhere('address_type', 'work');
                    })
                    ->update(['is_current' => false]);
            }

            // Update the address with the validated data
            $userAddress->update($validatedData);

            // Optionally, hide sensitive fields
            $userAddress->makeHidden(['user_id','address_line1', 'address_line2', 'location', 'created_at', 'updated_at']);

            return Helper::jsonResponse(true, 'Address successfully updated.', 200, $userAddress);

        } catch (\Exception $e) {
            return Helper::jsonErrorResponse('Failed to update address'. $e->getMessage(), 403);
        }
    }

    public function delete($id)
    {
        try {
            // Find the address by ID
            $address = UserAddress::find($id);

            // Check if the address exists
            if (!$address) {
                return Helper::jsonErrorResponse('This address was not found.', 404);
            }

            // If the address is associated with any job posts (or any other condition), you can check here
            // For example, if you want to prevent deletion if it's associated with job posts:
            // if ($address->jobPosts()->exists()) {
            //     return Helper::jsonErrorResponse('This address is associated with job posts and cannot be deleted.', 403);
            // }

            // Delete the address
            $address->delete();

            // Return success response
            return Helper::jsonResponse(true, 'Address deleted successfully', 200);
        } catch (\Exception $e) {
            // Catch any exceptions and return an error response
            return Helper::jsonErrorResponse('Failed to delete address', 403);
        }
    }

}
