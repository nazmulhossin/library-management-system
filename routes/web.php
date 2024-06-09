<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages/home');
});


Route::prefix('admin') -> group(function() {
    Route::get('/dashboard', function () {
        return view('admin/dashboard');
    }) -> name('admin/dashboard');

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