<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


Route::get('/register-page',[RegisterController::class,'register_page'])->name('register.page');
Route::post('/register',[RegisterController::class,'register'])->name('register');
Route::get('/login',[LoginController::class,'login_page'])->name('login');
Route::post('/login',[LoginController::class,'login']);

Route::middleware('auth')->group(function(){
Route::get('/dashboard_page',[DashboardController::class,'dashboard_page'])->name('dashboard');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('profile_page',[ProfileController::class,'profile_page']);
Route::get('/profile_edit_page',[ProfileController::class,'profile_edit_page']);
Route::put('/profile_update',[ProfileController::class,'profile_update'])->name('profile.update');
});


