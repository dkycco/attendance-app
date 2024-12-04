<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Configuration\UsersController;
use App\Http\Controllers\DashboardController;
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

});

require __DIR__.'/auth.php';
