<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'title' => 'Librarian',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'phone_number' => '01300000000',
            'password' => Hash::make('12345678'),
            'image' => 'photos/MPjfxc7MUVUh4WSx7zpxllDGkVG862mpiqRtYPfN.png',
            'user_type' => 'Admin',
            'status' => 'Approved',
            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
