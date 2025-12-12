<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SertifikasiRegistration;
use App\Rules\IndonesianPhoneNumber;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $this->ensureTableSchema();

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'string', 'max:255'],
            'prodi' => ['required', 'string', 'max:255'],
            'whatsapp' => ['required', 'string', 'max:255', new IndonesianPhoneNumber()],
            'tanggal_pelaksanaan' => ['required', 'date'],
            'poster_sertifikasi' => ['required', 'image', 'max:2048'],
        ]);

        $posterPath = $validated['poster_sertifikasi']->store('poster-sertifikasi', 'public');

        $registration = SertifikasiRegistration::create([
            'nama' => $validated['nama'],
            'nip' => $validated['nip'],
            'prodi' => $validated['prodi'],
            'whatsapp' => $validated['whatsapp'],
            'tanggal_pelaksanaan' => $validated['tanggal_pelaksanaan'],
            'poster_path' => $posterPath,
        ]);

        return response()->json([
            'message' => 'Pendaftaran sertifikasi berhasil disimpan.',
            'data' => $registration,
        ], 201);
    }

    protected function ensureTableSchema(): void
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

            return;
        }

        if (! Schema::hasColumn('sertifikasi_registrations', 'nip')) {
            Schema::table('sertifikasi_registrations', function (Blueprint $table) {
                $table->string('nip')->after('nama');
            });
        }
    }
}
