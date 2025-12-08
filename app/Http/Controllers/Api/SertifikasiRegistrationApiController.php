<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SertifikasiRegistration;
use App\Rules\IndonesianPhoneNumber;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class SertifikasiRegistrationApiController extends Controller
{
    public function index(): JsonResponse
    {
        $tableExists = Schema::hasTable('sertifikasi_registrations');

        $registrations = $tableExists
            ? SertifikasiRegistration::query()->latest()->get()
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
            'program_studi' => ['required', 'string', 'max:255'],
            'whatsapp' => ['required', 'string', 'max:255', new IndonesianPhoneNumber()],
            'program_sertifikasi' => ['required', 'string', 'max:255'],
            'motivasi' => ['nullable', 'string'],
            'status_sertifikasi' => ['required', 'string', 'max:255'],
        ]);

        $registration = SertifikasiRegistration::create($validated);

        return response()->json([
            'message' => 'Pendaftaran sertifikasi berhasil disimpan.',
            'data' => $registration,
        ], 201);
    }

    protected function ensureTableExists(): void
    {
        if (Schema::hasTable('sertifikasi_registrations')) {
            return;
        }

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
}
