<?php

namespace Tests\Feature;

use App\Models\SertifikasiRegistration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SertifikasiRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_form_is_accessible(): void
    {
        $this->get(route('pendaftaran.sertifikasi'))
            ->assertOk()
            ->assertSeeText('Pendaftaran Sertifikasi');
    }

    public function test_user_can_submit_registration_data(): void
    {
        $payload = [
            'nama' => 'Satria Purnama',
            'nim' => '239876543',
            'program_studi' => 'Teknik Informatika',
            'whatsapp' => '089876543210',
            'program_sertifikasi' => 'Data Analytics Fundamentals',
            'motivasi' => 'Meningkatkan kemampuan analisis data.',
            'status_sertifikasi' => 'Upgrade level',
        ];

        $response = $this->post(route('pendaftaran.sertifikasi.store'), $payload);

        $response
            ->assertRedirect(route('pendaftaran.sertifikasi'))
            ->assertSessionHas('status', 'Terima kasih! Data pendaftaran sertifikasi berhasil dikirim.');

        $this->assertDatabaseHas('sertifikasi_registrations', $payload);
    }

    public function test_admin_dashboard_displays_registration_records(): void
    {
        $registration = SertifikasiRegistration::factory()->create([
            'nama' => 'Nadya Kusuma',
            'nim' => '231112223',
            'program_studi' => 'Teknik Elektro',
            'whatsapp' => '082233445566',
            'program_sertifikasi' => 'Project Management Associate',
            'status_sertifikasi' => 'Perpanjangan',
        ]);

        $this->get(route('admin.sertifikasi'))
            ->assertOk()
            ->assertSeeText($registration->nama)
            ->assertSeeText($registration->nim)
            ->assertSeeText($registration->program_sertifikasi);
    }
}

