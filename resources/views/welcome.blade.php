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
                background: #f2f6ff;
                color: #1c2a4a;
                padding: 56px 20px;
            }

            .page-wrapper {
                width: min(1120px, 100%);
                background: #ffffff;
                border-radius: 24px;
                border: 1px solid rgba(93, 123, 214, 0.2);
                box-shadow: 0 25px 60px rgba(28, 42, 74, 0.1);
                overflow: hidden;
            }

            header {
                padding: clamp(36px, 5vw, 48px) clamp(32px, 6vw, 72px) clamp(12px, 3vw, 24px);
                text-align: center;
                border-bottom: 1px solid rgba(93, 123, 214, 0.12);
                background: linear-gradient(180deg, rgba(226, 233, 255, 0.65) 0%, rgba(255, 255, 255, 0) 100%);
            }

            header h1 {
                margin: 0 0 16px;
                font-size: clamp(2rem, 4vw, 2.6rem);
                font-weight: 600;
                color: #132452;
            }

            header p {
                margin: 0 auto;
                max-width: 720px;
                font-size: 1rem;
                line-height: 1.6;
                color: #4c5d88;
            }

            .sections {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: clamp(24px, 4vw, 40px);
                padding: clamp(28px, 5vw, 48px) clamp(32px, 6vw, 72px) clamp(40px, 6vw, 64px);
            }

            .card {
                display: flex;
                flex-direction: column;
                gap: 28px;
                padding: clamp(24px, 4vw, 32px);
                border-radius: 20px;
                border: 1px solid rgba(93, 123, 214, 0.24);
                background: #ffffff;
                box-shadow: 0 12px 30px rgba(19, 36, 82, 0.08);
            }

            .card-header {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .card-header h2 {
                margin: 0;
                font-size: clamp(1.3rem, 2.4vw, 1.7rem);
                font-weight: 600;
                color: #173166;
            }

            .card-header p {
                margin: 0;
                color: #4b5c82;
                line-height: 1.6;
            }

            .card-section {
                display: flex;
                flex-direction: column;
                gap: 16px;
            }

            .card-section h3 {
                margin: 0;
                font-size: 1.05rem;
                font-weight: 600;
                color: #1f2f55;
            }

            .image-frame {
                border: 1px solid rgba(93, 123, 214, 0.25);
                border-radius: 18px;
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
                padding: 0 24px 36px;
                color: #7585ad;
                font-size: 0.85rem;
                border-top: 1px solid rgba(93, 123, 214, 0.12);
                background: rgba(245, 249, 255, 0.65);
            }

            @media (max-width: 720px) {
                body {
                    padding: 32px 16px;
                }

                header {
                    padding: 32px 20px 12px;
                }

                .sections {
                    padding: 24px 20px 32px;
                }

                .card {
                    padding: 24px 20px;
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

            <div class="sections">
                <section class="card" aria-labelledby="lomba-heading">
                    <div class="card-header">
                        <h2 id="lomba-heading">Pendaftaran Lomba</h2>
                        <p>
                            Daftarkan diri Anda untuk ikut kompetisi. Terbuka untuk mahasiswa aktif dari seluruh
                            perguruan tinggi.
                        </p>
                    </div>

                    <div class="card-section">
                        <h3>Alur Lomba</h3>
                        <div class="image-frame" role="img" aria-label="Area kosong untuk gambar infografis lomba">
                            Area gambar infografis lomba
                        </div>
                    </div>
                </section>

                <section class="card" aria-labelledby="sertifikasi-heading">
                    <div class="card-header">
                        <h2 id="sertifikasi-heading">Pendaftaran Sertifikasi</h2>
                        <p>
                            Ikuti jadwal sertifikasi terbaru. Tersedia beberapa gelombang setiap semester dengan
                            kuota terbatas.
                        </p>
                    </div>

                    <div class="card-section">
                        <h3>Alur Sertifikasi</h3>
                        <div class="image-frame" role="img" aria-label="Area kosong untuk gambar infografis sertifikasi">
                            Area gambar infografis sertifikasi
                        </div>
                    </div>
                </section>
            </div>

            <footer>
                &copy; {{ date('Y') }} Program Kompetisi &amp; Sertifikasi
            </footer>
        </div>
    </body>
</html>
