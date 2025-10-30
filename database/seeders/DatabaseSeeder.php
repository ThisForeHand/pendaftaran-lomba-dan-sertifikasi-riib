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
            ['username' => 'admin'],
            [
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
            ],
        );

        Dosen::query()->firstOrCreate(
            ['username' => 'dosen'],
            [
                'name' => 'Dosen Pembimbing',
                'email' => 'dosen@example.com',
                'phone' => '081234567890',
                'password' => Hash::make('dosen123'),
            ],
        );
    }
}
