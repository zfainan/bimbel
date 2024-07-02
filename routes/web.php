<?php

declare(strict_types=1);

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::prefix('master-data')->group(function () {
        Route::resource('siswa', SiswaController::class);

        Route::resource('alumni', AlumniController::class)
            ->except(['create', 'store']);

        Route::resource('users', UserController::class);

        Route::resource('program', ProgramController::class);
    });

    Route::resource('cabang', CabangController::class);

    Route::get('payments', [PaymentController::class, 'siswa'])
        ->name('payments.list-siswa');

    Route::resource('siswa.payments', PaymentController::class);

    Route::post('program/{program}/add-siswa', [ProgramController::class, 'addSiswa'])
        ->name('program.add-siswa');

    Route::post('program/{program}/remove-siswa/{siswa}', [ProgramController::class, 'removeSiswa'])
        ->name('program.remove-siswa');
});

Auth::routes();
