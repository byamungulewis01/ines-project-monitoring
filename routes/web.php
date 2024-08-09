<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    })->middleware(['verified']);

    Route::resource('departments', DepartmentController::class);

    Route::resource('students', StudentController::class);
    Route::get('students-all', [StudentController::class, 'students'])->name('students.all');

    Route::resource('customers', CustomerController::class);
    Route::get('customers-all', [CustomerController::class, 'customers'])->name('customers.all');

    Route::resource('users', UserController::class);
    Route::get('users-all', [UserController::class, 'users'])->name('users.all');

    Route::resource('products', ProductController::class);
    Route::get('products-all', [ProductController::class, 'products'])->name('products.all');

    Route::resource('orders', OrderController::class);
    Route::get('orders-all', [OrderController::class, 'orders'])->name('orders.all');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
