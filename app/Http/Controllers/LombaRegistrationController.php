<?php

namespace App\Http\Controllers;

use App\Models\LombaRegistration;
use App\Rules\IndonesianPhoneNumber;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LombaRegistrationController extends Controller
{
    /**
     * Display the registration form.
     */
    public function create(): View
    {
        return view('modules.lomba.pendaftaran-lomba');
    }

    public function downloadAdminRegistrations(): StreamedResponse
    {
        $this->ensureTableSchema();

        $tableExists = Schema::hasTable('lomba_registrations');

        $registrations = $tableExists
            ? LombaRegistration::query()->latest()->get()
            : collect();

        $headers = [
            'No',
            'Nama',
            'NIM',
            'Email',
            'Program Studi',
            'No. WhatsApp',
            'Peran Tim',
            'Status Tim',
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
                echo '<td>' . $escape($registration->email) . '</td>';
                echo '<td>' . $escape($registration->program_studi) . '</td>';
                echo '<td>' . $escape($registration->whatsapp) . '</td>';
                echo '<td>' . $escape($registration->pilihan_peran) . '</td>';
                echo '<td>' . $escape($registration->status_tim) . '</td>';
                echo '<td>' . $escape($formattedDate) . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        }, 'data-pendaftaran-lomba.xls', [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
        ]);
    }

    /**
     * Store a new registration in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->ensureTableSchema();

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'program_studi' => ['required', 'string', 'max:255'],
            'whatsapp' => ['required', 'string', 'max:255', new IndonesianPhoneNumber()],
            'pilihan_peran' => ['required', 'string', 'max:255'],
            'motivasi' => ['nullable', 'string'],
            'status_tim' => ['required', 'string', 'max:255'],
        ]);

        LombaRegistration::create($validated);

        $communityName = config('komunitas.lomba.name');

        return redirect()
            ->route('pendaftaran.lomba')
            ->with('status', "Terima kasih! Data pendaftaran lomba Anda telah kami terima. Kami akan segera menghubungi Anda untuk informasi selanjutnya. Untuk koordinasi teknis dan info terbaru, segera gabung ke channel WhatsApp {$communityName}.");
    }

    /**
     * Display a listing of the registrations for admins.
     */
    public function index(): View
    {
        $this->ensureTableSchema();

        $lombaTableExists = Schema::hasTable('lomba_registrations');

        $lombaRegistrations = $lombaTableExists
            ? LombaRegistration::latest()->get()
            : collect();

        return view('modules.admin.lomba', [
            'activeTab' => 'lomba',
            'tableExists' => $lombaTableExists,
            'registrations' => $lombaRegistrations,
        ]);
    }

    /**
     * Display a simplified dashboard for lecturers.
     */
    public function lecturerDashboard(): View
    {
        $lecturer = Auth::guard('lecturer')->user();

        $this->ensureTableSchema();

        $tableExists = Schema::hasTable('lomba_registrations');

        $registrations = collect();

        if ($tableExists && $lecturer && filled($lecturer->program_studi)) {
            $registrations = LombaRegistration::query()
                ->where('program_studi', $lecturer->program_studi)
                ->latest()
                ->get();
        }

        $lecturerAccount = $lecturer
            ? [
                'name' => $lecturer->name,
                'email' => $lecturer->email,
                'phone' => $lecturer->phone,
                'program_studi' => $lecturer->program_studi,
            ]
            : null;

        return view('modules.dosen.lomba-dashboard', [
            'registrations' => $registrations,
            'tableExists' => $tableExists,
            'lecturerAccount' => $lecturerAccount,
        ]);
    }

    public function downloadLecturerRegistrations(): StreamedResponse
    {
        $lecturer = Auth::guard('lecturer')->user();

        if (! $lecturer || blank($lecturer->program_studi)) {
            abort(403, 'Akun dosen belum memiliki informasi program studi.');
        }

        $this->ensureTableSchema();

        $tableExists = Schema::hasTable('lomba_registrations');

        $registrations = $tableExists
            ? LombaRegistration::query()
                ->where('program_studi', $lecturer->program_studi)
                ->latest()
                ->get()
            : collect();

        $headers = [
            'No',
            'Nama',
            'NIM',
            'Email',
            'Program Studi',
            'No. WhatsApp',
            'Peran Tim',
            'Status Tim',
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
                echo '<td>' . $escape($registration->email) . '</td>';
                echo '<td>' . $escape($registration->program_studi) . '</td>';
                echo '<td>' . $escape($registration->whatsapp) . '</td>';
                echo '<td>' . $escape($registration->pilihan_peran) . '</td>';
                echo '<td>' . $escape($registration->status_tim) . '</td>';
                echo '<td>' . $escape($formattedDate) . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        }, 'data-pendaftaran-lomba.xls', [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        if (! Schema::hasTable('lomba_registrations')) {
            return back()->with('status', 'Tabel pendaftaran lomba belum tersedia.');
        }

        $validated = $request->validate([
            'ids' => ['array'],
            'ids.*' => ['integer'],
            'clear_all' => ['nullable', 'boolean'],
        ]);

        $clearAll = (bool) ($validated['clear_all'] ?? false);

        if ($clearAll) {
            LombaRegistration::query()->delete();

            return back()->with('status', 'Semua data pendaftaran lomba berhasil dihapus.');
        }

        $ids = $validated['ids'] ?? [];

        if (! empty($ids)) {
            LombaRegistration::query()->whereIn('id', $ids)->delete();

            return back()->with('status', 'Data pendaftaran lomba terpilih berhasil dihapus.');
        }

        return back()->with('status', 'Tidak ada data yang dipilih untuk dihapus.');
    }

    protected function ensureTableSchema(): void
    {
        if (! Schema::hasTable('lomba_registrations')) {
            Schema::create('lomba_registrations', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->string('nim');
                $table->string('email');
                $table->string('program_studi');
                $table->string('whatsapp');
                $table->string('pilihan_peran');
                $table->text('motivasi')->nullable();
                $table->string('status_tim');
                $table->timestamps();
            });

            return;
        }

        Schema::table('lomba_registrations', function (Blueprint $table) {
            if (! Schema::hasColumn('lomba_registrations', 'email')) {
                $table->string('email')->after('nim')->nullable();
            }

            if (! Schema::hasColumn('lomba_registrations', 'created_at')) {
                $table->timestamp('created_at')->nullable()->after('status_tim');
            }

            if (! Schema::hasColumn('lomba_registrations', 'updated_at')) {
                $table->timestamp('updated_at')->nullable()->after('created_at');
            }
        });
    }
}
