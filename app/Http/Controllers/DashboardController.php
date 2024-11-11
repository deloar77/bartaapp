<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard_page(){
        $user=Auth::user();
          
    
    $posts=Post::with('user')->get();
        return view('pages.dashboard-page',compact('user','posts'));
    }
}
