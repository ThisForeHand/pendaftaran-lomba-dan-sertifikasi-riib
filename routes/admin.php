<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminLecturerController;
use App\Http\Controllers\AdminRegistrationFlowController;
use App\Http\Controllers\LombaRegistrationController;
use App\Http\Controllers\SertifikasiRegistrationController;
use Illuminate\Support\Facades\Route;

// -----------------------------------------------------------------------------
// Admin dashboard routes (guard: auth:admin)
// -----------------------------------------------------------------------------
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/lomba', [LombaRegistrationController::class, 'index'])->name('admin.lomba');
    Route::get('/admin/lomba/download', [LombaRegistrationController::class, 'downloadAdminRegistrations'])->name('admin.lomba.download');

    Route::get('/admin/sertifikasi', [SertifikasiRegistrationController::class, 'index'])->name('admin.sertifikasi');
    Route::get('/admin/sertifikasi/download', [SertifikasiRegistrationController::class, 'downloadAdminRegistrations'])->name('admin.sertifikasi.download');

    Route::get('/admin/dosen/create', [AdminLecturerController::class, 'create'])->name('admin.dosen.create');
    Route::post('/admin/dosen', [AdminLecturerController::class, 'store'])->name('admin.dosen.store');

    Route::get('/admin/alur', [AdminRegistrationFlowController::class, 'index'])->name('admin.alur');
    Route::post('/admin/alur', [AdminRegistrationFlowController::class, 'store'])->name('admin.alur.store');
    Route::put('/admin/alur/{registrationFlow}', [AdminRegistrationFlowController::class, 'update'])->name('admin.alur.update');
    Route::delete('/admin/alur/{registrationFlow}', [AdminRegistrationFlowController::class, 'destroy'])->name('admin.alur.destroy');
});
