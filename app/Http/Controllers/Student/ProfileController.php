<?php

namespace App\Http\Controllers\Student;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class ProfileController extends Controller
{
    //
    public function edit()
    {
        $student = auth()->guard('student')->user();
        // dd($student);
        return view('student.profile', [
            'student' => $student,
        ]);
    }
    public function update(Request $request,)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'phone' => 'required',
            'biography' => 'nullable',
            'image_file' => 'nullable|mimes:jpeg,jpg,png',
            'whatsapp_number' => 'nullable',
            'call_number' => 'nullable',
        ]);

        if ($request->hasFile('image_file')) {
            $image_file = $request->file('image_file')->store('profile', 'public');
            $request->merge(['profile_image' => $image_file]);
        }


        try {
            Student::find(auth()->guard('student')->id())->update($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
            return back()->with('warning', $th->getMessage());
        }
        return back()->with('message', 'Profile updated successfully');
    }
    public function password_store(Request $request)
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        Student::find(auth()->guard('student')->id())->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
