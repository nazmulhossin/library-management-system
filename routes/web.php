<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\StudentRegistrationController;
use App\Http\Controllers\Auth\TeacherRegistrationController;
use App\Http\Controllers\Auth\LoginController;

Route::get('', function () {
    return view('auth/login');
})->name('login');



// Authentication Routes
Route::view('/register-student', 'auth/register-student')->name('register-student');
Route::post('/register-student', [StudentRegistrationController::class, 'store']);

Route::view('/register-teacher', 'auth/register-teacher')->name('register-teacher');
Route::post('/register-teacher', [TeacherRegistrationController::class, 'store']);

Route::view('/registration-pending', 'auth/registration-pending')->name('registration-pending');

Route::view('/login', 'auth/login')->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/books', [LoginController::class, 'books'])->name('books');
Route::get('/admin/dashboard', [LoginController::class, 'dashboard'])->name('admin/dashboard');


Route::prefix('admin') -> group(function() {
    Route::get('/book-list', function () {
        return view('admin/books');
    }) -> name('admin/book-list');

    Route::get('/issued-list', function () {
        return view('admin/issued');
    }) -> name('admin/issued-list');

    Route::get('/returned-list', function () {
        return view('admin/returned');
    }) -> name('admin/returned-list');

    Route::get('/not-returned-list', function () {
        return view('admin/not-returned');
    }) -> name('admin/not-returned-list');

    Route::get('/request-list', function () {
        return view('admin/request');
    }) -> name('admin/request-list');

    Route::get('/member-list', function () {
        return view('admin/members');
    }) -> name('admin/members-list');

    Route::get('/approve-member', function () {
        return view('admin/approve-member');
    }) -> name('admin/approve-member');

    Route::get('/settings', function () {
        return view('admin/settings');
    }) -> name('admin/settings');
});