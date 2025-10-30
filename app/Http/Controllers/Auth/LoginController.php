<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function show(): View
    {
        return view('admin.login');
    }

    /**
     * Handle an incoming authentication request for admin or lecturer.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $throttleKey = strtolower($credentials['email']) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            throw ValidationException::withMessages([
                'email' => __('Terlalu banyak percobaan login. Silakan coba lagi nanti.'),
            ])->status(429);
        }

        foreach (['admin' => route('admin.lomba'), 'lecturer' => route('dosen.lomba')] as $guard => $redirectRoute) {
            if (Auth::guard($guard)->attempt($credentials, $request->boolean('remember'))) {
                $request->session()->regenerate();
                RateLimiter::clear($throttleKey);

                return redirect()->intended($redirectRoute);
            }
        }

        RateLimiter::hit($throttleKey, 60);

        throw ValidationException::withMessages([
            'email' => __('Kredensial tidak ditemukan pada akun admin maupun dosen.'),
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

        return redirect()->route('admin.login');
    }
}
