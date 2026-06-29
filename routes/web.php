<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('guest')->group(function () {
    Route::livewire('/admin/login', 'pages::admin.login')->name('login');
});

Route::middleware('auth')->group(function () {
    Route::livewire('/', 'pages::dashboard')->name('dashboard');

    Route::livewire('/user', 'pages::user.list')->name('user_list');
    Route::livewire('/user/add', 'pages::user.ae')->name('user_add');
    Route::livewire('/user/edit/{id}', 'pages::user.ae')->name('user_edit');

});
