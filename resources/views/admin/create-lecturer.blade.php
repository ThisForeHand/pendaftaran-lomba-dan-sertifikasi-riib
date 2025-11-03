<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Buat Akun Dosen - Dashboard Admin</title>

        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700"
            rel="stylesheet"
        />

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

            .dashboard-header-card {
                background: #ffffff;
                border-radius: 28px;
                padding: clamp(24px, 4vw, 36px);
                box-shadow: 0 20px 60px rgba(33, 62, 157, 0.12);
                border: 1px solid rgba(51, 86, 189, 0.14);
                display: grid;
                gap: clamp(16px, 3vw, 28px);
            }

            .dashboard-header-card header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: clamp(16px, 3vw, 24px);
                flex-wrap: wrap;
            }

            .dashboard-header-card .title-group {
                display: grid;
                gap: 6px;
            }

            .dashboard-header-card .title-group span {
                font-size: 1rem;
                color: #4b5a86;
            }

            .dashboard-header-card .title-group h1 {
                margin: 0;
                font-size: clamp(1.6rem, 3vw, 2rem);
                font-weight: 600;
                color: #16203b;
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
                cursor: pointer;
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
                padding: clamp(24px, 4vw, 40px);
                box-shadow: 0 20px 60px rgba(33, 62, 157, 0.12);
                border: 1px solid rgba(51, 86, 189, 0.14);
                display: grid;
                gap: clamp(20px, 3vw, 28px);
            }

            .card-header {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: space-between;
                gap: clamp(16px, 3vw, 24px);
            }

            .card-title {
                display: grid;
                gap: 6px;
            }

            .card-title span {
                font-size: 0.95rem;
                color: #4b5a86;
            }

            .card-title h1 {
                margin: 0;
                font-size: clamp(1.6rem, 3vw, 2rem);
                font-weight: 600;
                color: #16203b;
            }

            .card-actions {
                display: inline-flex;
                gap: 12px;
                flex-wrap: wrap;
            }

            .card-action-button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                padding: 12px 20px;
                border-radius: 14px;
                font-weight: 600;
                font-size: 0.95rem;
                text-decoration: none;
                border: 1.5px solid transparent;
                transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease,
                    color 0.2s ease, border 0.2s ease;
            }

            .card-action-button.secondary {
                background: #ffffff;
                color: #1f4db1;
                border-color: rgba(31, 77, 177, 0.4);
                box-shadow: 0 14px 30px rgba(33, 62, 157, 0.08);
            }

            .card-action-button.secondary:hover {
                background: #eef3ff;
                transform: translateY(-1px);
                box-shadow: 0 16px 34px rgba(33, 62, 157, 0.16);
            }

            form {
                display: grid;
                gap: 20px;
            }

            fieldset {
                border: 0;
                margin: 0;
                padding: 0;
                min-inline-size: 0;
                display: grid;
                gap: 18px;
            }

            .form-row {
                display: grid;
                gap: 18px;
            }

            @media (min-width: 720px) {
                .form-row.two-columns {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }

            label {
                font-weight: 600;
                font-size: 0.95rem;
                color: #24345a;
            }

            input[type="text"],
            input[type="email"],
            input[type="password"] {
                width: 100%;
                border-radius: 14px;
                border: 1px solid rgba(76, 98, 144, 0.22);
                padding: 14px 16px;
                font-size: 1rem;
                font-family: inherit;
                color: #1f2a44;
                background: #f7f8fb;
                transition: border 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
            }

            input[type="text"]:focus,
            input[type="email"]:focus,
            input[type="password"]:focus {
                outline: none;
                border-color: rgba(30, 75, 169, 0.6);
                box-shadow: 0 0 0 4px rgba(30, 75, 169, 0.15);
                background: #ffffff;
            }

            .form-field {
                display: grid;
                gap: 10px;
            }

            .form-help {
                margin: 0;
                font-size: 0.9rem;
                color: #4b5a86;
            }

            .status-message,
            .error-message {
                padding: 14px 18px;
                border-radius: 16px;
                font-size: 0.95rem;
                font-weight: 500;
            }

            .status-message {
                background: rgba(34, 197, 94, 0.12);
                color: #15803d;
                border: 1px solid rgba(21, 128, 61, 0.2);
            }

            .error-message {
                background: rgba(220, 38, 38, 0.12);
                color: #b91c1c;
                border: 1px solid rgba(185, 28, 28, 0.2);
            }

            ul.error-list {
                margin: 0;
                padding-left: 20px;
                display: grid;
                gap: 6px;
            }

            button[type="submit"] {
                border: 0;
                border-radius: 16px;
                background: linear-gradient(135deg, #1f4db1, #355ed8);
                color: #ffffff;
                font-weight: 600;
                padding: 16px 22px;
                font-size: 1rem;
                cursor: pointer;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                box-shadow: 0 18px 40px rgba(33, 62, 157, 0.18);
                transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
            }

            button[type="submit"]:hover {
                transform: translateY(-1px);
                box-shadow: 0 20px 46px rgba(33, 62, 157, 0.24);
                filter: brightness(1.02);
            }

            button[type="submit"]:active {
                transform: translateY(0);
            }
        </style>
    </head>
    <body>
        @php
            $displayAdminName = $adminName ?? 'Admin';
            $displayAdminInitial = $adminInitial ?? (strtoupper(substr($displayAdminName, 0, 1) ?: 'A'));
        @endphp

        <div class="page">
            @include('admin.partials.topbar', [
                'adminName' => $displayAdminName,
                'adminInitial' => $displayAdminInitial,
                'activeTab' => 'dosen',
            ])

            <section class="card">
                <header class="card-header">
                    <div class="card-title">
                        <span>Manajemen Akun</span>
                        <h1>Buat Akun Dosen</h1>
                    </div>
                    <div class="card-actions">
                        <a class="card-action-button secondary" href="{{ route('admin.lomba') }}">
                            &larr; Kembali ke Dashboard
                        </a>
                    </div>
                </header>

                @if (session('status'))
                    <div class="status-message" role="status">{{ session('status') }}</div>
                @endif

                @if ($errors->any())
                    <div class="error-message" role="alert">
                        <strong>Terjadi kesalahan pada data yang Anda masukkan:</strong>
                        <ul class="error-list">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" action="{{ route('admin.dosen.store') }}">
                    @csrf

                    <fieldset>
                        <div class="form-row two-columns">
                            <div class="form-field">
                                <label for="name">Nama Lengkap</label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    required
                                    autocomplete="name"
                                />
                            </div>
                            <div class="form-field">
                                <label for="username">Username</label>
                                <input
                                    type="text"
                                    id="username"
                                    name="username"
                                    value="{{ old('username') }}"
                                    required
                                    autocomplete="username"
                                />
                            </div>
                        </div>

                        <div class="form-row two-columns">
                            <div class="form-field">
                                <label for="email">Email</label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email"
                                />
                            </div>
                            <div class="form-field">
                                <label for="phone">No. Telepon</label>
                                <input
                                    type="text"
                                    id="phone"
                                    name="phone"
                                    value="{{ old('phone') }}"
                                    placeholder="Opsional"
                                    autocomplete="tel"
                                />
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="program_studi">Program Studi</label>
                            <input
                                type="text"
                                id="program_studi"
                                name="program_studi"
                                value="{{ old('program_studi') }}"
                                placeholder="Opsional"
                                autocomplete="organization-title"
                            />
                        </div>

                        <div class="form-row two-columns">
                            <div class="form-field">
                                <label for="password">Kata Sandi</label>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                />
                                <p class="form-help">Minimal 8 karakter dan gunakan kombinasi huruf &amp; angka.</p>
                            </div>
                            <div class="form-field">
                                <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                />
                            </div>
                        </div>
                    </fieldset>

                    <button type="submit">Simpan &amp; Buat Akun</button>
                </form>
            </section>
        </div>
    </body>
</html>
