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
                padding: clamp(18px, 3vw, 28px);
                background: rgba(124, 63, 253, 0.08);
                border-radius: clamp(24px, 4vw, 32px);
                border: 1px solid rgba(124, 63, 253, 0.18);
                box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4);
                display: grid;
                gap: clamp(18px, 3vw, 28px);
            }

            .timeline {
                list-style: none;
                margin: 0;
                padding: 0;
                display: grid;
                gap: clamp(18px, 3vw, 28px);
            }

            .timeline-step {
                position: relative;
                display: flex;
                align-items: flex-start;
                gap: clamp(16px, 3vw, 28px);
                padding: clamp(18px, 3vw, 26px);
                border-radius: clamp(20px, 3vw, 28px);
                background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(255, 255, 255, 0.9) 100%);
                border: 1px solid rgba(124, 63, 253, 0.18);
                box-shadow: 0 18px 38px rgba(67, 44, 117, 0.12);
                text-decoration: none;
                color: inherit;
                transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease;
            }

            .timeline-step:hover,
            .timeline-step:focus-visible {
                transform: translateY(-3px);
                box-shadow: 0 22px 44px rgba(58, 32, 115, 0.16);
                border-color: rgba(124, 63, 253, 0.32);
            }

            .timeline-step:focus-visible {
                outline: none;
                box-shadow: 0 0 0 4px rgba(124, 63, 253, 0.24), 0 22px 44px rgba(58, 32, 115, 0.16);
            }

            .step-badge {
                flex-shrink: 0;
                width: clamp(56px, 6vw, 72px);
                aspect-ratio: 1 / 1;
                border-radius: 50%;
                display: grid;
                place-items: center;
                color: #ffffff;
                font-size: clamp(1.35rem, 3.2vw, 1.6rem);
                font-weight: 700;
                position: relative;
                background: linear-gradient(135deg, #ef4444 0%, #f97316 38%, #facc15 100%);
                box-shadow: inset 0 0 0 2px rgba(255, 255, 255, 0.35), 0 16px 32px rgba(249, 115, 22, 0.24);
            }

            .step-badge::after {
                content: "";
                position: absolute;
                inset: -12%;
                border-radius: 50%;
                background: linear-gradient(135deg, rgba(239, 68, 68, 0.16) 0%, rgba(124, 58, 237, 0.14) 52%, rgba(14, 165, 233, 0.16) 100%);
                z-index: -1;
            }

            .timeline li:nth-child(2) .step-badge {
                background: linear-gradient(135deg, #0ea5e9 0%, #2563eb 48%, #4338ca 100%);
                box-shadow: inset 0 0 0 2px rgba(255, 255, 255, 0.35), 0 16px 32px rgba(37, 99, 235, 0.26);
            }

            .timeline li:nth-child(3) .step-badge {
                background: linear-gradient(135deg, #7c3aed 0%, #5b21b6 50%, #312e81 100%);
                box-shadow: inset 0 0 0 2px rgba(255, 255, 255, 0.32), 0 16px 32px rgba(91, 33, 182, 0.26);
            }

            .step-content {
                display: grid;
                gap: clamp(6px, 1.8vw, 12px);
            }

            .step-heading {
                margin: 0;
                font-size: clamp(1.05rem, 2.2vw, 1.22rem);
                font-weight: 600;
                color: #0f172a;
            }

            .step-subtitle {
                margin: 0;
                font-size: clamp(0.92rem, 1.8vw, 1rem);
                font-weight: 500;
                color: rgba(15, 23, 42, 0.74);
            }

            .step-list {
                margin: 0;
                padding-left: 1.2em;
                display: grid;
                gap: 6px;
                font-size: clamp(0.9rem, 1.8vw, 0.98rem);
                color: rgba(15, 23, 42, 0.78);
            }

            .step-list li::marker {
                color: rgba(124, 63, 253, 0.85);
            }

            .step-meta {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                margin-top: clamp(6px, 1.4vw, 10px);
                font-size: clamp(0.82rem, 1.6vw, 0.92rem);
                font-weight: 600;
                color: rgba(124, 58, 237, 0.9);
            }

            .support-box {
                padding: clamp(18px, 3vw, 24px);
                border-radius: clamp(18px, 3vw, 24px);
                background: rgba(14, 165, 233, 0.08);
                border: 1px solid rgba(14, 165, 233, 0.28);
                display: grid;
                gap: 6px;
            }

            .support-box strong {
                font-size: clamp(0.95rem, 1.8vw, 1.05rem);
                font-weight: 600;
                color: #0f172a;
            }

            .support-box p {
                margin: 0;
                font-size: clamp(0.88rem, 1.6vw, 0.96rem);
                color: rgba(15, 23, 42, 0.78);
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
                        <div class="flow-diagram">
                            <ol class="timeline" role="list">
                                <li>
                                    <a
                                        class="timeline-step"
                                        href="https://simampu.poltekkes-smg.ac.id/"
                                        target="_blank"
                                        rel="noopener"
                                        title="Buka portal resmi untuk membaca panduan"
                                    >
                                        <span class="step-badge">1</span>
                                        <span class="step-content">
                                            <span class="step-heading">Persiapkan Akun &amp; Panduan</span>
                                            <span class="step-subtitle">Mulai dengan memahami ketentuan pendaftaran.</span>
                                            <ul class="step-list">
                                                <li>Unduh dan baca panduan peserta terbaru dari portal resmi.</li>
                                                <li>Kunjungi <strong>simampu.poltekkes-smg.ac.id</strong> untuk memastikan jadwal.</li>
                                                <li>Klik tombol <strong>Pendaftaran</strong> untuk masuk ke layanan.</li>
                                            </ul>
                                            <span class="step-meta">➡️ Panduan &amp; Portal SIMAMPU</span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a
                                        class="timeline-step"
                                        href="{{ route('pendaftaran.sertifikasi') }}"
                                        title="Masuk ke formulir pendaftaran sertifikasi"
                                    >
                                        <span class="step-badge">2</span>
                                        <span class="step-content">
                                            <span class="step-heading">Lengkapi Formulir Online</span>
                                            <span class="step-subtitle">Isi data dan unggah berkas sesuai ketentuan.</span>
                                            <ul class="step-list">
                                                <li>Masukkan NIK, program studi, dan IPK semester terakhir.</li>
                                                <li>Unggah pas foto formal (JPG/JPEG) maksimal 300 KB.</li>
                                                <li>Pastikan seluruh isian tersimpan, lalu tekan <strong>Kirim</strong>.</li>
                                            </ul>
                                            <span class="step-meta">➡️ Formulir Digital Sertifikasi</span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a
                                        class="timeline-step"
                                        href="mailto:sertifikasi@poltekkes-smg.ac.id"
                                        title="Kirim bukti pembayaran atau tanya konfirmasi"
                                    >
                                        <span class="step-badge">3</span>
                                        <span class="step-content">
                                            <span class="step-heading">Konfirmasi &amp; Pembayaran</span>
                                            <span class="step-subtitle">Finalisasi pendaftaran sesuai tagihan.</span>
                                            <ul class="step-list">
                                                <li>Catat nomor booking dan virtual account yang tampil.</li>
                                                <li>Lakukan pembayaran biaya sertifikasi sesuai batas waktu.</li>
                                                <li>Kirim bukti bayar untuk diverifikasi oleh panitia.</li>
                                            </ul>
                                            <span class="step-meta">➡️ Kirim konfirmasi ke panitia</span>
                                        </span>
                                    </a>
                                </li>
                            </ol>

                            <div class="support-box">
                                <strong>Hanya bila diperlukan</strong>
                                <p>
                                    Masih kesulitan? Hubungi helpdesk melalui email di atas atau WhatsApp resmi panitia untuk
                                    mendapatkan bantuan teknis pendaftaran.
                                </p>
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
