<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

// When route is the index (/), return the "home" view, using an 
// anonymous function
Route::get('/', function () {
    // Create empty array
    $posts = [];
    // If user is logged in
    if (auth()->check()) {
        $posts = auth()->user()->usersCoolPosts()->latest()->get();
    }
    // Return the home view, and pass the $posts variable to it
    return view('home', ['posts' => $posts]);
});

//USER CONTROLER
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

//POST CONTROLLER
Route::post('create-post', [PostController::class, 'createPost']);
Route::get('edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::put('edit-post/{post}', [PostController::class, 'actuallyUpdatePost']);
Route::delete('delete-post/{post}', [PostController::class, 'deletepost']);