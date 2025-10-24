<?php

namespace App\Http\Controllers;

use App\Models\SertifikasiRegistration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class SertifikasiRegistrationController extends Controller
{
    /**
     * Display the registration form.
     */
    public function create(): View
    {
        return view('pendaftaran-sertifikasi');
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
            'whatsapp' => ['required', 'string', 'max:255'],
            'program_sertifikasi' => ['required', 'string', 'max:255'],
            'motivasi' => ['nullable', 'string'],
            'status_sertifikasi' => ['required', 'string', 'max:255'],
        ]);

        SertifikasiRegistration::create($validated);

        return redirect()
            ->route('pendaftaran.sertifikasi')
            ->with('status', 'Terima kasih! Data pendaftaran sertifikasi berhasil dikirim.');
    }

    /**
     * Display the certification registrations for admins.
     */
    public function index(): View
    {
        $tableExists = Schema::hasTable('sertifikasi_registrations');

        $registrations = $tableExists
            ? SertifikasiRegistration::latest()->get()
            : collect();

        return view('admin.sertifikasi-dashboard', [
            'registrations' => $registrations,
            'tableExists' => $tableExists,
        ]);
    }
}
