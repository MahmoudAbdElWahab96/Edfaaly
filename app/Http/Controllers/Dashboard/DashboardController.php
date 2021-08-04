<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class DashboardController extends Controller
{
    public function index() {
        return view('dashboard.pages.index');
    }

    public function logout() {
        Auth::logout();
        return redirect()->back();
    }
}
