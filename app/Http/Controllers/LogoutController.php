<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
        public function logout(Request $request)
    {
        // Log the user out
        Auth::logout();
       Session::flush();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token
        $request->session()->regenerateToken();

        // Redirect to the login page or any page you want after logout
        return redirect('/login')->with('message', 'Logged out successfully.');
    }
}
