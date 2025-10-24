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
                text-align: center;
            }

            .login-card h1 {
                margin: 0;
                font-size: clamp(1.42rem, 3.4vw, 1.72rem);
                font-weight: 600;
                color: #1f2a44;
            }

            .login-card p {
                margin: 0;
                font-size: 1rem;
                line-height: 1.6;
                color: #3d4b77;
            }

            .status-badge {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                border-radius: 999px;
                padding: 10px 18px;
                background: rgba(30, 75, 169, 0.1);
                color: #1e4ba9;
                font-weight: 600;
                font-size: 0.95rem;
            }
        </style>
    </head>
    <body>
        <main class="login-card">
            <h1>Halaman Login</h1>
            <div class="status-badge">Sementara Dinonaktifkan</div>
            <p>
                Sistem login admin sedang dinonaktifkan sementara. Anda masih dapat mengakses data
                pendaftaran melalui tautan dashboard tanpa melakukan proses masuk.
            </p>
            <p>
                Jika membutuhkan akses khusus, silakan hubungi pengelola aplikasi untuk informasi
                lebih lanjut.
            </p>
        </main>
    </body>
</html>
