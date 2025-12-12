<?php

namespace Database\Factories;

use App\Models\SertifikasiRegistration;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SertifikasiRegistration>
 */
class SertifikasiRegistrationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<SertifikasiRegistration>
     */
    protected $model = SertifikasiRegistration::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'nip' => '1989'.$this->faker->unique()->numerify('#######'),
            'program_studi' => $this->faker->randomElement([
                'Teknik Logistik',
                'Bisnis Digital',
                'Sistem Informasi',
                'Teknik Industri',
                'RPL',
            ]),
            'whatsapp' => '08'.$this->faker->numerify('##########'),
            'tanggal_pelaksanaan' => $this->faker->date(),
            'poster_path' => 'poster-sertifikasi/'.$this->faker->unique()->lexify('poster_????.jpg'),
        ];
    }
}

