<?php
namespace App\Http\Controllers\Web\Backend\CMS;

use App\Http\Controllers\Controller;


class ProviderPageProcessContainerController extends Controller{
    
    public function index(){

        return view('backend.layouts.cms.provider_register_page.process_container.index');
    }
}
