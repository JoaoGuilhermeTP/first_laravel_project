<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Function to create a new post
    // This function takes the request with the data provided by the user
    public function createPost(Request $request) {
        // Validate the request. Both fields are required
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        // Strip away any tags that a malicious user migh fill in the form
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        // Set the current user id as the value for the key "user_id" in
        // thie incomingFields array
        $incomingFields['user_id'] = auth()->id();

        // Create a new post using the Post model
        Post::create($incomingFields);
        return redirect('/');
    }

    // Function to show screen to edit a post
    public function showEditScreen(Post $post) {
        // If current user is not the author of the post they want to edit
        if (auth()->user()->id !== $post['user_id']) {
            // Redirect to homepage
            return redirect('/');
        }
        // Return view for editing post
        return view('edit-post', ['post' => $post]);
    }

    public function actuallyUpdatePost(Post $post, Request $request) {
        // If current user is not the author of the post they want to edit
        if (auth()->user()->id !== $post['user_id']) {
            // Redirect to homepage
            return redirect('/');
        }

        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        // Strip away any tags that a malicious user migh fill in the form
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        // Update post in database
        $post->update($incomingFields);
        return redirect('/');
    }

    public function deletePost(Post $post) {
        // If current user is the author of the post they want to delete
        if (auth()->user()->id === $post['user_id']) {
            // Delete post
            $post->delete();
        }
        return redirect('/');
    }
}
