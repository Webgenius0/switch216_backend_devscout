<?php

namespace App\Services\Web\Frontend;

use Exception;
use Illuminate\Support\Facades\Auth;

class LiveNotificationService
{
    protected $user;

    /**
     * Set the user property.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = Auth::user();
    }
    /**
     * Mark all notifications as read.
     *
     * @return array
     * @throws \Exception
     */
    public function markAllAsRead()
    {
        try {
            $this->user->notifications()->update(['read_at' => now()]);
            return ['success' => true, 'message' => 'Notifications marked as read.'];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Mark a single notification as read.
     *
     * @param int $id Notification ID
     * @return array
     * @throws \Exception
     */
    public function markSingleAsRead($id)
    {
        try {
            $notification = $this->user->notifications()->findOrFail($id);
            $notification->update(['read_at' => now()]);
            return ['success' => true, 'message' => 'Notification marked as read.'];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    /**
     * Delete a single notification.
     *
     * @param int $id Notification ID
     * @return array
     * @throws \Exception
     */
    public function delete($id)
    {
        try {
            $notification = $this->user->notifications()->findOrFail($id);
            $notification->delete();
            return ['success' => true, 'message' => 'Notification deleted successfully.'];
        } catch (Exception $e) {
            throw new Exception('Something went wrong');
        }
    }
    /**
     * Delete all notifications.
     *
     * @return array
     * @throws \Exception
     */
    public function deleteAll()
    {
        try {
            $this->user->notifications()->delete();
            return ['success' => true, 'message' => 'All notifications cleared successfully.'];
        } catch (Exception $e) {
            throw new Exception('Something went wrong');
        }
    }

}