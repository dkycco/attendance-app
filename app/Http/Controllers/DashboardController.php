<?php

namespace App\Http\Controllers;

use App\Models\Course;
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
        $studentCount = User::count();
        $courseCount = Course::where('teacher_id', getUser('id'))->count();
        return view('pages.dashboard.dosen-dashboard', compact('studentCount', 'courseCount'));
    }
}
