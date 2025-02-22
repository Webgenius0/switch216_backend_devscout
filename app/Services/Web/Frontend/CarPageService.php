<?php

namespace App\Services\Web\Frontend;

use App\Models\Category;
use App\Models\SubCategory;
use Exception;
use App\Models\Booking;
use App\Models\Review;
use App\Models\Service;
use Illuminate\Support\Facades\Log;

class CarPageService
{
    /**
     * Fetch all resources.
     *
     * @return mixed
     */
    public function index()
    {
        try {
            $car_Services = Service::with(['user', 'CarService'])->where('category_id', 3)->where("status", 'active')->latest()->take('6')->get();
            $carServiceSubCategorys = SubCategory::where('category_id', 3)->where("status", 'active')->get();
            $data = [
                'car_Services' => $car_Services,
                'carServiceSubCategorys' => $carServiceSubCategorys,
            ];
            return $data;
        } catch (Exception $e) {
            Log::error('CarPageService::index' . $e->getMessage());
            throw $e;
        }
    }
    /**
     * Fetch all resources.
     *
     * @return mixed
     */
    public function carList()
    {
        try {
            $services = Service::with(['user', 'CarService'])->where("status", 'active')->where('is_emergency', true)->latest()->get();
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
            $service = Service::with(['user', 'CarService'])->where("status", 'active')->findOrFail($id);
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
    public function ContactorProfileCounter($contactor_id)
    {
        try {
            $ContactorReviewCount = Review::where('contactor_id', $contactor_id)->count();
            $services = Service::where('user_id', $contactor_id)->get();
            // dd($services);
            $ContactorCompleteBookingCount = Booking::whereIn('service_id', $services->pluck('id'))->where('status', 'completed')->count();
            $ContactorPendingBookingCount = Booking::whereIn('service_id', $services->pluck('id'))->whereIn('status', ['pending', 'pending_reschedule'])->count();

            return ['client_review_count' => $ContactorReviewCount, 'complete_booking_count' => $ContactorCompleteBookingCount, 'pending_booking_count' => $ContactorPendingBookingCount];
        } catch (Exception $e) {
            throw $e;
        }
    }


}