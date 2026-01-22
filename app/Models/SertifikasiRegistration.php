<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SertifikasiRegistration extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'nip',
        'email',
        'program_studi',
        'whatsapp',
        'status_pegawai',
        'judul_sertifikasi',
        'waktu_pelaksanaan',
        'tempat',
        'penyelenggara',
        'cp_penyelenggara',
        'web_penyelenggara',
        'biaya',
        'justifikasi_pemilihan_judul',
        'tanggal_pelaksanaan',
        'poster_path',
    ];
}
