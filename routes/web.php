<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\Backend\StripePaymentController;
use App\Http\Controllers\Web\Frontend\AboutUsPageController;
use App\Http\Controllers\Web\Backend\CMS\ProviderRegisterPageController;
use App\Http\Controllers\Web\Frontend\Contractor\ContractorSubscriptionController;
use App\Http\Controllers\Web\Frontend\Customer\CustomerSettingController;
use App\Http\Controllers\Web\Frontend\ProviderRegisterPageController as ServiceProviderRegisterPageController;
use App\Http\Controllers\Web\Frontend\CarPageController;
use App\Http\Controllers\Web\Frontend\ContactPageController;
use App\Http\Controllers\Web\Frontend\Contractor\BookingContactorController;
use App\Http\Controllers\Web\Frontend\Contractor\ChatController;
use App\Http\Controllers\Web\Frontend\Contractor\ContractorDashboardController;
use App\Http\Controllers\Web\Frontend\Contractor\ContractorServiceController;
use App\Http\Controllers\Web\Frontend\Contractor\ContractorSettingController;
use App\Http\Controllers\Web\Frontend\Contractor\LiveNotificationController;
use App\Http\Controllers\Web\Frontend\Customer\AppointmentCustomerController;
use App\Http\Controllers\Web\Frontend\EmergencyPageController;
use App\Http\Controllers\Web\Frontend\HomePageController;
use App\Http\Controllers\Web\Frontend\RealEstateServiceController;
use App\Http\Controllers\Web\Frontend\RestaurantPageController;
use App\Http\Controllers\Web\Frontend\ServiceController;
use App\Services\Web\Frontend\RealStatePageService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

// Route::get('/', function () {
//     // return view('welcome');
//     return view('frontend.layouts.home.index');
// })->name('home');


Route::get('/map-api-key', function () {
    return response()->json(['key' => env('MAPTILER_API_KEY')]);
})->name('map.api.key');


Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/provider', [ServiceProviderRegisterPageController::class, 'index'])->name('provider.index');
Route::post('/serchingStatic', [HomePageController::class, 'serchingStatic'])->name('home.serchingStatic');

Route::get('/about', [AboutUsPageController::class, 'index'])->name('about');

Route::get('/contact-us', [ContactPageController::class, 'index'])->name('contact_us.index');
Route::post('/contact-us', [ContactPageController::class, 'store'])->name('contact_us.store');

//show single service with contractor profile
Route::get('/service/single/{id}', [EmergencyPageController::class, 'show'])->name('service.single_show');
//emergency page
Route::get('/services', [EmergencyPageController::class, 'index'])->name('service.emergency');
//car page
Route::get('/car-services', [CarPageController::class, 'index'])->name('service.car');
Route::get('/car-services/list', [CarPageController::class, 'carList'])->name('service.car_list');

//realState page
Route::get('/real-state-services', [RealEstateServiceController::class, 'index'])->name('service.real_state');
Route::get('/real-state-services/list', [RealEstateServiceController::class, 'realStateList'])->name('service.real_state_list');
//realState page
Route::get('/restaurant-services', [RestaurantPageController::class, 'index'])->name('service.restaurant');
Route::get('/restaurant-services/list', [RestaurantPageController::class, 'restaurantList'])->name('service.restaurant_list');

Route::get('/service-category', [ServiceController::class, 'categoryList'])->name('service.category');
Route::get('/service-sub-category/{id}', [ServiceController::class, 'subCategoryList'])->name('service.sub_category');



// Route::get('/about', function () {
//     return view(view: 'frontend.layouts.about.index');
// })->name('about');

// Route::get('/contact', function () {
//     return view(view: 'frontend.layouts.contact.index');
// })->name('contact_us');

//service all
// Route::get('/service', function () {
//     return view(view: 'frontend.layouts.service.index');
// })->name('service.index');

// Route::get('/service-category', function () {
//     return view(view: 'frontend.layouts.service.category');
// })->name('service.category');

// Route::get('/service-sub-category', function () {
//     return view(view: 'frontend.layouts.service.sub_category');
// })->name('service.sub_category');

