<?php

namespace App\Http\Controllers;

use App\Models\SertifikasiRegistration;
use App\Rules\IndonesianPhoneNumber;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
                $table->string('nip');
                $table->string('prodi');
                $table->string('whatsapp');
                $table->date('tanggal_pelaksanaan');
                $table->string('poster_path');
                $table->timestamps();
            });
        }

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'string', 'max:255'],
            'prodi' => ['required', 'string', 'max:255'],
            'whatsapp' => ['required', 'string', 'max:255', new IndonesianPhoneNumber()],
            'tanggal_pelaksanaan' => ['required', 'date'],
            'poster_sertifikasi' => ['required', 'image', 'max:2048'],
        ]);

        $posterPath = $validated['poster_sertifikasi']->store('poster-sertifikasi', 'public');

        $payload = [
            'nama' => $validated['nama'],
            'nip' => $validated['nip'],
            'prodi' => $validated['prodi'],
            'whatsapp' => $validated['whatsapp'],
            'tanggal_pelaksanaan' => $validated['tanggal_pelaksanaan'],
            'poster_path' => $posterPath,
        ];

        SertifikasiRegistration::create($payload);

        $communityName = config('komunitas.sertifikasi.name');

        return redirect()
            ->route('pendaftaran.sertifikasi')
            ->with('status', "Terima kasih! Data pendaftaran sertifikasi Anda telah kami terima. Kami akan segera menghubungi Anda untuk informasi selanjutnya. Untuk briefing jadwal belajar dan pengumpulan berkas, segera gabung ke channel WhatsApp {$communityName}.");
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
            'NIP',
            'Prodi',
            'No. WhatsApp',
            'Tanggal Pelaksanaan',
            'Poster Sertifikasi',
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
                echo '<td>' . $escape($registration->nip) . '</td>';
                echo '<td>' . $escape($registration->prodi) . '</td>';
                echo '<td>' . $escape($registration->whatsapp) . '</td>';
                echo '<td>' . $escape($registration->tanggal_pelaksanaan) . '</td>';

                $posterUrl = $registration->poster_path
                    ? Storage::disk('public')->url($registration->poster_path)
                    : '';

                echo '<td>' . ($posterUrl ? '<a href="' . $escape($posterUrl) . '">Lihat Poster</a>' : '-') . '</td>';
                echo '<td>' . $escape($formattedDate) . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        }, 'data-pendaftaran-sertifikasi.xls', [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        if (! Schema::hasTable('sertifikasi_registrations')) {
            return back()->with('status', 'Tabel pendaftaran sertifikasi belum tersedia.');
        }

        $validated = $request->validate([
            'ids' => ['array'],
            'ids.*' => ['integer'],
            'clear_all' => ['nullable', 'boolean'],
        ]);

        $clearAll = (bool) ($validated['clear_all'] ?? false);

        if ($clearAll) {
            SertifikasiRegistration::query()->delete();

            return back()->with('status', 'Semua data pendaftaran sertifikasi berhasil dihapus.');
        }

        $ids = $validated['ids'] ?? [];

        if (! empty($ids)) {
            SertifikasiRegistration::query()->whereIn('id', $ids)->delete();

            return back()->with('status', 'Data pendaftaran sertifikasi terpilih berhasil dihapus.');
        }

        return back()->with('status', 'Tidak ada data yang dipilih untuk dihapus.');
    }
}
