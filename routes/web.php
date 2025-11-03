<?php

use App\Http\Controllers\AdminLecturerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LombaRegistrationController;
use App\Http\Controllers\SertifikasiRegistrationController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/portal-lomba');
Route::view('/portal-lomba', 'User_lomba.welcome-lomba')->name('portal.lomba');
Route::view('/portal-sertifikasi', 'user_sertifikasi.welcome-sertifikasi')->name('portal.sertifikasi');

Route::get('/pendaftaran-lomba', [LombaRegistrationController::class, 'create'])->name('pendaftaran.lomba');
Route::post('/pendaftaran-lomba', [LombaRegistrationController::class, 'store'])->name('pendaftaran.lomba.store');

Route::get('/pendaftaran-sertifikasi', [SertifikasiRegistrationController::class, 'create'])->name('pendaftaran.sertifikasi');
Route::post('/pendaftaran-sertifikasi', [SertifikasiRegistrationController::class, 'store'])->name('pendaftaran.sertifikasi.store');

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/lomba', [LombaRegistrationController::class, 'index'])->name('admin.lomba');
    Route::get('/admin/lomba/download', [LombaRegistrationController::class, 'downloadAdminRegistrations'])->name('admin.lomba.download');
    Route::get('/admin/sertifikasi', [SertifikasiRegistrationController::class, 'index'])->name('admin.sertifikasi');
    Route::get('/admin/sertifikasi/download', [SertifikasiRegistrationController::class, 'downloadAdminRegistrations'])->name('admin.sertifikasi.download');
    Route::get('/admin/dosen/create', [AdminLecturerController::class, 'create'])->name('admin.dosen.create');
    Route::post('/admin/dosen', [AdminLecturerController::class, 'store'])->name('admin.dosen.store');
});

Route::middleware('auth:lecturer')->group(function () {
    Route::get('/dosen/lomba', [LombaRegistrationController::class, 'lecturerDashboard'])->name('dosen.lomba');
    Route::get('/dosen/lomba/download', [LombaRegistrationController::class, 'downloadLecturerRegistrations'])->name('dosen.lomba.download');
});
