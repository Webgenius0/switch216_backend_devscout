<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_name',
        'email',
        'phone',
        'avatar',
        'gender',
        'instagram_social_link',
        'password',
        'otp',
        'reset_password_token',
        'reset_password_token_expire_at',
        'otp_expires_at',
        'remember_token',
        'email_verified_at',
        'last_seen',
        'created_at',
        'updated_at',
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'otp',
        'otp_expires_at',
        'email_verified_at',
        'reset_password_token',
        'reset_password_token_expire_at',
        'is_otp_verified',
        'created_at',
        'updated_at',
        'role',
        'status',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'otp_expires_at' => 'datetime',
            'is_otp_verified' => 'boolean',
            'reset_password_token_expires_at' => 'datetime',
            'last_seen' => 'datetime',
            'password' => 'hashed'
        ];
    }

    public function getAvatarAttribute($value): string|null
    {
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }
        // Check if the request is an API request
        if (request()->is('api/*') && !empty($value)) {
            // Return the full URL for API requests
            return url($value);
        }

        // Return only the path for web requests
        return $value;
    }


    /**
     * Get the services created by the user (contractor).
     */
    public function services()
    {
        return $this->hasMany(Service::class, 'user_id');
    }

    /**
     * Get the bookings made by the user (customer).
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }


    /**
     * Get the addresses associated with the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userAddresses()
    {
        return $this->hasMany(UserAddress::class, 'user_id');
    }


    /**
     * Get the contractor ranking associated with the user.
     */
    public function contractorRanking()
    {
        return $this->hasOne(ContractorRanking::class, 'user_id');
    }



    /**
     * Count the completed bookings for the user.
     */
    public function completedBookingsCount()
    {
        return $this->bookings()->where('status', 'completed')->count();
    }

    /**
     * Count the pending bookings for the user.
     */
    public function pendingBookingsCount()
    {
        return $this->bookings()->where('status', 'pending')->count();
    }

    /**
     * Count the reviews made by the user.
     */
    // public function reviewsCount()
    // {
    //     return $this->hasMany(Review::class, 'contactor_id')->count();
    // }


    public function contractorSubscriptions()
    {
        return $this->hasMany(ContractorSubscription::class, 'contractor_id');
    }

    public function getUserSubscriptionRemainingDays()
    {
        $latestSubscription = $this->contractorSubscriptions()
            ->where('status', 'active')
            ->where('end_date', '>=', Carbon::now())
            ->orderByDesc('end_date')
            ->first();

        if (!$latestSubscription) {
            return '0 days, 0 hours, 0 minutes'; // No active subscription
        }

        $now = Carbon::now();
        $end = Carbon::parse($latestSubscription->end_date); // ensure it's a Carbon instance

        if ($now->greaterThanOrEqualTo($end)) {
            return '0 days, 0 hours, 0 minutes';
        }

        $totalMinutes = $now->diffInMinutes($end);

        $days = floor($totalMinutes / (60 * 24));
        $hours = floor(($totalMinutes % (60 * 24)) / 60);
        $minutes = $totalMinutes % 60;

        return "{$days} days, {$hours} hours, {$minutes} minutes";
    }



    public function getContactorProfileCounter()
    {
        try {
            $sixtyDaysAgo = Carbon::now()->subDays(60);
            // dd($sixtyDaysAgo);
            $ContactorReviewCount = Review::where('contactor_id', $this->id)->count();
            $services = Service::where('user_id', $this->id)->get();

            $serviceIds = $services->pluck('id');

            $ContactorCompleteBookingCount = Booking::whereIn('service_id', $serviceIds)
                ->where('status', 'completed')
                ->count();

            $ContactorPendingBookingCount = Booking::whereIn('service_id', $serviceIds)
                ->where('status', 'confirmed')
                ->count();

            $averageRating = Review::where('contactor_id', $this->id)
                ->whereNotNull('rating')
                ->latest() // order by created_at descending
                ->take(50)
                ->pluck('rating') // get only the rating values
                ->avg(); // compute average

            // LAST 60 DAYS CALCULATIONS
            $last60DaysCompleteBookingCount = Booking::whereIn('service_id', $serviceIds)
                ->where('status', 'completed')
                ->where('created_at', '>=', $sixtyDaysAgo)
                ->count();

            $last60DaysAverageRating = Review::where('contactor_id', $this->id)
                ->whereNotNull('rating')
                ->latest()
                ->where('created_at', '>=', $sixtyDaysAgo)
                ->take(50)
                ->pluck('rating')
                ->avg();
            $last60daysResponseRate = $this->getResponseRateAttribute();
            Log::info('last60daysResponseRate' . $last60daysResponseRate);
            // dd($last60daysResponseRate);
            // RANK CALCULATION
            if ($last60DaysCompleteBookingCount >= 50 && $last60DaysAverageRating >= 4.8 && $last60daysResponseRate >= 80) {
                $rank = 'Expert Pro';
            } elseif ($last60DaysCompleteBookingCount >= 20 && $last60DaysAverageRating >= 4.8 && $last60daysResponseRate >= 60) {
                $rank = 'Pro';
            } elseif ($last60DaysCompleteBookingCount >= 5 && $last60DaysAverageRating >= 4.5) {
                $rank = 'Gold';
            } else {
                $rank = 'Silver';
            }

            return [
                'contactor_ranking_tag' => $rank,
                'contactor_average_rating' => round($averageRating ?? 0, 2),
                'client_review_count' => $ContactorReviewCount,
                'complete_booking_count' => $ContactorCompleteBookingCount,
                'pending_booking_count' => $ContactorPendingBookingCount,

                // LAST 60 DAYS DATA
                'last_60_days_complete_booking_count' => $last60DaysCompleteBookingCount,
                'last_60_days_average_rating' => round($last60DaysAverageRating ?? 0, 2),
                'last_60_days_response_rate' => round($last60daysResponseRate ?? 0, 2),
            ];
        } catch (Exception $e) {
            Log::error('Something went wrong: ' . $e->getMessage());
        }
    }


    public function getResponseRateAttribute()
    {
        $sixtyDaysAgo = now()->subDays(60);
        $thresholdMinutes = 5; // 5 minutes under reply

        // All messages received by contractor in last 60 days
        $receivedMessages = Message::where('receiver_id', $this->id)
            ->where('sent_at', '>=', $sixtyDaysAgo)
            ->orderBy('sent_at')
            ->get();

        $fastReplyCount = 0;

        foreach ($receivedMessages as $message) {
            // Find the first reply from this user in the same chat room after this message
            $reply = Message::where('chat_room_id', $message->chat_room_id)
                ->where('sender_id', $this->id)
                ->where('receiver_id', $message->sender_id)
                ->where('sent_at', '>', $message->sent_at)
                ->orderBy('sent_at')
                ->first();

            if ($reply) {
                $responseTimeMinutes = $reply->sent_at->diffInMinutes($message->sent_at);

                if ($responseTimeMinutes <= $thresholdMinutes) {
                    $fastReplyCount++;
                }
            }
        }

        $totalReceived = $receivedMessages->count();

        if ($totalReceived === 0) {
            return 100; // or 0 — depends on your logic
        }
        // dd(round(($fastReplyCount / $totalReceived) * 100, 2));
        return round(($fastReplyCount / $totalReceived) * 100, 2);
    }






}
