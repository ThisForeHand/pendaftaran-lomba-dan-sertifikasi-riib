<?php

namespace App\Http\Controllers;

use App\Models\SertifikasiRegistration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard with certification registration overview.
     */
    public function index(): View
    {
        $tableExists = Schema::hasTable('sertifikasi_registrations');

        $studyPrograms = collect(config('program_studi.options', []));

        $perProgramStudy = $tableExists
            ? SertifikasiRegistration::query()
                ->select('program_studi', DB::raw('count(*) as total'))
                ->groupBy('program_studi')
                ->get()
                ->pluck('total', 'program_studi')
            : collect();

        return view('modules.admin.dashboard', [
            'activeTab' => 'dashboard',
            'tableExists' => $tableExists,
            'chartLabels' => $studyPrograms,
            'chartValues' => $studyPrograms->map(
                fn (string $programStudy): int => (int) ($perProgramStudy[$programStudy] ?? 0)
            ),
        ]);
    }
}
