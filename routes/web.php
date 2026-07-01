<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::livewire('/', 'pages::dashboard')->name('dashboard');

Route::livewire('/admin/login', 'pages-admin::login')->name('admin_login');
Route::prefix('/admin')->middleware('auth')->group(function () {
    Route::livewire('/dashboard', 'pages-admin::dashboard')->name('admin_dashboard');

    Route::livewire('/user', 'pages-admin::user.list')->name('user_list');
    Route::livewire('/user/add', 'pages-admin::user.ae')->name('user_add');
    Route::livewire('/user/edit/{id}', 'pages-admin::user.ae')->name('user_edit');

    Route::livewire('/galeri', 'pages-admin::galeri.list')->name('galeri_list');
    Route::livewire('/galeri/add', 'pages-admin::galeri.ae')->name('galeri_add');
    Route::livewire('/galeri/edit/{id}', 'pages-admin::galeri.ae')->name('galeri_edit');

    Route::livewire('/our-service', 'pages-admin::our-service.list')->name('our_service_list');
    Route::livewire('/our-service/add', 'pages-admin::our-service.ae')->name('our_service_add');
    Route::livewire('/our-service/edit/{id}', 'pages-admin::our-service.ae')->name('our_service_edit');

    Route::livewire('/paket', 'pages-admin::paket.list')->name('paket_list');
    Route::livewire('/paket/add', 'pages-admin::paket.ae')->name('paket_add');
    Route::livewire('/paket/edit/{id}', 'pages-admin::paket.ae')->name('paket_edit');

    Route::livewire('/testimoni', 'pages-admin::testimoni.list')->name('testimoni_list');
    Route::livewire('/testimoni/add', 'pages-admin::testimoni.ae')->name('testimoni_add');
    Route::livewire('/testimoni/edit/{id}', 'pages-admin::testimoni.ae')->name('testimoni_edit');
});

