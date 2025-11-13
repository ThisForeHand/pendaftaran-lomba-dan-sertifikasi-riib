<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Rules\IndonesianPhoneNumber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AdminLecturerController extends Controller
{
    /**
     * Display the form for creating a new lecturer account.
     */
    public function create(): View
    {
        return view('admin.create-lecturer', [
            'studyPrograms' => config('program_studi.options', []),
        ]);
    }

    /**
     * Store a newly created lecturer account in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:dosens,username'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:dosens,email'],
            'phone' => ['nullable', 'string', 'max:30', new IndonesianPhoneNumber()],
            'program_studi' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        Dosen::query()->create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'program_studi' => $validated['program_studi'] ?? null,
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('admin.dosen.create')
            ->with('status', 'Akun dosen berhasil dibuat.');
    }
}
