<?php

use App\Http\Controllers\Academic\SchedulesController as AcademicSchedulesController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Configuration\UsersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterData\ClassNameController;
use App\Http\Controllers\MasterData\CoursesController;
use App\Http\Controllers\MasterData\FacultyController;
use App\Http\Controllers\MasterData\SchedulesController;
use App\Http\Controllers\MasterData\StudyProgramController;
use App\Http\Controllers\MasterData\StundentsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('logout', [AuthenticatedSessionController::class, 'destroy']);

Route::middleware('role:admin')->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'admin_dashboard'])->name('admin_dashboard');

    Route::group(['prefix' => 'configuration', 'as' => 'configuration.'], function() {
        Route::resource('users', UsersController::class);
    });

    Route::group(['prefix' => 'master-data', 'as' => 'master-data.'], function() {
        Route::group(['prefix' => 'students', 'as' => 'students.'], function() {
            Route::get('study_program/{id}', [StundentsController::class, 'study_program']);
            Route::get('class_name/{id}', [StundentsController::class, 'class_name']);
        });
        Route::resource('students', StundentsController::class);
        Route::resource('faculty', FacultyController::class);
        Route::resource('study-program', StudyProgramController::class);
        Route::resource('class-name', ClassNameController::class);
        Route::resource('courses', CoursesController::class);
        Route::resource('schedules', SchedulesController::class);
    });

});

Route::middleware('role:dosen')->group(function () {
    Route::get('dosen/dashboard', [DashboardController::class, 'dosen_dashboard'])->name('dosen_dashboard');

    Route::group(['prefix' => 'academic', 'as' => 'academic.'], function() {
        Route::resource('schedules', AcademicSchedulesController::class);
    });
});

require __DIR__.'/auth.php';
