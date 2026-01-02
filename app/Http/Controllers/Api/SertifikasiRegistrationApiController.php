<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SertifikasiRegistration;
use App\Rules\IndonesianPhoneNumber;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'email' => ['required', 'email', 'max:255'],
            'program_studi' => ['required', 'string', 'max:255'],
            'whatsapp' => ['required', 'string', 'max:255', new IndonesianPhoneNumber()],
            'tanggal_pelaksanaan' => ['required', 'date'],
            'poster_sertifikasi' => ['required', 'image', 'max:2048'],
        ]);

        $posterPath = $validated['poster_sertifikasi']->store('poster-sertifikasi', 'public');

        $registration = SertifikasiRegistration::create([
            'nama' => $validated['nama'],
            'nip' => $validated['nip'],
            'email' => $validated['email'],
            'program_studi' => $validated['program_studi'],
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
            $table->string('email');
            $table->string('program_studi');
            $table->string('whatsapp');
            $table->date('tanggal_pelaksanaan');
            $table->string('poster_path');
            $table->timestamps();
            });

            return;
        }

        Schema::table('sertifikasi_registrations', function (Blueprint $table) {
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

            if (! Schema::hasColumn('sertifikasi_registrations', 'tanggal_pelaksanaan')) {
                $table->date('tanggal_pelaksanaan')->after('whatsapp')->nullable();
            }

            if (! Schema::hasColumn('sertifikasi_registrations', 'poster_path')) {
                $table->string('poster_path')->after('tanggal_pelaksanaan')->nullable();
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
}
