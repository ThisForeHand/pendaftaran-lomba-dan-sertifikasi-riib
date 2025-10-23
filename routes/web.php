<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::view('/pendaftaran-lomba', 'pendaftaran-lomba')->name('pendaftaran.lomba');
Route::view('/pendaftaran-sertifikasi', 'pendaftaran-sertifikasi')->name('pendaftaran.sertifikasi');
