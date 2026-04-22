<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', config('app.name', 'Portal Kompetisi & Sertifikasi'))</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <link rel="icon" type="image/png" href="{{ asset('images/iebi logo_crop.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('images/iebi logo_crop.png') }}">

        <style>
            .guest-login-link {
                position: fixed;
                top: 18px;
                right: 18px;
                z-index: 50;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border-radius: 999px;
                padding: 10px 18px;
                background: #14213d;
                color: #ffffff;
                font-family: "Instrument Sans", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
                font-size: 0.9rem;
                font-weight: 700;
                letter-spacing: 0.01em;
                text-decoration: none;
                box-shadow: 0 16px 34px rgba(20, 33, 61, 0.18);
                transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
            }

            .guest-login-link:hover,
            .guest-login-link:focus-visible {
                transform: translateY(-1px);
                background: #20325c;
                color: #ffffff;
                box-shadow: 0 18px 38px rgba(20, 33, 61, 0.24);
                outline: none;
            }

            @media (max-width: 640px) {
                .guest-login-link {
                    top: 12px;
                    right: 12px;
                    padding: 9px 14px;
                    font-size: 0.82rem;
                }
            }
        </style>

        @stack('styles')
    </head>
    <body>
        @unless (request()->routeIs('login'))
            <a class="guest-login-link" href="{{ route('login') }}">Login Admin</a>
        @endunless

        @yield('content')

        @stack('scripts')
    </body>
</html>
