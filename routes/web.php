<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/show-project/{project}', 'showProject')->name('showProject');
    Route::post('/buy-project/{id}', 'buyProject')->name('buyProject');
    Route::get('/payment-callback', 'paymentCallback')->name('paymentCallback');
    Route::get('/projects-category/{department}', 'category')->name('projectCategory');
});

Route::middleware('auth')->group(function () {

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    })->middleware(['verified']);

    Route::resource('departments', DepartmentController::class);

    Route::resource('students', StudentController::class);
    Route::get('students-all', [StudentController::class, 'students'])->name('students.all');

    Route::resource('users', UserController::class);
    Route::get('users-all', [UserController::class, 'users'])->name('users.all');

    Route::controller(\App\Http\Controllers\ProjectController::class)->prefix('projects')->name('projects.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/sponsored', 'sponsored')->name('sponsored');
        Route::get('/sponsored-api', 'sponsoredApi')->name('sponsoredApi');
        Route::get('/{id}', 'show')->name('show');
        Route::put('reaction/{project}', 'reaction')->name('reaction');
    });



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('student')->prefix('student')->name('student.')->group(function () {

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'student')->name('dashboard');
    })->middleware(['verified']);

    Route::controller(\App\Http\Controllers\Student\ProjectController::class)->prefix('project')->name('project.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/edit/{project}', 'edit')->name('edit');
        Route::post('/', 'store')->name('store');
        Route::put('/{project}', 'update')->name('update');
    });

    Route::controller(\App\Http\Controllers\Student\AlumninController::class)->prefix('alumnins')->name('alumnins.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}', 'show')->name('show');
    });

    Route::get('/profile', [\App\Http\Controllers\Student\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\Student\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password_store', [\App\Http\Controllers\Student\ProfileController::class, 'password_store'])->name('profile.password_store');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/student-auth.php';
require __DIR__ . '/sponser-auth.php';
