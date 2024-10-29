<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate form data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in the user
        if(Auth::attempt($credentials)) {
            $user = Auth::user();
            Session::put('user', $user); // Store user information in session

            // Redirect based on user type
            if ($user->user_type === 'Admin') {
                return redirect()->route('admin/dashboard');
            } else {
                return redirect()->route('books');
            }
        }

        return back()->with('error', 'Invalid email or password');
    }

    public function logout(Request $request)
    {
        Session::forget('user'); // Clear user session data
        Auth::logout();
        return redirect()->route('login');
    }

    public function dashboard()
    {
        if(session('user'))
            return view('admin/dashboard');
        else
            return redirect()->route('login');
    }

    public function books()
    {
        if(session('user'))
            return view('pages/books');
        else
            return redirect()->route('login');
    }
}
