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

        $adminDefaults = config('accounts.admin');
        $lecturerDefaults = config('accounts.lecturer');

        if (! empty($adminDefaults)) {
            Admin::query()->firstOrCreate(
                ['username' => $adminDefaults['username']],
                [
                    'name' => $adminDefaults['name'],
                    'email' => $adminDefaults['email'],
                    'password' => Hash::make($adminDefaults['password']),
                ],
            );
        }

        if (! empty($lecturerDefaults)) {
            Dosen::query()->firstOrCreate(
                ['username' => $lecturerDefaults['username']],
                [
                    'name' => $lecturerDefaults['name'],
                    'email' => $lecturerDefaults['email'],
                    'phone' => $lecturerDefaults['phone'],
                    'password' => Hash::make($lecturerDefaults['password']),
                ],
            );
        }
    }
}
