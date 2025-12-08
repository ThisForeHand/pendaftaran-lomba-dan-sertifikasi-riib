<?php

namespace Tests\Feature;

use App\Models\RegistrationFlow;
use App\Models\SertifikasiRegistration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_flow_steps_for_lomba(): void
    {
        RegistrationFlow::create([
            'type' => 'lomba',
            'sequence' => 1,
            'title' => 'Registrasi',
            'description' => 'Isi formulir pendaftaran lomba.',
            'link' => 'https://example.com/register',
        ]);

        $response = $this->getJson('/api/v1/flows/lomba');

        $response
            ->assertOk()
            ->assertJsonPath('meta.type', 'lomba')
            ->assertJsonPath('meta.total', 1)
            ->assertJsonFragment([
                'title' => 'Registrasi',
                'description' => 'Isi formulir pendaftaran lomba.',
            ]);
    }

    public function test_it_can_store_lomba_registration_via_api(): void
    {
        $payload = [
            'nama' => 'Siti Laras',
            'nim' => '239988877',
            'program_studi' => 'Sistem Informasi',
            'whatsapp' => '081234567889',
            'pilihan_peran' => 'Hipster',
            'motivasi' => 'Siap membantu presentasi.',
            'status_tim' => 'Sudah',
        ];

        $response = $this->postJson('/api/v1/registrations/lomba', $payload);

        $response
            ->assertCreated()
            ->assertJsonPath('data.nama', 'Siti Laras')
            ->assertJsonPath('message', 'Pendaftaran lomba berhasil disimpan.');

        $this->assertDatabaseHas('lomba_registrations', $payload);
    }

    public function test_it_lists_sertifikasi_registrations(): void
    {
        $registration = SertifikasiRegistration::factory()->create([
            'nama' => 'Rian Maulana',
            'nim' => '238887766',
            'program_studi' => 'Bisnis Digital',
            'whatsapp' => '081122334455',
            'program_sertifikasi' => 'Junior Cloud',
            'status_sertifikasi' => 'Belum',
        ]);

        $response = $this->getJson('/api/v1/registrations/sertifikasi');

        $response
            ->assertOk()
            ->assertJsonPath('meta.total', 1)
            ->assertJsonFragment([
                'nama' => $registration->nama,
                'program_sertifikasi' => 'Junior Cloud',
            ]);
    }
}
