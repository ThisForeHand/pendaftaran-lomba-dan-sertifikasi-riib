<?php

namespace App\Http\Controllers;

use App\Models\RegistrationFlow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class PortalLandingController extends Controller
{
    public function lomba(): View
    {
        return view('modules.lomba.welcome-lomba', [
            'flowSteps' => $this->getFlowSteps('lomba'),
        ]);
    }

    public function sertifikasi(): View
    {
        return view('modules.sertifikasi.welcome-sertifikasi', [
            'flowSteps' => $this->getFlowSteps('sertifikasi'),
        ]);
    }

    protected function getFlowSteps(string $type): Collection
    {
        if (! Schema::hasTable('registration_flows')) {
            return collect();
        }

        return RegistrationFlow::query()
            ->where('type', $type)
            ->orderBy('sequence')
            ->orderBy('id')
            ->get();
    }
}
