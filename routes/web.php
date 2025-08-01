<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\UserController;
use App\Models\Course;
use Illuminate\Support\Facades\Route;


// No Authentication Required
Route::get('/', function () {
    $courses = Course::whereNot('status', 'draft')->latest()->take(3)->get();
    return view('home', compact("courses"));
})->name('home');

Route::resource('courses', CourseController::class)
    ->only('show', 'index')
    ->where(['course' => '[0-9]+']);

Route::get('/forgot-password', [PasswordResetController::class, 'request'])->name('password.request');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'reset'])->name('password.reset');
Route::post('/forgot-password', [PasswordResetController::class, 'email'])->name('password.email');
Route::post('reset-password', [PasswordResetController::class, 'update'])->name('password.update');


// Only for Guests
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/login', [AuthController::class, 'attempt'])->name('auth.attempt');
    Route::post('/register', [AuthController::class, 'store'])->name('auth.store');
});


// Authentication Required
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::put('/users/{user}/password', [UserController::class, 'updatePassword'])->name('users.password.update');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::middleware('permission:enroll')->group(function () {
        Route::post("/courses/{course}/enroll", [EnrollmentController::class, 'enroll'])->name('courses.enroll');
        Route::get('/courses/{course}/enroll/success', [EnrollmentController::class, 'success'])->name('courses.enroll.success');
        Route::get('/courses/{course}/enroll/cancel', [EnrollmentController::class, 'cancel'])->name('courses.enroll.cancel');
    });

    Route::middleware('permission:view course students')->group(function () {
        Route::get('/courses/{course}/students/export', [UserController::class, 'exportStudents'])->name('courses.students.export');
        Route::get('/courses/{course}/students', [CourseController::class, 'students'])->name('courses.students');
    });

    Route::middleware('permission:manage courses')->group(function () {
        Route::get('/courses/manage', [CourseController::class, 'manage'])->name('courses.manage');
        Route::post('/courses/{course}/publish', [CourseController::class, 'publish'])->name('courses.publish');
        Route::post('/courses/{course}/archive', [CourseController::class, 'archive'])->name('courses.archive');
        Route::resource('courses', CourseController::class)->except('show', 'index');
    });

    Route::middleware('permission:manage course materials')->group(function () {
        Route::get('/courses/{course}/materials/manage', [MaterialController::class, 'index'])->name('materials.manage');
        Route::post('/courses/{course}/materials/relist', [MaterialController::class, 'relist'])->name('materials.relist');
        Route::post('/courses/{course}/materials', [MaterialController::class, 'store'])->name('materials.store');
        Route::delete('/courses/{course}/materials/{material}', [MaterialController::class, 'destroy'])->name('materials.destroy');
    });

    Route::middleware('permission:view course materials')->group(function () {
        Route::get("/courses/{course}/materials/{material}", [MaterialController::class, 'show'])->name('materials.show');
        Route::get("/courses/{course}/archives/{material}", [MaterialController::class, 'archiveView'])->name('materials.archiveView');
        Route::get('/courses/{course}/download', [MaterialController::class, 'downloadAll'])->name('materials.download');
    });

    Route::resource('users', UserController::class)->middleware('permission:manage users');
    Route::get('/certificate/{course}', [CourseController::class, 'generateCertificate'])->name('certificate.generate')->middleware('permission:download certificate');
});