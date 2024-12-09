<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeFeedController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\notificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;


Route::get('/register-page',[RegisterController::class,'register_page'])->name('register.page');
Route::post('/register',[RegisterController::class,'register'])->name('register');
Route::get('/login',[LoginController::class,'login_page'])->name('login');
Route::post('/login',[LoginController::class,'login']);


Route::middleware('auth')->group(function(){

Route::get('/dashboard_page',[DashboardController::class,'dashboard_page'])->name('dashboard');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('profile_page',[ProfileController::class,'profile_page'])->name('profile.page');
Route::get('/profile_edit_page',[ProfileController::class,'profile_edit_page']);
Route::put('/profile_update',[ProfileController::class,'profile_update'])->name('profile.update');
Route::post('/posts',[PostController::class,'store'])->name('posts.store');
Route::get('/posts/{photo}/edit',[PostController::class,'edit'])->name('posts.edit');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::get('/barta',[HomeFeedController::class,'barta'])->name('barta');

Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');
Route::get('/search',[SearchController::class,'search'])->name('users.search');
Route::get('/user/{id}',[SearchController::class,'show'])->name('user.show');

Route::post('/posts/{post_id}/toggle-like',[PostLikeController::class,'LikePost']);
Route::get('/api/notifications',[notificationController::class,'index']);

});


