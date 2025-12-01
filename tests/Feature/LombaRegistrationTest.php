<?php

namespace Tests\Feature;

use App\Models\LombaRegistration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LombaRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_form_is_accessible(): void
    {
        $this->get(route('pendaftaran.lomba'))
            ->assertOk()
            ->assertSeeText('Pendaftaran Persiapan Peserta Lomba Innovillage 2025');
    }

    public function test_user_can_submit_registration_data(): void
    {
        $payload = [
            'nama' => 'Dewi Lestari',
            'nim' => '231234567',
            'program_studi' => 'Teknik Logistik',
            'whatsapp' => '081234567890',
            'pilihan_peran' => 'Ketua',
            'motivasi' => 'Ingin mengembangkan ide sosial.',
            'status_tim' => 'Belum',
        ];

        $response = $this->post(route('pendaftaran.lomba.store'), $payload);

        $expectedStatus = 'Terima kasih! Data pendaftaran lomba Anda telah kami terima. Kami akan segera menghubungi Anda untuk informasi selanjutnya. Untuk koordinasi teknis dan info terbaru, segera gabung ke channel WhatsApp ' . config('komunitas.lomba.name') . '.';

        $response
            ->assertRedirect(route('pendaftaran.lomba'))
            ->assertSessionHas('status', $expectedStatus);

        $this->assertDatabaseHas('lomba_registrations', $payload);
    }

    public function test_user_can_submit_registration_data_with_international_format_number(): void
    {
        $payload = [
            'nama' => 'Ayu Mentari',
            'nim' => '239988776',
            'program_studi' => 'Bisnis Digital',
            'whatsapp' => '+6281234567890',
            'pilihan_peran' => 'Hacker',
            'motivasi' => 'Siap membantu teknis tim.',
            'status_tim' => 'Sudah',
        ];

        $response = $this->post(route('pendaftaran.lomba.store'), $payload);

        $response
            ->assertRedirect(route('pendaftaran.lomba'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('lomba_registrations', $payload);
    }

    public function test_registration_rejects_invalid_whatsapp_number(): void
    {
        $payload = [
            'nama' => 'Joko Ananda',
            'nim' => '23001122',
            'program_studi' => 'Sistem Informasi',
            'whatsapp' => '12345',
            'pilihan_peran' => 'Hipster',
            'motivasi' => 'Siap membawa visual terbaik.',
            'status_tim' => 'Belum',
        ];

        $this->post(route('pendaftaran.lomba.store'), $payload)
            ->assertSessionHasErrors('whatsapp');

        $this->assertDatabaseCount('lomba_registrations', 0);
    }

    public function test_admin_dashboard_displays_registration_records(): void
    {
        $registration = LombaRegistration::factory()->create([
            'nama' => 'Raka Pradipta',
            'nim' => '239998877',
            'program_studi' => 'RPL',
            'whatsapp' => '081111222233',
            'pilihan_peran' => 'Hipster',
            'status_tim' => 'Sudah',
        ]);

        $this->get(route('admin.lomba'))
            ->assertOk()
            ->assertSeeText($registration->nama)
            ->assertSeeText($registration->nim)
            ->assertSeeText($registration->pilihan_peran);
    }
}

