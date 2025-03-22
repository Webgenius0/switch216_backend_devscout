<?php

namespace App\Http\Controllers\Web\Frontend\Customer;

use App\Http\Controllers\Controller;
use App\Services\Web\Settings\ProfileService;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CustomerSettingController extends Controller
{
    protected $profileService;
    protected $user;


    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
        $this->user = Auth::user();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contractor = $this->profileService->get();
        return view('frontend.dashboard.customer.layouts.settings.index', compact('contractor'));
    }

    /**
     * Display the form to update the customer's password.
     */
    public function password()
    {
        return view('frontend.dashboard.customer.layouts.settings.password');
    }
    /**
     * Update the customer's password.
     */
    public function passwordUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'old_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    // Check if the old password matches the current password
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail('The old password is incorrect.');
                    }
                },
            ],
            'password' => 'required|confirmed|min:8',
        ]);
        try {
            $updatedProfile = $this->profileService->updatePassword($this->user, $validatedData);
            if (!$updatedProfile) {
                // Flash error message
                flash()->error('Something went wrong');
                return redirect()->back();
            }
            flash()->success('Password updated successfully');
            return redirect()->route('customer.dashboard');
        } catch (Exception $e) {
            Log::error('CustomerSettingController::passwordUpdate ' . $e->getMessage());
            // Flash error message
            flash()->error('Something went wrong');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'gender' => 'required|in:male,female,other',
            'avatar' => 'nullable|image|max:2048',
        ]);

        try {
            $updatedProfile = $this->profileService->update($this->user, $validatedData);
            if ($updatedProfile) {
                flash()->success('Profile Update Succesfull');
                return redirect()->route('customer.dashboard');
            } else {
                // Flash error message
                flash()->error('Something went wrong');
                return redirect()->back();
            }
        } catch (Exception $e) {
            Log::error('CustomerSettingController::updateProfile ' . $e->getMessage());
            // Flash error message
            flash()->error('Something went wrong');
            return redirect()->back();
        }

    }

}
