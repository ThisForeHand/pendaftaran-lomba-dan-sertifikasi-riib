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

            *,
            *::before,
            *::after {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                font-family: "Instrument Sans", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
                background: radial-gradient(circle at 15% 20%, rgba(68, 110, 230, 0.12), transparent 42%),
                    radial-gradient(circle at 85% 18%, rgba(0, 194, 255, 0.16), transparent 48%),
                    linear-gradient(180deg, #f8fbff 0%, #eef3ff 40%, #ffffff 100%);
                color: #102048;
                padding: clamp(32px, 6vw, 64px) clamp(16px, 5vw, 48px);
            }

            .page-wrapper {
                width: min(1120px, 100%);
                background: #ffffff;
                border-radius: 36px;
                border: 1px solid rgba(28, 64, 187, 0.08);
                box-shadow: 0 28px 80px rgba(28, 42, 74, 0.12);
                overflow: hidden;
            }

            header {
                padding: clamp(40px, 6vw, 64px) clamp(32px, 7vw, 96px) clamp(28px, 4vw, 48px);
                text-align: center;
                background: linear-gradient(180deg, rgba(226, 233, 255, 0.7) 0%, rgba(255, 255, 255, 0) 60%);
                border-bottom: 1px solid rgba(68, 96, 200, 0.12);
            }

            header h1 {
                margin: 0 0 16px;
                font-size: clamp(2.1rem, 4.6vw, 2.8rem);
                font-weight: 600;
                letter-spacing: -0.02em;
                color: #0d1a3a;
            }

            header p {
                margin: 0 auto;
                max-width: 680px;
                line-height: 1.7;
                font-size: clamp(1rem, 2.2vw, 1.1rem);
                color: rgba(13, 26, 58, 0.72);
            }

            .main-card {
                padding: clamp(32px, 5vw, 60px) clamp(24px, 6vw, 80px) clamp(40px, 5vw, 72px);
                display: grid;
                gap: clamp(32px, 5vw, 48px);
            }

            .cta-block {
                display: grid;
                gap: 16px;
                justify-items: center;
                text-align: center;
            }

            .cta-block .card-title {
                font-size: clamp(1.6rem, 3vw, 1.9rem);
                font-weight: 600;
                color: #0d1a3a;
            }

            .cta-block p {
                margin: 0;
                max-width: 540px;
                font-size: clamp(0.98rem, 2vw, 1.08rem);
                line-height: 1.65;
                color: rgba(16, 32, 72, 0.75);
            }

            .cta-button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                padding: 14px 32px;
                background: linear-gradient(135deg, #1f49e0 0%, #0d2fbb 100%);
                color: #ffffff;
                font-weight: 600;
                font-size: 0.98rem;
                border-radius: 999px;
                text-decoration: none;
                box-shadow: 0 16px 32px rgba(31, 73, 224, 0.25);
                transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
            }

            .cta-button:hover,
            .cta-button:focus {
                transform: translateY(-2px);
                background: linear-gradient(135deg, #1a3fba 0%, #0a2596 100%);
                box-shadow: 0 18px 36px rgba(26, 63, 186, 0.28);
            }

            .flow-layout {
                display: grid;
                gap: clamp(24px, 4vw, 40px);
            }

            @media (min-width: 960px) {
                .flow-layout {
                    grid-template-columns: minmax(240px, 1fr) minmax(200px, 320px) minmax(240px, 1fr);
                    align-items: start;
                }
            }

            .column {
                display: grid;
                gap: clamp(20px, 3vw, 28px);
                position: relative;
            }

            .column::before {
                content: "";
                position: absolute;
                left: calc(44px - 1px);
                top: 28px;
                bottom: 28px;
                width: 2px;
                background: linear-gradient(180deg, rgba(68, 96, 200, 0.16) 0%, rgba(68, 96, 200, 0.04) 100%);
            }

            .column.right::before {
                left: auto;
                right: calc(44px - 1px);
            }

            @media (max-width: 959px) {
                .column::before {
                    display: none;
                }
            }

            .step-card {
                position: relative;
                display: grid;
                grid-template-columns: auto 1fr;
                gap: 20px;
                padding: clamp(22px, 4vw, 28px) clamp(22px, 4vw, 30px);
                border-radius: 28px;
                background: linear-gradient(135deg, rgba(238, 242, 255, 0.92) 0%, rgba(255, 255, 255, 0.98) 100%);
                border: 1px solid rgba(68, 96, 200, 0.14);
                box-shadow: 0 18px 36px rgba(16, 32, 72, 0.08);
            }

            .step-card::after {
                content: "";
                position: absolute;
                left: 44px;
                top: calc(100% - 8px);
                width: 2px;
                height: clamp(24px, 4vw, 36px);
                background: linear-gradient(180deg, rgba(68, 96, 200, 0.22) 0%, rgba(68, 96, 200, 0) 100%);
            }

            .column.right .step-card::after {
                left: auto;
                right: 44px;
            }

            .column .step-card:last-child::after {
                display: none;
            }

            .step-number {
                width: clamp(56px, 9vw, 64px);
                aspect-ratio: 1;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 700;
                font-size: clamp(1.3rem, 3vw, 1.6rem);
                color: #ffffff;
                background: var(--accent, linear-gradient(135deg, #1f49e0 0%, #0d2fbb 100%));
                box-shadow: 0 16px 32px rgba(16, 32, 72, 0.18);
            }

            .step-body {
                display: grid;
                gap: 10px;
            }

            .step-title {
                margin: 0;
                font-size: clamp(1.05rem, 2.4vw, 1.28rem);
                font-weight: 600;
                color: #0d1a3a;
            }

            .step-text {
                margin: 0;
                font-size: 0.95rem;
                line-height: 1.6;
                color: rgba(13, 26, 58, 0.7);
            }

            .step-links {
                margin: 0;
                padding-left: 1.2rem;
                display: grid;
                gap: 6px;
                font-size: 0.94rem;
            }

            .step-links li a {
                color: #1f49e0;
                text-decoration: none;
                font-weight: 600;
                position: relative;
                padding-bottom: 2px;
            }

            .step-links li a::after {
                content: "";
                position: absolute;
                left: 0;
                bottom: 0;
                width: 100%;
                height: 2px;
                background: rgba(31, 73, 224, 0.3);
                transform: scaleX(0);
                transform-origin: left;
                transition: transform 0.2s ease;
            }

            .step-links li a:hover::after,
            .step-links li a:focus::after {
                transform: scaleX(1);
            }

            .step-links li a:hover,
            .step-links li a:focus {
                color: #1330a8;
            }

            .step-card.accent-red {
                --accent: linear-gradient(135deg, #f0294d 0%, #c41635 100%);
            }

            .step-card.accent-orange {
                --accent: linear-gradient(135deg, #fb7033 0%, #d6551c 100%);
            }

            .step-card.accent-gold {
                --accent: linear-gradient(135deg, #f1bd29 0%, #d49a07 100%);
            }

            .step-card.accent-blue {
                --accent: linear-gradient(135deg, #28a6ff 0%, #1178d6 100%);
            }

            .step-card.accent-teal {
                --accent: linear-gradient(135deg, #01c0a6 0%, #04977f 100%);
            }

            .step-card.accent-purple {
                --accent: linear-gradient(135deg, #7d5bff 0%, #5530e3 100%);
            }

            .middle-column {
                display: grid;
                align-items: center;
            }

            .middle-card {
                padding: clamp(28px, 4vw, 36px);
                border-radius: 32px;
                background: linear-gradient(180deg, rgba(255, 255, 255, 0.9) 0%, rgba(236, 244, 255, 0.95) 100%);
                border: 1px solid rgba(68, 96, 200, 0.18);
                box-shadow: 0 22px 46px rgba(16, 32, 72, 0.12);
                text-align: center;
                display: grid;
                gap: 16px;
            }

            .middle-card h3 {
                margin: 0;
                font-size: clamp(1.2rem, 2.5vw, 1.4rem);
                font-weight: 600;
                color: #0d1a3a;
            }

            .middle-card p {
                margin: 0;
                font-size: 0.95rem;
                color: rgba(13, 26, 58, 0.68);
                line-height: 1.6;
            }

            .middle-card ul {
                list-style: none;
                margin: 0;
                padding: 0;
                display: grid;
                gap: 10px;
                font-size: 0.94rem;
            }

            .middle-card ul a {
                color: #1f49e0;
                text-decoration: none;
                font-weight: 600;
            }

            .middle-card ul a:hover,
            .middle-card ul a:focus {
                text-decoration: underline;
            }

            footer {
                text-align: center;
                padding: 0 24px 40px;
                color: rgba(13, 26, 58, 0.58);
                font-size: 0.85rem;
            }

            @media (max-width: 640px) {
                body {
                    padding: 28px 16px;
                }

                header {
                    padding: 32px 20px 24px;
                }

                .main-card {
                    padding: 28px 20px 40px;
                }

                .step-card {
                    grid-template-columns: minmax(48px, 1fr);
                    justify-items: flex-start;
                }

                .step-card::after {
                    display: none;
                }

                .step-number {
                    width: 52px;
                }
            }
        </style>
    </head>
    <body>
        <div class="page-wrapper">
            <header>
                <h1>Portal Pendaftaran Kompetisi</h1>
                <p>
                    Ikuti alur pendaftaran lomba secara bertahap. Klik setiap tautan untuk membuka halaman yang relevan dan pastikan
                    seluruh persyaratan telah terpenuhi.
                </p>
            </header>

            <main class="main-card">
                <section class="cta-block">
                    <div class="card-title">Mulai Pendaftaran</div>
                    <p>
                        Daftarkan diri Anda sebagai peserta kompetisi. Portal terbuka untuk mahasiswa aktif yang ingin mengikuti
                        seleksi lomba tingkat nasional maupun internasional.
                    </p>
                    <a class="cta-button" href="{{ route('pendaftaran.lomba') }}">
                        Buka Formulir Pendaftaran
                    </a>
                </section>

                <section class="flow-layout" aria-label="Alur pendaftaran lomba">
                    <div class="column left">
                        <article class="step-card accent-red">
                            <div class="step-number">1</div>
                            <div class="step-body">
                                <h2 class="step-title">Persiapan Dokumen</h2>
                                <p class="step-text">Unduh panduan dan pelajari syarat umum pendaftaran.</p>
                                <ul class="step-links">
                                    <li><a href="https://sipenmaru.poltekkes-smg.ac.id" target="_blank" rel="noopener">Unduh buku panduan</a></li>
                                    <li><a href="https://poltekkes-smg.ac.id" target="_blank" rel="noopener">Buka website resmi</a></li>
                                    <li><a href="https://sipenmaru.poltekkes-smg.ac.id/pmdp" target="_blank" rel="noopener">Lihat jalur PMDP</a></li>
                                </ul>
                            </div>
                        </article>

                        <article class="step-card accent-orange">
                            <div class="step-number">2</div>
                            <div class="step-body">
                                <h2 class="step-title">Nomor Booking</h2>
                                <p class="step-text">Dapatkan kode unik untuk melanjutkan ke proses pembayaran.</p>
                                <ul class="step-links">
                                    <li><a href="https://sipenmaru.poltekkes-smg.ac.id/virtual-account" target="_blank" rel="noopener">Tampil nomor booking</a></li>
                                    <li><a href="https://www.bni.co.id" target="_blank" rel="noopener">Cetak BNI Virtual Account</a></li>
                                    <li><a href="https://ibank.bni.co.id" target="_blank" rel="noopener">Panduan setor BNI Virtual</a></li>
                                </ul>
                            </div>
                        </article>

                        <article class="step-card accent-gold">
                            <div class="step-number">3</div>
                            <div class="step-body">
                                <h2 class="step-title">Pembayaran Biaya</h2>
                                <p class="step-text">Lunasi biaya pendaftaran melalui kanal pembayaran resmi.</p>
                                <ul class="step-links">
                                    <li><a href="https://www.bni.co.id/id-id/personal/simpanan/bniva" target="_blank" rel="noopener">Cara bayar via ATM</a></li>
                                    <li><a href="https://www.bni.co.id/id-id/personal/layanan-digital/bni-mobile-banking" target="_blank" rel="noopener">Instruksi mobile banking</a></li>
                                    <li><a href="https://www.bni.co.id/id-id/personal/layanan-digital/internet-banking" target="_blank" rel="noopener">Panduan internet banking</a></li>
                                </ul>
                            </div>
                        </article>
                    </div>

                    <div class="middle-column">
                        <div class="middle-card">
                            <h3>Hanya Bila Diperlukan</h3>
                            <p>Gunakan langkah tambahan berikut jika Anda membutuhkan bantuan selama proses pendaftaran.</p>
                            <ul>
                                <li><a href="{{ route('login') }}">Login calon mahasiswa</a></li>
                                <li><a href="{{ route('pendaftaran.lomba') }}">Cetak kartu pendaftaran</a></li>
                                <li><a href="mailto:sipenmaru@poltekkes-smg.ac.id">Hubungi pusat bantuan</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="column right">
                        <article class="step-card accent-blue">
                            <div class="step-number">4</div>
                            <div class="step-body">
                                <h2 class="step-title">Unggah Dokumen</h2>
                                <p class="step-text">Lengkapi identitas, ijazah, dan pasfoto sesuai ketentuan.</p>
                                <ul class="step-links">
                                    <li><a href="{{ route('pendaftaran.lomba') }}#dokumen">Unggah berkas registrasi</a></li>
                                    <li><a href="https://compressjpeg.com/" target="_blank" rel="noopener">Kompres foto &lt; 300 KB</a></li>
                                    <li><a href="https://imagecompressor.com/" target="_blank" rel="noopener">Optimalkan file JPEG/PNG</a></li>
                                </ul>
                            </div>
                        </article>

                        <article class="step-card accent-teal">
                            <div class="step-number">5</div>
                            <div class="step-body">
                                <h2 class="step-title">Verifikasi Data</h2>
                                <p class="step-text">Pastikan seluruh data sudah benar sebelum finalisasi.</p>
                                <ul class="step-links">
                                    <li><a href="{{ route('pendaftaran.lomba') }}#review">Periksa ringkasan data</a></li>
                                    <li><a href="https://sipenmaru.poltekkes-smg.ac.id/kartu-booking" target="_blank" rel="noopener">Cetak kartu booking</a></li>
                                    <li><a href="https://sipenmaru.poltekkes-smg.ac.id/pengumuman" target="_blank" rel="noopener">Lihat status verifikasi</a></li>
                                </ul>
                            </div>
                        </article>

                        <article class="step-card accent-purple">
                            <div class="step-number">6</div>
                            <div class="step-body">
                                <h2 class="step-title">Finalisasi</h2>
                                <p class="step-text">Selesaikan proses pendaftaran dan unduh dokumen akhir.</p>
                                <ul class="step-links">
                                    <li><a href="{{ route('pendaftaran.lomba') }}#submit">Kirim formulir akhir</a></li>
                                    <li><a href="{{ route('portal.sertifikasi') }}">Akses portal sertifikasi</a></li>
                                    <li><a href="https://sipenmaru.poltekkes-smg.ac.id/nilai" target="_blank" rel="noopener">Lihat nilai &amp; hasil seleksi</a></li>
                                </ul>
                            </div>
                        </article>
                    </div>
                </section>
            </main>

            <footer>
                &copy; {{ date('Y') }} Program Kompetisi &amp; Sertifikasi. Seluruh hak cipta dilindungi.
            </footer>
        </div>
    </body>
</html>
