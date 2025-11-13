@extends('layouts.guest')

@section('title', 'Pendaftaran Persiapan Lomba Mahasiswa')

@push('styles')
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

            .back-link {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                margin-bottom: clamp(20px, 4vw, 28px);
                font-size: 0.98rem;
                font-weight: 600;
                color: #2e4eb8;
                text-decoration: none;
                background: rgba(236, 243, 255, 0.7);
                border-radius: 999px;
                padding: 10px 18px;
                transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
            }

            .back-link svg {
                width: 18px;
                height: 18px;
            }

            .back-link:hover,
            .back-link:focus {
                transform: translateY(-1px);
                box-shadow: 0 10px 24px rgba(46, 110, 248, 0.18);
                background: rgba(219, 233, 255, 0.9);
                outline: none;
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

            .alert {
                border-radius: 16px;
                padding: 16px 20px;
                font-size: 0.95rem;
                font-weight: 500;
            }

            .alert-success {
                background: rgba(46, 171, 115, 0.12);
                color: #1b7c4b;
                border: 1px solid rgba(46, 171, 115, 0.28);
            }

            .error-messages {
                display: grid;
                gap: 6px;
                background: rgba(196, 31, 58, 0.08);
                color: #a31f33;
                border: 1px solid rgba(196, 31, 58, 0.2);
                border-radius: 16px;
                padding: 14px 18px;
                font-size: 0.92rem;
            }

            .error-messages strong {
                font-weight: 600;
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
@endpush

@section('content')
<div class="page-container">
            <header>
                <a class="back-link" href="{{ url('/') }}">
                    <svg aria-hidden="true" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M15 18l-6-6 6-6" />
                    </svg>
                    <span>Kembali ke Halaman Utama</span>
                </a>
                <p class="eyebrow">Formulir Pendaftaran</p>
                <h1>Pendaftaran Persiapan Peserta Semua Lomba</h1>
                <p class="lead">
                    Mohon lengkapi informasi di bawah ini agar kami dapat memetakan kebutuhan pendampingan
                    dan menyesuaikan timeline persiapan tim Anda menuju berbagai ajang lomba yang diikuti.
                </p>
                <ul>
                    <li>Pastikan data yang Anda isikan sudah benar dan mudah dihubungi.</li>
                    <li>Bersiaplah untuk mengikuti sesi briefing teknis setelah formulir ini kami terima.</li>
                    <li>Formulir ini ditujukan bagi mahasiswa aktif dengan ketertarikan mengikuti berbagai lomba dan kompetisi.</li>
                </ul>
            </header>

            <main>
                @if (session('status'))
                    <div class="alert alert-success" role="status">{{ session('status') }}</div>
                @endif

                @if ($errors->any())
                    <div class="error-messages" role="alert">
                        <strong>Terjadi kesalahan pada data yang dikirim:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pendaftaran.lomba.store') }}" method="post">
                    @csrf
                    <div class="field-group">
                        <label for="nama">1. Nama Lengkap</label>
                        <input
                            id="nama"
                            name="nama"
                            type="text"
                            placeholder="Tuliskan nama lengkap Anda"
                            value="{{ old('nama') }}"
                            required
                        >
                    </div>

                    <div class="field-group">
                        <label for="nim">2. NIM</label>
                        <input
                            id="nim"
                            name="nim"
                            type="text"
                            placeholder="Masukkan NIM aktif"
                            value="{{ old('nim') }}"
                            required
                        >
                    </div>

                    <fieldset class="field-group">
                        <legend>3. Program Studi</legend>
                        <div class="options">
                            <label class="option-item">
                                <input
                                    type="radio"
                                    name="program_studi"
                                    value="Teknik Industri"
                                    @checked(old('program_studi') === 'Teknik Industri')
                                    required
                                >
                                <span>Teknik Industri</span>
                            </label>
                            <label class="option-item">
                                <input
                                    type="radio"
                                    name="program_studi"
                                    value="Teknik Informatika"
                                    @checked(old('program_studi') === 'Teknik Informatika')
                                >
                                <span>Teknik Informatika</span>
                            </label>
                            <label class="option-item">
                                <input
                                    type="radio"
                                    name="program_studi"
                                    value="Teknik Elektro"
                                    @checked(old('program_studi') === 'Teknik Elektro')
                                >
                                <span>Teknik Elektro</span>
                            </label>
                        </div>
                    </fieldset>

                    <div class="field-group">
                        <label for="whatsapp">4. Nomor WhatsApp</label>
                        <input
                            id="whatsapp"
                            name="whatsapp"
                            type="tel"
                            inputmode="tel"
                            pattern="^(?:\+?62|0)[0-9\s\-()]{8,20}$"
                            placeholder="Contoh: 0812-3456-7890 atau +62812-3456-7890"
                            title="Masukkan nomor WhatsApp yang diawali 0 atau +62"
                            value="{{ old('whatsapp') }}"
                            required
                        >
                    </div>

                    <fieldset class="field-group">
                        <legend>5. Pilihan Peran</legend>
                        <div class="options">
                            <label class="option-item">
                                <input
                                    type="radio"
                                    name="pilihan_peran"
                                    value="Ketua"
                                    @checked(old('pilihan_peran') === 'Ketua')
                                    required
                                >
                                <span>
                                    Ketua &mdash; memimpin koordinasi, membawa ide utama, serta menjaga orisinalitas konsep.
                                </span>
                            </label>
                            <label class="option-item">
                                <input
                                    type="radio"
                                    name="pilihan_peran"
                                    value="Hacker"
                                    @checked(old('pilihan_peran') === 'Hacker')
                                >
                                <span>
                                    Hacker &mdash; memastikan pengembangan solusi secara teknis dan sesuai kebutuhan lapangan.
                                </span>
                            </label>
                            <label class="option-item">
                                <input
                                    type="radio"
                                    name="pilihan_peran"
                                    value="Hipster"
                                    @checked(old('pilihan_peran') === 'Hipster')
                                >
                                <span>
                                    Hipster &mdash; merancang pengalaman, visual, dan komunikasi produk agar mudah dipahami masyarakat.
                                </span>
                            </label>
                        </div>
                    </fieldset>

                    <div class="field-group">
                        <label for="motivasi">6. Motivasi Partisipasi Lomba</label>
                        <textarea
                            id="motivasi"
                            name="motivasi"
                            placeholder="Ceritakan motivasi dan harapan Anda mengikuti lomba yang dituju"
                        >{{ old('motivasi') }}</textarea>
                    </div>

                    <fieldset class="field-group">
                        <legend>7. Apakah sudah mempunyai tim?</legend>
                        <div class="options">
                            <label class="option-item">
                                <input
                                    type="radio"
                                    name="status_tim"
                                    value="Sudah"
                                    @checked(old('status_tim') === 'Sudah')
                                    required
                                >
                                <span>Sudah</span>
                            </label>
                            <label class="option-item">
                                <input
                                    type="radio"
                                    name="status_tim"
                                    value="Belum"
                                    @checked(old('status_tim') === 'Belum')
                                >
                                <span>Belum</span>
                            </label>
                            <label class="option-item">
                                <input
                                    type="radio"
                                    name="status_tim"
                                    value="Belum namun siap mencari anggota"
                                    @checked(old('status_tim') === 'Belum namun siap mencari anggota')
                                >
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
@endsection
