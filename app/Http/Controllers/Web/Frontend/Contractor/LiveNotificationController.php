<?php

namespace App\Http\Controllers\Web\Frontend\Contractor;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Services\Web\Frontend\LiveNotificationService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class LiveNotificationController extends Controller
{
    protected $liveNotificationService;
    /**
     * Constructor
     *
     * @param LiveNotificationService $liveNotificationService
     */
    public function __construct(LiveNotificationService $liveNotificationService)
    {
        $this->liveNotificationService = $liveNotificationService;
    }
    /**
     * Mark all notifications as read
     * @return \Illuminate\Http\JsonResponse
     */
    public function markAllAsRead()
    {
        try {
            $response = $this->liveNotificationService->markAllAsRead();
            return response()->json($response, 200);
        } catch (Exception $e) {
            return Helper::jsonErrorResponse($e->getMessage(), 500);
        }
    }

    /**
     * Mark a single notification as read
     * @param int $id Notification ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function markAsSingleRead($id)
    {
        try {
            $response = $this->liveNotificationService->markSingleAsRead($id);
            return response()->json($response, 200);
        } catch (Exception $e) {
            return Helper::jsonErrorResponse($e->getMessage(), 500);
        }
    }

    /**
     * Delete a single notification.
     *
     * @param int $id Notification ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            $response = $this->liveNotificationService->delete($id);
            return response()->json($response, 200);
        } catch (Exception $e) {
            return Helper::jsonErrorResponse('Something went wrong', 500);
        }
    }

    /**
     * Delete all notifications.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAll()
    {
        try {
            $response = $this->liveNotificationService->deleteAll();
            return response()->json($response, 200);
        } catch (Exception $e) {
            return Helper::jsonErrorResponse('Something went wrong', 500);
        }
    }

}
