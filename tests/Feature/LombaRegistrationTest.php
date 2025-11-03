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
            'program_studi' => 'Teknik Industri',
            'whatsapp' => '081234567890',
            'pilihan_peran' => 'Ketua',
            'motivasi' => 'Ingin mengembangkan ide sosial.',
            'status_tim' => 'Belum',
        ];

        $response = $this->post(route('pendaftaran.lomba.store'), $payload);

        $response
            ->assertRedirect(route('pendaftaran.lomba'))
            ->assertSessionHas('status', 'Terima kasih! Data pendaftaran lomba berhasil dikirim. Akan dihubungi untuk informasi lebih lanjutnya.');

        $this->assertDatabaseHas('lomba_registrations', $payload);
    }

    public function test_admin_dashboard_displays_registration_records(): void
    {
        $registration = LombaRegistration::factory()->create([
            'nama' => 'Raka Pradipta',
            'nim' => '239998877',
            'program_studi' => 'Desain Produk',
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

