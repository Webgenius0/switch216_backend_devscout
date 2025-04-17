<?php

namespace App\Services\Web\Frontend;

use App\Models\Booking;
use App\Models\ContactorStatistic;
use App\Models\Review;
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
     * Display a specific resource.
     *
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        try {
            $service = Service::with(['user',])->where("status", 'active')->findOrFail($id);
            return $service;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getContactorCategoryList($contactor_id)
    {
        try {
            $contactor_serviceCategory = Service::where('user_id', $contactor_id)->with(['category', 'subcategory', 'bookings', 'reviews'])->get();
            $categoryNames = $contactor_serviceCategory->pluck('category.name');
            return $categoryNames;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function ServiceTitleWithDescription($contactor_id)
    {
        try {
            $ServiceTitleWithDescription = Service::where('user_id', $contactor_id)->select('id', 'title', 'description')->get();
            return $ServiceTitleWithDescription;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function ContactorReview($contactor_id)
    {
        try {
            $ContactorReviews = Review::where('contactor_id', $contactor_id)->with([
                'user' => function ($q) {
                    $q->select('id', 'name', 'avatar');
                }
            ])->select('id', 'service_id', 'contactor_id', 'booking_id', 'user_id', 'rating', 'review', 'created_at')->get();
            return $ContactorReviews;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function contactorStatistics($contactor_id)
    {
        try {
            $contactorStatistics = ContactorStatistic::where('user_id', $contactor_id)->first();
            return $contactorStatistics;
        } catch (Exception $e) {
            throw $e;
        }
    }


}