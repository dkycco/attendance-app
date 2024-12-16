<?php

use App\Http\Controllers\Academic\AttendanceController;
use App\Http\Controllers\Academic\SchedulesController as AcademicSchedulesController;
use App\Http\Controllers\Academic\TeacherAttendanceController;
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
            Route::get('semester/{id}', [StundentsController::class, 'semester']);
            Route::get('class_name/{study_program}/{semester}', [StundentsController::class, 'class_name']);
        });
        Route::resource('students', StundentsController::class);
        Route::resource('faculty', FacultyController::class);
        Route::resource('study-program', StudyProgramController::class);
        Route::resource('class-name', ClassNameController::class);
        Route::resource('courses', CoursesController::class);
        Route::group(['prefix' => 'schedules', 'as' => 'schedules.'], function() {
            Route::get('view_student/{schedule}', [SchedulesController::class, 'view_student'])->name('view_student');
            Route::get('study_program/{id}', [SchedulesController::class, 'study_program'])->name('study_program');
            Route::get('class_name/{study_program}/{semester}', [SchedulesController::class, 'class_name'])->name('class_name');
            Route::get('student/{id}', [SchedulesController::class, 'student'])->name('student');
            Route::post('store_student', [SchedulesController::class, 'store_student'])->name('store_student');
        });
        Route::resource('schedules', SchedulesController::class);
    });

});

Route::middleware('role:teacher')->group(function () {
    Route::get('teacher/dashboard', [DashboardController::class, 'teacher_dashboard'])->name('teacher_dashboard');

    Route::group(['prefix' => 'academic', 'as' => 'academic.'], function() {
        Route::group(['prefix' => 'schedules', 'as' => 'schedules.'], function() {
            Route::get('view_student/{schedule}', [AcademicSchedulesController::class, 'view_student'])->name('view_student');
            Route::post('present/{schedule}', [AcademicSchedulesController::class, 'present'])->name('present');
        });
        Route::resource('schedules', AcademicSchedulesController::class);
        Route::group(['prefix' => 'attendance', 'as' => 'attendance.'], function() {
            Route::get('view_student/{attendance}', [TeacherAttendanceController::class, 'view_student'])->name('view_student');
            Route::post('save_qr/{id}', [TeacherAttendanceController::class, 'save_qr'])->name('save_qr');
            Route::get('make_qr/{id}', [TeacherAttendanceController::class, 'make_qr'])->name('make_qr');
            Route::get('view_qr/{id}', [TeacherAttendanceController::class, 'view_qr'])->name('view_qr');
        });
        Route::resource('attendance', TeacherAttendanceController::class);
    });
});

require __DIR__.'/auth.php';
