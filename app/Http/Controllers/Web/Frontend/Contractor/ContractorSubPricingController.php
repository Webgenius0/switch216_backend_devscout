<?php

namespace App\Http\Controllers\Web\Frontend\Contractor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContractorSubPricingController extends Controller{
    public function index(){
        return view('frontend.dashboard.contractor.layouts.pricing.contractor_sub_package.index');
    }

    public function create(){
        //
    }

    public function store(Request $request){
        //
    }

    public function show(string $id){
        //
    }

    public function edit(string $id){
        //
    }

    public function update(Request $request, string $id){
        //
    }
}

