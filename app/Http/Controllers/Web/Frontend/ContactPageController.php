<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Web\Frontend\ContactService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ContactPageController extends Controller
{
    protected $contact;
    public function __construct(ContactService $contact)
    {
        $this->contact = $contact;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $systemSetting = $this->contact->index();
        return view('frontend.layouts.contact.index', compact('systemSetting'));
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            // dd($validatedData);
            $this->contact->handleContactForm($validatedData);
            flash()->success('Message sent successfully');
            return redirect()->route('contact_us.index');
        } catch (Exception $e) {
            Log::error('ContactPageController::store ' . $e->getMessage());
            flash()->error($e->getMessage());
            return redirect()->route('contact_us.index');
        }
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
