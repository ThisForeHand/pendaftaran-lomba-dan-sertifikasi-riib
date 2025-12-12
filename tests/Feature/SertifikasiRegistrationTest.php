<?php

namespace Tests\Feature;

use App\Models\SertifikasiRegistration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
        Storage::fake('public');

        $payload = [
            'nama' => 'Satria Purnama',
            'nip' => '198900123',
            'program_studi' => 'Teknik Logistik',
            'whatsapp' => '089876543210',
            'tanggal_pelaksanaan' => '2025-05-20',
            'poster_sertifikasi' => UploadedFile::fake()->image('poster.jpg'),
        ];

        $response = $this->post(route('pendaftaran.sertifikasi.store'), $payload);

        $expectedStatus = 'Terima kasih! Data pendaftaran sertifikasi Anda telah kami terima. Kami akan segera menghubungi Anda untuk informasi selanjutnya. Untuk briefing jadwal belajar dan pengumpulan berkas, segera gabung ke channel WhatsApp ' . config('komunitas.sertifikasi.name') . '.';

        $response
            ->assertRedirect(route('pendaftaran.sertifikasi'))
            ->assertSessionHas('status', $expectedStatus);

        $registration = SertifikasiRegistration::first();

        $this->assertNotNull($registration);
        $this->assertEquals('Satria Purnama', $registration->nama);
        $this->assertEquals('198900123', $registration->nip);
        $this->assertEquals('Teknik Logistik', $registration->program_studi);
        $this->assertEquals('089876543210', $registration->whatsapp);
        $this->assertEquals('2025-05-20', $registration->tanggal_pelaksanaan);
        Storage::disk('public')->assertExists($registration->poster_path);
    }

    public function test_user_can_submit_certification_registration_with_plus_62_number(): void
    {
        Storage::fake('public');

        $payload = [
            'nama' => 'Gilang Raharja',
            'nip' => '199900001',
            'program_studi' => 'Bisnis Digital',
            'whatsapp' => '+628229991111',
            'tanggal_pelaksanaan' => '2025-06-15',
            'poster_sertifikasi' => UploadedFile::fake()->image('poster-plus.jpg'),
        ];

        $response = $this->post(route('pendaftaran.sertifikasi.store'), $payload);

        $response
            ->assertRedirect(route('pendaftaran.sertifikasi'))
            ->assertSessionHas('status');

        $registration = SertifikasiRegistration::first();

        $this->assertNotNull($registration);
        $this->assertEquals('Gilang Raharja', $registration->nama);
        $this->assertEquals('199900001', $registration->nip);
        $this->assertEquals('Bisnis Digital', $registration->program_studi);
        $this->assertEquals('+628229991111', $registration->whatsapp);
        $this->assertEquals('2025-06-15', $registration->tanggal_pelaksanaan);
        Storage::disk('public')->assertExists($registration->poster_path);
    }

    public function test_certification_registration_rejects_invalid_whatsapp_number(): void
    {
        Storage::fake('public');

        $payload = [
            'nama' => 'Hani Putri',
            'nip' => '199900999',
            'program_studi' => 'Sistem Informasi',
            'whatsapp' => '98765',
            'tanggal_pelaksanaan' => '2025-06-20',
            'poster_sertifikasi' => UploadedFile::fake()->image('invalid-wa.jpg'),
        ];

        $this->post(route('pendaftaran.sertifikasi.store'), $payload)
            ->assertSessionHasErrors('whatsapp');

        $this->assertDatabaseCount('sertifikasi_registrations', 0);
    }

    public function test_admin_dashboard_displays_registration_records(): void
    {
        $registration = SertifikasiRegistration::factory()->create([
            'nama' => 'Nadya Kusuma',
            'nip' => '19981112223',
            'program_studi' => 'RPL',
            'whatsapp' => '082233445566',
            'tanggal_pelaksanaan' => '2025-07-10',
        ]);

        $this->get(route('admin.sertifikasi'))
            ->assertOk()
            ->assertSeeText($registration->nama)
            ->assertSeeText($registration->nip)
            ->assertSeeText($registration->tanggal_pelaksanaan);
    }
}

