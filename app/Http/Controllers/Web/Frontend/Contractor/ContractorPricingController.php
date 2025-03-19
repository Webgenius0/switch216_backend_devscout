<?php

namespace App\Http\Controllers\Web\Frontend\Contractor;

use App\Http\Controllers\Controller;
use App\Models\ContractorSubscriptionPackage;
use Illuminate\Http\Request;

class ContractorPricingController extends Controller{
    public function index(){

        $pricing = ContractorSubscriptionPackage::where('status','=','active')->get();
        return view('frontend.dashboard.contractor.layouts.pricing.contractor_package.index',compact('pricing'));
    }

    public function create(){
        
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

