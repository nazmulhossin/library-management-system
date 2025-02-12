<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // Student Registration
    public function studentRegistration(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'roll_number' => 'required|string|max:20',
            'session' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|regex:/^(1[3-9]\d{8})$/',
            'password' => 'required|string|confirmed|min:8',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Check if the file was uploaded
        if($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $file->store('photos', 'public'); // Store the file in the 'storage/app/public/photos' directory

            $user = DB::table('users')->insert([
                'name' => $request->name,
                'registration_number' => $request->roll_number,
                'email' => $request->email,
                'session' => $request->session,
                'username' => explode('@', $request->email)[0].$request->roll_number,
                'phone_number' => '0'.$request->phone_number,
                'password' => Hash::make($request->password),
                'image' => $path,
                'user_type' => 'Student',
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return $this->sendVerificationEmail($request->email);
        }
    }

    // Teacher Registration
    public function teacherRegistration(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:30',
            'teacher_id' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|regex:/^(1[3-9]\d{8})$/',
            'password' => 'required|string|confirmed|min:8',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Check if the file was uploaded
        if($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $file->store('photos', 'public'); // Store the file in the 'storage/app/public/photos' directory

            $user = DB::table('users')->insert([
                'name' => $request->name,
                'title' => $request->title,
                'registration_number' => $request->teacher_id,
                'email' => $request->email,
                'username' => explode('@', $request->email)[0].$request->teacher_id,
                'phone_number' => '0'.$request->phone_number,
                'password' => Hash::make($request->password),
                'image' => $path,
                'user_type' => 'Teacher',
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return $this->sendVerificationEmail($request->email);
        }
    }

    // Send Verification Email
    public function sendVerificationEmail($email)
    {
        // Generate verify token
        $token = Str::random(60);

        // Delete existing reset requests for this email
        DB::table('email_verification_tokens')->where('email', $email)->delete();

        // Insert new reset token
        DB::table('email_verification_tokens')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

         // Send email with verification link
        Mail::send('emails/email-verification', ['token' => $token], function ($message) use ($email) {
            $message->to($email);
            $message->subject('Verify Your Email');
        });

        return redirect()->route('verification-email-msg', ['email' => $email]);
    }

    // Verify Email
    public function verifyEmail($token)
    {
        $record = DB::table('email_verification_tokens')->where('token', $token)->first();

        // Mark email as verified
        DB::table('users')
            ->where('email', $record->email)
            ->update([
                'email_verified_at' => now(),
            ]);

        // Delete token
        DB::table('email_verification_tokens')->where('token', $token)->delete();

        return redirect()->route('registration-pending');
    }

    // If a user already login then redirect his/her
    public function checkLogin()
    {
        // Check if the authenticated user is an admin
        if (session()->has('user')) {
            // Redirect based on user type
            if (session('user')->user_type === 'Admin') {
                return redirect()->route('admin/dashboard');
            } else {
                return redirect()->route('all-books');
            }
        } else {
            return view('auth/login');
        }
    }

    // Handle Login
    public function login(Request $request)
    {
        // Validate form data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        // Attempt to log in the user
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
        
            if (is_null($user->email_verified_at)) {
                return $this->sendVerificationEmail($request->email);
            }
            
            if ($user->status === 'Pending') {
                return redirect()->route('registration-pending');
            }
        
            Session::put('user', $user);
        
            // Redirect based on user type
            return $user->user_type === 'Admin' ? redirect()->route('admin/dashboard') : redirect()->route('all-books');
        }

        return back()->with('error', 'Invalid email or password');
    }

    // Handle Logout
    public function logout(Request $request)
    {
        Session::forget('user'); // Clear user session data
        Auth::logout();
        return redirect()->route('login');
    }

    // Send Reset Link
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Generate reset token
        $token = Str::random(60);

        // Delete existing reset requests for this email
        DB::table('password_resets')->where('email', $request->email)->delete();

        // Insert new reset token
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        // Send email with reset link
        Mail::send('emails/reset-password', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Password Reset Request');
        });

        return redirect()->route('password-reset-msg');
    }
    
    // Show Reset Password Form
    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    // Handle Reset Password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        // Check if token is valid
        $resetRequest = DB::table('password_resets')
            ->where('token', $request->token)
            ->first();

        if (!$resetRequest) {
            return back()->with('error', 'Invalid token or email.');
        }

        // Update user password
        DB::table('users')->where('email', $resetRequest->email)->update([
            'password' => Hash::make($request->password),
        ]);

        // Delete the reset request
        DB::table('password_resets')->where('token', $request->token)->delete();

        return redirect()->route('login');
    }
}