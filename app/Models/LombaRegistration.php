<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LombaRegistration extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'nim',
        'email',
        'program_studi',
        'whatsapp',
        'pilihan_peran',
        'motivasi',
        'status_tim',
        'pernyataan_komitmen',
    ];

    protected $casts = [
        'pernyataan_komitmen' => 'boolean',
    ];
}
