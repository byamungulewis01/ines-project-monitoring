<?php

use App\Models\Project;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SponserAuth\RegisteredUserController;
use App\Http\Controllers\SponserAuth\AuthenticatedSessionController;
use App\Models\Order;

Route::middleware('guest')->prefix('sponser')->name('sponser.')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('sponser')->prefix('sponser')->name('sponser.')->group(function () {
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
    Route::get('projects', function () {
        $ids = Order::where('sponser_id', auth()->guard('sponser')->id())->pluck('project_id')->toArray();
        $projects = Project::whereIn('id', $ids)->get();

        return view('sponser.index', compact('projects'));
    })->name('projects');
    Route::get('projects/{id}', function ($id) {
        $project = Project::findOrFail($id);
        return view('sponser.show', compact('project'));
    })->name('showProject');
});
