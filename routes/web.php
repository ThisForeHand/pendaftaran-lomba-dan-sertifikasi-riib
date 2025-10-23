<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\LombaRegistrationController;
use App\Http\Controllers\SertifikasiRegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pendaftaran-lomba', [LombaRegistrationController::class, 'create'])->name('pendaftaran.lomba');
Route::post('/pendaftaran-lomba', [LombaRegistrationController::class, 'store'])->name('pendaftaran.lomba.store');

Route::get('/pendaftaran-sertifikasi', [SertifikasiRegistrationController::class, 'create'])->name('pendaftaran.sertifikasi');
Route::post('/pendaftaran-sertifikasi', [SertifikasiRegistrationController::class, 'store'])->name('pendaftaran.sertifikasi.store');

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'create'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'store'])->name('admin.login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/admin/logout', [AdminAuthController::class, 'destroy'])->name('admin.logout');
    Route::get('/admin/lomba', [LombaRegistrationController::class, 'index'])->name('admin.lomba');
    Route::get('/admin/sertifikasi', [SertifikasiRegistrationController::class, 'index'])->name('admin.sertifikasi');
});
