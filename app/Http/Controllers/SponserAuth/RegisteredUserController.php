<?php

namespace App\Http\Controllers\SponserAuth;

use Error;
use App\Models\User;
use App\Models\Student;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use App\Models\Sponser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('student-auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:sponsers'],
            'password' => ['required', 'min:6'],
        ]);

        $request->merge([
            'password' => Hash::make($request->password),
        ]);
        $sponser = Sponser::create($request->all());

        Auth::guard('sponser')->login($sponser);

        return back();
    }
}
