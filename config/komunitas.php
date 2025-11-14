<?php

return [
    'lomba' => [
        'name' => env('LOMBA_WHATSAPP_GROUP_NAME', 'Channel Info Lomba RIIB'),
        'whatsapp_link' => env('LOMBA_WHATSAPP_GROUP_LINK', 'https://whatsapp.com/channel/0029VbAnaf52ZjCnTgjAmC0K'),
        'description' => 'Channel ini dipakai untuk menyebarkan kabar lomba, briefing persiapan, serta dukungan mentor.',
    ],
    'sertifikasi' => [
        'name' => env('SERTIFIKASI_WHATSAPP_GROUP_NAME', 'Channel Sertifikasi RIIB'),
        'whatsapp_link' => env('SERTIFIKASI_WHATSAPP_GROUP_LINK', 'https://whatsapp.com/channel/0029VbBt0GDL2ATsZCJydk3y'),
        'description' => 'Channel ini berfokus pada info kelas sertifikasi, pengumpulan berkas, dan tips lulus ujian.',
    ],
];
