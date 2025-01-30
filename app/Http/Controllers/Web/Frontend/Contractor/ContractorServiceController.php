<?php

namespace App\Http\Controllers\Web\Frontend\Contractor;

use App\Http\Controllers\Controller;
use App\Services\Web\Frontend\ContractorServiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractorServiceController extends Controller
{
    protected $ContractorServiceService;
    protected $user;
    public function __construct(ContractorServiceService $ContractorServiceService)
    {
        $this->ContractorServiceService = $ContractorServiceService;
        $this->user = Auth::user();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = $this->ContractorServiceService->index();
        return view('frontend.dashboard.contractor.layouts.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
