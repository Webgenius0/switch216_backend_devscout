<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisterContractorController extends Controller
{


    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.contractor_register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        dd($request->all());
        $validateData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'location' => 'required|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'serviceDetails' => 'nullable|string',
            'serviceTitle' => 'nullable|string|max:255',
            'gallery_images.*' => 'file|mimes:jpg,jpeg,png,gif|max:2048',
            'avatar' => 'file|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        dd($validateData);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'contarctor',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('contarctor.dashboard', absolute: false));
    }

}
