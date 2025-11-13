<?php

namespace App\Http\Controllers;

use App\Models\SertifikasiRegistration;
use App\Rules\IndonesianPhoneNumber;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SertifikasiRegistrationController extends Controller
{
    /**
     * Display the registration form.
     */
    public function create(): View
    {
        return view('modules.sertifikasi.pendaftaran-sertifikasi');
    }

    /**
     * Store a new certification registration.
     */
    public function store(Request $request): RedirectResponse
    {
        if (! Schema::hasTable('sertifikasi_registrations')) {
            Schema::create('sertifikasi_registrations', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->string('nim');
                $table->string('program_studi');
                $table->string('whatsapp');
                $table->string('program_sertifikasi');
                $table->text('motivasi')->nullable();
                $table->string('status_sertifikasi');
                $table->timestamps();
            });
        }

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:255'],
            'program_studi' => ['required', 'string', 'max:255'],
            'whatsapp' => ['required', 'string', 'max:255', new IndonesianPhoneNumber()],
            'program_sertifikasi' => ['required', 'string', 'max:255'],
            'motivasi' => ['nullable', 'string'],
            'status_sertifikasi' => ['required', 'string', 'max:255'],
        ]);

        SertifikasiRegistration::create($validated);

        $communityName = config('komunitas.sertifikasi.name');

        return redirect()
            ->route('pendaftaran.sertifikasi')
            ->with('status', "Terima kasih! Data pendaftaran sertifikasi Anda telah kami terima. Kami akan segera menghubungi Anda untuk informasi selanjutnya. Untuk briefing jadwal belajar dan pengumpulan berkas, segera gabung ke komunitas WhatsApp {$communityName}.");
    }

    /**
     * Display the certification registrations for admins.
     */
    public function index(): View
    {
        $sertifikasiTableExists = Schema::hasTable('sertifikasi_registrations');

        $sertifikasiRegistrations = $sertifikasiTableExists
            ? SertifikasiRegistration::latest()->get()
            : collect();

        return view('modules.admin.sertifikasi', [
            'activeTab' => 'sertifikasi',
            'tableExists' => $sertifikasiTableExists,
            'registrations' => $sertifikasiRegistrations,
        ]);
    }

    public function downloadAdminRegistrations(): StreamedResponse
    {
        $tableExists = Schema::hasTable('sertifikasi_registrations');

        $registrations = $tableExists
            ? SertifikasiRegistration::query()->latest()->get()
            : collect();

        $headers = [
            'No',
            'Nama',
            'NIM',
            'Program Studi',
            'No. WhatsApp',
            'Program Sertifikasi',
            'Status Sertifikasi',
            'Tanggal Pendaftaran',
        ];

        return response()->streamDownload(function () use ($registrations, $headers) {
            $escape = static fn ($value) => htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');

            echo '<table border="1">';
            echo '<thead><tr>';

            foreach ($headers as $header) {
                echo '<th>' . $escape($header) . '</th>';
            }

            echo '</tr></thead>';
            echo '<tbody>';

            foreach ($registrations as $index => $registration) {
                $formattedDate = $registration->created_at
                    ? $registration->created_at->format('Y-m-d H:i:s')
                    : '';

                echo '<tr>';
                echo '<td>' . $escape($index + 1) . '</td>';
                echo '<td>' . $escape($registration->nama) . '</td>';
                echo '<td>' . $escape($registration->nim) . '</td>';
                echo '<td>' . $escape($registration->program_studi) . '</td>';
                echo '<td>' . $escape($registration->whatsapp) . '</td>';
                echo '<td>' . $escape($registration->program_sertifikasi) . '</td>';
                echo '<td>' . $escape($registration->status_sertifikasi) . '</td>';
                echo '<td>' . $escape($formattedDate) . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        }, 'data-pendaftaran-sertifikasi.xls', [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
        ]);
    }
}
