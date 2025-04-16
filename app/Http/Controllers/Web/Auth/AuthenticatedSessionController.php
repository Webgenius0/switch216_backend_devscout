<?php

namespace App\Http\Controllers\Web\Auth;

use App\Enums\Page;
use App\Enums\Section;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\CMS;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $LoginVideoContainer = CMS::where('page', Page::LoginPage)->where('section', Section::LoginVideoContainer)->select('image')->first();
        return view('auth.login', compact('LoginVideoContainer'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        // Authenticate the user
        $request->authenticate();

        // Retrieve the authenticated user
        $user = auth()->user();

        // if ($user->status == 'inactive') {
        //     Auth::guard('web')->logout();
        //     $request->session()->invalidate();

        //     $request->session()->regenerateToken();
        //     flash()->error('your account is not active.');
        //     return redirect('/login');
        // }
        // Check the user's role
        if ($user->role === 'admin') {
            flash()->success('Login successfully.');
            // Redirect to admin dashboard
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'customer') {
            flash()->success('Login successfully.');
            // Redirect to user dashboard
            return redirect()->route('customer.dashboard');
        } elseif ($user->role === 'contractor') {
            flash()->success('Login successfully.');
            // Redirect to user dashboard
            return redirect()->route('contractor.dashboard');
        }

        $request->session()->regenerate();
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        // flash()->success('Logout successfully.');
        return redirect('/');
    }
}
