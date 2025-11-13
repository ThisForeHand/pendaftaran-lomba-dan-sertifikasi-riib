<?php

use App\Http\Controllers\LombaRegistrationController;
use Illuminate\Support\Facades\Route;

// -----------------------------------------------------------------------------
// Lecturer dashboard routes (guard: auth:lecturer)
// -----------------------------------------------------------------------------
Route::middleware('auth:lecturer')->group(function () {
    Route::get('/dosen/lomba', [LombaRegistrationController::class, 'lecturerDashboard'])->name('dosen.lomba');
    Route::get('/dosen/lomba/download', [LombaRegistrationController::class, 'downloadLecturerRegistrations'])->name('dosen.lomba.download');
});
