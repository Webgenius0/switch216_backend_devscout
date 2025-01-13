<?php

/**
 * Backend Admin Routes for Web Application
 *
 * This file contains all the routes for managing the admin panel, including routes for
 * dashboard, system Settings, profile Settings, daily tips, blogs, and natural care.
 * Routes are grouped under the 'admin' prefix and require authentication with the 'admin' middleware.
 */


use App\Http\Controllers\Web\Backend\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:web'])->prefix('admin')->group(function () {
    // Route for the admin dashboard
    // Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // Routes for managing guests
    Route::get('/', function () {
        return view('backend.layouts.dashboard.index');
        // return view('backend.layouts.dashboard.index');
    })->name('admin.dashboard');
    
    Route::get('settings-profile', [ProfileController::class, 'index'])->name('profile_settings.index');
    Route::post('settings-profile', [ProfileController::class, 'update'])->name('profile_settings.update');
    Route::get('settings-profile-password', [ProfileController::class, 'passwordChange'])->name('profile_settings.password_change');
    Route::post('settings-profile-password', [ProfileController::class, 'UpdatePassword'])->name('profile_settings.password');

});

// Public route for dynamic pages accessible to all users
// Route::get('/pages/{slug}', [DynamicPageController::class, 'showDaynamicPage'])->name('pages');


