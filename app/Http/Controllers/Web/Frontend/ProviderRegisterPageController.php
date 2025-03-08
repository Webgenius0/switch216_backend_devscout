<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CMS;
use Illuminate\Http\Request;

class ProviderRegisterPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ServiceProvider_container = CMS::where('section', 'service_provider_container')->where('page', 'service_register_page')->where('status', 'active')->first();

        $ServiceProvider_container_image = CMS::where('section', 'service_provider_image_container')
            ->where('page', 'service_register_page')
            ->where('status', 'active')
            ->take(4)
            ->get();

        $ProviderProcess_container = CMS::where('section', 'provider_process_container')->where('page', 'service_register_page')
            ->where('status', 'active')->first();

        $provider_process_image_container = CMS::where('section', 'provider_process_image_container')->where('page', 'service_register_page')
            ->where('status', 'active')->first();
        $provider_process_image_container_content = CMS::where('section', 'provider_process_image_container')->where('page', 'service_register_page')
            ->where('status', 'active')->skip(1)->take(3)->get();


        $provider_work_container = CMS::where('section', 'provider_work_container')->where('page', 'service_register_page')->where('status', 'active')->first();



        return view("frontend.layouts.provider.index", compact(
            'ServiceProvider_container',
            'ServiceProvider_container_image',
            'ProviderProcess_container',
            'provider_process_image_container',
            'provider_process_image_container_content',
            'provider_work_container'
        ));
    }
}
