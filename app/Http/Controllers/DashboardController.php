<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Sponser;
use App\Models\Student;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $project = (object) [
            'active' => Project::where('status', 'approved')->count(),
            'pending' => Project::where('status', 'pending')->count(),
            'total' => Project::where('visible', 'publish')->count(),
            'sponsored' => Project::where('isSponsered', true)->count(),
        ];
        $users = (object) [
            'local' => User::where('status', 'active')->count(),
            'student' => Student::where('student_status', 'student')->count(),
            'alumni' => Student::where('student_status', 'alumni')->count(),
            'sponsor' => Sponser::count(),
        ];
        $revenues = Project::where('isSponsered', true)->sum('price');
        return view('admin.index', compact('project', 'users', 'revenues'));
    }
    public function student()
    {
        $student = auth()->guard('student')->user();
        return view('student.index', compact('student'));
    }
}
