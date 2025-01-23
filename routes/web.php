<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\StudentRegistrationController;
use App\Http\Controllers\Auth\TeacherRegistrationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;

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


Route::get('/home', [LoginController::class, 'home'])->name('home');
Route::get('/admin/dashboard', [LoginController::class, 'dashboard'])->name('admin/dashboard');




Route::prefix('admin')->group(function () {
    Route::get('/add-book', function () { return view('admin/add-book'); })->name('admin/add-book');
    Route::post('/add-book', [AdminController::class, 'addBook'])->name('admin/add-book');

    Route::get('/book-list', [AdminController::class, 'showBooks'])->name('admin/book-list');
    
    Route::get('/pending-members', [AdminController::class, 'showPendingUsers'])->name('admin/pending-members');
    Route::get('/user-approve/{id}', [AdminController::class, 'approveMember'])->name('admin/user-approve');
    Route::get('/user-decline/{id}', [AdminController::class, 'declineMember'])->name('admin/user-decline');

    Route::get('/member-list', [AdminController::class, 'showMembers'])->name('admin/member-list');
});

// Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
//     Route::get('/user/approve/{id}', [AdminController::class, 'approve'])->name('admin.user.approve');
//     Route::get('/user/decline/{id}', [AdminController::class, 'decline'])->name('admin.user.decline');
// });

Route::prefix('admin') -> group(function() {


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

    Route::get('/settings', function () {
        return view('admin/settings');
    }) -> name('admin/settings');
});