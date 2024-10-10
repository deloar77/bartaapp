<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request){
         $user=Auth::user();
        // Retrieve the search input
        $search = $request->query('search');
        
        // Search across multiple fields (username, first name, last name, and email)
        $users = User::where('username', 'like', '%' . $search . '%')
                    ->orWhere('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->get();
                    
                    return view('pages.search-page')->with(['users'=>$users,'user'=>$user]);
    }

    public function show($id){
        $user=User::with('posts')->findOrFail($id);
        

        return view('pages.user-page',compact('user'));
    }
}
