<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

// When route is the index (/), return the "home" view, using an 
// anonymous function
Route::get('/', function () {
    return view('home');
});

//USER CONTROLER

// Register new user
Route::post('/register', [UserController::class, 'register']);
// Log user in
Route::post('/login', [UserController::class, 'login']);
// Log user out
Route::post('/logout', [UserController::class, 'logout']);

//POST CONTROLLER

// Create new post
Route::post('create-post', [PostController::class, 'createPost'];)