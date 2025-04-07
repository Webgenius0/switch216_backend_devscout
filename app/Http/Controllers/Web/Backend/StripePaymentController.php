<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\ContractorSubscription;
use App\Models\Payment;
use App\Models\SubcriptionPackage;
use App\Models\User;
use App\Notifications\BookingNotification;
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
            Stripe::setApiKey(config('services.stripe.secret'));
            //calculation
            $amount = $package->price * 100; // total amount in cents
            $transactionId = substr(uniqid('txn_', true), 0, 10);

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
                'payment_intent_data' => [
                    'metadata' => [
                        'user_id' => $user_id,
                        'package_id' => $package->id,
                        'transaction_id' => $transactionId,
                        'payment_method' => 'stripe',
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('contractor.payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('contractor.payment.cancel'),
            ]);
            if ($session->url) {
                DB::commit();
                Log::info('Stripe checkout session created: ' . $session->id);
                return redirect()->away($session->url);
            } else {
                DB::rollBack();
                Log::info('Stripe checkout session creation failed');
                return redirect()->back()->with('error', 'Something went wrong.');
            }
        } catch (ApiErrorException $e) {
            Log::error('Stripe API error: ' . $e->getMessage());
            return redirect()->back()->with('Stripe error', 'Something went wrong.');
            // return Helper::jsonResponse(false, 'Stripe API error: ' . $e->getMessage(), 500);
        } catch (Exception $e) {
            Log::error('General error: ' . $e->getMessage());
            return redirect()->back()->with('General error:', 'Something went wrong.');
            // return Helper::jsonResponse(false, 'General error: ' . $e->getMessage(), 500);
        }
    }

    public function handleWebhook(Request $request): JsonResponse
    {
        Log::info('Stripe webhook received');

        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
            Log::info('Stripe webhook event: ' . json_encode($event));
        } catch (UnexpectedValueException $e) {
            Log::error('Stripe webhook error: ' . $e->getMessage());
            return Helper::jsonResponse(false, $e->getMessage(), 400, []);
        } catch (SignatureVerificationException $e) {
            Log::error('Stripe webhook signature error: ' . $e->getMessage());
            return Helper::jsonResponse(false, $e->getMessage(), 400, []);
        }

        try {
            DB::beginTransaction();
            switch ($event->type) {
                case 'payment_intent.succeeded':
                    $this->handlePaymentSuccess($event->data->object);
                    DB::commit();
                    return Helper::jsonResponse(true, 'Payment successful', 200, []);

                case 'payment_intent.payment_failed':
                    $this->handlePaymentFailure($event->data->object);
                    DB::commit();
                    return Helper::jsonResponse(true, 'Payment failed', 200, []);

                default:
                    return Helper::jsonResponse(true, 'Unhandled event type', 200, []);
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Stripe webhook error (handler): ' . $e->getMessage());
            return Helper::jsonResponse(false, $e->getMessage(), 500, []);
        }
    }


    protected function handlePaymentSuccess($paymentIntent): void
    {
        Log::info('Payment succeeded: ' . json_encode($paymentIntent));

        //* Create a contractor subscription
        $contractorSubscription = ContractorSubscription::create([
            'contractor_id' => $paymentIntent->metadata->user_id,
            'subscription_package_id' => $paymentIntent->metadata->package_id,
            'amount_paid' => $paymentIntent->amount / 100,
            'payment_status' => 'completed',
            'start_date' => now(),
            'end_date' => now()->addDays(SubcriptionPackage::find($paymentIntent->metadata->package_id)->days),
            'status' => 'active',
        ]);
        //* Record the successful payment in the database
        Payment::create([
            'user_id' => $paymentIntent->metadata->user_id,
            'subscription_id' => $contractorSubscription->id,
            'amount' => $paymentIntent->amount / 100,
            'transaction_id' => $paymentIntent->metadata->transaction_id,
            'payment_method' => $paymentIntent->metadata->payment_method,
            'status' => 'completed',
        ]);

        //* Send a notification to the contractor
        $contractor = User::find($paymentIntent->metadata->user_id);
        $notificationData = [
            'title' => 'Subcribe Notification',
            'message' => 'Your payment is successful',
            'url' => '#',
            'type_id' => '',
            'type' => 'Payment Notification',
            'thumbnail' => asset('backend/admin/assets/images/subcription_notification.png' ?? ''),
        ];
        // notify contractor 
        $contractor->notify(new BookingNotification($notificationData));
    }

    protected function handlePaymentFailure($paymentIntent): void
    {
        Log::error('Payment failed: ' . $paymentIntent->failure_message);
        //* Record the successful payment in the database
        $payment = Payment::create([
            'user_id' => $paymentIntent->metadata->user_id,
            'subscription_id' => $paymentIntent->metadata->package_id,
            'amount' => $paymentIntent->amount / 100,
            'transaction_id' => $paymentIntent->metadata->transaction_id,
            'payment_method' => $paymentIntent->metadata->payment_method,
            'status' => 'failed',
        ]);

        $contractor = User::find($paymentIntent->metadata->user_id);
        $notificationData = [
            'title' => 'Subcribe Notification',
            'message' => 'Your payment is failed',
            'url' => '#',
            'type_id' => '',
            'type' => 'Payment Notification',
            'thumbnail' => asset('backend/admin/assets/images/subcription_notification.png' ?? ''),
        ];
        // notify contractor 
        $contractor->notify(new BookingNotification($notificationData));
    }

    public function paymentSuccess(Request $request)
    {
        // return "Payment was successful!";
        return redirect()->route('contractor.dashboard')->with('success', 'subscription successfully.');
    }

    public function paymentCancel()
    {
        // return "Payment was canceled.";
        return redirect()->route('contractor.dashboard')->with('error', 'subscription not successfully.');
    }
}
