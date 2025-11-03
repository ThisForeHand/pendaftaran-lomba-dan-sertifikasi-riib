<?php

return [
    'admin' => [
        'name' => env('ADMIN_NAME', 'Administrator'),
        'username' => env('ADMIN_USERNAME', 'admin'),
        'email' => env('ADMIN_EMAIL', 'admin@example.com'),
        'password' => env('ADMIN_PASSWORD', 'admin123'),
    ],

    'lecturer' => [
        'name' => env('DOSEN_NAME', 'Dosen Pembimbing'),
        'username' => env('DOSEN_USERNAME', 'dosen'),
        'email' => env('DOSEN_EMAIL', 'dosen@example.com'),
        'password' => env('DOSEN_PASSWORD', 'dosen123'),
        'phone' => env('DOSEN_PHONE'),
        'program_studi' => env('DOSEN_PROGRAM_STUDI'),
    ],
];
