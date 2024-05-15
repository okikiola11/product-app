<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)->group(function() {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
});

// Route::get('auth/home', [AuthController::class, 'index'])->name('auth.home');

// Route::get('students/home', [AuthController::class, 'index'])->name('students.home');

Route::middleware(['auth'])->group(function() {
    Route::get('students', [StudentController::class, 'index'])->name('students.index');

    Route::get('students/index', [StudentController::class, 'index'])->name('students.index');

    Route::get('students/create',  [StudentController::class, 'showCreate'])->name('students.create');

    Route::post('students', [StudentController::class, 'store'])->name('students.store');

    Route::get('students/{id}', [StudentController::class, 'show']);

    Route::get('students/search', [StudentController::class, 'search']);

    Route::get('students/{id}/edit', [StudentController::class, 'edit']);

    Route::put('students/{id}/edit', [StudentController::class, 'update']);

    Route::delete('students/{id}/delete', [StudentController::class, 'destroy']);
});

Auth::routes();

// Student ROUTE
Route::middleware(['auth', 'user-role:user'])->group(function() {
    Route::get("home", [HomeController::class, 'userHome'])->name('home');
});

// LECTURER ROUTE
Route::middleware(['auth', 'user-role:lecturer'])->group(function() {
    Route::get("lecturer/home", [HomeController::class, 'lecturerHome'])->name('lecturer.home');
});

//ADMIN ROUTE
Route::middleware(['auth', 'user-role:admin'])->group(function() {
    Route::get("admin/home", [HomeController::class, 'adminHome'])->name('admin.home');
});

// logout route
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
