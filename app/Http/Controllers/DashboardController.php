<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard_page(){
        $user=Auth::user();
        return view('pages.dashboard-page',compact('user'));
    }
}
