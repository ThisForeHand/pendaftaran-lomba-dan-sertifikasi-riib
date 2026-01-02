<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LombaRegistrationController;
use App\Http\Controllers\PortalLandingController;
use App\Http\Controllers\SertifikasiRegistrationController;
use Illuminate\Support\Facades\Route;

// -----------------------------------------------------------------------------
// Public portal landing pages
// -----------------------------------------------------------------------------
Route::get('/', [PortalLandingController::class, 'lomba'])->name('portal.lomba');
Route::redirect('/portal-lomba', '/');
Route::get('/portal-sertifikasi', [PortalLandingController::class, 'sertifikasi'])->name('portal.sertifikasi');

// -----------------------------------------------------------------------------
// Registration flows for students and pembina
// -----------------------------------------------------------------------------
Route::get('/form-pendaftaran-lomba', [LombaRegistrationController::class, 'create'])->name('pendaftaran.lomba');
Route::post('/form-pendaftaran-lomba', [LombaRegistrationController::class, 'store'])->name('pendaftaran.lomba.store');
Route::redirect('/pendaftaran-lomba', '/form-pendaftaran-lomba');
Route::post('/pendaftaran-lomba', [LombaRegistrationController::class, 'store']);

Route::get('/pendaftaran-sertifikasi', [SertifikasiRegistrationController::class, 'create'])->name('pendaftaran.sertifikasi');
Route::post('/pendaftaran-sertifikasi', [SertifikasiRegistrationController::class, 'store'])->name('pendaftaran.sertifikasi.store');

// -----------------------------------------------------------------------------
// Authentication endpoints shared by every guard
// -----------------------------------------------------------------------------
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

require __DIR__.'/admin.php';
require __DIR__.'/lecturer.php';
