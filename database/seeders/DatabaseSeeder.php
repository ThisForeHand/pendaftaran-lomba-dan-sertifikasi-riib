<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Dosen;
use App\Models\LombaRegistration;
use App\Models\SertifikasiRegistration;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        LombaRegistration::factory()->count(5)->create();
        SertifikasiRegistration::factory()->count(5)->create();

        Admin::query()->firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
            ],
        );

        Dosen::query()->firstOrCreate(
            ['email' => 'dosen@example.com'],
            [
                'name' => 'Dosen Pembimbing',
                'phone' => '081234567890',
                'password' => Hash::make('dosen123'),
            ],
        );
    }
}
