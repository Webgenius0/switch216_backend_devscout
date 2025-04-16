<?php

namespace App\Console\Commands;

use App\Models\Booking;
use App\Models\ContactorStatistic;
use App\Models\Message;
use App\Models\Review;
use App\Models\Service;
use App\Models\User;
use Exception;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Log;

class UpdateContactorStatistics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-contactor-statistics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update statistics for all contactors, including their rank, average rating, booking count, and response rate for the last 60 days.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $contractors = User::where('role', 'contractor')->get();
        Log::info('Total Contractors: ' . $contractors->count());
        foreach ($contractors as $user) {
            try {
                Log::info('Updating statistics for user ' . $user->id);

                $sixtyDaysAgo = Carbon::now()->subDays(60);
                $reviewCount = Review::where('contactor_id', $user->id)->count();

                $services = Service::where('user_id', $user->id)->get();
                $serviceIds = $services->pluck('id');

                if ($serviceIds->isEmpty()) {
                    Log::info("User {$user->id} has no services. Skipping.");
                    continue;
                }

                // Safe bookings
                $completeCount = Booking::whereIn('service_id', $serviceIds)->where('status', 'completed')->count();
                $pendingCount = Booking::whereIn('service_id', $serviceIds)->where('status', 'confirmed')->count();

                $ratings = Review::where('contactor_id', $user->id)
                    ->whereNotNull('rating')
                    ->latest()
                    ->take(50)
                    ->pluck('rating');

                $avgRating = $ratings->isNotEmpty() ? $ratings->avg() : 0;

                $last60Completed = Booking::whereIn('service_id', $serviceIds)
                    ->where('status', 'completed')
                    ->where('created_at', '>=', $sixtyDaysAgo)
                    ->count();

                $recentRatings = Review::where('contactor_id', $user->id)
                    ->whereNotNull('rating')
                    ->where('created_at', '>=', $sixtyDaysAgo)
                    ->latest()
                    ->take(50)
                    ->pluck('rating');

                $last60AvgRating = $recentRatings->isNotEmpty() ? $recentRatings->avg() : 0;

                $responseRate = $this->calculateResponseRate($user, $sixtyDaysAgo);

                // RANKING LOGIC
                if ($last60Completed >= 50 && $last60AvgRating >= 4.8 && $responseRate >= 80) {
                    $rank = 'Expert Pro';
                } elseif ($last60Completed >= 20 && $last60AvgRating >= 4.8 && $responseRate >= 60) {
                    $rank = 'Pro';
                } elseif ($last60Completed >= 5 && $last60AvgRating >= 4.5) {
                    $rank = 'Gold';
                } else {
                    $rank = 'Silver';
                }

                ContactorStatistic::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'rank' => $rank,
                        'average_rating' => round($avgRating, 2),
                        'review_count' => $reviewCount,
                        'complete_booking_count' => $completeCount,
                        'pending_booking_count' => $pendingCount,
                        'last_60_days_complete_booking_count' => $last60Completed,
                        'last_60_days_average_rating' => round($last60AvgRating, 2),
                        'last_60_days_response_rate' => round($responseRate, 2),
                    ]
                );

                Log::info("UpdateContactorStatistics::handle - Updated stats for user {$user->id}");
            } catch (Exception $e) {
                Log::error("UpdateContactorStatistics::handle - Failed for user {$user->id}: " . $e->getMessage());
            }
        }
    }


    private function calculateResponseRate(User $user, $since)
    {
        try {
            $threshold = 5; // 5 minutes threshold for fast reply
            $messages = Message::where('receiver_id', $user->id)
                ->where('sent_at', '>=', $since)
                ->orderBy('sent_at')
                ->get();

            // Skip if there are no messages
            if ($messages->isEmpty()) {
                Log::info("User {$user->id} has no messages in the last 60 days. Skipping response rate calculation.");
                return 0;
            }

            $fastReplies = 0;

            foreach ($messages as $msg) {
                // Find the first reply from the user in the same chat room after this message
                $reply = Message::where('chat_room_id', $msg->chat_room_id)
                    ->where('sender_id', $user->id)
                    ->where('receiver_id', $msg->sender_id)
                    ->where('sent_at', '>', $msg->sent_at)
                    ->orderBy('sent_at')
                    ->first();

                // Count as a fast reply if the reply exists and was within the threshold time
                if ($reply && $reply->sent_at->diffInMinutes($msg->sent_at) <= $threshold) {
                    $fastReplies++;
                }
            }

            // If there were no fast replies, the response rate is 0%
            if ($fastReplies === 0) {
                return 0;
            }

            // Calculate and return the response rate as a percentage
            return round(($fastReplies / $messages->count()) * 100, 2);

        } catch (\Throwable $e) {
            Log::error("UpdateContactorStatistics::calculateResponseRate - Failed to calculate response rate for user {$user->id}: " . $e->getMessage());
            return 0;
        }
    }


}
