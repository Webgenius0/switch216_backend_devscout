<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\Frontend\Contractor\BookingContactorController;
use App\Http\Controllers\Web\Frontend\Contractor\ChatController;
use App\Http\Controllers\Web\Frontend\Contractor\ContractorDashboardController;
use App\Http\Controllers\Web\Frontend\Contractor\ContractorServiceController;
use App\Http\Controllers\Web\Frontend\Contractor\ContractorSettingController;
use App\Http\Controllers\Web\Frontend\Customer\BookingCustomerController;
use App\Http\Controllers\Web\Frontend\EmergencyPageController;
use App\Http\Controllers\Web\Frontend\HomePageController;
use App\Http\Controllers\Web\Frontend\ServiceController;
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
Route::get('/services', [EmergencyPageController::class, 'index'])->name('service.emergency');
Route::get('/service/single/{id}', [EmergencyPageController::class, 'show'])->name('service.single_show');

Route::get('/service-category', [ServiceController::class, 'categoryList'])->name('service.category');
Route::get('/service-sub-category/{id}', [ServiceController::class, 'subCategoryList'])->name('service.sub_category');



Route::get('/about', function () {
    return view(view: 'frontend.layouts.about.index');
})->name('about');

Route::get('/contract', function () {
    return view(view: 'frontend.layouts.contract.index');
})->name('contract');

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
Route::get('/food', function () {
    return view(view: 'frontend.layouts.food_service.index');
})->name('food.index');

// Route::get('/food-details', function () {
//     return view(view: 'frontend.layouts.food_service.list');
// })->name('food.details');

// Route::get('/food-order', function () {
//     return view(view: 'frontend.layouts.food_service.details');
// })->name('food.order');


//car service all
Route::get('/car', function () {
    return view(view: 'frontend.layouts.car_service.index');
})->name('car.index');

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
Route::get('/house', function () {
    return view(view: 'frontend.layouts.house_service.index');
})->name('house.index');

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

Route::get('/provider', function () {
    return view(view: 'frontend.layouts.provider.index');
})->name('provider.index');

Route::get('/provider-list', function () {
    return view(view: 'frontend.layouts.provider.index');
})->name('provider.list');

Route::get('/provider-details', function () {
    return view(view: 'frontend.layouts.provider.details');
})->name('provider.details');


//for customer only
Route::middleware(['auth:web', 'is_customer'])->prefix('customer')->group(function () {
    Route::get('dashboard', function () {
        return view('frontend.dashboard.customer.layouts.home.index');
    })->name('customer.dashboard');
    // customer bookings 
    Route::get('/customer-booking', [BookingCustomerController::class, 'index'])->name('customer.booking.index');
    Route::get('/customer-bookings/all', [BookingCustomerController::class, 'getAllBooking'])->name('customer.booking.get_all');
    Route::post('/customer-booking', [BookingCustomerController::class, 'store'])->name('customer.booking.store');
    Route::post('/customer-booking/complete/${bookingId}', [BookingCustomerController::class, 'markAsComplete'])->name('customer.booking.mark_as_complete');
    Route::post('/customer-booking/cancle/${bookingId}', [BookingCustomerController::class, 'cancelBooking'])->name('customer.booking.cancle');
    Route::post('/customer-booking/reschedule/${bookingId}', [BookingCustomerController::class, 'reschedule'])->name('customer.booking.reschedule');
    Route::post('/customer-booking/given-review', [BookingCustomerController::class, 'givenReview'])->name('customer.booking.review');
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
    Route::resource('services', ContractorServiceController::class)->names('contractor.services');
    Route::post('services/status/{id}', [ContractorServiceController::class, 'status'])->name('contractor.services.status');
    Route::post('services/emargence/{id}', [ContractorServiceController::class, 'emargence'])->name('contractor.services.emargence');

    Route::get('/contractor-booking', [BookingContactorController::class, 'index'])->name('contractor.booking.index');

});


//for customer and contractor only
Route::middleware(['auth:web', 'is_customer_or_contractor'])->prefix('chat')->group(function () {
    Route::get('/messages', [ChatController::class, 'index'])->name('contractor.message.index');
    Route::get('/messages/chat-room', [ChatController::class, 'chatRooms'])->name('contractor.message.chat_rooms');
    Route::get('/messages/single/{chatRoomId}', [ChatController::class, 'getMessages'])->name('contractor.message.get_messages');
    Route::post('/messages/send-message/{userId}', [ChatController::class, 'sendMessage'])->name('contractor.message.send_message');
    Route::get('/messages/{serviceId}/start-chat', [ChatController::class, 'startChat'])->name('contractor.message.start_chat');
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
