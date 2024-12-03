<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin_dashboard() {
        return view('pages.dashboard.admin-dashboard');
    }
}
