<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register_page(){
        return view('pages.register-page');
    }

    public function register(RegisterRequest $request){
      
                    $validated=$request->validated();
                    
            
        $user = User::create([
                       'first_name' => $validated['first_name'],
                       'last_name'  =>  $validated['last_name'],
                       'email'      =>  $validated['email'],
                       'username'=>$validated['username'],
                       'password'   => Hash::make( $validated['password'],)
                        ]);

  // Automatically log the user in after registration
      Auth::login($user);

//    // Redirect to the dashboard
//    return redirect()->route('dashboard')->with('success', 'Account created successfully!');

    // Validate the incoming request
    // $validated = $request->validated();
    
    // Manually insert the user into the database using a DB query
    // $userId = DB::table('users')->insertGetId([
    //     'first_name' => $validated['first_name'],
    //     'last_name'  => $validated['last_name'],
    //     'email'      => $validated['email'],
    //     'password'   => Hash::make($validated['password']),
    //     'created_at' => now(),
    //     'updated_at' => now(),
    // ]);

    // Fetch the newly created user (optional if you need the user object)
    // $user = DB::table('users')->where('id', $userId)->first();
    
    // // Automatically log the user in
    // Auth::loginUsingId($userId);

    // Redirect to the dashboard with a success message
    return redirect()->route('dashboard')->with('success', 'Account created successfully!');

    }
}
