<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeFeedController extends Controller
{
    public function barta(){
        $user=Auth::user();
    //    $posts = DB::table('posts')
    //    ->leftJoin('users', 'posts.user_id', '=', 'users.id')
    //    ->select('posts.*','users.image as user_image','posts.image as post_image','posts.id as post_id', 'users.created_at as user_created_at', 'users.updated_at as user_updated_at', 'users.*')
    //    ->get();
    $posts=Post::with('user')->get();
    
      
   
        return view('pages.home',compact('user','posts'));
    }
}
