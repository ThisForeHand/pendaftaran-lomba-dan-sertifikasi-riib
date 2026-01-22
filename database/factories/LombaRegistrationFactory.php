<?php

namespace Database\Factories;

use App\Models\LombaRegistration;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LombaRegistration>
 */
class LombaRegistrationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<LombaRegistration>
     */
    protected $model = LombaRegistration::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'nim' => '23'.$this->faker->unique()->numerify('#######'),
            'program_studi' => $this->faker->randomElement([
                'Teknik Logistik',
                'Bisnis Digital',
                'Sistem Informasi',
                'Teknik Industri',
                'RPL',
            ]),
            'whatsapp' => '08'.$this->faker->numerify('##########'),
            'pilihan_peran' => $this->faker->randomElement([
                'Koordinator',
                'Hacker',
                'Hipster',
            ]),
            'motivasi' => $this->faker->optional()->sentence(10),
            'status_tim' => $this->faker->randomElement([
                'Sudah',
                'Belum',
                'Belum namun siap mencari anggota',
            ]),
            'pernyataan_komitmen' => true,
        ];
    }
}
