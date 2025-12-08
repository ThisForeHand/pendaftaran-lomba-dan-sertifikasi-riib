<?php

use App\Http\Controllers\Api\LombaRegistrationApiController;
use App\Http\Controllers\Api\RegistrationFlowApiController;
use App\Http\Controllers\Api\SertifikasiRegistrationApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/flows/{type}', [RegistrationFlowApiController::class, 'show'])
        ->whereIn('type', ['lomba', 'sertifikasi']);

    Route::get('/registrations/lomba', [LombaRegistrationApiController::class, 'index']);
    Route::post('/registrations/lomba', [LombaRegistrationApiController::class, 'store']);

    Route::get('/registrations/sertifikasi', [SertifikasiRegistrationApiController::class, 'index']);
    Route::post('/registrations/sertifikasi', [SertifikasiRegistrationApiController::class, 'store']);
});
