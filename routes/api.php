<?php

use App\Http\Controllers\api\StudentController;
use App\Http\Controllers\CourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('students', function() {
//     return 'this is student api';
// });

// Route::get('students/index', [StudentController::class, 'index'])->name('students.index');

// Route::get('students/create',  [StudentController::class, 'showCreate'])->name('students.create');

// Route::post('students', [StudentController::class, 'store'])->name('students.store');

// Route::get('students/{id}', [StudentController::class, 'show']);

// Route::get('students/search', [StudentController::class, 'search']);

// Route::get('students/{id}/edit', [StudentController::class, 'edit']);

// Route::put('students/{id}/edit', [StudentController::class, 'update']);

// Route::delete('students/{id}/delete', [StudentController::class, 'destroy']);
