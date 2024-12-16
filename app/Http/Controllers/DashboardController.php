<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin_dashboard() {
        $adminCount = User::whereHas('roles', fn($qry) => $qry->whereIn('name', ['admin']))->count();
        $teacherCount = User::whereHas('roles', fn($qry) => $qry->whereIn('name', ['teacher']))->count();
        $studentCount = User::count();
        return view('pages.dashboard.admin-dashboard', compact('teacherCount', 'adminCount', 'studentCount'));
    }


    public function teacher_dashboard() {
        return view('pages.dashboard.dosen-dashboard');
    }
}
