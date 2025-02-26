<?php

namespace App\Services\Web\Frontend;

use App\Helpers\Helper;
use App\Models\ContactUs;
use App\Models\SystemSetting;
use App\Models\User;
use App\Notifications\ContactMessageNotification;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContactService
{
    /**
     * Fetch all resources.
     *
     * @return mixed
     */
    public function index()
    {
        try {
            $systemInfo = SystemSetting::first();
            return $systemInfo;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function handleContactForm($validatedData)
    {
        try {
            DB::beginTransaction();

            // Check for duplicate message submission within 24 hours
            $this->checkDuplicateMessage($validatedData['email']);

            // Create the contact message
            $contactMessage = ContactUs::create($validatedData);

            // Send notification to admins
            $this->sendAdminNotification($contactMessage);

            DB::commit();

            return $contactMessage;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function checkDuplicateMessage($email)
    {
        $lastMessage = ContactUs::where('email', $email)
            ->latest()
            ->first();

        if ($lastMessage) {
            $lastSentTime = $lastMessage->created_at;
            $currentTime = now();

            if ($lastSentTime->diffInHours($currentTime) < 24) {
                throw new Exception('You have already sent a message in the last 24 hours. Please wait before sending another one.');
            }
        }
    }

    private function sendAdminNotification(ContactUs $contactMessage)
    {
        $adminUsers = User::where('role', 'admin')->where('status', 'active')->get();

        $notificationData = [
            'title' => 'A new Contact Message has been submitted.',
            'message' => $contactMessage->message,
            'url' => route('admin_contact_us.index'),
            'type' => 'Contact Message',
            'thumbnail' => asset('backend/admin/assets/images/messages_user.png' ?? ''),
        ];

        foreach ($adminUsers as $admin) {
            $admin->notify(new ContactMessageNotification($notificationData));
            Log::info('Notification sent to admin: ' . $admin->name);
        }
    }
}