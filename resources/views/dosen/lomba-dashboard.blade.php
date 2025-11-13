<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Dashboard Dosen - Data Lomba Mahasiswa</title>

        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700"
            rel="stylesheet"
        />

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
                background: #f4f5fb;
                font-family: "Instrument Sans", system-ui, -apple-system, BlinkMacSystemFont,
                    "Segoe UI", sans-serif;
                color: #16203b;
                display: grid;
            }

            .page {
                width: min(1200px, 100%);
                margin: 0 auto;
                padding: clamp(24px, 4vw, 48px) clamp(16px, 4vw, 32px) 56px;
                display: grid;
                gap: clamp(24px, 4vw, 32px);
            }

            .footer-actions {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 16px;
                padding-top: 20px;
                margin-top: 8px;
                border-top: 1px solid rgba(47, 76, 178, 0.12);
            }

            .footer-actions-left {
                display: flex;
                align-items: center;
            }

            .footer-actions-right {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .logout-form {
                margin: 0;
            }

            .logout-button {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                border: 1.5px solid #1d4ed8;
                border-radius: 14px;
                padding: 10px 18px;
                background: #ffffff;
                color: #1d4ed8;
                font-size: 0.94rem;
                font-weight: 600;
                cursor: pointer;
                box-shadow: 0 10px 30px rgba(29, 78, 216, 0.12);
                transition: background-color 0.2s ease, box-shadow 0.2s ease,
                    transform 0.2s ease;
            }

            .logout-button::before {
                content: "";
                width: 16px;
                height: 16px;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24'%3E%3Cpath stroke='%231d4ed8' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.8' d='M9 5H5.4C4.075 5 3 6.12 3 7.5v9c0 1.38 1.075 2.5 2.4 2.5H9m7-4 4-4m0 0-4-4m4 4H9'/%3E%3C/svg%3E");
                background-size: contain;
                background-repeat: no-repeat;
            }

            .logout-button:hover {
                background: #eef3ff;
                box-shadow: 0 12px 34px rgba(29, 78, 216, 0.16);
                transform: translateY(-1px);
            }

            .download-button {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                border-radius: 14px;
                padding: 10px 18px;
                background: #1f4db1;
                color: #ffffff;
                font-size: 0.94rem;
                font-weight: 600;
                text-decoration: none;
                box-shadow: 0 14px 28px rgba(31, 77, 177, 0.22);
                transition: background-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
            }

            .download-button::before {
                content: "";
                width: 16px;
                height: 16px;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24'%3E%3Cpath stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.8' d='M12 3v12m0 0 4-4m-4 4-4-4m4 4v3m6 0H6'/%3E%3C/svg%3E");
                background-size: contain;
                background-repeat: no-repeat;
            }

            .download-button:hover {
                background: #1a3f94;
                box-shadow: 0 16px 32px rgba(31, 77, 177, 0.28);
                transform: translateY(-1px);
            }

            .download-button:focus-visible {
                outline: 3px solid rgba(31, 77, 177, 0.35);
                outline-offset: 3px;
            }

            .logout-button:focus-visible {
                outline: 3px solid rgba(29, 78, 216, 0.25);
                outline-offset: 3px;
            }

            .status-message {
                padding: 14px 18px;
                border-radius: 18px;
                border: 1px solid rgba(37, 99, 235, 0.18);
                background: #f8fafc;
                color: #1e2a52;
                font-size: 0.95rem;
                line-height: 1.5;
            }

            .status-message.warning {
                border-color: rgba(249, 115, 22, 0.35);
                background: #fff7ed;
                color: #b45309;
            }

            .dashboard-header-card {
                background: #ffffff;
                border-radius: 28px;
                padding: clamp(24px, 4vw, 36px);
                box-shadow: 0 20px 60px rgba(33, 62, 157, 0.12);
                border: 1px solid rgba(51, 86, 189, 0.14);
                display: grid;
                gap: clamp(16px, 3vw, 28px);
            }

            header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: clamp(16px, 3vw, 24px);
                flex-wrap: wrap;
            }

            .title-group {
                display: grid;
                gap: 6px;
            }

            .title-group h1 {
                margin: 0;
                font-size: clamp(1.6rem, 3vw, 2rem);
                font-weight: 600;
                color: #16203b;
            }

            .title-group span {
                font-size: 1rem;
                color: #4b5a86;
            }

            .admin-info {
                display: flex;
                align-items: center;
                gap: 14px;
                padding: 12px 18px 12px 12px;
                background: #f6f7fe;
                border-radius: 999px;
                border: 1px solid rgba(51, 86, 189, 0.12);
                box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4);
            }

            .admin-avatar {
                width: clamp(48px, 6vw, 56px);
                height: clamp(48px, 6vw, 56px);
                border-radius: 50%;
                background: linear-gradient(160deg, rgba(30, 75, 169, 0.16) 0%, rgba(79, 116, 208, 0.08) 100%);
                border: 1px solid rgba(30, 75, 169, 0.18);
                display: grid;
                place-items: center;
                font-size: clamp(1.4rem, 3vw, 1.8rem);
                color: #1e2a52;
            }

            .admin-name {
                font-weight: 600;
                color: #1e2a52;
                font-size: 1rem;
            }

            .admin-subtitle {
                margin-top: 4px;
                color: #4b5a86;
                font-size: 0.9rem;
                font-weight: 500;
            }

            .card-navigation {
                display: flex;
                justify-content: flex-start;
            }

            .dashboard-tabs {
                display: inline-flex;
                gap: clamp(16px, 3vw, 32px);
                padding: 0;
                background: transparent;
                border: none;
                box-shadow: none;
            }

            .dashboard-tabs .nav-link {
                position: relative;
                display: inline-flex;
                align-items: center;
                padding: 0 0 6px;
                font-size: 1rem;
                font-weight: 600;
                color: #4b5a86;
                text-decoration: none;
                border: none;
                border-radius: 0;
                background: transparent;
                min-width: auto;
                box-shadow: none;
                transition: color 0.2s ease;
            }

            .dashboard-tabs .nav-link::after {
                content: "";
                position: absolute;
                left: 0;
                bottom: 0;
                width: 100%;
                height: 3px;
                border-radius: 999px;
                background: transparent;
                transition: background 0.2s ease;
            }

            .dashboard-tabs .nav-link:hover {
                color: #1f4db1;
            }

            .dashboard-tabs .nav-link:hover::after {
                background: rgba(31, 77, 177, 0.6);
            }

            .dashboard-tabs .nav-link.active {
                color: #1f4db1;
            }

            .dashboard-tabs .nav-link.active::after {
                background: #1f4db1;
            }

            .card {
                background: #ffffff;
                border-radius: 26px;
                padding: clamp(20px, 3vw, 32px);
                box-shadow: 0 20px 60px rgba(33, 62, 157, 0.12);
                border: 1px solid rgba(51, 86, 189, 0.14);
                display: grid;
                gap: clamp(18px, 3vw, 24px);
            }

            .dashboard-section {
                display: none;
            }

            .dashboard-section.is-active {
                display: grid;
            }

            .card-header {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 16px;
            }

            .card-title {
                display: grid;
                gap: 6px;
            }

            .card-title h2 {
                margin: 0;
                font-size: clamp(1.2rem, 2.4vw, 1.5rem);
                font-weight: 600;
            }

            .card-title span {
                color: #53628f;
                font-size: 0.95rem;
            }

            .table-container {
                border-radius: 20px;
                overflow: hidden;
                border: 1px solid rgba(47, 76, 178, 0.15);
            }

            table {
                width: 100%;
                border-collapse: collapse;
                min-width: 640px;
            }

            thead {
                background: linear-gradient(180deg, rgba(30, 75, 169, 0.08) 0%, rgba(30, 75, 169, 0.02) 100%);
            }

            th {
                text-align: left;
                padding: 16px 20px;
                font-size: 0.9rem;
                font-weight: 600;
                color: #374777;
                border-bottom: 1px solid rgba(46, 75, 171, 0.16);
            }

            tbody tr:nth-child(even) {
                background: rgba(30, 75, 169, 0.03);
            }

            td {
                padding: 16px 20px;
                font-size: 0.95rem;
                color: #1f2a44;
                border-bottom: 1px solid rgba(46, 75, 171, 0.12);
            }

            tbody tr:last-child td {
                border-bottom: none;
            }

            .empty-state {
                text-align: center;
                color: #4b5a86;
                font-style: italic;
            }

            .badge {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                border-radius: 999px;
                padding: 6px 12px;
                font-size: 0.85rem;
                font-weight: 600;
            }

            .contact-link {
                color: #1f4db1;
                font-weight: 600;
                text-decoration: none;
                overflow-wrap: anywhere;
            }

            .contact-link:hover,
            .contact-link:focus-visible {
                text-decoration: underline;
            }

            .account-form {
                display: grid;
                gap: 18px;
            }

            .form-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 16px 20px;
            }

            label {
                display: grid;
                gap: 8px;
                font-weight: 600;
                color: #1e2a52;
                font-size: 0.95rem;
            }

            input {
                padding: 12px 16px;
                border-radius: 14px;
                border: 1px solid rgba(51, 86, 189, 0.24);
                background: #f8f9ff;
                font-size: 0.95rem;
                transition: border-color 0.2s ease, box-shadow 0.2s ease;
            }

            input:focus {
                outline: none;
                border-color: #1f4db1;
                box-shadow: 0 0 0 3px rgba(31, 77, 177, 0.12);
            }

            .button {
                border: none;
                border-radius: 14px;
                padding: 14px 22px;
                font-size: 0.96rem;
                font-weight: 600;
                cursor: pointer;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .button.primary {
                background: #1f4db1;
                color: #ffffff;
                box-shadow: 0 14px 26px rgba(31, 77, 177, 0.25);
            }

            .button.primary:hover {
                transform: translateY(-1px);
                box-shadow: 0 16px 30px rgba(31, 77, 177, 0.32);
            }

            @media (max-width: 768px) {
                .card-navigation {
                    justify-content: center;
                }

                .dashboard-tabs {
                    flex-direction: column;
                    width: 100%;
                    align-items: center;
                }

                .dashboard-tabs .nav-link {
                    width: auto;
                    justify-content: center;
                    text-align: center;
                }

                table {
                    min-width: unset;
                }

                .table-container {
                    overflow-x: auto;
                }

                .footer-actions {
                    flex-direction: column;
                    align-items: stretch;
                }

                .footer-actions-left {
                    justify-content: center;
                }

                .form-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    </head>
    <body>
        @php
            $registrations = $registrations ?? collect();
            $tableExists = $tableExists ?? false;
            $account = [
                'name' => $lecturerAccount['name'] ?? 'Dosen Pembimbing',
                'email' => $lecturerAccount['email'] ?? 'dosen@example.com',
                'phone' => $lecturerAccount['phone'] ?? '081234567890',
                'program_studi' => $lecturerAccount['program_studi'] ?? null,
            ];
            $lecturerInitial = strtoupper(substr($account['name'] ?? 'D', 0, 1));
            $hasProgramStudi = ! empty($account['program_studi']);
        @endphp
        <div class="page">
            <div class="dashboard-header-card">
                <header>
                    <div class="title-group">
                        <span>Dashboard Dosen</span>
                        <h1>Halo, {{ $account['name'] }}</h1>
                    </div>
                    <div class="admin-info">
                        <div class="admin-avatar">{{ $lecturerInitial }}</div>
                        <div>
                            <div class="admin-name">{{ $account['name'] }}</div>
                            <small style="color: #4b5a86; font-weight: 500">Akun pribadi dosen</small>
                            <div class="admin-subtitle">
                                @if ($hasProgramStudi)
                                    Program Studi: {{ $account['program_studi'] }}
                                @else
                                    Program Studi belum ditetapkan
                                @endif
                            </div>
                        </div>
                    </div>
                </header>
                <div class="card-navigation">
                    <nav class="dashboard-tabs" aria-label="Navigasi dashboard dosen">
                        <a class="nav-link active" href="#data-lomba">Data Lomba</a>
                        <a class="nav-link" href="#pengaturan-akun">Pengaturan Akun</a>
                    </nav>
                </div>
            </div>

            <section id="data-lomba" class="card dashboard-section is-active" aria-labelledby="title-data-lomba">
                <div class="card-header">
                    <div class="card-title" id="title-data-lomba">
                        <span>Monitoring Peserta</span>
                        <h2>Data Pendaftaran Lomba Mahasiswa</h2>
                    </div>
                    <p style="margin: 0; max-width: 360px; color: #4b5a86; font-size: 0.95rem">
                        Data ini hanya dapat dilihat oleh dosen sebagai bahan monitoring dan tindak lanjut.
                        Silakan hubungi admin apabila menemukan data yang perlu diperbarui.
                    </p>
                </div>
                @if (! $hasProgramStudi)
                    <div class="status-message warning">
                        Akun dosen Anda belum memiliki program studi yang terdaftar. Silakan hubungi admin
                        untuk memperbarui informasi prodi sebelum mengakses data mahasiswa.
                    </div>
                @endif
                <div class="table-container">
                    <table data-empty-text="Belum ada data pendaftaran lomba.">
                        <thead>
                            <tr>
                                <th style="width: 64px">No</th>
                                <th>Nama Lengkap</th>
                                <th>NIM</th>
                                <th>Program Studi</th>
                                <th>Kontak WhatsApp</th>
                                <th>Peran yang Dipilih</th>
                                <th>Status Tim</th>
                                <th>Tanggal Daftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($registrations as $index => $registration)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $registration->nama }}</td>
                                    <td>{{ $registration->nim }}</td>
                                    <td>{{ $registration->program_studi }}</td>
                                    <td>
                                        <x-contact-link :value="$registration->whatsapp" />
                                    </td>
                                    <td>{{ $registration->pilihan_peran }}</td>
                                    <td>
                                        <span class="badge" style="background: rgba(46, 171, 115, 0.12); color: #208f59">
                                            {{ $registration->status_tim }}
                                        </span>
                                    </td>
                                    <td>{{ $registration->created_at?->translatedFormat('d F Y') ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr class="empty-state">
                                    <td colspan="8">
                                        @if (! $tableExists)
                                            Tabel pendaftaran lomba belum tersedia. Silakan hubungi admin untuk menjalankan
                                            migrasi database terlebih dahulu.
                                        @elseif (! $hasProgramStudi)
                                            Akun dosen Anda belum memiliki program studi yang terdaftar. Silakan hubungi admin
                                            untuk memperbarui informasi prodi.
                                        @else
                                            Belum ada data pendaftaran lomba.
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="footer-actions">
                    <div class="footer-actions-left">
                        <form method="POST" action="{{ route('logout') }}" class="logout-form">
                            @csrf
                            <button type="submit" class="logout-button">Keluar</button>
                        </form>
                    </div>
                    <div class="footer-actions-right">
                        <a href="{{ route('dosen.lomba.download') }}" class="download-button">Unduh</a>
                    </div>
                </div>
            </section>

            <section id="pengaturan-akun" class="card dashboard-section" aria-labelledby="title-pengaturan-akun">
                <div class="card-header">
                    <div class="card-title" id="title-pengaturan-akun">
                        <span>Pengaturan Akun</span>
                        <h2>Perbarui Informasi Akun Dosen</h2>
                    </div>
                    <p style="margin: 0; max-width: 360px; color: #4b5a86; font-size: 0.95rem">
                        Pastikan data akun selalu terbaru agar komunikasi dengan mahasiswa dan admin berjalan lancar.
                    </p>
                </div>
                <form class="account-form" method="post" action="#">
                    <div class="form-grid">
                        <label>
                            Nama Lengkap
                            <input type="text" name="name" value="{{ $account['name'] }}" placeholder="Masukkan nama" />
                        </label>
                        <label>
                            Email Aktif
                            <input type="email" name="email" value="{{ $account['email'] }}" placeholder="nama@kampus.ac.id" />
                        </label>
                        <label>
                            Nomor WhatsApp
                            <input
                                type="tel"
                                name="phone"
                                value="{{ $account['phone'] }}"
                                inputmode="tel"
                                pattern="^(?:\+?62|0)[0-9\s\-()]{8,20}$"
                                placeholder="Contoh: 0812xxxx atau +62812xxxx"
                                title="Masukkan nomor WhatsApp yang diawali 0 atau +62"
                            />
                        </label>
                        <label>
                            Kata Sandi Baru
                            <input type="password" name="password" placeholder="Minimal 8 karakter" autocomplete="new-password" />
                        </label>
                        <label>
                            Konfirmasi Kata Sandi
                            <input type="password" name="password_confirmation" placeholder="Ulangi kata sandi" autocomplete="new-password" />
                        </label>
                    </div>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap">
                        <button type="submit" class="button primary">Simpan Perubahan</button>
                        <button
                            type="reset"
                            class="button"
                            style="background: rgba(31, 77, 177, 0.08); color: #1f4db1; border: 1px solid rgba(31, 77, 177, 0.18)"
                        >
                            Reset Form
                        </button>
                    </div>
                </form>
            </section>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const navLinks = Array.from(document.querySelectorAll('.dashboard-tabs .nav-link'));
                const sections = Array.from(document.querySelectorAll('.dashboard-section'));

                const setActiveSection = (targetId) => {
                    if (!targetId) {
                        sections.forEach((section, index) => {
                            section.classList.toggle('is-active', index === 0);
                        });
                        return;
                    }

                    sections.forEach((section) => {
                        const sectionId = `#${section.id}`;
                        if (sectionId === targetId) {
                            section.classList.add('is-active');
                        } else {
                            section.classList.remove('is-active');
                        }
                    });
                };

                navLinks.forEach((link) => {
                    link.addEventListener('click', (event) => {
                        const targetId = link.getAttribute('href');

                        if (targetId?.startsWith('#')) {
                            event.preventDefault();

                            navLinks.forEach((item) => item.classList.remove('active'));
                            link.classList.add('active');

                            setActiveSection(targetId);
                        }
                    });
                });

                setActiveSection(document.querySelector('.dashboard-tabs .nav-link.active')?.getAttribute('href'));
            });
        </script>
    </body>
</html>
