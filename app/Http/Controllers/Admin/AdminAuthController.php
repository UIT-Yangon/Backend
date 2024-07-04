<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{

    

    

    public function showWelcome()
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            $user = Auth::user();
            return view('welcome', ['user' => $user]);
        } else {
            return redirect()->route('login')->withErrors(['You do not have admin access.']);
        }
    }


    public function showLoginForm()
    {
        return view('authentication.login');
    }

    public function showRegisterForm()
    {
        return view('authentication.register');
    }

    public function showChangePasswordForm()
    {
        return view('authentication.changepassword');
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
        return redirect()->route('news#list')->with('success', 'Admin Registration Successful');
    }

    public function changePassword(Request $request)
    {

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Check if the current password matches the password in the database
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'The current password does not match.');
        }

        // Attempt to update the password
        try {
            User::where('id',$user->id)->update([
                'password'=>Hash::make($request->new_password)
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update password. Please try again.');
        }

        return redirect()->route('login')->with('success', 'Password updated successfully.');
    }





    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    

    
}