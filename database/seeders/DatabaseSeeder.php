<?php

namespace Database\Seeders;

use App\Models\LombaRegistration;
use App\Models\SertifikasiRegistration;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        LombaRegistration::factory()->count(5)->create();
        SertifikasiRegistration::factory()->count(5)->create();
    }
}
