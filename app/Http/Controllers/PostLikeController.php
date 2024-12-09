<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Notifications\PostLiked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostLikeController extends Controller
{

    public function LikePost(Request $request,$post_id){
        $user = Auth::user();
        
      
        $post = Post::where('id',$post_id)->first();
        
     
    // Check if the user has already liked the post
    $like = Like::where('post_id', $post_id)->where('user_id', $user->id)->first();
     
    // Initialize the $liked variable
    $liked = false;

    // If the user already liked the post, unlike it
    if ($like) {
        $like->delete(); // Delete the like
        $post->decrement('likes_count'); // Decrement the like count
    } else {
        // If the user hasn't liked the post, like it

      $lik=  Like::create([
            'user_id' => $user->id,
            'post_id' => $post_id
        ]); // Create a new like record
        $post->increment('likes_count'); // Increment the like count
          
        $liked = true; // Post is now liked
    }
    
    if($liked){
        $postOwner=$post->user;
        
        $postOwner->notify(new PostLiked($post,$user));
    }
    

    }



}
