<?php

namespace Database\Seeders;

use App\Models\LombaRegistration;
use App\Models\SertifikasiRegistration;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['username' => 'admin123'],
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
            ]
        );

        LombaRegistration::factory()->count(5)->create();
        SertifikasiRegistration::factory()->count(5)->create();
    }
}
