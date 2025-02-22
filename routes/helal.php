<?php

/**
 * Backend Admin Routes for Web Application
 *
 * This file contains all the routes for managing the admin panel, including routes for
 * dashboard, system Settings, profile Settings, daily tips, blogs, and natural care.
 * Routes are grouped under the 'admin' prefix and require authentication with the 'admin' middleware.
 */


use App\Http\Controllers\Web\Backend\CategoryController;
use App\Http\Controllers\Web\Backend\CMS\CarController;
use App\Http\Controllers\Web\Backend\CMS\HomePageController;
use App\Http\Controllers\Web\Backend\CMS\HomePageFaqContainerController;
use App\Http\Controllers\Web\Backend\CMS\HomePagePlatFormWorkContainerController;
use App\Http\Controllers\Web\Backend\CMS\HomePageProcessContainerController;
use App\Http\Controllers\Web\Backend\CMS\HomePageProviderWorkContainerController;
use App\Http\Controllers\Web\Backend\CMS\HomePageReviewContainerController;
use App\Http\Controllers\Web\Backend\CMS\HomePageServiceContainerController;
use App\Http\Controllers\Web\Backend\CMS\HomePageSocialLinkContainerController;
use App\Http\Controllers\Web\Backend\ContactMessageController;
use App\Http\Controllers\Web\Backend\DynamicPageController;
use App\Http\Controllers\Web\Backend\NotificationController;
use App\Http\Controllers\Web\Backend\ProfileController;
use App\Http\Controllers\Web\Backend\SubCategoryController;
use App\Http\Controllers\Web\Backend\SystemSettingController;
use App\Http\Controllers\Web\Backend\UserController;
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


    //! =============== Route for Home Page C_M_S ----------------------------- start

    // home banner container cms
    Route::resource('/cms/home-page/banner', HomePageController::class)->names(names: 'cms.home_page.banner');
    Route::post('/cms/home-page/banner/status/{id}', [HomePageController::class, 'status'])->name('cms.home_page.banner.status');

    // home service container cms 
    Route::resource('/cms/home-page/service-container', HomePageServiceContainerController::class)->names(names: 'cms.home_page.service_container');
    Route::Post('/cms/home-page/service-container-update', [HomePageServiceContainerController::class, 'ServiceContainerUpdate'])->name('cms.home_page.service_container.service_container_update');
    Route::post('/cms/home-page/service-container/status/{id}', [HomePageServiceContainerController::class, 'status'])->name('cms.home_page.service_container.status');

    // home process container cms 
    Route::resource('/cms/home-page/process-container', HomePageProcessContainerController::class)->names(names: 'cms.home_page.process_container');
    Route::Post('/cms/home-page/process-container-update', [HomePageProcessContainerController::class, 'ProcessContainerUpdate'])->name('cms.home_page.process_container.process_container_update');
    Route::post('/cms/home-page/process-container/status/{id}', [HomePageProcessContainerController::class, 'status'])->name('cms.home_page.process_container.status');

    // home platform work container cms 
    Route::resource('/cms/home-page/platform-work-container', HomePagePlatFormWorkContainerController::class)->names(names: 'cms.home_page.platform_work_container');
    Route::Post('/cms/home-page/platform-work-container-update', [HomePagePlatFormWorkContainerController::class, 'PlatFormWorkContainerUpdate'])->name('cms.home_page.platform_work_container.platform_work_container_update');
    Route::post('/cms/home-page/platform-work-container/status/{id}', [HomePagePlatFormWorkContainerController::class, 'status'])->name('cms.home_page.platform_work_container.status');

    // home provider work container  cms 
    Route::get('/cms/home-page/provider-work-container', [HomePageProviderWorkContainerController::class, 'index'])->name('cms.home_page.provider_work_container.index');
    Route::Post('/cms/home-page/provider-work-container-update', [HomePageProviderWorkContainerController::class, 'ProviderWorkContainerUpdate'])->name('cms.home_page.provider_work_container.provider_work_container_update');

    // home Review container  cms 
    Route::get('/cms/home-page/review-container', [HomePageReviewContainerController::class, 'index'])->name('cms.home_page.review_container.index');
    Route::Post('/cms/home-page/review-user-container-update', [HomePageReviewContainerController::class, 'ReviewUserContainerUpdate'])->name('cms.home_page.review_container.review_user_container_update');
    Route::Post('/cms/home-page/review-provider-container-update', [HomePageReviewContainerController::class, 'ReviewProviderContainerUpdate'])->name('cms.home_page.review_container.review_provide_container_update');

    // faq container cms 
    Route::resource('/cms/home-page/faq-container', HomePageFaqContainerController::class)->names(names: 'cms.home_page.faq_container');
    Route::Post('/cms/home-page/faq-container-update', [HomePageFaqContainerController::class, 'FaqContainerUpdate'])->name('cms.home_page.faq_container.faq_container_update');
    Route::post('/cms/home-page/faq-container/status/{id}', [HomePageFaqContainerController::class, 'status'])->name('cms.home_page.faq_container.status');
    //! ============= Route for Home Page C_M_S ----------------------------- end

    // footer social links and image cms
    Route::resource('/cms/home-page/social-link', HomePageSocialLinkContainerController::class)->names(names: 'cms.home_page.social_link');
    Route::post('/cms/home-page/social-link/status/{id}', [HomePageSocialLinkContainerController::class, 'status'])->name('cms.home_page.social_link.status');


    //! =============== Route for Care Page C_M_S ----------------------------- start

    Route::get('/cms/car-page/banner',[CarController::class,'index'])->name('cms.car_page.index');


    // ==================================== App route  start===========================================================

    // Route for UserController
    Route::resource('/user-list', UserController::class)->names('user-list');
    Route::post('/user-list/status/{id}', [UserController::class, 'status'])->name('user-list.status');

    //category
    Route::resource('categories', CategoryController::class)->names(names: 'category');
    Route::post('categories/status/{id}', [CategoryController::class, 'status'])->name('category.status');

    //category
    Route::resource('sub-categories', SubCategoryController::class)->names(names: 'sub_category');
    Route::post('sub-categories/status/{id}', [SubCategoryController::class, 'status'])->name('sub_category.status');

    // Routes for NotificationController
    Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notification.read');
    Route::post('/notifications/mark-as-read/single/{id}', [NotificationController::class, 'markAsSingleRead'])->name('notification.read_single');
    Route::delete('/notifications/{id}', [NotificationController::class, 'delete'])->name('notification.delete');
    Route::delete('/notifications', [NotificationController::class, 'deleteAll'])->name('notification.deleteall');

    Route::get('/contact-us-message', [ContactMessageController::class, 'index'])->name('admin_contact_us.index');
    Route::delete('/contact-us-message/{id}', [ContactMessageController::class, 'destroy'])->name('admin_contact_us.destroy');
    // ==================================== App route  end===========================================================


});


// Public route for dynamic pages accessible to all users
Route::get('/pages/{slug}', [DynamicPageController::class, 'showDaynamicPage'])->name('pages');



