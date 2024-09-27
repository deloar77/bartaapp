<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function profile_page(){
        $user=Auth::user();
        $id=Auth::id();
     
        $posts=DB::table('posts')->where('user_id',$id)->get();
        
        
        return view('pages.profile-page',compact('user','posts'));
    }
    public function profile_edit_page(){
        $user=Auth::user();
        return view('pages.profileedit-page',compact('user'));
    }
    public function profile_update(ProfileUpdateRequest $request){
        $validated=$request->validated();
       
        $id=Auth::id();
        try {
                       $user=  DB::table('users')->where('id',$id)->first();
                      if($user){
                          $data=[
                                'first_name'=>$request->input('first_name'),
                                'last_name'=>$request->input('last_name'),
                                'email'=>$request->input('email'),
                                'bio'=>$request->input('bio')

                               ];
                             
                            // Check if a new password is provided and hash it
                          if ($request->filled('password')) {
                              $data['password'] = Hash::make($request->input('password'));
                              }
                        
                       // Handle image upload
                       if ($request->hasFile('image')) {

                         // Check if the user already has a profile image and delete it
                          if ($user->image) {
                                  $existingImagePath = storage_path('app/public/profile_images/' . $user->image);

                                  if (file_exists($existingImagePath)) {
                                   unlink($existingImagePath); // Delete the old image
                                }
                           }
                            $image = $request->file('image');
 
                         // Generate a unique name for the image
                           $imageName = time() . '_' . $image->getClientOriginalName();
                           // Create the profile_images directory if it doesn't exist
                                 $directoryPath = storage_path('app/public/profile_images');
                               if (!file_exists($directoryPath)) {
                                 mkdir($directoryPath, 0755, true); // Create directory with permissions
                                 }

                                 
                              // Move the uploaded image to the desired location
                                $image->move($directoryPath, $imageName);

                              // Save the image path in the data array
                             $data['image'] = $imageName;
                         }
                        
                              // Update the user in the database
                              DB::table('users')->where('id', $id)->update($data);

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
}
