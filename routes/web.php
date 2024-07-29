<?php

declare(strict_types=1);

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\JadwalAjarController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PertemuanController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ReportController;
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

        Route::resource('jadwal-ajar', JadwalAjarController::class)->except(['show']);
    });

    Route::resource('cabang', CabangController::class);

    // jadwal pertemuan
    Route::get('jadwal', [PertemuanController::class, 'jadwal'])
        ->name('jadwal.pertemuan');

    Route::resource('jadwal.pertemuan', PertemuanController::class);

    // pembayaran
    Route::get('payments', [PaymentController::class, 'siswa'])
        ->name('payments.list-siswa');

    Route::post('payments/generate/report', [PaymentController::class, 'report'])
        ->name('payments.generate-report');

    // pembayaran program per siswa
    Route::resource('siswa.payments', PaymentController::class);

    Route::post('payments/{payment}/download', [PaymentController::class, 'download'])->name('payments.download');

    // siswa pada program
    Route::post('program/{program}/add-siswa', [ProgramController::class, 'addSiswa'])
        ->name('program.add-siswa');

    Route::post('program/{program}/remove-siswa/{siswa}', [ProgramController::class, 'removeSiswa'])
        ->name('program.remove-siswa');

    // presensi
    Route::post('presensi', [PresensiController::class, 'store'])->name('presensi.store');

    Route::prefix('reports')->group(function () {
        // laporan pembayaran
        Route::view('payments', 'reports.payments')
            ->name('reports.payments.create');
        Route::post('payments', [ReportController::class, 'downloadPayments'])
            ->name('reports.payments');

        // laporan presensi
        Route::post('presensi', [ReportController::class, 'downloadPresensi'])
            ->name('reports.presensi');
        Route::get('presensi', [ReportController::class, 'createPresensi'])
            ->name('reports.presensi.create');

        // laporan alumni
        Route::view('alumni', 'reports.alumni.create')
        ->name('reports.alumni.create');
        Route::post('alumni', [ReportController::class, 'downloadAlumni'])
            ->name('reports.alumni');
    });
});

Auth::routes();
