<?php

namespace App\Http\Controllers;

use App\Models\RegistrationFlow;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class AdminRegistrationFlowController extends Controller
{
    public function index(): View
    {
        $this->ensureTableExists();

        $flows = RegistrationFlow::query()
            ->orderBy('type')
            ->orderBy('sequence')
            ->orderBy('id')
            ->get()
            ->groupBy('type');

        return view('modules.admin.flows', [
            'activeTab' => 'alur',
            'navigationMode' => 'links',
            'flows' => [
                'lomba' => $flows->get('lomba', collect()),
                'sertifikasi' => $flows->get('sertifikasi', collect()),
            ],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->ensureTableExists();
        $validated = $this->validateFlow($request);

        RegistrationFlow::create($validated);

        return back()->with('status', 'Kotak alur baru berhasil ditambahkan.');
    }

    public function update(Request $request, RegistrationFlow $registrationFlow): RedirectResponse
    {
        $validated = $this->validateFlow($request);

        $registrationFlow->update($validated);

        return back()->with('status', 'Kotak alur berhasil diperbarui.');
    }

    public function destroy(RegistrationFlow $registrationFlow): RedirectResponse
    {
        $registrationFlow->delete();

        return back()->with('status', 'Kotak alur berhasil dihapus.');
    }

    protected function validateFlow(Request $request): array
    {
        return $request->validate([
            'type' => ['required', 'in:lomba,sertifikasi'],
            'sequence' => ['required', 'integer', 'min:1', 'max:99'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'link' => ['nullable', 'string', 'max:255'],
        ]);
    }

    protected function ensureTableExists(): void
    {
        if (Schema::hasTable('registration_flows')) {
            return;
        }

        Schema::create('registration_flows', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['lomba', 'sertifikasi']);
            $table->unsignedInteger('sequence')->default(1);
            $table->string('title');
            $table->text('description');
            $table->string('link')->nullable();
            $table->timestamps();

            $table->index(['type', 'sequence']);
        });
    }
}
