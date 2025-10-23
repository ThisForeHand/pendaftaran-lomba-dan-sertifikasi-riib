<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::view('/pendaftaran-lomba', 'pendaftaran-lomba')->name('pendaftaran.lomba');
