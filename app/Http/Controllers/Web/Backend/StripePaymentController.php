<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\SubcriptionPackage;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Exception\ApiErrorException;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Exception\UnexpectedValueException;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\Webhook;

class StripePaymentController extends Controller
{
    public function createPaymentIntent(Request $request, int $packageId)
    {

        try {
            DB::beginTransaction();
            // user id
            $user_id = Auth::id();
            $package = SubcriptionPackage::find($packageId);
            if (!$package) {
                flash()->error('Package not found.');
                return redirect()->back();
            }

            $stripe_secret = Stripe::setApiKey(config('services.stripe.secret'));
            //calculation
            $amount = $package->price * 100; // total amount in cents
            $transactionId = substr(uniqid('txn_', true), 0, 10);

            // // Create a payment intent with the calculated amount and metadata
            // $paymentIntent = PaymentIntent::create([
            //     'amount' => $amount,
            //     'currency' => 'usd',
            //     'metadata' => [
            //         'user_id' => $user_id,
            //         'package_id' => $package->id,
            //         'package_price' => $package->price,
            //         'package_days' => $package->days,
            //         'transaction_id' => $transactionId,
            //         'payment_method' => 'online',
            //     ],
            // ]);
            // dd($paymentIntent);
            // return Helper::jsonResponse(true, 'Payment Intent created successfully.', 200, [
            //     'client_secret' => $paymentIntent->client_secret,
            // ]);

            // Create a Stripe Checkout Session
            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $package->title ?? '',
                                'description' => 'Subscription Package - ' . $package->days . ' days',
                            ],
                            'unit_amount' => $amount,
                        ],
                        'quantity' => 1,
                    ]
                ],
                'metadata' => [
                    'user_id' => $user_id,
                    'package_id' => $package->id,
                    'transaction_id' => $transactionId,
                ],
                'mode' => 'payment',
                'success_url' => route('contractor.payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('contractor.payment.cancel'),
            ]);
            if ($session->url) {
                DB::commit();
                return redirect()->away($session->url);
            } else {
                DB::rollBack();
                return redirect()->back()->with('error', 'Something went wrong.');
            }
        } catch (ApiErrorException $e) {
            return Helper::jsonResponse(false, 'Stripe API error: ' . $e->getMessage(), 500);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'General error: ' . $e->getMessage(), 500);
        }
    }

    public function handleWebhook(Request $request): JsonResponse
    {
        //? Verify the webhook signature
        $stripe_webhook_secret = Stripe::setApiKey(config('services.stripe.webhook_secret'));

        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = $stripe_webhook_secret;

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
        } catch (UnexpectedValueException $e) {
            return Helper::jsonResponse(false, $e->getMessage(), 400, []);
        } catch (SignatureVerificationException $e) {
            return Helper::jsonResponse(false, $e->getMessage(), 400, []);
        }


        //? Handle the event based on its type
        try {
            switch ($event->type) {
                case 'payment_intent.succeeded':
                    $this->handlePaymentSuccess($event->data->object);
                    return Helper::jsonResponse(true, 'Payment successful', 200, []);

                case 'payment_intent.payment_failed':
                    $this->handlePaymentFailure($event->data->object);
                    return Helper::jsonResponse(true, 'Payment failed', 200, []);

                default:
                    return Helper::jsonResponse(true, 'Unhandled event type', 200, []);
            }
        } catch (Exception $e) {
            return Helper::jsonResponse(false, $e->getMessage(), 500, []);
        }
    }

    protected function handlePaymentSuccess($paymentIntent): void
    {
        if ($paymentIntent->metadata->payment_marge === false) {
            //* Record the successful payment in the database
            $payment = Payment::create([
                'user_id' => $paymentIntent->metadata->user_id,
                'order_id' => $paymentIntent->metadata->order_id,
                'hotel_id' => $paymentIntent->metadata->hotel_id,
                'amount' => $paymentIntent->amount / 100,
                'transaction_id' => $paymentIntent->metadata->transaction_id,
                'payment_method' => $paymentIntent->metadata->payment_method,
                'status' => 'paid',
            ]);
        }
        if ($paymentIntent->metadata->payment_marge === true) {

            $guest = User::find($paymentIntent->metadata->user_id);
            $booking = Booking::where('secure_key', $guest->used_secure_key)->where('status', 'check_in')->first();
            Log::info('payment complete is user: ' . $guest->id);
            $orders = Order::with(['payment'])
                ->where('hotel_id', $guest->hotel_id)
                ->where('booking_id', $booking->id)
                ->latest()
                ->get();
            Log::info('payment complete order:' . $orders);

            // Loop through each order
            foreach ($orders as $order) {
                // Case 1: If the order status is 'completed' and payment is null, create a payment
                if ($order->status === 'completed' && is_null($order->payment)) {
                    $transactionId = substr(uniqid('txn_', true), 0, 10);
                    $payment = Payment::create([
                        'user_id' => $order->user_id,
                        'order_id' => $order->id,
                        'hotel_id' => $guest->hotel_id,
                        'amount' => $order->total_price, // Ensure 'total_price' is correct
                        'transaction_id' => $transactionId,
                        'payment_method' => 'online',
                        'status' => 'paid',
                    ]);
                }

                // Case 2: If the order status is not 'completed' and payment status is 'paid', refund the payment
                if ($order->status !== 'completed' && $order->payment && $order->payment->status === 'paid') {
                    $order->payment->update([
                        'status' => 'refunded'
                    ]);
                }
            }
        }

        $guest = User::find($paymentIntent->metadata->user_id);
        $notificationData = [
            'message' => 'Payment is successful',
            'url' => '',
            'type' => NotificationType::PAYMENT,
            'thumbnail' => ''
        ];
        // notify guest 
        $guest->notify(new GuestRequestNotification($notificationData));

    }

    protected function handlePaymentFailure($paymentIntent): void
    {
        if ($paymentIntent->metadata->payment_marge === false) {
            //* Record the failure payment in the database
            $payment = Payment::create([
                'user_id' => $paymentIntent->metadata->user_id,
                'order_id' => $paymentIntent->metadata->order_id,
                'hotel_id' => $paymentIntent->metadata->hotel_id,
                'amount' => $paymentIntent->amount / 100,
                'transaction_id' => $paymentIntent->metadata->transaction_id,
                'payment_method' => $paymentIntent->metadata->payment_method,
                'status' => 'unpaid',
            ]);
        }

        $guest = User::find($paymentIntent->metadata->user_id);
        $notificationData = [
            'message' => 'Payment is unsuccessful',
            // 'url' => $paymentIntent->metadata->order_id ?? '',
            'url' => '',
            'type' => NotificationType::PAYMENT,
            'thumbnail' => ''
        ];
        // notify guest 
        $guest->notify(new GuestRequestNotification($notificationData));
        $firebaseTokens = FirebaseTokens::where('user_id', $guest->id)->get();

        // Now you have a collection, you can check if the collection is not empty and then get the tokens
        if (!empty($firebaseTokens)) {

            $notifyData = [
                'title' => 'Payment is unsuccessful',
                'body' => $paymentIntent->metadata->order_id
            ];
            foreach ($firebaseTokens as $tokens) {
                if (!empty($tokens->token)) {
                    $token = $tokens->token; // Pluck tokens into an array
                    // Send notifications using the token array
                    Helper::sendNotifyMobile($token, $notifyData);
                } else {
                    Log::warning('Token is missing for user: ' . $guest->id);
                }
            }
        } else {
            Log::warning('No Firebase tokens found for this user.');
        }
    }

    public function paymentSuccess(Request $request)
    {
        // return "Payment was successful!";
        return redirect()->route('contractor.dashboard')->with('success','subscription successfully.');
    }

    public function paymentCancel()
    {
        // return "Payment was canceled.";
        return redirect()->route('contractor.dashboard')->with('success','subscription not successfully.');
    }
}
