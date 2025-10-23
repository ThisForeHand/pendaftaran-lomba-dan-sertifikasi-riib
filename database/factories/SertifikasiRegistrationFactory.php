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
            'nim' => '23'.$this->faker->unique()->numerify('#######'),
            'program_studi' => $this->faker->randomElement([
                'Teknik Industri',
                'Teknik Informatika',
                'Teknik Elektro',
                'Lainnya',
            ]),
            'whatsapp' => '08'.$this->faker->numerify('##########'),
            'program_sertifikasi' => $this->faker->randomElement([
                'Digital Marketing Strategy',
                'Data Analytics Fundamentals',
                'Project Management Associate',
            ]),
            'motivasi' => $this->faker->optional()->sentence(10),
            'status_sertifikasi' => $this->faker->randomElement([
                'Belum pernah',
                'Upgrade level',
                'Perpanjangan',
            ]),
        ];
    }
}

