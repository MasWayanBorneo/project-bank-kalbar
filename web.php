<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/daftar');
Route::livewire('/daftar', 'pages::register-form');

Route::livewire('/login', 'pages::login')->name('login')->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::livewire('/admin', 'pages::registration-list')->name('admin.index');
    Route::livewire('/admin/{registration}/edit', 'pages::edit-registration')->name('admin.edit');
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->middleware('auth')->name('logout');