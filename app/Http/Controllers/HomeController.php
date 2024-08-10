<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $departments = Department::all();
        $projects = Project::where('visible', 'publish')->where('status', 'approved')->get();
        return view('welcome', compact('departments', 'projects'));
    }
    public function showProject()
    {
        // dd('here');
        return view('show-project');
    }
    public function category()
    {
        // dd('here');
        return view('category-project');
    }
}