// Route::get('/service-emergency', function () {
//     return view(view: 'frontend.layouts.service.emergency');
// })->name('service.emergency');


//food service all
// Route::get('/food', function () {
//     return view(view: 'frontend.layouts.food_service.index');
// })->name('food.index');

// Route::get('/food-details', function () {
//     return view(view: 'frontend.layouts.food_service.list');
// })->name('food.details');

// Route::get('/food-order', function () {
//     return view(view: 'frontend.layouts.food_service.details');
// })->name('food.order');


//car service all
// Route::get('/car', function () {
//     return view(view: 'frontend.layouts.car_service.index');
// })->name('car.index');

// Route::get('/car-details', function () {
//     return view(view: 'frontend.layouts.car_service.index');
// })->name('car.details');

// Route::get('/car-rental', function () {
//     return view(view: 'frontend.layouts.car_service.index');
// })->name('car.rental');

//error page
Route::get('/error-comming-soon', function () {
    return view(view: 'frontend.layouts.about.index');
})->name('error.comming_soon');

Route::get('/error-404', function () {
    return view(view: 'frontend.layouts.about.index');
})->name('error.404');


//house service all
// Route::get('/house', function () {
//     return view(view: 'frontend.layouts.house_service.index');
// })->name('house.index');

// Route::get('/house-details', function () {
//     return view(view: 'frontend.layouts.house_service.details');
// })->name('house.details');

// Route::get('/house-list', function () {
//     return view(view: 'frontend.layouts.house_service.list');
// })->name('house.list');


//provider
// Route::get('/provider/register', function () {
//     return view(view: 'frontend.layouts.provider.register');
// })->name('provider.register');

// Route::get('/provider', function () {
//     return view(view: 'frontend.layouts.provider.index');
// })->name('provider.index');

Route::get('/provider-list', function () {
    return view(view: 'frontend.layouts.provider.index');
})->name('provider.list');

// Route::get('/provider-details', function () {
//     return view(view: 'frontend.layouts.provider.details');
// })->name('provider.details');


//for customer only
Route::middleware(['auth:web', 'is_customer'])->prefix('customer')->group(function () {
    Route::get('dashboard', function () {
        return view('frontend.dashboard.customer.layouts.home.index');
    })->name('customer.dashboard');

    //profile settings
    Route::get('settings-profile', [CustomerSettingController::class, 'index'])->name('customer.settings.index');
    Route::post('settings-profile', [CustomerSettingController::class, 'updateProfile'])->name('customer.settings.update');
    Route::get('settings-password', [CustomerSettingController::class, 'password'])->name('customer.settings.password');
    Route::post('settings-password', [CustomerSettingController::class, 'passwordUpdate'])->name('customer.settings.password_update');

    // customer bookings 
    Route::get('/customer-booking', [AppointmentCustomerController::class, 'index'])->name('customer.booking.index');
    Route::get('/customer-bookings/all', [AppointmentCustomerController::class, 'getAllBooking'])->name('customer.booking.get_all');
    Route::post('/customer-booking', [AppointmentCustomerController::class, 'store'])->name('customer.booking.store');
    Route::post('/customer-booking/complete/{bookingId}', [AppointmentCustomerController::class, 'markAsComplete'])->name('customer.booking.mark_as_complete');
    Route::get('/customer-booking/cancle/{bookingId}', [AppointmentCustomerController::class, 'cancelBooking'])->name('customer.booking.cancle');
    Route::post('/customer-booking/reschedule', [AppointmentCustomerController::class, 'reSchedule'])->name('customer.booking.reschedule');

    Route::post('/customer-booking/given-review', [AppointmentCustomerController::class, 'givenReview'])->name('customer.booking.review');


});


