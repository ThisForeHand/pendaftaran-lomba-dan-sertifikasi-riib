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
                background: #f4f6fb;
                color: #1f2a44;
                padding: 40px 20px;
            }

            .page-wrapper {
                width: min(1100px, 100%);
                background: #ffffff;
                border-radius: 20px;
                box-shadow: 0 15px 40px rgba(31, 42, 68, 0.12);
                overflow: hidden;
            }

            header {
                padding: 40px clamp(24px, 5vw, 48px) 24px;
                background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            }

            header h1 {
                margin: 0 0 12px;
                font-size: clamp(1.8rem, 3vw, 2.4rem);
                font-weight: 600;
                color: #1b2559;
            }

            header p {
                margin: 0;
                max-width: 720px;
                font-size: 1rem;
                line-height: 1.5;
                color: #52608b;
            }

            .sections {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: clamp(24px, 3vw, 40px);
                padding: 24px clamp(24px, 5vw, 48px) 48px;
            }

            .card {
                display: flex;
                flex-direction: column;
                gap: 20px;
                padding: clamp(20px, 3vw, 28px);
                border-radius: 18px;
                border: 1px solid rgba(93, 107, 152, 0.15);
                background: linear-gradient(180deg, #ffffff 0%, #f8f9ff 100%);
                box-shadow: 0 8px 24px rgba(31, 42, 68, 0.08);
            }

            .card h2 {
                margin: 0;
                font-size: clamp(1.2rem, 2.2vw, 1.6rem);
                font-weight: 600;
                color: #1b2559;
            }

            .card p {
                margin: 0;
                color: #4a5781;
                line-height: 1.6;
            }

            .timeline {
                display: grid;
                gap: 16px;
            }

            .timeline-step {
                display: grid;
                grid-template-columns: auto 1fr;
                gap: 16px;
                align-items: start;
            }

            .timeline-step .number {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: grid;
                place-items: center;
                font-weight: 600;
                color: #fff;
                background: linear-gradient(135deg, #667eea, #764ba2);
                box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4);
            }

            .timeline-step .content {
                padding-top: 4px;
            }

            .timeline-step .title {
                margin: 0 0 4px;
                font-size: 1.05rem;
                color: #1f2a44;
                font-weight: 600;
            }

            .timeline-step .description {
                margin: 0;
                color: #5a678e;
                font-size: 0.95rem;
                line-height: 1.5;
            }

            .image-placeholder {
                width: 100%;
                aspect-ratio: 4 / 3;
                border-radius: 16px;
                border: 2px dashed rgba(102, 126, 234, 0.3);
                background: repeating-linear-gradient(
                    135deg,
                    rgba(102, 126, 234, 0.12),
                    rgba(102, 126, 234, 0.12) 16px,
                    rgba(118, 75, 162, 0.12) 16px,
                    rgba(118, 75, 162, 0.12) 32px
                );
                display: grid;
                place-items: center;
                color: rgba(31, 42, 68, 0.5);
                font-weight: 500;
                text-align: center;
                padding: 20px;
                font-size: 0.95rem;
            }

            .card footer {
                margin-top: auto;
                font-size: 0.85rem;
                color: #6b79a8;
            }

            @media (max-width: 720px) {
                body {
                    padding: 24px 16px;
                }

                header {
                    padding: 32px 24px 16px;
                }

                .sections {
                    padding: 16px 24px 32px;
                }

                .card {
                    padding: 20px;
                }
            }
        </style>
    </head>
    <body>
        <div class="page-wrapper">
            <header>
                <h1>Pendaftaran Kompetisi &amp; Sertifikasi</h1>
                <p>
                    Daftarkan diri Anda untuk mengikuti berbagai kompetisi dan program sertifikasi.
                    Halaman ini menampilkan alur pendaftaran yang jelas sehingga memudahkan Anda
                    mempersiapkan dokumen dan tahapan yang diperlukan.
                </p>
            </header>

            <div class="sections">
                <section class="card" aria-labelledby="lomba-heading">
                    <div>
                        <h2 id="lomba-heading">Pendaftaran Lomba</h2>
                        <p>
                            Daftarkan diri Anda untuk ikut kompetisi. Terbuka untuk mahasiswa aktif dari
                            seluruh perguruan tinggi.
                        </p>
                    </div>

                    <div class="timeline" aria-label="Alur Lomba">
                        <div class="timeline-step">
                            <div class="number">1</div>
                            <div class="content">
                                <p class="title">Pendaftaran Online</p>
                                <p class="description">Lengkapi formulir pendaftaran dan unggah dokumen pendukung.</p>
                            </div>
                        </div>
                        <div class="timeline-step">
                            <div class="number">2</div>
                            <div class="content">
                                <p class="title">Seleksi Administrasi</p>
                                <p class="description">Panitia melakukan verifikasi kelengkapan dan kesesuaian berkas.</p>
                            </div>
                        </div>
                        <div class="timeline-step">
                            <div class="number">3</div>
                            <div class="content">
                                <p class="title">Pengumuman Finalis</p>
                                <p class="description">Peserta yang lolos seleksi diundang untuk mengikuti babak final.</p>
                            </div>
                        </div>
                        <div class="timeline-step">
                            <div class="number">4</div>
                            <div class="content">
                                <p class="title">Presentasi &amp; Penilaian</p>
                                <p class="description">Finalis mempresentasikan karya di hadapan dewan juri.</p>
                            </div>
                        </div>
                        <div class="timeline-step">
                            <div class="number">5</div>
                            <div class="content">
                                <p class="title">Pengumuman Pemenang</p>
                                <p class="description">Daftar juara diumumkan secara resmi pada acara penutupan.</p>
                            </div>
                        </div>
                    </div>

                    <div class="image-placeholder" aria-hidden="true">
                        Area gambar infografis lomba
                    </div>
                </section>

                <section class="card" aria-labelledby="sertifikasi-heading">
                    <div>
                        <h2 id="sertifikasi-heading">Pendaftaran Sertifikasi</h2>
                        <p>
                            Ikuti jadwal sertifikasi terbaru. Tersedia beberapa gelombang setiap semester dengan
                            kuota terbatas.
                        </p>
                    </div>

                    <div class="timeline" aria-label="Alur Sertifikasi">
                        <div class="timeline-step">
                            <div class="number">1</div>
                            <div class="content">
                                <p class="title">Registrasi Akun</p>
                                <p class="description">Buat akun peserta dan pilih program sertifikasi yang diminati.</p>
                            </div>
                        </div>
                        <div class="timeline-step">
                            <div class="number">2</div>
                            <div class="content">
                                <p class="title">Pembayaran Biaya</p>
                                <p class="description">Lakukan pembayaran biaya sertifikasi sesuai instruksi yang berlaku.</p>
                            </div>
                        </div>
                        <div class="timeline-step">
                            <div class="number">3</div>
                            <div class="content">
                                <p class="title">Pelatihan Persiapan</p>
                                <p class="description">Ikuti sesi pembekalan daring atau luring yang telah dijadwalkan.</p>
                            </div>
                        </div>
                        <div class="timeline-step">
                            <div class="number">4</div>
                            <div class="content">
                                <p class="title">Uji Kompetensi</p>
                                <p class="description">Kerjakan asesmen kompetensi sesuai standar lembaga sertifikasi.</p>
                            </div>
                        </div>
                        <div class="timeline-step">
                            <div class="number">5</div>
                            <div class="content">
                                <p class="title">Penerbitan Sertifikat</p>
                                <p class="description">Sertifikat digital dan fisik dikirimkan kepada peserta yang lulus.</p>
                            </div>
                        </div>
                    </div>

                    <div class="image-placeholder" aria-hidden="true">
                        Area gambar infografis sertifikasi
                    </div>
                </section>
            </div>

            <footer style="text-align: center; padding: 0 24px 32px; color: #7a88b9; font-size: 0.85rem;">
                &copy; {{ date('Y') }} Program Kompetisi &amp; Sertifikasi
            </footer>
        </div>
    </body>
</html>
