<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Dashboard Admin - Pendaftaran Lomba</title>

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

            .card-navigation {
                display: flex;
                justify-content: flex-start;
            }

            .dashboard-tabs {
                display: inline-flex;
                gap: clamp(12px, 2vw, 18px);
                padding: clamp(10px, 2vw, 14px);
                background: rgba(244, 248, 255, 0.92);
                border-radius: 24px;
                border: 1px solid rgba(51, 86, 189, 0.18);
                box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.75), 0 22px 48px rgba(33, 62, 157, 0.12);
                backdrop-filter: blur(18px);
                align-items: center;
            }

            .dashboard-tabs .nav-link {
                display: inline-flex;
                align-items: center;
                gap: clamp(12px, 2.2vw, 18px);
                padding: clamp(10px, 1.8vw, 14px) clamp(18px, 3vw, 26px);
                border-radius: 999px;
                text-decoration: none;
                border: 1px solid rgba(30, 75, 169, 0.24);
                background: rgba(255, 255, 255, 0.92);
                color: #1d2f63;
                font-size: 1rem;
                font-weight: 600;
                min-width: clamp(220px, 28vw, 260px);
                box-shadow: 0 14px 26px rgba(31, 77, 177, 0.16);
                transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease, color 0.2s ease;
            }

            .dashboard-tabs .nav-link:hover {
                transform: translateY(-1px);
                box-shadow: 0 18px 32px rgba(31, 77, 177, 0.22);
            }

            .dashboard-tabs .nav-link.active {
                background: linear-gradient(135deg, #1e4ba9 0%, #123184 100%);
                border-color: transparent;
                color: #ffffff;
                box-shadow: 0 22px 40px rgba(30, 75, 169, 0.32);
            }

            .dashboard-tabs .nav-link:not(.active):hover {
                background: rgba(255, 255, 255, 0.98);
            }

            .nav-icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 46px;
                height: 46px;
                border-radius: 14px;
                background: linear-gradient(135deg, rgba(30, 75, 169, 0.12) 0%, rgba(30, 75, 169, 0.04) 100%);
                border: 1px solid rgba(30, 75, 169, 0.28);
                box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.7);
            }

            .nav-icon svg {
                width: 22px;
                height: 22px;
                color: currentColor;
            }

            .dashboard-tabs .nav-link.active .nav-icon {
                background: rgba(255, 255, 255, 0.22);
                border-color: rgba(255, 255, 255, 0.42);
                box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4);
            }

            .nav-label {
                display: inline-flex;
                flex-direction: column;
                gap: 4px;
                line-height: 1.15;
            }

            .nav-label span {
                display: inline-block;
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

            .card-actions {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
            }

            .button {
                border: none;
                border-radius: 14px;
                padding: 12px 20px;
                font-size: 0.96rem;
                font-weight: 600;
                cursor: pointer;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .button:hover {
                transform: translateY(-1px);
            }

            .button.primary {
                background: #1f4db1;
                color: #ffffff;
                box-shadow: 0 14px 26px rgba(31, 77, 177, 0.25);
            }

            .button.danger {
                background: rgba(220, 53, 69, 0.12);
                color: #b11f33;
                border: 1px solid rgba(220, 53, 69, 0.32);
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

            .badge {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                background: rgba(46, 171, 115, 0.12);
                color: #208f59;
                border-radius: 999px;
                padding: 6px 12px;
                font-size: 0.85rem;
                font-weight: 600;
            }

            .select-column,
            .select-cell {
                display: none;
                width: 48px;
                text-align: center;
            }

            .select-cell input[type='checkbox'] {
                width: 18px;
                height: 18px;
                cursor: pointer;
            }

            .clear-all-button {
                display: none;
                margin-left: 12px;
                padding: 6px 14px;
                border-radius: 999px;
                border: none;
                background: rgba(196, 31, 58, 0.12);
                color: #c41f3a;
                font-weight: 600;
                font-size: 0.8rem;
                cursor: pointer;
                transition: background 0.2s ease, transform 0.2s ease;
            }

            .clear-all-button:hover {
                background: rgba(196, 31, 58, 0.18);
                transform: translateY(-1px);
            }

            body.selection-mode .select-column,
            body.selection-mode .select-cell,
            body.selection-mode .clear-all-button {
                display: table-cell;
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
            }

            .footer-actions-right {
                display: flex;
                gap: 12px;
            }

            .logout {
                display: inline-flex;
                align-items: center;
                gap: 12px;
                padding: 12px 22px;
                border-radius: 16px;
                text-decoration: none;
                color: #153a8a;
                font-weight: 600;
                background: linear-gradient(135deg, rgba(224, 233, 255, 0.85) 0%, rgba(239, 245, 255, 0.85) 100%);
                border: 1px solid rgba(28, 74, 177, 0.2);
                box-shadow: 0 14px 30px rgba(33, 62, 157, 0.14);
                transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
            }

            .logout:hover {
                transform: translateY(-1px);
                box-shadow: 0 16px 36px rgba(33, 62, 157, 0.2);
                background: linear-gradient(135deg, rgba(210, 226, 255, 0.95) 0%, rgba(226, 237, 255, 0.95) 100%);
            }

            .logout-icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 36px;
                height: 36px;
                border-radius: 12px;
                background: #ffffff;
                border: 1px solid rgba(28, 74, 177, 0.14);
                box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.6);
                color: #153a8a;
            }

            .logout-icon svg {
                width: 20px;
                height: 20px;
            }

            .action-button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 112px;
                padding: 12px 28px;
                border-radius: 14px;
                font-weight: 600;
                font-size: 0.96rem;
                text-decoration: none;
                color: #ffffff;
                box-shadow: 0 14px 30px rgba(33, 62, 157, 0.08);
                transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
            }

            .action-button.download {
                background: #08275e;
            }

            .action-button.delete {
                background: #c41f3a;
            }

            .action-button:hover {
                transform: translateY(-1px);
                box-shadow: 0 16px 34px rgba(33, 62, 157, 0.16);
                filter: brightness(1.02);
            }

            @media (max-width: 768px) {
                .card-navigation {
                    justify-content: center;
                }

                .dashboard-tabs {
                    flex-direction: column;
                    width: 100%;
                }

                .dashboard-tabs .nav-link {
                    width: 100%;
                    justify-content: flex-start;
                }

                .nav-icon {
                    flex-shrink: 0;
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

                .footer-actions-right {
                    flex-direction: column;
                }

                .logout,
                .action-button {
                    width: 100%;
                    justify-content: center;
                    text-align: center;
                }
            }
        </style>
    </head>
    <body>
        <div class="page">
            <div class="dashboard-header-card">
                <header>
                    <div class="title-group">
                        <span>Dashboard Admin</span>
                        <h1>Halo Selamat Datang Admin</h1>
                    </div>
                    <div class="admin-info">
                        <div class="admin-avatar"></div>
                        <span class="admin-name">Admin</span>
                    </div>
                </header>
            </div>

            <section class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h2>Pendaftaran Lomba</h2>
                        <span>Daftar peserta dan rincian kelompok</span>
                    </div>
                </div>

                <div class="card-navigation">
                    <nav class="dashboard-tabs" aria-label="Navigasi halaman pendaftaran">
                        <a href="{{ route('admin.lomba') }}" class="nav-link active">
                            <span class="nav-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M8 21h8" />
                                    <path d="M9 17c.5 1.5 1.5 4 3 4s2.5-2.5 3-4" />
                                    <path d="M5 4h14" />
                                    <path d="M6 4v5.5a2.5 2.5 0 0 1-5 0V4z" />
                                    <path d="M18 4v5.5a2.5 2.5 0 0 0 5 0V4z" />
                                </svg>
                            </span>
                            <span class="nav-label">
                                <span>Pendaftaran</span>
                                <span>Lomba</span>
                            </span>
                        </a>
                        <a href="{{ route('admin.sertifikasi') }}" class="nav-link">
                            <span class="nav-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="8" r="5" />
                                    <path d="M8.5 14h7" />
                                    <path d="M6 21l1.5-3 1.5 3 1.5-3 1.5 3 1.5-3 1.5 3" />
                                </svg>
                            </span>
                            <span class="nav-label">
                                <span>Pendaftaran</span>
                                <span>Sertifikasi</span>
                            </span>
                        </a>
                    </nav>
                </div>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Prodi</th>
                                <th>No Wa</th>
                                <th>Peran</th>
                                <th>Keterangan Kelompok</th>
                                <th class="select-column" aria-label="Pilih">
                                    <button type="button" class="clear-all-button">Clear All</button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Fefe Riki Fufi Fufu</td>
                                <td>1238073047</td>
                                <td>SI</td>
                                <td>08543892455</td>
                                <td>Hacker</td>
                                <td><span class="badge">Ada</span></td>
                                <td class="select-cell"><input type="checkbox" class="row-checkbox" /></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Pipot Selbor</td>
                                <td>1238073048</td>
                                <td>RPL</td>
                                <td>5332445525</td>
                                <td>Hipster</td>
                                <td><span class="badge">Ada</span></td>
                                <td class="select-cell"><input type="checkbox" class="row-checkbox" /></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Pipot Selbor</td>
                                <td>1238073049</td>
                                <td>RPL</td>
                                <td>5332445525</td>
                                <td>Hipster</td>
                                <td><span class="badge">Ada</span></td>
                                <td class="select-cell"><input type="checkbox" class="row-checkbox" /></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Mie Ayam Gedongan</td>
                                <td>1238073050</td>
                                <td>TT</td>
                                <td>5332445525</td>
                                <td>Hustler</td>
                                <td><span class="badge">Ada</span></td>
                                <td class="select-cell"><input type="checkbox" class="row-checkbox" /></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Mie Ayam Gedongan</td>
                                <td>1238073051</td>
                                <td>TT</td>
                                <td>5332445525</td>
                                <td>Hustler</td>
                                <td><span class="badge">Ada</span></td>
                                <td class="select-cell"><input type="checkbox" class="row-checkbox" /></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Hason Susanto</td>
                                <td>1238073052</td>
                                <td>SI</td>
                                <td>0832445525</td>
                                <td>Hacker</td>
                                <td><span class="badge">Ada</span></td>
                                <td class="select-cell"><input type="checkbox" class="row-checkbox" /></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Hason Susanto</td>
                                <td>1238073053</td>
                                <td>SI</td>
                                <td>0832445525</td>
                                <td>Hacker</td>
                                <td><span class="badge">Ada</span></td>
                                <td class="select-cell"><input type="checkbox" class="row-checkbox" /></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Hason Susanto</td>
                                <td>1238073054</td>
                                <td>SI</td>
                                <td>0832445525</td>
                                <td>Hacker</td>
                                <td><span class="badge">Ada</span></td>
                                <td class="select-cell"><input type="checkbox" class="row-checkbox" /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="footer-actions">
                    <div class="footer-actions-left">
                        <a href="{{ route('admin.login') }}" class="logout">
                            <span class="logout-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="3.75" y="4.75" width="12.5" height="14.5" rx="2.75" stroke="currentColor" stroke-width="1.5" />
                                    <path d="M12.5 12h7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M17.25 8.75L19.75 12l-2.5 3.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            Keluar
                        </a>
                    </div>
                    <div class="footer-actions-right">
                        <a href="#" class="action-button download">Unduh</a>
                        <a href="#" class="action-button delete">Hapus</a>
                    </div>
                </div>
            </section>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const deleteButton = document.querySelector('.action-button.delete');
                const clearAllButton = document.querySelector('.clear-all-button');
                const rowCheckboxes = document.querySelectorAll('.row-checkbox');

                if (deleteButton) {
                    deleteButton.addEventListener('click', function (event) {
                        event.preventDefault();
                        document.body.classList.toggle('selection-mode');

                        if (!document.body.classList.contains('selection-mode')) {
                            rowCheckboxes.forEach((checkbox) => {
                                checkbox.checked = false;
                            });
                        }
                    });
                }

                if (clearAllButton) {
                    clearAllButton.addEventListener('click', function () {
                        rowCheckboxes.forEach((checkbox) => {
                            checkbox.checked = false;
                        });
                    });
                }
            });
        </script>
    </body>
</html>
