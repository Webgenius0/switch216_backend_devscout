<?php

namespace App\Http\Controllers\Web\Backend\CMS;

use App\Http\Controllers\Controller;

class CarController extends Controller{


    public function index(){
        
        return view('backend.layouts.cms.car_page.banner.index');
    }


}