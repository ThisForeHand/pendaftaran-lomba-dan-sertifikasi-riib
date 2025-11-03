<?php

namespace App\Http\Controllers;

use App\Models\LombaRegistration;
use App\Models\SertifikasiRegistration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class LombaRegistrationController extends Controller
{
    /**
     * Display the registration form.
     */
    public function create(): View
    {
        return view('User_lomba.pendaftaran-lomba');
    }

    /**
     * Store a new registration in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if (! Schema::hasTable('lomba_registrations')) {
            Schema::create('lomba_registrations', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->string('nim');
                $table->string('program_studi');
                $table->string('whatsapp');
                $table->string('pilihan_peran');
                $table->text('motivasi')->nullable();
                $table->string('status_tim');
                $table->timestamps();
            });
        }

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:255'],
            'program_studi' => ['required', 'string', 'max:255'],
            'whatsapp' => ['required', 'string', 'max:255'],
            'pilihan_peran' => ['required', 'string', 'max:255'],
            'motivasi' => ['nullable', 'string'],
            'status_tim' => ['required', 'string', 'max:255'],
        ]);

        LombaRegistration::create($validated);

        return redirect()
            ->route('pendaftaran.lomba')
            ->with('status', 'Terima kasih! Data pendaftaran lomba Anda telah kami terima. Kami akan segera menghubungi Anda untuk informasi selanjutnya.');
    }

    /**
     * Display a listing of the registrations for admins.
     */
    public function index(): View
    {
        $lombaTableExists = Schema::hasTable('lomba_registrations');
        $sertifikasiTableExists = Schema::hasTable('sertifikasi_registrations');

        $lombaRegistrations = $lombaTableExists
            ? LombaRegistration::latest()->get()
            : collect();

        $sertifikasiRegistrations = $sertifikasiTableExists
            ? SertifikasiRegistration::latest()->get()
            : collect();

        return view('admin.dashboard', [
            'activeTab' => 'lomba',
            'lombaRegistrations' => $lombaRegistrations,
            'lombaTableExists' => $lombaTableExists,
            'sertifikasiRegistrations' => $sertifikasiRegistrations,
            'sertifikasiTableExists' => $sertifikasiTableExists,
        ]);
    }

    /**
     * Display a simplified dashboard for lecturers.
     */
    public function lecturerDashboard(): View
    {
        $tableExists = Schema::hasTable('lomba_registrations');

        $registrations = $tableExists
            ? LombaRegistration::latest()->get()
            : collect();

        $lecturer = Auth::guard('lecturer')->user();

        $lecturerAccount = $lecturer
            ? [
                'name' => $lecturer->name,
                'email' => $lecturer->email,
                'phone' => $lecturer->phone,
            ]
            : null;

        return view('dosen.lomba-dashboard', [
            'registrations' => $registrations,
            'tableExists' => $tableExists,
            'lecturerAccount' => $lecturerAccount,
        ]);
    }
}
