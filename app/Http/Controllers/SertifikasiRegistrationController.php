<?php

namespace App\Http\Controllers;

use App\Models\SertifikasiRegistration;
use App\Rules\IndonesianPhoneNumber;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $this->ensureTableSchema();

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'program_studi' => ['required', 'string', 'max:255'],
            'whatsapp' => ['required', 'string', 'max:255', new IndonesianPhoneNumber()],
            'status_pegawai' => ['required', 'string', 'max:255'],
            'judul_sertifikasi' => ['required', 'string', 'max:255'],
            'waktu_pelaksanaan' => ['required', 'string', 'max:255'],
            'tempat' => ['required', 'string', 'max:255'],
            'penyelenggara' => ['required', 'string', 'max:255'],
            'cp_penyelenggara' => ['required', 'string', 'max:255'],
            'web_penyelenggara' => ['required', 'string', 'max:255'],
            'biaya' => ['required', 'string', 'max:255'],
            'justifikasi_pemilihan_judul' => ['required', 'string', 'max:1000'],
            'tanggal_pelaksanaan' => ['required', 'date'],
            'poster_sertifikasi' => ['required', 'image', 'max:2048'],
        ]);

        $posterPath = $validated['poster_sertifikasi']->store('poster-sertifikasi', 'public');

        $payload = [
            'nama' => $validated['nama'],
            'nip' => $validated['nip'],
            'email' => $validated['email'],
            'program_studi' => $validated['program_studi'],
            'whatsapp' => $validated['whatsapp'],
            'status_pegawai' => $validated['status_pegawai'],
            'judul_sertifikasi' => $validated['judul_sertifikasi'],
            'waktu_pelaksanaan' => $validated['waktu_pelaksanaan'],
            'tempat' => $validated['tempat'],
            'penyelenggara' => $validated['penyelenggara'],
            'cp_penyelenggara' => $validated['cp_penyelenggara'],
            'web_penyelenggara' => $validated['web_penyelenggara'],
            'biaya' => $validated['biaya'],
            'justifikasi_pemilihan_judul' => $validated['justifikasi_pemilihan_judul'],
            'tanggal_pelaksanaan' => $validated['tanggal_pelaksanaan'],
            'poster_path' => $posterPath,
        ];

        SertifikasiRegistration::create($payload);

        $communityName = config('komunitas.sertifikasi.name');

        return redirect()
            ->route('pendaftaran.sertifikasi')
            ->with('status', "Terima kasih! Data pendaftaran sertifikasi Anda telah kami terima. Kami akan segera menghubungi Anda untuk informasi selanjutnya. Untuk briefing jadwal belajar dan pengumpulan berkas, segera gabung ke channel WhatsApp {$communityName}.");
    }

    protected function ensureTableSchema(): void
    {
        if (! Schema::hasTable('sertifikasi_registrations')) {
            Schema::create('sertifikasi_registrations', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->string('nip');
                $table->string('email');
                $table->string('program_studi');
                $table->string('whatsapp');
                $table->string('status_pegawai');
                $table->string('judul_sertifikasi');
                $table->string('waktu_pelaksanaan');
                $table->string('tempat');
                $table->string('penyelenggara');
                $table->string('cp_penyelenggara');
                $table->string('web_penyelenggara');
                $table->string('biaya');
                $table->text('justifikasi_pemilihan_judul');
                $table->date('tanggal_pelaksanaan');
                $table->string('poster_path');
                $table->timestamps();
            });

            return;
        }

        Schema::table('sertifikasi_registrations', function (Blueprint $table) {
            if (! Schema::hasColumn('sertifikasi_registrations', 'nama')) {
                $table->string('nama')->after('id');
            }

            if (! Schema::hasColumn('sertifikasi_registrations', 'nip')) {
                $table->string('nip')->after('nama');
            }

            if (! Schema::hasColumn('sertifikasi_registrations', 'email')) {
                $table->string('email')->after('nip')->nullable();
            }

            if (! Schema::hasColumn('sertifikasi_registrations', 'program_studi')) {
                $table->string('program_studi')->after('email')->nullable();
            }

            if (! Schema::hasColumn('sertifikasi_registrations', 'whatsapp')) {
                $table->string('whatsapp')->after('program_studi')->nullable();
            }

            if (! Schema::hasColumn('sertifikasi_registrations', 'status_pegawai')) {
                $table->string('status_pegawai')->after('whatsapp')->nullable();
            }

            if (! Schema::hasColumn('sertifikasi_registrations', 'judul_sertifikasi')) {
                $table->string('judul_sertifikasi')->after('status_pegawai')->nullable();
            }

            if (! Schema::hasColumn('sertifikasi_registrations', 'waktu_pelaksanaan')) {
                $table->string('waktu_pelaksanaan')->after('judul_sertifikasi')->nullable();
            }

            if (! Schema::hasColumn('sertifikasi_registrations', 'tempat')) {
                $table->string('tempat')->after('waktu_pelaksanaan')->nullable();
            }

            if (! Schema::hasColumn('sertifikasi_registrations', 'penyelenggara')) {
                $table->string('penyelenggara')->after('tempat')->nullable();
            }

            if (! Schema::hasColumn('sertifikasi_registrations', 'cp_penyelenggara')) {
                $table->string('cp_penyelenggara')->after('penyelenggara')->nullable();
            }

            if (! Schema::hasColumn('sertifikasi_registrations', 'web_penyelenggara')) {
                $table->string('web_penyelenggara')->after('cp_penyelenggara')->nullable();
            }

            if (! Schema::hasColumn('sertifikasi_registrations', 'biaya')) {
                $table->string('biaya')->after('web_penyelenggara')->nullable();
            }

            if (! Schema::hasColumn('sertifikasi_registrations', 'justifikasi_pemilihan_judul')) {
                $table->text('justifikasi_pemilihan_judul')->after('biaya')->nullable();
            }

            if (! Schema::hasColumn('sertifikasi_registrations', 'tanggal_pelaksanaan')) {
                $table->date('tanggal_pelaksanaan')->after('justifikasi_pemilihan_judul')->nullable();
            }

            if (! Schema::hasColumn('sertifikasi_registrations', 'poster_path')) {
                $table->string('poster_path')->after('tanggal_pelaksanaan')->nullable();
            }

            $createdAtMissing = ! Schema::hasColumn('sertifikasi_registrations', 'created_at');
            $updatedAtMissing = ! Schema::hasColumn('sertifikasi_registrations', 'updated_at');

            if ($createdAtMissing && $updatedAtMissing) {
                $table->timestamps();
            } elseif ($createdAtMissing) {
                $table->timestamp('created_at')->nullable()->after('poster_path');
            } elseif ($updatedAtMissing) {
                $table->timestamp('updated_at')->nullable()->after('created_at');
            }
        });

        if (
            Schema::hasColumn('sertifikasi_registrations', 'prodi')
            && Schema::hasColumn('sertifikasi_registrations', 'program_studi')
        ) {
            DB::table('sertifikasi_registrations')
                ->whereNull('program_studi')
                ->update(['program_studi' => DB::raw('prodi')]);

            Schema::table('sertifikasi_registrations', function (Blueprint $table) {
                $table->dropColumn('prodi');
            });
        }
    }

    /**
     * Display the certification registrations for admins.
     */
    public function index(): View
    {
        $this->ensureTableSchema();

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
        $this->ensureTableSchema();

        $tableExists = Schema::hasTable('sertifikasi_registrations');

        $registrations = $tableExists
            ? SertifikasiRegistration::query()->latest()->get()
            : collect();

        $headers = [
            'No',
            'Nama',
            'NIP',
            'Email',
            'Prodi',
            'No. WhatsApp',
            'Status Pegawai',
            'Judul Sertifikasi',
            'Waktu Pelaksanaan',
            'Tempat',
            'Penyelenggara',
            'CP Penyelenggara',
            'Web Penyelenggara',
            'Biaya',
            'Justifikasi Pemilihan Judul',
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
                echo '<td>' . $escape($registration->email) . '</td>';
                echo '<td>' . $escape($registration->program_studi) . '</td>';
                echo '<td>' . $escape($registration->whatsapp) . '</td>';
                echo '<td>' . $escape($registration->status_pegawai) . '</td>';
                echo '<td>' . $escape($registration->judul_sertifikasi) . '</td>';
                echo '<td>' . $escape($registration->waktu_pelaksanaan) . '</td>';
                echo '<td>' . $escape($registration->tempat) . '</td>';
                echo '<td>' . $escape($registration->penyelenggara) . '</td>';
                echo '<td>' . $escape($registration->cp_penyelenggara) . '</td>';
                echo '<td>' . $escape($registration->web_penyelenggara) . '</td>';
                echo '<td>' . $escape($registration->biaya) . '</td>';
                echo '<td>' . $escape($registration->justifikasi_pemilihan_judul) . '</td>';
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
        $this->ensureTableSchema();

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
