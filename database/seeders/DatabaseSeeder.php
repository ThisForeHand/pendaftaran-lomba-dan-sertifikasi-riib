<?php

namespace Database\Seeders;

use App\Models\LombaRegistration;
use App\Models\SertifikasiRegistration;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $hasUsernameColumn = Schema::hasColumn('users', 'username');

        $lookup = $hasUsernameColumn
            ? ['username' => 'admin123']
            : ['email' => 'admin@example.com'];

        $defaults = [
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
        ];

        if ($hasUsernameColumn) {
            $defaults['username'] = 'admin123';
        }

        User::query()->updateOrCreate($lookup, $defaults);

        LombaRegistration::factory()->count(5)->create();
        SertifikasiRegistration::factory()->count(5)->create();
    }
}
