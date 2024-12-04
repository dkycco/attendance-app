<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Configuration\UsersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterData\ClassController;
use App\Http\Controllers\MasterData\FacultyController;
use App\Http\Controllers\MasterData\StudyProgramController;
use App\Http\Controllers\MasterData\StundentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy']);

Route::middleware('role:admin')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin_dashboard'])->name('admin_dashboard');

    Route::group(['prefix' => 'configuration', 'as' => 'configuration.'], function() {
        Route::resource('users', UsersController::class);
    });

    Route::group(['prefix' => 'master-data', 'as' => 'master-data.'], function() {
        Route::resource('students', StundentController::class);
        Route::resource('faculty', FacultyController::class);
        Route::resource('study-program', StudyProgramController::class);
        Route::resource('class', ClassController::class);
    });

});

require __DIR__.'/auth.php';
