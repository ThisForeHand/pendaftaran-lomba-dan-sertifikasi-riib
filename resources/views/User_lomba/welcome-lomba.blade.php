<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Portal Pendaftaran Lomba</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

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
                display: flex;
                justify-content: center;
                align-items: flex-start;
                font-family: "Instrument Sans", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
                background: linear-gradient(180deg, #f3f7ff 0%, #f9fbff 48%, #ffffff 100%);
                color: #000000;
                padding: clamp(40px, 6vw, 72px) clamp(16px, 6vw, 40px);
            }

            .page-wrapper {
                width: min(960px, 100%);
                background: #ffffff;
                border-radius: 28px;
                border: 1px solid rgba(93, 123, 214, 0.18);
                box-shadow: 0 30px 70px rgba(28, 42, 74, 0.08);
                overflow: hidden;
            }

            header {
                padding: clamp(40px, 6vw, 56px) clamp(32px, 6vw, 80px) clamp(24px, 4vw, 32px);
                text-align: center;
                background: linear-gradient(180deg, rgba(226, 233, 255, 0.65) 0%, rgba(255, 255, 255, 0) 100%);
                border-bottom: 1px solid rgba(93, 123, 214, 0.12);
            }

            header h1 {
                margin: 0 0 14px;
                font-size: clamp(2rem, 4.5vw, 2.7rem);
                font-weight: 600;
                color: #000000;
                letter-spacing: -0.02em;
            }

            header p {
                margin: 0 auto;
                max-width: 720px;
                font-size: clamp(1rem, 2vw, 1.05rem);
                line-height: 1.65;
                color: #000000;
            }

            .main-card {
                padding: clamp(32px, 5vw, 52px) clamp(32px, 6vw, 80px);
                display: grid;
                gap: clamp(32px, 6vw, 60px);
            }

            .link-block {
                display: grid;
                gap: 16px;
            }

            .card-title {
                font-size: clamp(1.4rem, 2.8vw, 1.68rem);
                font-weight: 600;
                color: #000000;
                text-decoration: underline;
                text-decoration-thickness: 2px;
                text-underline-offset: 6px;
            }

            .card-button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                border: none;
                background: linear-gradient(135deg, #3068ff 0%, #1f49e0 100%);
                color: #ffffff;
                font-weight: 600;
                font-size: 0.95rem;
                padding: 12px 26px;
                border-radius: 999px;
                text-decoration: none;
                box-shadow: 0 12px 24px rgba(41, 104, 246, 0.22);
                transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
                width: fit-content;
            }

            .card-button:hover,
            .card-button:focus {
                transform: translateY(-2px);
                box-shadow: 0 14px 28px rgba(31, 73, 224, 0.26);
                background: linear-gradient(135deg, #2a5cea 0%, #1a3fba 100%);
            }

            .secondary-link {
                color: #000000;
                font-weight: 600;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 8px;
            }

            .secondary-link:hover,
            .secondary-link:focus {
                color: #000000;
                text-decoration: underline;
            }

            .flow-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: clamp(24px, 5vw, 48px);
                padding-top: clamp(16px, 3vw, 28px);
            }

            .flow-card {
                display: grid;
                gap: clamp(20px, 4vw, 32px);
                position: relative;
                z-index: 1;
            }

            .flow-card h3 {
                margin: 0;
                font-size: 1.08rem;
                font-weight: 600;
                color: #000000;
            }

            .flow-visual {
                position: relative;
                display: grid;
                grid-template-columns: auto 1fr;
                align-items: center;
                gap: clamp(28px, 6vw, 52px);
                padding: clamp(26px, 5vw, 40px);
                background: linear-gradient(135deg, #cbe96a 0%, #a6da3a 100%);
                border-radius: clamp(32px, 6vw, 48px);
                box-shadow: 0 24px 48px rgba(108, 156, 25, 0.22);
                overflow: hidden;
            }

            .flow-visual::before {
                content: "";
                position: absolute;
                inset: 10%;
                border-radius: 48px;
                border: 1px solid rgba(255, 255, 255, 0.35);
                pointer-events: none;
            }

            .flow-circle {
                position: relative;
                width: clamp(96px, 16vw, 138px);
                aspect-ratio: 1;
                border-radius: 50%;
                display: grid;
                place-items: center;
                font-weight: 700;
                font-size: clamp(2rem, 5vw, 2.8rem);
                color: #ffffff;
                background: radial-gradient(circle at 30% 30%, #6ec8ff 0%, #1e79f5 55%, #0f4ec1 100%);
                box-shadow: 0 20px 36px rgba(13, 80, 180, 0.45);
                isolation: isolate;
            }

            .flow-circle::before {
                content: "";
                position: absolute;
                inset: -12px;
                border-radius: inherit;
                border: 4px solid rgba(255, 255, 255, 0.65);
                opacity: 0.75;
                z-index: -1;
            }

            .flow-circle::after {
                content: "";
                position: absolute;
                inset: -24px;
                border-radius: inherit;
                background: radial-gradient(circle, rgba(14, 54, 140, 0.26) 0%, rgba(14, 54, 140, 0) 70%);
                z-index: -2;
            }

            .flow-info {
                position: relative;
                background: radial-gradient(circle at 20% 20%, rgba(255, 255, 255, 0.12) 0%, rgba(23, 18, 32, 0.92) 68%, rgba(16, 12, 26, 0.94) 100%);
                border-radius: clamp(28px, 6vw, 48px);
                padding: clamp(26px, 5vw, 48px) clamp(28px, 5vw, 56px);
                box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.06);
                color: #f5f6ff;
            }

            .flow-info::before {
                content: "";
                position: absolute;
                inset: 12px;
                border-radius: inherit;
                border: 1px solid rgba(255, 255, 255, 0.12);
                pointer-events: none;
                opacity: 0.6;
            }

            .flow-subtitle {
                margin: 0 0 clamp(14px, 2vw, 20px);
                font-size: clamp(1rem, 2.2vw, 1.18rem);
                font-weight: 600;
                letter-spacing: 0.01em;
            }

            .flow-info-list {
                margin: 0;
                padding: 0;
                list-style: none;
                display: grid;
                gap: clamp(12px, 2vw, 18px);
                position: relative;
                z-index: 1;
            }

            .flow-info-list li {
                position: relative;
                padding-left: 22px;
                font-size: clamp(0.95rem, 2.2vw, 1.05rem);
                line-height: 1.6;
                color: rgba(243, 246, 255, 0.92);
            }

            .flow-info-list li::before {
                content: "-";
                position: absolute;
                left: 0;
                top: 0;
                color: #7ddcff;
                font-weight: 600;
            }

            @media (max-width: 720px) {
                body {
                    padding: 32px 16px;
                }

                header {
                    padding: 32px 20px 18px;
                }

                .main-card {
                    padding: 28px 20px 36px;
                }

                .flow-visual {
                    grid-template-columns: 1fr;
                    text-align: center;
                }

                .flow-circle {
                    margin: 0 auto;
                }

                .flow-info {
                    text-align: left;
                    padding: clamp(24px, 6vw, 36px);
                }
            }

            footer {
                text-align: center;
                padding: 0 24px 40px;
                color: #000000;
                font-size: 0.85rem;
            }

            @media (max-width: 720px) {
                body {
                    padding: 32px 16px;
                }

                header {
                    padding: 32px 20px 18px;
                }

                .main-card {
                    padding: 28px 20px 36px;
                }
            }
        </style>
    </head>
    <body>
        <div class="page-wrapper">
            <header>
                <h1>Portal Pendaftaran Kompetisi</h1>
                <p>
                    Jelajahi informasi pendaftaran lomba yang sedang dibuka dan lengkapi seluruh persyaratan agar proses
                    seleksi berjalan lancar.
                </p>
            </header>

            <main class="main-card">
                <div class="link-block">
                    <div class="card-title">Pendaftaran Lomba</div>
                    <p>
                        Daftarkan diri Anda untuk ikut kompetisi. Terbuka untuk mahasiswa aktif dari seluruh perguruan tinggi.
                    </p>
                    <a class="card-button" href="{{ route('pendaftaran.lomba') }}">
                        Daftar Lomba
                    </a>
                </div>

                <div class="flow-grid">
                    <div class="flow-card">
                        <h3>Alur Pendaftaran Lomba</h3>
                        <div class="flow-visual" role="group" aria-label="Langkah kedua pendaftaran lomba">
                            <div class="flow-circle" aria-hidden="true">2</div>
                            <div class="flow-info">
                                <p class="flow-subtitle">Lengkapi seluruh informasi sebelum mengirim pendaftaran.</p>
                                <ul class="flow-info-list">
                                    <li>Melengkapi NIK, program studi, Indeks Prestasi Semester, dan data yang diminta oleh sistem.</li>
                                    <li>Upload pas foto format JPG/JPEG dengan ukuran kurang dari 300 KB.</li>
                                    <li>Klik tombol <strong>Kirim</strong> untuk menyelesaikan proses pendaftaran.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <footer>
                &copy; {{ date('Y') }} Program Kompetisi &amp; Sertifikasi
            </footer>
        </div>
    </body>
</html>
