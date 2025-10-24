<?php

namespace Database\Seeders;

use App\Models\LombaRegistration;
use App\Models\SertifikasiRegistration;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        LombaRegistration::factory()->count(5)->create();
        SertifikasiRegistration::factory()->count(5)->create();
    }
}
