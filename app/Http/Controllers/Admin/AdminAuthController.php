<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('authentication.login');
    }

    public function showRegisterForm()
    {
        return view('authentication.register');
    }
    /**
     * Handle an admin login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (!Auth::attempt($request->only('email', 'password'))) {
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                'email' => 'These credentials do not match our records.',
            ]);
        }

        // If successful, then redirect to the welcome page
        return redirect()->route('news#list');

    }

    public function register(Request $request)
    {
        // Validation rules for registration data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create new admin user with 'admin' role
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash the password
            'role' => 'admin', // Set role to 'admin'
        ]);

        // Redirect to login page with success message
        return redirect()->route('login')->with('success', 'Admin Registration Successful');
    }
}