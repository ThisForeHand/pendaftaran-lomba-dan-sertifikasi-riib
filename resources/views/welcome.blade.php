<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pendaftaran Kompetisi & Sertifikasi</title>

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
                color: #1c2a4a;
                padding: clamp(40px, 6vw, 72px) clamp(16px, 6vw, 40px);
            }

            .page-wrapper {
                width: min(1160px, 100%);
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
                color: #132452;
                letter-spacing: -0.02em;
            }

            header p {
                margin: 0 auto;
                max-width: 720px;
                font-size: clamp(1rem, 2vw, 1.05rem);
                line-height: 1.65;
                color: #4c5d88;
            }

            .main-card {
                padding: clamp(32px, 5vw, 52px) clamp(32px, 6vw, 80px);
                display: grid;
                gap: clamp(32px, 6vw, 60px);
            }

            .link-row {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                gap: clamp(24px, 4vw, 48px);
            }

            .link-block {
                display: grid;
                gap: 10px;
            }

            .card-link {
                font-size: clamp(1.28rem, 2.6vw, 1.58rem);
                font-weight: 600;
                color: #2968f6;
                text-decoration: underline;
                transition: color 0.2s ease, text-decoration-color 0.2s ease;
                text-decoration-thickness: 2px;
                text-underline-offset: 6px;
            }

            .card-link:hover,
            .card-link:focus {
                color: #174be4;
            }

            .link-block p {
                margin: 0;
                color: #4b5c82;
                line-height: 1.6;
            }

            .flow-grid {
                position: relative;
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: clamp(24px, 5vw, 48px);
                padding-top: clamp(16px, 3vw, 28px);
            }

            .flow-grid::before {
                content: "";
                position: absolute;
                top: 0;
                bottom: 0;
                left: 50%;
                width: 1px;
                background: rgba(93, 123, 214, 0.18);
                transform: translateX(-50%);
            }

            @media (max-width: 860px) {
                .flow-grid::before {
                    display: none;
                }
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
                color: #1f2f55;
            }

            .image-frame {
                border: 1px solid rgba(93, 123, 214, 0.25);
                border-radius: 20px;
                background: repeating-linear-gradient(
                    135deg,
                    rgba(226, 233, 255, 0.7) 0px,
                    rgba(226, 233, 255, 0.7) 22px,
                    rgba(255, 255, 255, 0.9) 22px,
                    rgba(255, 255, 255, 0.9) 44px
                );
                min-height: 360px;
                display: grid;
                place-items: center;
                color: rgba(19, 36, 82, 0.45);
                font-weight: 500;
                text-align: center;
                padding: 24px;
                font-size: 0.95rem;
            }

            footer {
                text-align: center;
                padding: 0 24px 40px;
                color: #7585ad;
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
                <h1>Pendaftaran Kompetisi &amp; Sertifikasi</h1>
                <p>
                    Daftarkan diri Anda ke berbagai ajang lomba dan program sertifikasi. Ikuti alur
                    pendaftaran yang sudah kami susun agar setiap tahapan dapat dipersiapkan dengan mudah.
                </p>
            </header>

            <main class="main-card">
                <div class="link-row">
                    <div class="link-block">
                        <a class="card-link" href="{{ route('pendaftaran.lomba') }}">Pendaftaran Lomba</a>
                        <p>
                            Daftarkan diri Anda untuk ikut kompetisi. Terbuka untuk mahasiswa aktif dari seluruh
                            perguruan tinggi.
                        </p>
                    </div>
                    <div class="link-block">
                        <a class="card-link" href="{{ route('pendaftaran.sertifikasi') }}">Pendaftaran Sertifikasi</a>
                        <p>
                            Ikuti jadwal sertifikasi terbaru. Program sertifikasi khusus dosen untuk menguatkan kompetensi, portofolio, dan jenjang karier Anda.
                        </p>
                    </div>
                </div>

                <div class="flow-grid">
                    <div class="flow-card">
                        <h3>Alur Lomba</h3>
                        <div class="image-frame" role="img" aria-label="Area kosong untuk gambar infografis lomba">
                            Area gambar infografis lomba
                        </div>
                    </div>
                    <div class="flow-card">
                        <h3>Alur Sertifikasi</h3>
                        <div class="image-frame" role="img" aria-label="Area kosong untuk gambar infografis sertifikasi">
                            Area gambar infografis sertifikasi
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
