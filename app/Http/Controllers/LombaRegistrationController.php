<?php

namespace App\Http\Controllers;

use App\Models\LombaRegistration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class LombaRegistrationController extends Controller
{
    /**
     * Display the registration form.
     */
    public function create(): View
    {
        return view('pendaftaran-lomba');
    }

    /**
     * Store a new registration in storage.
     */
    public function store(Request $request): RedirectResponse
    {
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
            ->with('status', 'Terima kasih! Data pendaftaran lomba berhasil dikirim.');
    }

    /**
     * Display a listing of the registrations for admins.
     */
    public function index(): View
    {
        $tableExists = Schema::hasTable('lomba_registrations');

        $registrations = $tableExists
            ? LombaRegistration::latest()->get()
            : collect();

        return view('admin.lomba-dashboard', [
            'registrations' => $registrations,
            'tableExists' => $tableExists,
        ]);
    }
}
