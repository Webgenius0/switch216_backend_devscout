<?php

/**
 * Backend Admin Routes for Web Application
 *
 * This file contains all the routes for managing the admin panel, including routes for
 * dashboard, system Settings, profile Settings, daily tips, blogs, and natural care.
 * Routes are grouped under the 'admin' prefix and require authentication with the 'admin' middleware.
 */


use Illuminate\Support\Facades\Route;

Route::middleware(['auth:web'])->prefix('admin')->group(function () {
    // Route for the admin dashboard
    // Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // Routes for managing guests
    Route::get('/', function () {
        return view('backend.layouts.dashboard.index');
        // return view('backend.layouts.dashboard.index');
    })->name('admin.dashboard');

});

// Public route for dynamic pages accessible to all users
// Route::get('/pages/{slug}', [DynamicPageController::class, 'showDaynamicPage'])->name('pages');