//for contractor only
Route::middleware(['auth:web', 'is_contractor'])->prefix('contractor')->group(function () {
    Route::get('dashboard', [ContractorDashboardController::class, 'index'])->name('contractor.dashboard');
    //profile settings
    Route::get('settings-profile', [ContractorSettingController::class, 'index'])->name('contractor.settings.index');
    Route::post('settings-profile', [ContractorSettingController::class, 'updateProfile'])->name('contractor.settings.update');
    Route::get('settings-password', [ContractorSettingController::class, 'password'])->name('contractor.settings.password');
    Route::post('settings-password', [ContractorSettingController::class, 'passwordUpdate'])->name('contractor.settings.password_update');

    // manage services from contactor 
    Route::resource('services', ContractorServiceController::class)->names('contractor.services')->middleware('check_contractor_subscription');
    Route::post('services/status/{id}', [ContractorServiceController::class, 'status'])->name('contractor.services.status');
    Route::post('services/emargence/{id}', [ContractorServiceController::class, 'emargence'])->name('contractor.services.emargence');

    Route::get('/contractor-booking', [BookingContactorController::class, 'index'])->name('contractor.booking.index')->middleware('check_contractor_subscription');
    ;
    Route::get('/contractor-booking/confirm/{bookingId}', [BookingContactorController::class, 'confirmBooking'])->name('contractor.booking.confirm')->middleware('check_contractor_subscription');
    Route::get('/contractor-booking/cancle/{bookingId}', [BookingContactorController::class, 'cancleBooking'])->name('contractor.booking.cancle')->middleware('check_contractor_subscription');
    Route::get('/contractor-booking/mark-as-complete/{bookingId}', [BookingContactorController::class, 'markAsComplete'])->name('contractor.booking.mark_as_complete')->middleware('check_contractor_subscription');

    // contractor Subscription
    Route::get('/my-subscription', [ContractorSubscriptionController::class, 'index'])->name('contractor.subscription.index');
    Route::get('/my-subscription/packages', [ContractorSubscriptionController::class, 'getPakeges'])->name('contractor.subscription.packages');
    Route::post('/make-subscription/{pakageId}', [ContractorSubscriptionController::class, 'makeSubscribe'])->name('contractor.subscription.make_subscribe');
    Route::get('/create-payment-intent/{pakageId}', [StripePaymentController::class, 'createPaymentIntent'])->name('contractor.subscription.create_payment_intent');
});
Route::get('stripe/payment-success', [StripePaymentController::class, 'paymentSuccess'])->name('contractor.payment.success');
Route::get('stripe/payment-cancel', [StripePaymentController::class, 'paymentCancel'])->name('contractor.payment.cancel');

//for customer and contractor only chating
Route::middleware(['auth:web', 'is_customer_or_contractor'])->prefix('chat')->group(function () {
    Route::get('/messages', [ChatController::class, 'index'])->name('contractor.message.index');
    Route::get('/messages/chat-room', [ChatController::class, 'chatRooms'])->name('contractor.message.chat_rooms');
    Route::get('/messages/single/{chatRoomId}', [ChatController::class, 'getMessages'])->name('contractor.message.get_messages');
    Route::post('/messages/send-message/{userId}', [ChatController::class, 'sendMessage'])->name('contractor.message.send_message');
    Route::get('/messages/{serviceId}/start-chat', [ChatController::class, 'startChat'])->name('contractor.message.start_chat');
});

//for customer and contractor only notification
Route::middleware(['auth:web', 'is_customer_or_contractor'])->prefix('my-notifications')->group(function () {
    // Routes for LiveNotificationController
    Route::post('/mark-as-read', [LiveNotificationController::class, 'markAllAsRead'])->name('customer_or_contractor.notification.read');
    Route::post('/mark-as-read/single/{id}', [LiveNotificationController::class, 'markAsSingleRead'])->name('customer_or_contractor.notification.read_single');
    Route::delete('/delete/single/{id}', [LiveNotificationController::class, 'delete'])->name('customer_or_contractor.notification.delete');
    Route::delete('/delete-all', [LiveNotificationController::class, 'deleteAll'])->name('customer_or_contractor.notification.deleteall');
});


//Language translate
Route::post('/set-locale/{locale}', function ($locale) {

    //check valid lang code
    if (!in_array($locale, ['en', 'es', 'ar', 'fr'])) {
        //set default language
        App::setLocale(Config::get('app.locale'));
    } else {
        //set language
        App::setLocale($locale);
        session(['locale' => $locale]);

        // Log::info('Session Local set ::' . $locale);
    }
    return response()->noContent();
})->name('setLocale');


require __DIR__ . '/auth.php';
