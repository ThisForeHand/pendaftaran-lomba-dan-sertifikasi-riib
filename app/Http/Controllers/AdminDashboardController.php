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

        $perProgramStudy = $tableExists
            ? SertifikasiRegistration::query()
                ->select('program_studi', DB::raw('count(*) as total'))
                ->groupBy('program_studi')
                ->orderBy('program_studi')
                ->get()
            : collect();

        return view('modules.admin.dashboard', [
            'activeTab' => 'dashboard',
            'tableExists' => $tableExists,
            'chartLabels' => $perProgramStudy->pluck('program_studi'),
            'chartValues' => $perProgramStudy->pluck('total'),
        ]);
    }
}
