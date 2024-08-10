<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Models\Department;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $departments = Department::all();

        return view('admin.students', compact('departments'));
    }

    public function students()
    {
        //
        $collection = Student::orderByDesc('id')->get();
        return StudentResource::collection($collection);
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
        $request->validate([
            'name' => 'required|string|min:4',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|unique:students,phone',
            'department_id' => 'required',
            'option' => 'required',
            'academic_year' => [
                'required',
                'regex:/^\d{4} - \d{4}$/',
            ],
        ]);
        $studentId = str_pad(Student::max('id') + 1, 5, '0', STR_PAD_LEFT);
        $request->merge(['reg_number' => date('y') . '/' . $studentId]);

        try {
            Student::create($request->all());
            return back()->with('message', 'students Added Succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|min:4',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'required|unique:students,phone,' . $student->id,
            'department_id' => 'required',
            'option' => 'required',
            'academic_year' => [
                'required',
                'regex:/^\d{4} - \d{4}$/',
            ],
        ]);
        if ($request->completion_date) {
            $request->merge([
                'completion_date' => $request->completion_date,
                'student_status' => 'alumni',
            ]);
        }

        try {
            $student->update($request->all());
            return back()->with('message', 'Student updated succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
