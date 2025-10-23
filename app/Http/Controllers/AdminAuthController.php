<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    /**
     * Display the login form.
     */
    public function create(): View
    {
        return view('admin.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $identifier = $credentials['username'];
        $password = $credentials['password'];

        $attemptColumns = [];

        if (Schema::hasColumn('users', 'username')) {
            $attemptColumns[] = 'username';
        }

        if (Schema::hasColumn('users', 'email')) {
            $attemptColumns[] = 'email';
        }

        foreach (array_unique($attemptColumns) as $column) {
            if ($column === 'email' && ! filter_var($identifier, FILTER_VALIDATE_EMAIL) && in_array('username', $attemptColumns, true)) {
                continue;
            }

            if (Auth::attempt([$column => $identifier, 'password' => $password])) {
                $request->session()->regenerate();

                return redirect()->intended(route('admin.lomba'));
            }
        }

        return back()
            ->withErrors([
                'username' => 'Kredensial tidak cocok. Pastikan username atau email dan kata sandi benar.',
            ])
            ->onlyInput('username');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
