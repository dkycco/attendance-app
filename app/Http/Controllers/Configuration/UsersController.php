<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index() {
        return view('pages.dashboard.configuration.users');
    }
}
