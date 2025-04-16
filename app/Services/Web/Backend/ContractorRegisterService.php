<?php

namespace App\Services\Web\Backend;

use App\Helpers\Helper;
use App\Models\ContactorCategory;
use App\Models\User;
use App\Models\UserAddress;
use DB;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ContractorRegisterService
{
    /**
     * Fetch all resources.
     *
     * @return mixed
     */
    public function index()
    {
        try {
            // Logic to fetch all resources
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        try {
            // Logic for create form
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Store a new resource.
     *
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            // Check if 'avatar' is in the array and if the file exists
            if (isset($data['avatar']) && is_file($data['avatar'])) {
                // Use the Helper method to handle the file upload
                $data['avatar'] = Helper::fileUpload($data['avatar'], 'avatar', time() . '_' . getFileName($data['avatar']));
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'instagram_social_link' => $data['instagram_social_link'] ?? null,
                    'password' => Hash::make($data['password']),
                    'role' => 'contractor',
                    'avatar' => $data['avatar'],
                ]);
                // Create user address
                $user_address = UserAddress::create([
                    'user_id' => $user->id,
                    'location' => $data['address'],
                    'latitude' => $data['latitude'],
                    'longitude' => $data['longitude'],
                    'address_type' => 'work',
                    'is_current' => true,
                ]);
                // create contactor category
                $contactorCategory = ContactorCategory::create([
                    'user_id' => $user->id,
                    'category_id' => $data['category_id'],
                    'sub_category_id' => $data['subcategory_id'],
                ]);
            } else {
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'instagram_social_link' => $data['instagram_social_link'] ?? null,
                    'password' => Hash::make($data['password']),
                    'role' => 'contractor',
                ]);
                // Create user address
                $user_address = UserAddress::create([
                    'user_id' => $user->id,
                    'location' => $data['address'],
                    'latitude' => $data['latitude'],
                    'longitude' => $data['longitude'],
                    'address_type' => 'work',
                    'is_current' => true,
                ]);
                // create contactor category
                $contactorCategory = ContactorCategory::create([
                    'user_id' => $user->id,
                    'category_id' => $data['category_id'],
                ]);
            }
            event(new Registered($user));
            Auth::login($user);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Display a specific resource.
     *
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        try {
            // Logic to show a specific resource
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Show the form for editing a resource.
     *
     * @param int $id
     * @return void
     */
    public function edit(int $id)
    {
        try {
            // Logic for edit form
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Update a specific resource.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        try {
            // Logic to update a specific resource
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Delete a specific resource.
     *
     * @param int $id
     * @return bool
     */
    public function destroy(int $id)
    {
        try {
            // Logic to delete a specific resource
        } catch (Exception $e) {
            throw $e;
        }
    }

}