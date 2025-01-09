<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;

class NotificationController extends Controller
{
    public function index()
    {
        try {
            $notifications = auth()->user()->notifications;
            return Helper::jsonResponse(true, "Notifications fetched successfully", 200, $notifications);
        } catch (\Exception $e) {
            return Helper::jsonErrorResponse($e->getMessage(), 500);
        }
    }

    public function markAsRead(Request $request)
    {
        try {
            $request->validate([
                'notification_ids' => 'required|array',
            ]);

            $user = auth()->user();
            $user->notifications()->whereIn('id', $request->notification_ids)->update(['read_at' => now()]);

            return Helper::jsonResponse(true, 'Notifications marked as read', 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return Helper::jsonErrorResponse('Validation failed: ' . $e->getMessage(), 422);
        } catch (\Exception $e) {
            return Helper::jsonErrorResponse($e->getMessage(), 500);
        }
    }

    public function delete($id)
    {
        try {
            $notification = auth()->user()->notifications()->findOrFail($id);
            $notification->delete();

            return Helper::jsonResponse(true, 'Notification deleted successfully.', 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return Helper::jsonErrorResponse('Notification not found.', 404);
        } catch (\Exception $e) {
            return Helper::jsonErrorResponse($e->getMessage(), 500);
        }
    }

    public function deleteAll()
    {
        try {
            auth()->user()->notifications()->delete();
            return Helper::jsonResponse(true, 'All notifications deleted successfully.', 200);
        } catch (\Exception $e) {
            return Helper::jsonErrorResponse($e->getMessage(), 500);
        }
    }
}
