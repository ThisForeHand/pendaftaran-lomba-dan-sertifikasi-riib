<?php

namespace Database\Seeders;

use App\Models\LombaRegistration;
use App\Models\SertifikasiRegistration;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $hasUsernameColumn = Schema::hasColumn('users', 'username');

        $adminUsername = config('admin.username');
        $adminEmail = config('admin.email');
        $adminPassword = config('admin.password');
        $adminName = config('admin.name');

        $lookup = $hasUsernameColumn
            ? ['username' => $adminUsername]
            : ['email' => $adminEmail];

        $defaults = [
            'name' => $adminName,
            'email' => $adminEmail,
            'password' => $adminPassword,
        ];

        if ($hasUsernameColumn) {
            $defaults['username'] = $adminUsername;
        }

        User::query()->updateOrCreate($lookup, $defaults);

        LombaRegistration::factory()->count(5)->create();
        SertifikasiRegistration::factory()->count(5)->create();
    }
}
