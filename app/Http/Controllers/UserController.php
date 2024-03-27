<?php

namespace App\Http\Controllers;

// The Request class is already imported by default
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\User;


class UserController extends Controller
{
    // We will pass the user's request (their input) to the function
    // that will register that user into the database
    public function register(Request $request) {

        // Create an array defining the requisites for each field
        // to be validated
        $validation = ['name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')], 
                       'email' => ['required', 'email', Rule::unique('users', 'email')], 
                       'password' => ['required', 'min:8', 'max:200']];

        // Validate the user input, passsing that array
        // to the validate method from the Request object
        $incomingFields = $request->validate($validation);

        // Encrypt the user's password so that it is not stored in
        // plain text in the database
        $incomingFields['password'] = bcrypt($incomingFields['password']);

        // Create a model to store that user and add it to the
        // database
        $user = User::create($incomingFields);

        // Log user in
        auth()->login($user);
        return redirect('/'); 
    }

    public function login(Request $request) {
        $validation = ['loginname' => 'required', 
                       'loginpassword' => 'required'];
        $incomingFields = $request->validate($validation);

        if (auth()->attempt(['name'=>$incomingFields['loginname'], 'password'=>$incomingFields['loginpassword']])) {
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    // Function to log user out of their account
    public function logout () {

        // Use globally avaliable function "auth", accessing it's
        // "logout" method
        auth()->logout();
        // Redirect user to home page
        return redirect('/');
    }
}