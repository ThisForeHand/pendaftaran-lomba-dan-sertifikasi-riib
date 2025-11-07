<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Portal Pendaftaran Sertifikasi</title>

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
                background: linear-gradient(180deg, #f6f2ff 0%, #fbf9ff 48%, #ffffff 100%);
                color: #000000;
                padding: clamp(40px, 6vw, 72px) clamp(16px, 6vw, 40px);
            }

            .page-wrapper {
                width: min(960px, 100%);
                background: #ffffff;
                border-radius: 28px;
                border: 1px solid rgba(139, 112, 214, 0.18);
                box-shadow: 0 30px 70px rgba(38, 30, 74, 0.08);
                overflow: hidden;
            }

            header {
                padding: clamp(40px, 6vw, 56px) clamp(32px, 6vw, 80px) clamp(24px, 4vw, 32px);
                text-align: center;
                background: linear-gradient(180deg, rgba(234, 226, 255, 0.65) 0%, rgba(255, 255, 255, 0) 100%);
                border-bottom: 1px solid rgba(139, 112, 214, 0.12);
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
                background: linear-gradient(135deg, #7c3ffd 0%, #5a28e0 100%);
                color: #ffffff;
                font-weight: 600;
                font-size: 0.95rem;
                padding: 12px 26px;
                border-radius: 999px;
                text-decoration: none;
                box-shadow: 0 12px 24px rgba(123, 61, 246, 0.22);
                transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
                width: fit-content;
            }

            .card-button:hover,
            .card-button:focus {
                transform: translateY(-2px);
                box-shadow: 0 14px 28px rgba(90, 40, 224, 0.26);
                background: linear-gradient(135deg, #6d32eb 0%, #4a20c4 100%);
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

            .flow-diagram {
                margin: 0;
                padding: clamp(12px, 2vw, 18px);
                background: rgba(124, 63, 253, 0.08);
                border-radius: clamp(24px, 4vw, 32px);
                border: 1px solid rgba(124, 63, 253, 0.18);
                box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4);
                display: grid;
                gap: clamp(12px, 2vw, 18px);
            }

            .flow-diagram a {
                position: relative;
                display: inline-block;
                border-radius: clamp(20px, 4vw, 28px);
                overflow: hidden;
                outline: none;
            }

            .flow-diagram a:focus-visible {
                box-shadow: 0 0 0 4px rgba(124, 63, 253, 0.32);
            }

            .flow-diagram img {
                display: block;
                width: 100%;
                height: auto;
            }

            .flow-diagram figcaption {
                font-size: clamp(0.9rem, 1.8vw, 1rem);
                color: rgba(0, 0, 0, 0.78);
            }

            .visually-hidden {
                position: absolute;
                width: 1px;
                height: 1px;
                padding: 0;
                margin: -1px;
                overflow: hidden;
                clip: rect(0, 0, 0, 0);
                white-space: nowrap;
                border: 0;
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

                .flow-diagram {
                    padding: clamp(16px, 6vw, 24px);
                }
            }
        </style>
    </head>
    <body>
        <div class="page-wrapper">
            <header>
                <h1>Portal Pendaftaran Sertifikasi</h1>
                <p>
                    Dapatkan sertifikasi profesional untuk menguatkan kompetensi, portofolio, dan jenjang karier Anda.
                </p>
            </header>

            <main class="main-card">
                <div class="link-block">
                    <div class="card-title">Pendaftaran Sertifikasi</div>
                    <p>
                        Ikuti jadwal sertifikasi terbaru khusus dosen dan tenaga pendidik. Pastikan data dan dokumen yang dibutuhkan sudah lengkap.
                    </p>
                    <a class="card-button" href="{{ route('pendaftaran.sertifikasi') }}">
                        Daftar Sertifikasi
                    </a>
                </div>

                <div class="flow-grid">
                    <div class="flow-card">
                        <h3>Alur Pendaftaran Sertifikasi</h3>
                        <figure class="flow-diagram">
                            <a href="https://www.youtube.com/" target="_blank" rel="noopener" title="Buka panduan alur pendaftaran">
                                <img
                                    src="{{ asset('images/alur-pendaftaran-sertifikasi.svg') }}"
                                    alt="Diagram alur pendaftaran sertifikasi"
                                    loading="lazy"
                                />
                                <span class="visually-hidden">Klik bagian tautan pada gambar untuk membuka panduan video</span>
                            </a>
                            <figcaption>
                                Klik bagian tautan pada gambar untuk membuka panduan (sementara diarahkan ke YouTube).
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </main>

            <footer>
                &copy; {{ date('Y') }} Program Kompetisi &amp; Sertifikasi
            </footer>
        </div>
    </body>
</html>
