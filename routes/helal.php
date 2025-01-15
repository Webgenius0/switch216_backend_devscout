<?php

/**
 * Backend Admin Routes for Web Application
 *
 * This file contains all the routes for managing the admin panel, including routes for
 * dashboard, system Settings, profile Settings, daily tips, blogs, and natural care.
 * Routes are grouped under the 'admin' prefix and require authentication with the 'admin' middleware.
 */


use App\Http\Controllers\Web\Backend\CMS\HomePageController;
use App\Http\Controllers\Web\Backend\CMS\HomePagePlatFormWorkContainerController;
use App\Http\Controllers\Web\Backend\CMS\HomePageProcessContainerController;
use App\Http\Controllers\Web\Backend\CMS\HomePageServiceContainerController;
use App\Http\Controllers\Web\Backend\DynamicPageController;
use App\Http\Controllers\Web\Backend\ProfileController;
use App\Http\Controllers\Web\Backend\SystemSettingController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:web', 'role_check'])->prefix('admin')->group(function () {
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

    // Route for system settings index
    Route::get('system-settings', [SystemSettingController::class, 'index'])->name('system_settings.index');

    // Route for updating system settings
    Route::post('system-settings-update', [SystemSettingController::class, 'update'])->name('system_settings.update');

    // Mail Settings index
    Route::get('system-settings-mail', [SystemSettingController::class, 'mailSettingGet'])->name('system_settings.mail_get');
    // Mail Settings routes
    Route::post('system-settings-mail', [SystemSettingController::class, 'mailSettingUpdate'])->name('system_settings.mail');

    // Routes for DynamicPageController
    Route::resource('/dynamic-page', DynamicPageController::class)->names('dynamic_page');
    Route::post('/dynamic-page/status/{id}', [DynamicPageController::class, 'status'])->name('dynamic_page.status');


    // cms all-------------------------------------------------
    // cms all-------------------------------------------------


    //! Route for Home Page C_M_S 
    // Route::controller(HomePageController::class)->group(function () {
    //     // Routes for displaying sections
    //     Route::get('/cms/home-page/banner', 'index')->name('cms.home_page.banner');
    //     Route::post('/cms/home-page/banner', 'store')->name('cms.home_page.banner.store');
    //     Route::patch('/cms/home-page/banner-update', 'update')->name('cms.home_page.banner.update');
    // });
    Route::resource('/cms/home-page/banner', HomePageController::class)->names(names: 'cms.home_page.banner');
    Route::post('/cms/home-page/banner/status/{id}', [HomePageController::class, 'status'])->name('cms.home_page.banner.status');

    // home service container cms 
    Route::resource('/cms/home-page/service-container', HomePageServiceContainerController::class)->names(names: 'cms.home_page.service_container');
    Route::Post('/cms/home-page/service-container-update', [HomePageServiceContainerController::class, 'ServiceContainerUpdate'])->name('cms.home_page.service_container.service_container_update');
    Route::post('/cms/home-page/service-container/status/{id}', [HomePageServiceContainerController::class, 'status'])->name('cms.home_page.service_container.status');

    // home process container cms 
    Route::resource('/cms/home-page/process-container', HomePageProcessContainerController::class)->names(names: 'cms.home_page.process_container');
    Route::Post('/cms/home-page/process-container-update', [HomePageProcessContainerController::class, 'processContainerUpdate'])->name('cms.home_page.process_container.process_container_update');
    Route::post('/cms/home-page/process-container/status/{id}', [HomePageProcessContainerController::class, 'status'])->name('cms.home_page.process_container.status');

    // home platform work container container cms 
    Route::resource('/cms/home-page/platform-work-container', HomePagePlatFormWorkContainerController::class)->names(names: 'cms.home_page.platform_work_container');
    Route::Post('/cms/home-page/platform-work-container-update', [HomePagePlatFormWorkContainerController::class, 'PlatFormWorkContainerUpdate'])->name('cms.home_page.platform_work_container.platform_work_container_update');
    Route::post('/cms/home-page/platform-work-container/status/{id}', [HomePagePlatFormWorkContainerController::class, 'status'])->name('cms.home_page.platform_work_container.status');
});

// Public route for dynamic pages accessible to all users
Route::get('/pages/{slug}', [DynamicPageController::class, 'showDaynamicPage'])->name('pages');



