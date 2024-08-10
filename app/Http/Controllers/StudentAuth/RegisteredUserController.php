<?php

namespace App\Http\Controllers\StudentAuth;

use Error;
use App\Models\User;
use App\Models\Student;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'exists:students,email'],
            'reg_number' => ['required', 'exists:students,reg_number'],
            'password' => ['required', 'min:6'],
        ]);

        $student = Student::where('email', $request->email)->where('reg_number', $request->reg_number)->first();
        if (!$student) {
            throw ValidationException::withMessages([
                'email' =>  'Email and reg number does\'t match',
            ]);
        }
        $student->update([
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('student')->login($student);

        return redirect(RouteServiceProvider::STUDENT_HOME);
    }
}
