<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    public function login_page(){
        return view('pages.login-page');
    }


    public function login(LoginRequest $request){
      // The request is already validated at this point.
    // You can now proceed with authentication logic.

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials,$request->remember)) {
        // Authentication passed
        return redirect()->intended('dashboard_page'); // Or your desired route
    } else {
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }
    }
}
