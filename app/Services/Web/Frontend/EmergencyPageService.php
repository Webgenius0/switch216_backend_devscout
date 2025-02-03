<?php

namespace App\Services\Web\Frontend;

use App\Models\Service;
use Exception;
use Illuminate\Support\Facades\Log;

class EmergencyPageService
{
    /**
     * Fetch all resources.
     *
     * @return mixed
     */
    public function index()
    {
        try {
            $services = Service::with(['user'])->where("status", 'active')->where('is_emergency', true)->latest()->get();
            return $services;
        } catch (Exception $e) {
            Log::error('EmergencyPageService::index' . $e->getMessage());
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
            // Logic to store a new resource
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
            $service = Service::with(['user'])->where("status", 'active')->findOrFail($id);
            return $service;
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