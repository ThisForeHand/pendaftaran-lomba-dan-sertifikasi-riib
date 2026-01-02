<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LombaRegistration;
use App\Rules\IndonesianPhoneNumber;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class LombaRegistrationApiController extends Controller
{
    public function index(): JsonResponse
    {
        $tableExists = Schema::hasTable('lomba_registrations');

        $registrations = $tableExists
            ? LombaRegistration::query()->latest()->get()
            : collect();

        return response()->json([
            'data' => $registrations,
            'meta' => [
                'table_exists' => $tableExists,
                'total' => $registrations->count(),
            ],
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $this->ensureTableExists();

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

        $registration = LombaRegistration::create($validated);

        return response()->json([
            'message' => 'Pendaftaran lomba berhasil disimpan.',
            'data' => $registration,
        ], 201);
    }

    protected function ensureTableExists(): void
    {
        if (Schema::hasTable('lomba_registrations')) {
            return;
        }

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
    }
}
