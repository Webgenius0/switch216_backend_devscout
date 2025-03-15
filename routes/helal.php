<?php

/**
 * Backend Admin Routes for Web Application
 *
 * This file contains all the routes for managing the admin panel, including routes for
 * dashboard, system Settings, profile Settings, daily tips, blogs, and natural care.
 * Routes are grouped under the 'admin' prefix and require authentication with the 'admin' middleware.
 */


use App\Http\Controllers\Web\Backend\ContractorRankingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Backend\UserController;
use App\Http\Controllers\Web\Backend\CityController;
use App\Http\Controllers\Web\Backend\ProfileController;
use App\Http\Controllers\Web\Backend\CategoryController;
use App\Http\Controllers\Web\Backend\CMS\CarPageController;
use App\Http\Controllers\Web\Backend\DynamicPageController;
use App\Http\Controllers\Web\Backend\SubCategoryController;
use App\Http\Controllers\Web\Backend\CMS\HomePageController;
use App\Http\Controllers\Web\Backend\NotificationController;
use App\Http\Controllers\Web\Backend\SystemSettingController;
use App\Http\Controllers\Web\Backend\CMS\RealEstateController;
use App\Http\Controllers\Web\Backend\CMS\RestaurantController;
use App\Http\Controllers\Web\Backend\ContactMessageController;
use App\Http\Controllers\Web\Backend\CMS\AboutUsPageController;
use App\Http\Controllers\Web\Backend\CMS\HomePageFaqContainerController;
use App\Http\Controllers\Web\Backend\CMS\ProviderRegisterPageController;
use App\Http\Controllers\Web\Backend\CMS\HomePageReviewContainerController;
use App\Http\Controllers\Web\Backend\CMS\HomePageProcessContainerController;
use App\Http\Controllers\Web\Backend\CMS\HomePageServiceContainerController;
use App\Http\Controllers\Web\Backend\CMS\ProviderPageWorkContainerController;
use App\Http\Controllers\Web\Backend\CMS\HomePageSocialLinkContainerController;
use App\Http\Controllers\Web\Backend\CMS\ProviderPageProcessContainerController;
use App\Http\Controllers\Web\Backend\CMS\HomePagePlatFormWorkContainerController;
use App\Http\Controllers\Web\Backend\CMS\HomePageProviderWorkContainerController;
use App\Http\Controllers\Web\Backend\CMS\HomePageAdvertisementContainerController;
use App\Http\Controllers\Web\Backend\RankController;

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


  // home view container cms
  Route::get('/cms/home-page/advertisement-container', [HomePageAdvertisementContainerController::class, 'index'])->name('cms.home_page.advertisement_container.index');
  Route::post('/cms/home-page/advertisement-container/update', [HomePageAdvertisementContainerController::class, 'update'])->name('cms.home_page.advertisement_container.update');


  // About 1st view About us cms
  Route::get('/cms/about-page/AboutUs-container/index', [AboutUsPageController::class, 'index'])->name('cms.about_page.about_us_container.index');
  Route::post('/cms/about-page/service-container-update', [AboutUsPageController::class, 'AboutContainerUpdate'])->name('cms.about_page.about_us_container.about_us_container_update');


  // About 2nd view About us cms
  Route::post('/cms/about-page/AboutUs-container/store', [AboutUsPageController::class, 'store'])->name('cms.about_page.about_us_container.store');
  Route::get('/cms/about-page/AboutUs-container/edit/{id}', [AboutUsPageController::class, 'edit'])->name('cms.about_page.about_us_container.edit');
  Route::put('/cms/about-page/AboutUs-container/update/{id}', [AboutUsPageController::class, 'update'])->name('cms.about_page.about_us_container.update');
  Route::post('/cms/about-page/AboutUs-container/status/{id}', [AboutUsPageController::class, 'status'])->name('cms.about_page.about_us_container.status');
  Route::delete('/cms/about-page/AboutUs-container/destroy/{id}', [AboutUsPageController::class, 'destroy'])->name('cms.about_page.about_us_container.destroy');



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

  Route::get('/cms/car-page/banner', [CarPageController::class, 'index'])->name('cms.car_page.banner.index');
  Route::post('/cms/car-page/update', [CarPageController::class, 'update'])->name('cms.car_page.banner.update');

  //! =============== Route for Restaurant Page C_M_S ----------------------------- start
  Route::get('/cms/restaurant-page/banner', [RestaurantController::class, 'index'])->name('cms.restaurant_page.banner');
  Route::post('/cms/restaurant-page/update', [RestaurantController::class, 'update'])->name('cms.restaurant_page.banner.update');

  //! =============== Route for Real Estate Page C_M_S ----------------------------- start
  Route::get('/cms/RealEstate-page/banner', [RealEstateController::class, 'index'])->name('cms.RealEstate_page.banner');
  Route::post('/cms/RealEstate-page/update', [RealEstateController::class, 'update'])->name('cms.RealEstate_page.banner.update');

  //! =============== Route for service provider Page C_M_S ----------------------------- start

  Route::get('/cms/service-page/container', [ProviderRegisterPageController::class, 'index'])->name('cms.service_page.container.index');
  Route::post('/cms/service-page/container/update', [ProviderRegisterPageController::class, 'ServiceContainerUpdate'])->name('cms.service_page.container.update');

  // service provider Image Section

  Route::post('/cms/service-page/container/image/store', [ProviderRegisterPageController::class, 'store'])->name('cms.service_page.container.image.store');
  Route::get('/cms/service-page/container/image/edit/{id}', [ProviderRegisterPageController::class, 'edit'])->name('cms.service_page.container.image.edit');
  Route::put('/cms/service-page/container/image/update/{id}', [ProviderRegisterPageController::class, 'update'])->name('cms.service_page.container.image.update');
  Route::post('/cms/service-page/container/image/status/{id}', [ProviderRegisterPageController::class, 'status'])->name('cms.service_page.container.image.status');
  Route::delete('/cms/service-page/container/image/destroy/{id}', [ProviderRegisterPageController::class, 'destroy'])->name('cms.service_page.container.image.destroy');


  //! =============== Route for service provider Page C_M_S ----------------------------- start

  Route::get('/cms/provider-page/process/container', [ProviderPageProcessContainerController::class, 'index'])->name('cms.provider_page.process.index');
  Route::post('/cms/provider-page/process/container/update', [ProviderPageProcessContainerController::class, 'ProcessContainerUpdate'])->name('cms.provider_page.process.update');

  // Provider Multiple image Section
  Route::get('/cms/provider-page/process/container/show', [ProviderPageProcessContainerController::class, 'show'])->name('cms.provider_page.process.show');
  Route::post('/cms/provider-page/process/container/store', [ProviderPageProcessContainerController::class, 'store'])->name('cms.provider_page.process.store');
  Route::get('/cms/provider-page/process/container/edit/{id}', [ProviderPageProcessContainerController::class, 'edit'])->name('cms.provider_page.process.edit');
  Route::put('/cms/provider-page/process/container/update/{id}', [ProviderPageProcessContainerController::class, 'update'])->name('cms.provider_page.process.update');
  Route::post('/cms/provider-page/process/container/status/{id}', [ProviderPageProcessContainerController::class, 'status'])->name('cms.provider_page.process.status');
  Route::delete('/cms/provider-page/process/container/destroy/{id}', [ProviderPageProcessContainerController::class, 'destroy'])->name('cms.provider_page.process.destroy');

  //! =============== Route for  provider work Page C_M_S ----------------------------- start

  Route::get('/cms/provider-page/work/container', [ProviderPageWorkContainerController::class, 'index'])->name('cms.provider_page.work.index');
  Route::post('/cms/provider-page/work/container/update', [ProviderPageWorkContainerController::class, 'update'])->name('cms.provider_page.work.update');



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

  // Route for CityController
  Route::resource('/cities', CityController::class)->names('cities');
  Route::post('/cities/status/{id}', [CityController::class, 'status'])->name('cities.status');


  //! =============== Route for Provider Rating Page ----------------------------- start
  // Route for Provider Rating Page
  Route::get('provider-rating-page', [ContractorRankingController::class, 'show'])->name('provider_rating_page.index');
  Route::post('provider-rating-page/{userId}', [ContractorRankingController::class, 'update'])->name('provider_rating_page.update');

  // Route for RankController
  Route::resource('ranks', RankController::class)->names('ranks');
  // Route::get('/rank/{userId}', [RankController::class, 'rank.index']);
  Route::post('ranks/status/{id}', [RankController::class, 'status'])->name('ranks.status');


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
