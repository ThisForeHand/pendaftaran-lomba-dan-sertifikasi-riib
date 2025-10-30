<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Masuk Admin - Pendaftaran Kompetisi & Sertifikasi</title>

        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700"
            rel="stylesheet"
        />

        <style>
            :root {
                color-scheme: light;
            }

            *,
            *::before,
            *::after {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                min-height: 100vh;
                display: grid;
                place-items: center;
                padding: 40px 16px;
                background: #eef2f6;
                font-family: "Instrument Sans", system-ui, -apple-system, BlinkMacSystemFont,
                    "Segoe UI", sans-serif;
                color: #1f2a44;
            }

            .login-shell {
                width: min(440px, 100%);
                border-radius: 28px;
                background: #ffffff;
                padding: clamp(32px, 6vw, 48px);
                box-shadow: 0px 32px 70px rgba(31, 42, 68, 0.12);
                border: 1px solid rgba(111, 130, 173, 0.16);
                display: grid;
                gap: clamp(24px, 4vw, 32px);
            }

            .login-header {
                display: grid;
                place-items: center;
                text-align: center;
                gap: 18px;
            }

            .avatar {
                width: 72px;
                height: 72px;
                border-radius: 50%;
                display: grid;
                place-items: center;
                background: linear-gradient(145deg, rgba(42, 99, 221, 0.12), rgba(42, 99, 221, 0.36));
                color: #1e4ba9;
            }

            .avatar svg {
                width: 36px;
                height: 36px;
            }

            h1 {
                margin: 0;
                font-size: clamp(1.5rem, 3vw, 1.9rem);
                font-weight: 600;
                color: #1f2a44;
            }

            .subtitle {
                margin: 0;
                font-size: 1rem;
                line-height: 1.5;
                color: #3d4b77;
                max-width: 28ch;
            }

            form {
                display: grid;
                gap: 20px;
            }

            .input-field {
                display: grid;
                gap: 10px;
            }

            label {
                font-weight: 600;
                font-size: 0.95rem;
                color: #24345a;
            }

            input[type="email"],
            input[type="password"] {
                width: 100%;
                border-radius: 14px;
                border: 1px solid rgba(76, 98, 144, 0.22);
                padding: 14px 16px;
                font-size: 1rem;
                font-family: inherit;
                color: #1f2a44;
                background: #f7f8fb;
                transition: border 0.2s ease, box-shadow 0.2s ease;
            }

            input[type="email"]:focus,
            input[type="password"]:focus {
                outline: none;
                border-color: rgba(30, 75, 169, 0.6);
                box-shadow: 0 0 0 4px rgba(30, 75, 169, 0.15);
                background: #ffffff;
            }

            .password-field {
                position: relative;
                display: flex;
                align-items: center;
            }

            .password-field input {
                padding-right: 48px;
            }

            .toggle-password {
                position: absolute;
                top: 50%;
                right: 14px;
                transform: translateY(-50%);
                border: 0;
                background: transparent;
                cursor: pointer;
                padding: 6px;
                display: grid;
                place-items: center;
                color: #3d4b77;
            }

            .toggle-password:hover,
            .toggle-password:focus {
                color: #1e4ba9;
                outline: none;
            }

            .toggle-password svg {
                width: 22px;
                height: 22px;
            }

            button[type="submit"] {
                border: 0;
                border-radius: 14px;
                background: #1e4ba9;
                color: white;
                font-weight: 600;
                padding: 16px 20px;
                font-size: 1rem;
                cursor: pointer;
                transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
            }

            button[type="submit"]:hover {
                background: #123a88;
                box-shadow: 0 12px 30px rgba(18, 58, 136, 0.25);
                transform: translateY(-1px);
            }

            button[type="submit"]:active {
                transform: translateY(0);
            }

            .help-text {
                margin: 0;
                text-align: center;
                font-size: 0.95rem;
                color: #3d4b77;
            }

            .help-text a {
                color: #1e4ba9;
                font-weight: 600;
                text-decoration: none;
            }

            .help-text a:hover {
                text-decoration: underline;
            }

            @media (max-width: 480px) {
                body {
                    padding: 32px 12px;
                }

                .login-shell {
                    border-radius: 22px;
                    padding: 28px 22px;
                }
            }
        </style>
    </head>
    <body>
        <main class="login-shell">
            <header class="login-header">
                <div class="avatar" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="currentColor" role="img">
                        <path
                            d="M12 2a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 12c4.42 0 8 2.24 8 5v1c0 .55-.45 1-1 1H5a1 1 0 0 1-1-1v-1c0-2.76 3.58-5 8-5z"
                        />
                    </svg>
                </div>
                <div>
            <h1>Masuk Sistem</h1>
            <p class="subtitle">
                Gunakan kredensial admin atau dosen untuk mengakses dashboard yang sesuai.
            </p>
        </div>
    </header>

    <form action="{{ route('admin.login.attempt') }}" method="post" novalidate>
        @csrf
        <div class="input-field">
            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                placeholder="Masukkan email anda"
                autocomplete="username"
                value="{{ old('email') }}"
            />
            @error('email')
                <p style="margin: 0; color: #c0392b; font-size: 0.9rem;">{{ $message }}</p>
            @enderror
        </div>

        <div class="input-field">
            <label for="password">Kata Sandi</label>
            <div class="password-field">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan kata sandi anda"
                            autocomplete="current-password"
                        />
                        <button type="button" class="toggle-password" aria-label="Tampilkan kata sandi">
                            <svg viewBox="0 0 24 24" fill="currentColor" role="img">
                                <path
                                    d="M12 5c-5 0-9.27 3.11-11 7.5 1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5C21.27 8.11 17 5 12 5zm0 12c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"
                                />
                            </svg>
                        </button>
                    </div>
            @error('password')
                <p style="margin: 0; color: #c0392b; font-size: 0.9rem;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Masuk</button>
            </form>

            <p class="help-text">
                Lupa kata sandi? <a href="#">Hubungi pengelola fungsional</a>
            </p>
        </main>

        <script>
            const passwordField = document.querySelector("#password");
            const toggleButton = document.querySelector(".toggle-password");

            function togglePasswordVisibility() {
                const isHidden = passwordField.getAttribute("type") === "password";
                passwordField.setAttribute("type", isHidden ? "text" : "password");
                toggleButton.setAttribute(
                    "aria-label",
                    isHidden ? "Sembunyikan kata sandi" : "Tampilkan kata sandi"
                );
            }

            toggleButton?.addEventListener("click", togglePasswordVisibility);
        </script>
    </body>
</html>
