<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Student;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //
    public function index()
    {
        $students = Student::where('student_status', 'alumni')->get();
        return view('admin.alumnin.index', compact('students'));
    }
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.alumnin.show', compact('student'));
    }
    public function reaction(Request $request, Project $project)
    {
        if ($request->status == 'approved') {
            $request->validate([
                'price' => 'required|numeric',
                'comment' => 'nullable',
            ]);
        } else {
            $request->validate([
                'price' => 'nullable|numeric',
                'comment' => 'required',
            ]);
        }
        $project->update($request->all());

        return back()->with('success', 'Reaction submited');
    }
}
