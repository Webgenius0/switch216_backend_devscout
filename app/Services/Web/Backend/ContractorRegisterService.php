<?php

namespace App\Services\Web\Backend;

use App\Helpers\Helper;
use App\Models\User;
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
    public function get()
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
            // Check if 'avatar' is in the array and if the file exists
            if (isset($data['avatar']) && is_file($data['avatar'])) {
                // Use the Helper method to handle the file upload
                $data['avatar'] = Helper::fileUpload($data['avatar'], 'avatar', time() . '_' . getFileName($data['avatar']));
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'role' => 'contractor',
                    'avatar' => $data['avatar'],
                ]);
            } else {
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'role' => 'contractor',
                ]);
            }

            event(new Registered($user));
            Auth::login($user);
            return true;
        } catch (Exception $e) {
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
    public function delete(int $id)
    {
        try {
            // Logic to delete a specific resource
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Handle exceptions.
     *
     * @param Exception $e
     * @return mixed
     */
    private function handleException(Exception $e)
    {
        // Log the exception or handle it as needed
        // You can use logger or return an error response
        return [
            'success' => false,
            'message' => $e->getMessage(),
        ];
    }
}