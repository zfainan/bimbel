<?php

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::resource('siswa', SiswaController::class);
    Route::resource('alumni', AlumniController::class);
    Route::resource('users', UserController::class);
});

Auth::routes();
