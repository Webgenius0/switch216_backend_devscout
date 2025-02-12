<?php

namespace App\Services\Web\Frontend;

use App\Helpers\Helper;
use App\Models\ContactorCategory;
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
            $services = Service::where("user_id", Auth::user()->id)->latest()->get();
            return $services;
        } catch (Exception $e) {
            throw $e;
        }
    }


    public function contactorCategory()
    {
        try {
            $contactor_category = ContactorCategory::where('user_id', Auth::user()->id)->with('category.subCategories')->first();
            return $contactor_category;
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
            $validatedData['verify'] = 'approved'; // Set the verify field to 'approved' but after complete the verification process change it to 'pending'
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
     * Toggle the status of a specific resource.
     *
     * @param int $id The ID of the resource to toggle the status for.
     * @return bool True on success, false on failure.
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
    /**
     * Toggle the emargence of a specific resource.
     *
     * @param int $id The ID of the resource to toggle the emargence for.
     * @return bool True on success, false on failure.
     */
    public function emargence(int $id)
    {
        try {
            $data = Service::where('user_id', Auth::user()->id)->findOrFail($id);

            // check if the category exists
            if (empty($data)) {
                return false;
            }
            // toggle status of the category
            if ($data->is_emergency == true) {
                $data->is_emergency = false;
            } else {
                $data->is_emergency = true;
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