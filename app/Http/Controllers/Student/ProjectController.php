<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //
    public function index()
    {
        $project = Project::where('student_id', auth()->guard('student')->id())->first();
        return view('student.project.index', compact('project'));
    }
    public function create()
    {
        return view('student.project.create');
    }
    public function edit(Project $project)
    {
        return view('student.project.edit', compact('project'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'proposalFile' => 'required',
            'prototypeFile' => 'required',
            'visible' => 'required',
        ]);

        if ($request->hasFile('proposalFile')) {
            $proposalFile = $request->file('proposalFile')->store('project', 'public');
            $request->merge(['proposal_file' => $proposalFile]);
        }
        if ($request->hasFile('prototypeFile')) {
            $prototypeFile = $request->file('prototypeFile')->store('project', 'public');
            $request->merge(['prototype_file' => $prototypeFile]);
        }
        $request->merge(['student_id' => auth()->guard('student')->id(), 'department_id' => auth()->guard('student')->user()->department_id]);

        try {
            Project::create($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            // dd($th->getMessage());
            return back()->with('warning', $th->getMessage());
        }
        return to_route('student.project.index')->with('message', 'Project registered successfully');
    }
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'proposalFile' => 'nullable',
            'prototypeFile' => 'nullable',
            'visible' => 'required',
        ]);

        if ($request->hasFile('proposalFile')) {
            $proposalFile = $request->file('proposalFile')->store('project', 'public');
            $request->merge(['proposal_file' => $proposalFile]);
        }
        if ($request->hasFile('prototypeFile')) {
            $prototypeFile = $request->file('prototypeFile')->store('project', 'public');
            $request->merge(['prototype_file' => $prototypeFile]);
        }
        $request->merge(['student_id' => auth()->guard('student')->id()]);

        try {
            $project->update($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            // dd($th->getMessage());
            return back()->with('warning', $th->getMessage());
        }
        return to_route('student.project.index')->with('message', 'Project registered successfully');
    }
}
