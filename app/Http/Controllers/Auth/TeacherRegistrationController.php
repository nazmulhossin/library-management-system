<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TeacherRegistrationController extends Controller
{
    public function store(Request $request)
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

            return redirect()->route('registration-pending');
        }
    }
}
