<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return view('frontend.layouts.home.index');
})->name('home');

Route::get('/about', function () {
    return view(view: 'frontend.layouts.about.index');
})->name('about');

Route::get('/contract', function () {
    return view(view: 'frontend.layouts.contract.index');
})->name('contract');

//service all
Route::get('/service', function () {
    return view(view: 'frontend.layouts.service.index');
})->name('service.index');

Route::get('/service-category', function () {
    return view(view: 'frontend.layouts.service.category');
})->name('service.category');

Route::get('/service-sub-category', function () {
    return view(view: 'frontend.layouts.service.sub_category');
})->name('service.sub_category');

Route::get('/service-emergency', function () {
    return view(view: 'frontend.layouts.service.emergency');
})->name('service.emergency');


//food service all
Route::get('/food', function () {
    return view(view: 'frontend.layouts.food_service.index');
})->name('food.index');

Route::get('/food-details', function () {
    return view(view: 'frontend.layouts.food_service.list');
})->name('food.details');

Route::get('/food-order', function () {
    return view(view: 'frontend.layouts.food_service.details');
})->name('food.order');


//car service all
Route::get('/car', function () {
    return view(view: 'frontend.layouts.car_service.index');
})->name('car.index');

Route::get('/car-details', function () {
    return view(view: 'frontend.layouts.car_service.index');
})->name('car.details');

Route::get('/car-rental', function () {
    return view(view: 'frontend.layouts.car_service.index');
})->name('car.rental');

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

Route::get('/house-details', function () {
    return view(view: 'frontend.layouts.house_service.details');
})->name('house.details');

Route::get('/house-list', function () {
    return view(view: 'frontend.layouts.house_service.list');
})->name('house.list');


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



Route::get('/contractor-dashboard', function () {
    return view('frontend.dashboard.layouts.contractor.index');
})->middleware(['auth', 'verified'])->name('contractor.dashboard');


Route::get('/customer-dashboard', function () {
    return view('frontend.dashboard.layouts.customer.index');
})->middleware(['auth', 'verified'])->name('customer.dashboard');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
