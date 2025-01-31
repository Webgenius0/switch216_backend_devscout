<?php

namespace App\Services\Web\Frontend;

use App\Helpers\Helper;
use App\Models\Service;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ContractorServiceService
{
    /**
     * Fetch all resources.
     *
     * @return mixed
     */
    public function index()
    {
        try {
            $services = Service::where("user_id", Auth::user()->id)->get();
            return $services;
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
     * @param array $validatedData
     * @return mixed
     */
    public function store(array $validatedData)
    {
        try {
            // Handle Cover Image Upload
            if (isset($validatedData['cover_image'])) {

                $coverImagePath = Helper::fileUpload($validatedData['cover_image'], 'services_cover_image', getFileName($validatedData['cover_image']));
                $validatedData['cover_image'] = $coverImagePath;
            }

            // Handle Gallery Images Upload
            $galleryImages = [];
            if (isset($validatedData['gallery_images'])) {
                if ($validatedData['gallery_images']) {
                    foreach ($validatedData['gallery_images'] as $key => $image) {
                        // $imagePath = $image->store('uploads/gallery', 'public'); // Save in storage/app/public/uploads/gallery
                        $imagePath = Helper::fileUpload($image, 'services_gallery_images', $key . '_' . getFileName($image));
                        $galleryImages[] = $imagePath;
                    }
                }
            }
            $validatedData['user_id'] = Auth::user()->id;
            $validatedData['gallery_images'] = json_encode($galleryImages);
            $service = Service::create($validatedData);
            return $service;
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
    public function destroy(int $id)
    {
        try {
            $service = Service::where("user_id", Auth::user()->id)->findOrFail($id);
            if (!$service) {
                return false;
            }
            $service->delete();
            return true;
        } catch (Exception $e) {
            Log::error('ContractorServiceService::destroy-' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Delete a specific resource.
     *
     * @param int $id
     * @return bool
     */
    public function status(int $id)
    {
        try {
            $data = Service::where('user_id', Auth::user()->id)->findOrFail($id);

            // check if the category exists
            if (empty($data)) {
                return false;
            }
            // toggle status of the category
            if ($data->status == 'active') {
                $data->status = 'inactive';
            } else {
                $data->status = 'active';
            }
            // save the changes
            $data->save();
            return true;
        } catch (Exception $e) {
            Log::error('ContractorServiceService::status-' . $e->getMessage());
            throw $e;
        }
    }


}