<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::livewire('/', 'pages::dashboard')->name('dashboard');

Route::livewire('/admin/login', 'pages-admin::login')->name('admin_login');
Route::prefix('/admin')->middleware('auth')->group(function () {
    Route::livewire('/', 'pages-admin::dashboard')->name('admin_dashboard');

    Route::livewire('/user', 'pages-admin::user.list')->name('user_list');
    Route::livewire('/user/add', 'pages-admin::user.ae')->name('user_add');
    Route::livewire('/user/edit/{id}', 'pages-admin::user.ae')->name('user_edit');
});

