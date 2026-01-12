<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Dosen;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function show(): View
    {
        $this->prepareAuthenticationStorage();

        return view('modules.auth.login');
    }

    /**
     * Handle an incoming authentication request for admin or lecturer.
     */
    public function login(Request $request): RedirectResponse
    {
        $this->prepareAuthenticationStorage();

        $validated = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $guardCandidates = [];
        $identifier = $validated['username'];

        if (Admin::query()->where('username', $identifier)->orWhere('email', $identifier)->exists()) {
            $guardCandidates['admin'] = route('admin.lomba');
        }

        if (Dosen::query()->where('username', $identifier)->orWhere('email', $identifier)->exists()) {
            $guardCandidates['lecturer'] = route('dosen.lomba');
        }

        if (empty($guardCandidates)) {
            $guardCandidates = [
                'admin' => route('admin.lomba'),
                'lecturer' => route('dosen.lomba'),
            ];
        }

        $throttleKey = strtolower($validated['username'])
            . '|' . implode(',', array_keys($guardCandidates))
            . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            throw ValidationException::withMessages([
                'username' => __('Terlalu banyak percobaan login. Silakan coba lagi nanti.'),
            ])->status(429);
        }

        $credentialSets = [
            [
                'username' => $identifier,
                'password' => $validated['password'],
            ],
            [
                'email' => $identifier,
                'password' => $validated['password'],
            ],
        ];

        foreach ($guardCandidates as $guard => $redirectRoute) {
            foreach ($credentialSets as $credentials) {
                if (Auth::guard($guard)->attempt($credentials, $request->boolean('remember'))) {
                    $request->session()->regenerate();
                    RateLimiter::clear($throttleKey);

                    return redirect()->intended($redirectRoute);
                }
            }
        }

        RateLimiter::hit($throttleKey, 60);

        throw ValidationException::withMessages([
            'username' => __('Kredensial tidak sesuai dengan akun yang terdaftar.'),
        ]);
    }

    /**
     * Log the authenticated user out of the application.
     */
    public function logout(Request $request): RedirectResponse
    {
        foreach (['admin', 'lecturer'] as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::guard($guard)->logout();
            }
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Ensure the database has the required tables and seed data for authentication.
     */
    protected function prepareAuthenticationStorage(): void
    {
        if (! Schema::hasTable('admins')) {
            Schema::create('admins', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('username')->unique();
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('dosens')) {
            Schema::create('dosens', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('username')->unique();
                $table->string('email')->unique();
                $table->string('phone')->nullable();
                $table->string('program_studi')->nullable();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
        } elseif (! Schema::hasColumn('dosens', 'program_studi')) {
            Schema::table('dosens', function (Blueprint $table) {
                $table->string('program_studi')->nullable()->after('phone');
            });
        }

        if (! Schema::hasTable('password_reset_tokens')) {
            Schema::create('password_reset_tokens', function (Blueprint $table) {
                $table->string('email')->primary();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });
        }

        if (config('session.driver') === 'database' && ! Schema::hasTable('sessions')) {
            Schema::create('sessions', function (Blueprint $table) {
                $table->string('id')->primary();
                $table->foreignId('user_id')->nullable()->index();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->longText('payload');
                $table->integer('last_activity')->index();
            });
        }

        $adminConfig = config('accounts.admin');

        if (! empty($adminConfig)) {
            $admin = Admin::query()->firstOrCreate(
                ['username' => $adminConfig['username']],
                [
                    'name' => $adminConfig['name'],
                    'email' => $adminConfig['email'],
                    'password' => Hash::make($adminConfig['password']),
                ],
            );

            $adminUpdates = [];

            if ($admin->name !== $adminConfig['name']) {
                $adminUpdates['name'] = $adminConfig['name'];
            }

            if ($admin->email !== $adminConfig['email']) {
                $adminUpdates['email'] = $adminConfig['email'];
            }

            if (! Hash::check($adminConfig['password'], $admin->password)) {
                $adminUpdates['password'] = Hash::make($adminConfig['password']);
            }

            if (! empty($adminUpdates)) {
                $admin->forceFill($adminUpdates)->save();
            }
        }

        $lecturerConfig = config('accounts.lecturer');

        if (! empty($lecturerConfig)) {
            $dosen = Dosen::query()->firstOrCreate(
                ['username' => $lecturerConfig['username']],
                [
                    'name' => $lecturerConfig['name'],
                    'email' => $lecturerConfig['email'],
                    'phone' => $lecturerConfig['phone'],
                    'program_studi' => $lecturerConfig['program_studi'] ?? null,
                    'password' => Hash::make($lecturerConfig['password']),
                ],
            );

            if (
                isset($lecturerConfig['program_studi'])
                && $dosen->program_studi !== $lecturerConfig['program_studi']
            ) {
                $dosen->forceFill([
                    'program_studi' => $lecturerConfig['program_studi'],
                ])->save();
            }
        }
    }
}
