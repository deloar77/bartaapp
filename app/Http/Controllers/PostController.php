<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;

class PostController extends Controller
{
    public function store(PostCreateRequest $request){
         $validated=$request->validated();
         $id=Auth::id();
         try {
             // Prepare the data array for inserting the post
           $data = [
            'user_id' => $id,
            'body' => $validated['body'], // Text content of the post
            'created_at' => now(),  // Current timestamp
             'updated_at' => now()   // Current timestamp
         ];
            if($request->hasFile('image')){
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                 // Create the profile_images directory if it doesn't exist
                 $directoryPath = storage_path('app/public/post_images');
                         if (!file_exists($directoryPath)) {
                                 mkdir($directoryPath, 0755, true); // Create directory with permissions
                            }
                            // Move the uploaded image to the desired location
                             $image->move($directoryPath, $imageName);

                              // Save the image path in the data array
                             $data['image'] = $imageName;
            }
                // Insert the data into the database using the DB facade
                DB::table('posts')->insert($data);

            // Redirect or return success response
             return redirect()->back()->with('success', 'Post created successfully!');
         } catch (Exception $e) {
               // Handle any exceptions that occur during the process
        return redirect()->back()->with('error', 'An error occurred while creating the post: ' . $e->getMessage());
         }

    }


  public function edit(Request $request,$id){
   
      $post = DB::table('posts')->where('id',$id)->first();
      
    return view('pages.posts.post-edit-page',compact('post'));
  }
    
    public function update(PostUpdateRequest $request,$id){
      $validated = $request->validated();
        
         try {
                       $post=  DB::table('posts')->where('id',$id)->first();
                      if($post){
                          $data=[
                                'body'=>$request->input('body'),
                                'updated_at'=>now()

                               ];
                             
                      
                       // Handle image upload
                       if ($request->hasFile('image')) {
                            
                         // Check if the user already has a profile image and delete it
                          if ($post->image) {
                             
                                  $existingImagePath = storage_path('app/public/post_images/' . $post->image);

                                  if (file_exists($existingImagePath)) {
                                   unlink($existingImagePath); // Delete the old image
                                }
                           }
                            $image = $request->file('image');
 
                         // Generate a unique name for the image
                           $imageName = time() . '_' . $image->getClientOriginalName();
                           // Create the profile_images directory if it doesn't exist
                                 $directoryPath = storage_path('app/public/post_images');
                               if (!file_exists($directoryPath)) {
                                 mkdir($directoryPath, 0755, true); // Create directory with permissions
                                 }

                                 
                              // Move the uploaded image to the desired location
                                $image->move($directoryPath, $imageName);

                              // Save the image path in the data array
                             $data['image'] = $imageName;
                         }
                        
                              // Update the user in the database
                              DB::table('posts')->where('id', $id)->update($data);

                            // Redirect back with success message
                             return redirect()->back()->with('success', 'Profile updated successfully.');

                         } else {
                             return redirect()->back()->with('error', 'User not found.');
                         }
             
        }   catch (Exception $e) {
           
              // Redirect back with error message
              
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
            
        }
    }

    public function destroy($id){
    
      // Delete the post by its ID
      try {
         $post=  DB::table('posts')->where('id',$id)->first();
        if($post){
         
            $existingImagePath = storage_path('app/public/post_images/' . $post->image);

             if (file_exists($existingImagePath)) {
                   unlink($existingImagePath); // Delete the old image
                }

                 $deleted = DB::table('posts')->where('id', $id)->delete();

                return redirect()->back()->with('success', 'Post deleted successfully.');
    
        }

      } catch (Exception $e) {
         return redirect()->back()->with('error', 'Something went wrong. Please try again.');
      }
   
    }

}
