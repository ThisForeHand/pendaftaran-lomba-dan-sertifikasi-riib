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
                gap: 18px;
                position: relative;
                z-index: 1;
            }

            .flow-card h3 {
                margin: 0;
                font-size: 1.08rem;
                font-weight: 600;
                color: #000000;
            }

            .flow-steps {
                list-style: none;
                margin: 0;
                padding: 0;
                display: grid;
                gap: clamp(16px, 3vw, 24px);
            }

            .step-item {
                --accent: #1f49e0;
                position: relative;
                display: grid;
                grid-template-columns: auto 1fr;
                gap: clamp(16px, 3vw, 24px);
                padding: clamp(18px, 3vw, 26px) clamp(18px, 3vw, 28px);
                border-radius: 24px;
                border: 1px solid rgba(93, 123, 214, 0.22);
                background: linear-gradient(135deg, rgba(231, 237, 255, 0.72) 0%, rgba(255, 255, 255, 0.95) 100%);
                box-shadow: 0 18px 40px rgba(28, 42, 74, 0.08);
            }

            .step-item::after {
                content: "";
                position: absolute;
                left: 44px;
                top: calc(100% - 12px);
                width: 2px;
                height: clamp(20px, 4vw, 36px);
                background: linear-gradient(180deg, rgba(93, 123, 214, 0.28) 0%, rgba(93, 123, 214, 0) 100%);
                border-radius: 999px;
            }

            .step-item:last-child::after {
                display: none;
            }

            .step-number {
                width: clamp(52px, 8vw, 64px);
                aspect-ratio: 1;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 700;
                font-size: clamp(1.4rem, 3.6vw, 1.8rem);
                color: #ffffff;
                background: linear-gradient(135deg, var(--accent) 0%, rgba(0, 0, 0, 0.15) 100%);
                box-shadow: 0 16px 34px rgba(28, 42, 74, 0.14);
            }

            .step-content {
                display: grid;
                gap: 8px;
            }

            .step-title {
                margin: 0;
                font-size: clamp(1.05rem, 2.5vw, 1.28rem);
                font-weight: 600;
                color: var(--accent);
            }

            .step-period {
                margin: 0;
                font-size: 0.95rem;
                font-weight: 600;
                color: rgba(28, 42, 74, 0.7);
            }

            .step-description {
                margin: 0;
                font-size: 0.95rem;
                line-height: 1.6;
                color: rgba(28, 42, 74, 0.82);
            }

            .step-link {
                width: fit-content;
                display: inline-flex;
                align-items: center;
                gap: 6px;
                font-size: 0.92rem;
                font-weight: 600;
                color: var(--accent);
                text-decoration: none;
                padding-bottom: 2px;
                border-bottom: 1px solid rgba(0, 0, 0, 0.06);
                transition: color 0.2s ease, border-color 0.2s ease;
            }

            .step-link:hover,
            .step-link:focus {
                color: #1a3fba;
                border-color: currentColor;
            }

            @media (max-width: 640px) {
                .step-item {
                    grid-template-columns: minmax(48px, 1fr);
                    justify-items: flex-start;
                }

                .step-item::after {
                    left: 32px;
                }

                .step-number {
                    width: 48px;
                    font-size: 1.35rem;
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
                        <ol class="flow-steps">
                            <li class="step-item" style="--accent: #f0294d;">
                                <span class="step-number">1</span>
                                <div class="step-content">
                                    <h4 class="step-title">Pengumuman Lomba</h4>
                                    <p class="step-period">Periode: 1 - 15 Mei 2023</p>
                                    <p class="step-description">Detail teknis dan jadwal publikasi.</p>
                                    <a class="step-link" href="https://example.com/pengumuman" target="_blank" rel="noopener">
                                        Buka portal pengumuman
                                    </a>
                                </div>
                            </li>
                            <li class="step-item" style="--accent: #fb7033;">
                                <span class="step-number">2</span>
                                <div class="step-content">
                                    <h4 class="step-title">Registrasi Akun</h4>
                                    <p class="step-period">Periode: 5 - 20 Mei 2023</p>
                                    <p class="step-description">Buat akun sekolah dan lengkapi profil.</p>
                                    <a class="step-link" href="https://example.com/registrasi" target="_blank" rel="noopener">
                                        Daftar melalui portal registrasi
                                    </a>
                                </div>
                            </li>
                            <li class="step-item" style="--accent: #f1bd29;">
                                <span class="step-number">3</span>
                                <div class="step-content">
                                    <h4 class="step-title">Unggah Dokumen</h4>
                                    <p class="step-period">Periode: 10 - 25 Mei 2023</p>
                                    <p class="step-description">Upload berkas persyaratan lomba.</p>
                                    <a class="step-link" href="https://example.com/dokumen" target="_blank" rel="noopener">
                                        Unggah berkas sekarang
                                    </a>
                                </div>
                            </li>
                            <li class="step-item" style="--accent: #28a6ff;">
                                <span class="step-number">4</span>
                                <div class="step-content">
                                    <h4 class="step-title">Verifikasi &amp; Pengumuman</h4>
                                    <p class="step-period">Periode: 26 Mei - 5 Juni 2023</p>
                                    <p class="step-description">Validasi data dan hasil akhir.</p>
                                    <a class="step-link" href="https://example.com/pengumuman-akhir" target="_blank" rel="noopener">
                                        Lihat hasil verifikasi
                                    </a>
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
            </main>

            <footer>
                &copy; {{ date('Y') }} Program Kompetisi &amp; Sertifikasi
            </footer>
        </div>
    </body>
</html>
