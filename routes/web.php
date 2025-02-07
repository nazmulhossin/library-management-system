<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('', function () { return view('auth/login'); })->name('login');


// Authentication Routes
Route::view('/register-student', 'auth/register-student')->name('register-student');
Route::post('/register-student', [AuthController::class, 'studentRegistration']);

Route::view('/register-teacher', 'auth/register-teacher')->name('register-teacher');
Route::post('/register-teacher', [AuthController::class, 'teacherRegistration']);

Route::view('/registration-pending', 'auth/registration-pending')->name('registration-pending');

Route::get('/forgot-password', function () { return view('auth/forgot-password'); })->name('forgot-password');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('send-reset-link');
Route::get('/password-reset-msg', function () { return view('auth/reset-password-msg'); })->name('password-reset-msg');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password-reset');
Route::post('/update-password', [AuthController::class, 'resetPassword'])->name('update-password');

Route::view('/login', 'auth/login')->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// User Routes
Route::get('/all-books', [UserController::class, 'showAllBooks'])->name('all-books');
Route::get('/cse-books', [UserController::class, 'showCSEBooks'])->name('cse-books');
Route::get('/eee-books', [UserController::class, 'showEEEBooks'])->name('eee-books');
Route::get('/programming-books', [UserController::class, 'showProgrammingBooks'])->name('programming-books');
Route::get('/machine-learning-books', [UserController::class, 'showMachineLearningBooks'])->name('machine-learning-books');
Route::get('/mathematics-books', [UserController::class, 'showMathematicsBooks'])->name('mathematics-books');
Route::get('/search-books', [UserController::class, 'searchBooks'])->name('search-books');

Route::post('/borrow-request', [UserController::class, 'borrowRequest']);
Route::post('/cancel-borrow-request', [UserController::class, 'cancelRequest']);
Route::delete('/cancel-borrow-request-with-id/{book_id}', [UserController::class, 'cancelRequestWithID'])->name('cancel-borrow-request-with-id');

Route::get('/book/{book_id}', [UserController::class, 'showBookDetails'])->name('show-book-details');

Route::get('/my-profile', function () { return view('user/my-profile'); })->name('my-profile');
Route::post('/change-password', [UserController::class, 'changePassword'])->name('change-password');
Route::get('/my-requested-book-list', [UserController::class, 'showRequestedBookList'])->name('my-requested-book-list');
Route::get('/my-borrowed-book-list', [UserController::class, 'showBorrowedBookList'])->name('my-borrowed-book-list');
Route::get('/my-returned-book-list', [UserController::class, 'showReturnedBookList'])->name('my-returned-book-list');

// Routes for admin pannel
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin/dashboard');

    Route::get('/request-list', [AdminController::class, 'showRequestList'])->name('admin/request-list');
    Route::post('/admin/approveRequest/{request_id}', [AdminController::class, 'approveRequest'])->name('admin/approveRequest');

    Route::get('/assign-book-form', function () { return view('admin/assign-book'); })->name('admin/assign-book-form');
    Route::post('/get-book-user-info', [AdminController::class, 'getBookAndUserInfo']);
    Route::post('/assign-book-manually/{book_id}/{reg_no}', [AdminController::class, 'assignBookManually'])->name('admin/assign-book-manually');

    Route::get('/issued-list', [AdminController::class, 'showIssuedList'])->name('admin/issued-list');
    Route::get('/receive-returned-book/{borrow_id}', [AdminController::class, 'receiveReturnedBook'])->name('admin/receive-returned-book');

    Route::get('/not-returned-list', [AdminController::class, 'showNotReturnedBooks'])->name('admin/not-returned-list');

    Route::get('/returned-list', [AdminController::class, 'showReturnedBooks'])->name('admin/returned-list');

    Route::get('/add-book', function () { return view('admin/add-book'); })->name('admin/add-book');
    Route::post('/add-book', [AdminController::class, 'addBook'])->name('admin/add-book');

    Route::get('/book-list', [AdminController::class, 'showBooks'])->name('admin/book-list');
    
    Route::get('/pending-members', [AdminController::class, 'showPendingUsers'])->name('admin/pending-members');
    Route::get('/user-approve/{id}', [AdminController::class, 'approveMember'])->name('admin/user-approve');
    Route::get('/user-decline/{id}', [AdminController::class, 'declineMember'])->name('admin/user-decline');

    Route::get('/member-list', [AdminController::class, 'showMembers'])->name('admin/member-list');

    Route::get('/settings', function () { return view('admin/settings'); }) -> name('admin/settings');
    Route::post('/change-password', [AdminController::class, 'changePassword']) -> name('admin/change-password');
});

// Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
//     Route::get('/user/approve/{id}', [AdminController::class, 'approve'])->name('admin.user.approve');
//     Route::get('/user/decline/{id}', [AdminController::class, 'decline'])->name('admin.user.decline');
// });