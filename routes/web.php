<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// When route is the index (/), return the "home" view, using an 
// anonymous function
Route::get('/', function () {
    return view('home');
});

// When route is /register, will execute the function "register"
// from the "UserController"
Route::post('/register', [UserController::class, 'register']);

// When route is /login, will execute the function "login"
// from the "UserController"
Route::post('/login', [UserController::class, 'login']);

// When route is /logout, will execute the function "logout"
// from the "UserController"
Route::post('/logout', [UserController::class, 'logout']);