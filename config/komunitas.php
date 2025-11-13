<?php

return [
    'lomba' => [
        'name' => env('LOMBA_WHATSAPP_GROUP_NAME', 'Ruang Juara RIIB'),
        'whatsapp_link' => env('LOMBA_WHATSAPP_GROUP_LINK', 'https://wa.me/message/RIIBLomba'),
        'description' => 'Komunitas ini dipakai untuk menyebarkan kabar lomba, briefing persiapan, serta dukungan mentor.',
    ],
    'sertifikasi' => [
        'name' => env('SERTIFIKASI_WHATSAPP_GROUP_NAME', 'Ruang Kompetensi RIIB'),
        'whatsapp_link' => env('SERTIFIKASI_WHATSAPP_GROUP_LINK', 'https://wa.me/message/RIIBSertifikasi'),
        'description' => 'Komunitas ini berfokus pada info kelas sertifikasi, pengumpulan berkas, dan tips lulus ujian.',
    ],
];
