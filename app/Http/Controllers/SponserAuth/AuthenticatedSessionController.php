<?php

namespace App\Http\Controllers\SponserAuth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required'],
        ]);

        $request->session()->regenerate();
        $credentials = $request->only('email', 'password');

        if (!Auth::guard('sponser')->attempt($credentials)) {

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }
        return back();
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('sponser')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('index');
    }
}
