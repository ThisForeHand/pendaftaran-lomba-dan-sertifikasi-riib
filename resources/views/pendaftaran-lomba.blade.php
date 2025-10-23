<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pendaftaran Persiapan Lomba Innovillage 2025</title>

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
                background: linear-gradient(180deg, #eef3ff 0%, #f8faff 40%, #ffffff 100%);
                color: #14213d;
                padding: clamp(32px, 6vw, 64px) clamp(16px, 5vw, 40px);
            }

            .page-container {
                width: min(880px, 100%);
                background: #ffffff;
                border-radius: 28px;
                border: 1px solid rgba(82, 112, 204, 0.18);
                box-shadow: 0 24px 60px rgba(20, 33, 61, 0.08);
                overflow: hidden;
            }

            header {
                padding: clamp(40px, 6vw, 60px) clamp(32px, 7vw, 72px) clamp(16px, 4vw, 28px);
                background: linear-gradient(180deg, rgba(229, 236, 255, 0.75) 0%, rgba(255, 255, 255, 0) 100%);
                border-bottom: 1px solid rgba(82, 112, 204, 0.12);
            }

            header p.eyebrow {
                font-size: 0.92rem;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                color: #4f6ab8;
                font-weight: 600;
                margin: 0 0 12px;
            }

            header h1 {
                margin: 0 0 18px;
                font-size: clamp(2rem, 4.8vw, 2.7rem);
                font-weight: 600;
                color: #132452;
                letter-spacing: -0.015em;
            }

            header .lead {
                margin: 0 0 18px;
                font-size: clamp(1.02rem, 2vw, 1.12rem);
                line-height: 1.65;
                color: #475a86;
            }

            header ul {
                margin: 0;
                padding-left: 1.2rem;
                color: #4a5d88;
                line-height: 1.6;
            }

            main {
                padding: clamp(32px, 6vw, 56px) clamp(32px, 7vw, 72px) clamp(40px, 6vw, 60px);
                display: grid;
                gap: clamp(28px, 5vw, 48px);
            }

            form {
                display: grid;
                gap: clamp(24px, 4vw, 36px);
            }

            .field-group {
                display: grid;
                gap: 12px;
            }

            .field-group legend,
            .field-group label {
                font-size: 1rem;
                font-weight: 600;
                color: #1d2e56;
            }

            input[type="text"],
            input[type="email"],
            textarea {
                width: 100%;
                font: inherit;
                padding: 14px 16px;
                border-radius: 14px;
                border: 1px solid rgba(82, 112, 204, 0.24);
                background: rgba(243, 247, 255, 0.6);
                transition: border-color 0.2s ease, box-shadow 0.2s ease;
            }

            textarea {
                min-height: 120px;
                resize: vertical;
            }

            input:focus,
            textarea:focus {
                outline: none;
                border-color: #3d63f5;
                box-shadow: 0 0 0 3px rgba(61, 99, 245, 0.15);
                background: #ffffff;
            }

            .options {
                display: grid;
                gap: 10px;
                padding-left: 4px;
            }

            .option-item {
                display: flex;
                align-items: flex-start;
                gap: 10px;
                font-size: 0.98rem;
                color: #425580;
                background: rgba(239, 244, 255, 0.6);
                border-radius: 14px;
                padding: 12px 14px;
                border: 1px solid rgba(82, 112, 204, 0.16);
            }

            .option-item input {
                margin-top: 4px;
            }

            .submit-row {
                display: flex;
                justify-content: flex-end;
            }

            button[type="submit"] {
                font: inherit;
                font-weight: 600;
                padding: 14px 28px;
                border-radius: 999px;
                border: none;
                background: linear-gradient(135deg, #2e6ef8 0%, #315ff0 100%);
                color: #ffffff;
                cursor: pointer;
                transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
            }

            button[type="submit"]:hover,
            button[type="submit"]:focus {
                transform: translateY(-1px);
                box-shadow: 0 10px 24px rgba(49, 95, 240, 0.32);
                filter: brightness(1.05);
                outline: none;
            }

            @media (max-width: 720px) {
                body {
                    padding: 24px 16px 40px;
                }

                header,
                main {
                    padding-left: clamp(20px, 6vw, 32px);
                    padding-right: clamp(20px, 6vw, 32px);
                }

                .submit-row {
                    justify-content: stretch;
                }

                button[type="submit"] {
                    width: 100%;
                }
            }
        </style>
    </head>
    <body>
        <div class="page-container">
            <header>
                <p class="eyebrow">Formulir Pendaftaran</p>
                <h1>Pendaftaran Persiapan Peserta Lomba Innovillage 2025</h1>
                <p class="lead">
                    Mohon lengkapi informasi di bawah ini agar kami dapat memetakan kebutuhan pendampingan
                    dan menyesuaikan timeline persiapan tim Anda menuju Innovillage 2025.
                </p>
                <ul>
                    <li>Pastikan data yang Anda isikan sudah benar dan mudah dihubungi.</li>
                    <li>Bersiaplah untuk mengikuti sesi briefing teknis setelah formulir ini kami terima.</li>
                    <li>Formulir ini ditujukan bagi mahasiswa aktif dengan ketertarikan mengikuti Innovillage.</li>
                </ul>
            </header>

            <main>
                <form action="#" method="post">
                    <div class="field-group">
                        <label for="nama">1. Nama Lengkap</label>
                        <input id="nama" name="nama" type="text" placeholder="Tuliskan nama lengkap Anda" required>
                    </div>

                    <div class="field-group">
                        <label for="nim">2. NIM</label>
                        <input id="nim" name="nim" type="text" placeholder="Masukkan NIM aktif" required>
                    </div>

                    <fieldset class="field-group">
                        <legend>3. Program Studi</legend>
                        <div class="options">
                            <label class="option-item">
                                <input type="radio" name="program_studi" value="Teknik Industri" required>
                                <span>Teknik Industri</span>
                            </label>
                            <label class="option-item">
                                <input type="radio" name="program_studi" value="Teknik Informatika">
                                <span>Teknik Informatika</span>
                            </label>
                            <label class="option-item">
                                <input type="radio" name="program_studi" value="Desain Produk">
                                <span>Desain Produk</span>
                            </label>
                            <label class="option-item">
                                <input type="radio" name="program_studi" value="Lainnya">
                                <span>Lainnya</span>
                            </label>
                        </div>
                    </fieldset>

                    <div class="field-group">
                        <label for="whatsapp">4. Nomor WhatsApp</label>
                        <input id="whatsapp" name="whatsapp" type="text" placeholder="Contoh: 0812-3456-7890" required>
                    </div>

                    <fieldset class="field-group">
                        <legend>5. Pilihan Peran</legend>
                        <div class="options">
                            <label class="option-item">
                                <input type="radio" name="pilihan_peran" value="Ketua" required>
                                <span>
                                    Ketua &mdash; memimpin koordinasi, membawa ide utama, serta menjaga orisinalitas konsep.
                                </span>
                            </label>
                            <label class="option-item">
                                <input type="radio" name="pilihan_peran" value="Hacker">
                                <span>
                                    Hacker &mdash; memastikan pengembangan solusi secara teknis dan sesuai kebutuhan lapangan.
                                </span>
                            </label>
                            <label class="option-item">
                                <input type="radio" name="pilihan_peran" value="Hipster">
                                <span>
                                    Hipster &mdash; merancang pengalaman, visual, dan komunikasi produk agar mudah dipahami masyarakat.
                                </span>
                            </label>
                        </div>
                    </fieldset>

                    <div class="field-group">
                        <label for="motivasi">6. Motivasi Partisipasi Lomba</label>
                        <textarea id="motivasi" name="motivasi" placeholder="Ceritakan motivasi dan harapan Anda mengikuti Innovillage"></textarea>
                    </div>

                    <fieldset class="field-group">
                        <legend>7. Apakah sudah mempunyai tim?</legend>
                        <div class="options">
                            <label class="option-item">
                                <input type="radio" name="status_tim" value="Sudah" required>
                                <span>Sudah</span>
                            </label>
                            <label class="option-item">
                                <input type="radio" name="status_tim" value="Belum">
                                <span>Belum</span>
                            </label>
                            <label class="option-item">
                                <input type="radio" name="status_tim" value="Belum namun siap mencari anggota">
                                <span>Belum, tetapi siap mencari 2 teman tim</span>
                            </label>
                        </div>
                    </fieldset>

                    <div class="submit-row">
                        <button type="submit">Kirim</button>
                    </div>
                </form>
            </main>
        </div>
    </body>
</html>
