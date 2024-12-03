<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy']);

Route::middleware('role:admin')->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'admin_dashboard'])->name('admin_dashboard');
});

require __DIR__.'/auth.php';
