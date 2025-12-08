<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RegistrationFlow;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Schema;

class RegistrationFlowApiController extends Controller
{
    public function show(string $type): JsonResponse
    {
        $tableExists = Schema::hasTable('registration_flows');

        $flows = $tableExists
            ? RegistrationFlow::query()
                ->where('type', $type)
                ->orderBy('sequence')
                ->orderBy('id')
                ->get()
            : collect();

        return response()->json([
            'data' => $flows,
            'meta' => [
                'table_exists' => $tableExists,
                'type' => $type,
                'total' => $flows->count(),
            ],
        ]);
    }
}
