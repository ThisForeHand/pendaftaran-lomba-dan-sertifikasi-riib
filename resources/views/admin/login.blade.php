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

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                min-height: 100vh;
                display: grid;
                place-items: center;
                padding: 40px 16px;
                background: #f3f4f6;
                font-family: "Instrument Sans", system-ui, -apple-system, BlinkMacSystemFont,
                    "Segoe UI", sans-serif;
                color: #1f2a44;
            }

            .login-card {
                width: min(480px, 100%);
                background: #ffffff;
                border-radius: 28px;
                padding: clamp(32px, 6vw, 48px);
                box-shadow: 0 20px 60px rgba(31, 42, 68, 0.08);
                border: 1px solid rgba(82, 108, 178, 0.12);
                display: grid;
                gap: clamp(24px, 4vw, 32px);
            }

            .avatar-circle {
                width: 72px;
                height: 72px;
                border-radius: 999px;
                background: linear-gradient(180deg, rgba(71, 112, 231, 0.16) 0%, rgba(71, 112, 231, 0.05) 100%);
                border: 1px solid rgba(71, 112, 231, 0.25);
                display: grid;
                place-items: center;
                margin: 0 auto;
            }

            .avatar-icon {
                width: 36px;
                height: 36px;
                border-radius: 999px;
                background: #2748b3;
                display: grid;
                place-items: center;
                color: #ffffff;
                font-size: 20px;
                font-weight: 600;
            }

            .login-card h1 {
                margin: 0;
                text-align: center;
                font-size: clamp(1.42rem, 3.4vw, 1.72rem);
                font-weight: 600;
                color: #1f2a44;
            }

            form {
                display: grid;
                gap: clamp(18px, 3vw, 22px);
            }

            label {
                display: grid;
                gap: 10px;
                font-size: 0.95rem;
                font-weight: 500;
                color: #1f2a44;
            }

            .input-wrapper {
                position: relative;
            }

            input[type="email"],
            input[type="password"] {
                width: 100%;
                border-radius: 16px;
                border: 1px solid rgba(82, 108, 178, 0.24);
                padding: 14px clamp(16px, 4vw, 18px);
                font-size: 1rem;
                font-family: inherit;
                background: #f8faff;
                color: #1f2a44;
                transition: border 0.2s ease, box-shadow 0.2s ease;
            }

            input[type="email"]:focus,
            input[type="password"]:focus {
                outline: none;
                border-color: #4360e0;
                box-shadow: 0 0 0 4px rgba(67, 96, 224, 0.12);
                background: #ffffff;
            }

            .toggle-password {
                position: absolute;
                top: 50%;
                right: clamp(12px, 4vw, 16px);
                transform: translateY(-50%);
                border: none;
                background: none;
                padding: 6px;
                cursor: pointer;
                color: #6b7aa6;
                display: grid;
                place-items: center;
            }

            .toggle-password span {
                display: block;
                font-size: 0.86rem;
            }

            .primary-button {
                display: inline-flex;
                justify-content: center;
                align-items: center;
                gap: 10px;
                border-radius: 16px;
                border: none;
                padding: 14px;
                font-size: 1.02rem;
                font-weight: 600;
                background: #1e4ba9;
                color: #ffffff;
                cursor: pointer;
                transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
            }

            .primary-button:hover {
                background: #17408f;
                box-shadow: 0 16px 32px rgba(30, 75, 169, 0.28);
                transform: translateY(-1px);
            }

            .primary-button:active {
                transform: translateY(0);
                box-shadow: none;
            }

            .forgot-password {
                text-align: center;
                font-size: 0.95rem;
                color: #3d4b77;
            }

            .forgot-password a {
                color: #1e4ba9;
                font-weight: 600;
                text-decoration: none;
            }

            .forgot-password a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <main class="login-card">
            <div class="avatar-circle">
                <div class="avatar-icon">👤</div>
            </div>

            <h1>Masuk sebagai Admin</h1>

            <form action="{{ route('admin.lomba') }}" method="GET">
                <label>
                    Email
                    <input type="email" name="email" placeholder="Masukkan email anda" required />
                </label>

                <label>
                    Kata Sandi
                    <div class="input-wrapper">
                        <input
                            type="password"
                            name="password"
                            placeholder="Masukkan kata sandi anda"
                            required
                        />
                        <button type="button" class="toggle-password" aria-label="Lihat kata sandi">
                            <span>👁️</span>
                        </button>
                    </div>
                </label>

                <button type="submit" class="primary-button">Masuk</button>
            </form>

            <p class="forgot-password">
                Lupa Password? <a href="#">Minta fungsional</a>
            </p>
        </main>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const passwordInput = document.querySelector('input[type="password"]');
                const toggleButton = document.querySelector('.toggle-password');

                if (!passwordInput || !toggleButton) {
                    return;
                }

                toggleButton.addEventListener('click', () => {
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    toggleButton.querySelector('span').textContent = isPassword ? '🙈' : '👁️';
                });
            });
        </script>
    </body>
</html>
