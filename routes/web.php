<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // -------- Schools --------
    Route::get('/schools', [SchoolController::class, 'index'])->name('schools.index');   // List all schools
    Route::get('/schools/create', [SchoolController::class, 'create'])->name('schools.create');
    Route::get('/schools/edit', [SchoolController::class, 'edit'])->name('edit.index');
    Route::post('/schools', [SchoolController::class, 'store'])->name('schools.store')->middleware(HandlePrecognitiveRequests::class);// Create a school
    Route::put('/schools/{id}', [SchoolController::class, 'update'])->name('schools.update'); // Update a school
    Route::delete('/schools/{id}', [SchoolController::class, 'destroy'])->name('schools.destroy'); // Delete a school

    // -------- Students --------
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');   // List all students
    Route::get('/students/create', [StudentController::class, 'create'])->name('create.index');
    Route::get('/students/edit', [StudentController::class, 'edit'])->name('edit.index');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');  // Create a student
    Route::put('/students/{id}', [StudentController::class, 'update'])->name('studensts.update'); // Update a student
    Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy'); // Delete a student

});
