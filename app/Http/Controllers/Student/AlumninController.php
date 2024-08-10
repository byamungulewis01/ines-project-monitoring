<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class AlumninController extends Controller
{
    //
    public function index()
    {
        $students = Student::where('student_status', 'alumni')->get();
        return view('student.alumnin.index', compact('students'));
    }
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('student.alumnin.show', compact('student'));
    }
}
