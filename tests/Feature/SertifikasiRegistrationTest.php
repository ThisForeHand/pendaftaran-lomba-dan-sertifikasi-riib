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
            'program_studi' => 'Teknik Logistik',
            'whatsapp' => '089876543210',
            'program_sertifikasi' => 'Data Analytics Fundamentals',
            'motivasi' => 'Meningkatkan kemampuan analisis data.',
            'status_sertifikasi' => 'Upgrade level',
        ];

        $response = $this->post(route('pendaftaran.sertifikasi.store'), $payload);

        $expectedStatus = 'Terima kasih! Data pendaftaran sertifikasi Anda telah kami terima. Kami akan segera menghubungi Anda untuk informasi selanjutnya. Untuk briefing jadwal belajar dan pengumpulan berkas, segera gabung ke channel WhatsApp ' . config('komunitas.sertifikasi.name') . '.';

        $response
            ->assertRedirect(route('pendaftaran.sertifikasi'))
            ->assertSessionHas('status', $expectedStatus);

        $this->assertDatabaseHas('sertifikasi_registrations', $payload);
    }

    public function test_user_can_submit_certification_registration_with_plus_62_number(): void
    {
        $payload = [
            'nama' => 'Gilang Raharja',
            'nim' => '237770001',
            'program_studi' => 'Bisnis Digital',
            'whatsapp' => '+628229991111',
            'program_sertifikasi' => 'AI Fundamentals',
            'motivasi' => 'Ingin menambah kompetensi baru.',
            'status_sertifikasi' => 'Belum pernah',
        ];

        $response = $this->post(route('pendaftaran.sertifikasi.store'), $payload);

        $response
            ->assertRedirect(route('pendaftaran.sertifikasi'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('sertifikasi_registrations', $payload);
    }

    public function test_certification_registration_rejects_invalid_whatsapp_number(): void
    {
        $payload = [
            'nama' => 'Hani Putri',
            'nim' => '230000999',
            'program_studi' => 'Sistem Informasi',
            'whatsapp' => '98765',
            'program_sertifikasi' => 'Cloud Computing',
            'motivasi' => 'Menyelesaikan sertifikasi wajib.',
            'status_sertifikasi' => 'Belum pernah',
        ];

        $this->post(route('pendaftaran.sertifikasi.store'), $payload)
            ->assertSessionHasErrors('whatsapp');

        $this->assertDatabaseCount('sertifikasi_registrations', 0);
    }

    public function test_admin_dashboard_displays_registration_records(): void
    {
        $registration = SertifikasiRegistration::factory()->create([
            'nama' => 'Nadya Kusuma',
            'nim' => '231112223',
            'program_studi' => 'RPL',
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

