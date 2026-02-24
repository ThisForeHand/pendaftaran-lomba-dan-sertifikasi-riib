<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>@yield('title', 'Dashboard Admin - Pendaftaran')</title>

        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700"
            rel="stylesheet"
        />

        <link rel="icon" type="image/png" href="{{ asset('images/iebi logo_crop.png') }}" />
        <link rel="apple-touch-icon" href="{{ asset('images/iebi logo_crop.png') }}" />

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
                display: block;
            }

            .app-shell {
                min-height: 100vh;
                display: grid;
                grid-template-columns: minmax(250px, 300px) minmax(0, 1fr);
                gap: clamp(20px, 3vw, 32px);
                padding: clamp(24px, 4vw, 48px);
                align-items: stretch;
            }

            .page {
                width: min(1100px, 100%);
                margin: 0 auto;
                padding: 0;
                display: grid;
                gap: clamp(24px, 4vw, 32px);
            }

            .sidebar {
                background: #f3f5fb;
                border-radius: 28px;
                padding: clamp(18px, 3vw, 26px);
                box-shadow: 0 18px 48px rgba(33, 62, 157, 0.12);
                border: 1px solid #e2e8f5;
                display: flex;
                flex-direction: column;
                gap: 14px;
                position: sticky;
                top: clamp(24px, 4vw, 40px);
                height: auto;
                align-self: start;
            }

            .sidebar-logo {
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 12px 14px;
                background: transparent;
                border: none;
            }

            .sidebar-logo-image {
                width: 100%;
                max-width: 140px;
                display: block;
                object-fit: contain;
                filter: drop-shadow(0 12px 26px rgba(31, 77, 177, 0.25));
            }

            .sidebar-divider {
                width: 100%;
                height: 1px;
                background: linear-gradient(90deg, rgba(31, 77, 177, 0.12), rgba(31, 77, 177, 0));
                border: none;
            }

            .sidebar-nav {
                display: grid;
                gap: 18px;
            }

            .sidebar-nav-group {
                display: grid;
                gap: 8px;
            }

            .sidebar-section-title {
                font-size: 0.82rem;
                color: #8a93a8;
                font-weight: 700;
                letter-spacing: 0.05em;
                text-transform: uppercase;
            }

            .sidebar-nav-list {
                display: grid;
                gap: 6px;
            }

            .sidebar-nav .nav-link {
                width: 100%;
                display: inline-flex;
                align-items: center;
                gap: 12px;
                padding: 12px 14px;
                border-radius: 14px;
                text-decoration: none;
                color: #3c4559;
                background: transparent;
                border: 1px solid transparent;
                font-weight: 600;
                font-size: 0.98rem;
                position: relative;
                transition: background 0.2s ease, color 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
            }

            .sidebar-nav .nav-link::before {
                content: "";
                position: absolute;
                left: 10px;
                top: 12px;
                bottom: 12px;
                width: 3px;
                border-radius: 999px;
                background: transparent;
                transition: background 0.2s ease;
            }

            .sidebar-nav .nav-icon {
                width: 32px;
                height: 32px;
                display: inline-grid;
                place-items: center;
                border-radius: 10px;
                background: linear-gradient(150deg, rgba(31, 77, 177, 0.12), rgba(49, 94, 216, 0.08));
                color: #1f2e55;
                border: 1px solid rgba(31, 77, 177, 0.08);
            }

            .sidebar-nav .nav-icon svg {
                width: 18px;
                height: 18px;
            }

            .sidebar-nav .nav-label {
                flex: 1;
                font-weight: 600;
                font-size: 0.98rem;
            }

            .sidebar-nav .nav-link:hover {
                background: #f0f3fc;
                color: #1f4db1;
                border-color: #e4e9f7;
            }

            .sidebar-nav .nav-link:hover .nav-icon {
                background: linear-gradient(160deg, rgba(31, 77, 177, 0.16), rgba(49, 94, 216, 0.12));
                color: #1f4db1;
                border-color: rgba(31, 77, 177, 0.14);
            }

            .sidebar-nav .nav-link.active {
                background: #ffffff;
                color: #1f2e55;
                border-color: #dfe6f6;
                box-shadow: 0 14px 32px rgba(31, 77, 177, 0.12);
            }

            .sidebar-nav .nav-link.active::before {
                background: #1f4db1;
            }

            .sidebar-nav .nav-link.active .nav-icon {
                background: linear-gradient(160deg, rgba(31, 77, 177, 0.22), rgba(49, 94, 216, 0.16));
                color: #1f2e55;
                border-color: rgba(31, 77, 177, 0.2);
            }

            .sidebar-logout {
                margin-top: auto;
            }

            .sidebar-footer {
                margin-top: auto;
                padding-top: 4px;
            }

            .logout-link {
                width: 100%;
                padding: 12px 14px;
                border-radius: 14px;
                border: 1px solid #e3e9f7;
                background: #ffffff;
                color: #b12727;
                font-weight: 700;
                cursor: pointer;
                display: inline-flex;
                align-items: center;
                gap: 10px;
                justify-content: center;
                transition: background 0.2s ease, border-color 0.2s ease, color 0.2s ease;
            }

            .logout-link .logout-icon {
                width: 20px;
                height: 20px;
                display: inline-grid;
                place-items: center;
            }

            .logout-link svg {
                width: 18px;
                height: 18px;
            }

            .logout-link:hover {
                background: #fff0f0;
                border-color: #f2c5c5;
                color: #9d1d1d;
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

            .table-container {
                border-radius: 20px;
                overflow-x: auto;
                overflow-y: hidden;
                border: 1px solid rgba(47, 76, 178, 0.15);
            }

            table {
                width: max-content;
                min-width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                white-space: nowrap;
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

            .data-panel .select-column,
            .data-panel .select-cell {
                display: none;
                width: 48px;
                text-align: center;
            }

            .data-panel .select-cell input[type='checkbox'] {
                width: 18px;
                height: 18px;
                cursor: pointer;
            }

            .data-panel .clear-all-button {
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

            .data-panel .clear-all-button:hover {
                background: rgba(196, 31, 58, 0.18);
                transform: translateY(-1px);
            }

            .data-panel.selection-mode .select-column,
            .data-panel.selection-mode .select-cell,
            .data-panel.selection-mode .clear-all-button {
                display: table-cell;
            }

            .data-panel.selection-mode .clear-all-button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
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
                transition: background-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
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

            .logout-button:focus-visible {
                outline: 3px solid rgba(29, 78, 216, 0.25);
                outline-offset: 3px;
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

            input[type='text'],
            input[type='email'],
            input[type='password'],
            input[type='number'],
            input[type='url'],
            select,
            textarea {
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

            textarea {
                min-height: 120px;
                resize: vertical;
            }

            select {
                appearance: none;
                -webkit-appearance: none;
                padding-right: 44px;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' fill='none' stroke='%2324345a' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5'/%3E%3C/svg%3E");
                background-repeat: no-repeat;
                background-position: right 16px center;
                background-size: 12px 8px;
                cursor: pointer;
            }

            input[type='text']:focus,
            input[type='email']:focus,
            input[type='password']:focus,
            input[type='number']:focus,
            input[type='url']:focus,
            select:focus,
            textarea:focus {
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

            button[type='submit'] {
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

            button[type='submit']:hover {
                transform: translateY(-1px);
                box-shadow: 0 20px 46px rgba(33, 62, 157, 0.24);
                filter: brightness(1.02);
            }

            button[type='submit']:active {
                transform: translateY(0);
            }

            .flow-management-grid {
                display: grid;
                gap: clamp(18px, 3vw, 28px);
                grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
                align-items: start;
            }

            .flow-column {
                display: grid;
                gap: 16px;
            }

            .flow-column h3 {
                margin: 0;
                font-size: 1.05rem;
            }

            .flow-entry {
                border: 1px solid rgba(76, 98, 144, 0.18);
                border-radius: 20px;
                padding: clamp(16px, 3vw, 22px);
                background: rgba(247, 248, 251, 0.8);
                display: grid;
                gap: 16px;
            }

            .flow-item-actions {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
                justify-content: flex-end;
            }

            .flow-item-actions button[type='submit'] {
                flex: 0 0 auto;
                min-width: 140px;
                padding-inline: 18px;
                padding-block: 12px;
            }

            .button-danger {
                background: linear-gradient(135deg, #dc2626, #b91c1c);
                box-shadow: 0 18px 40px rgba(220, 38, 38, 0.25);
            }

            .button-danger:hover {
                box-shadow: 0 20px 46px rgba(220, 38, 38, 0.3);
            }

            .empty-flow-state {
                margin: 0;
                padding: 18px;
                border-radius: 16px;
                background: rgba(248, 250, 252, 0.9);
                border: 1px dashed rgba(76, 98, 144, 0.4);
                color: #4b5a86;
                font-size: 0.95rem;
            }

            @media (max-width: 1024px) {
                .app-shell {
                    grid-template-columns: 1fr;
                }

                .sidebar {
                    position: static;
                    width: 100%;
                }

                .page {
                    width: 100%;
                }
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

                .footer-actions-right {
                    display: flex;
                    flex-direction: column;
                    gap: 12px;
                }

                .action-button {
                    width: 100%;
                    justify-content: center;
                    text-align: center;
                }
            }
        </style>
    </head>
    <body>
        @php
            $adminName = $adminName ?? 'Admin';
            $adminInitial = $adminInitial ?? (strtoupper(substr($adminName, 0, 1) ?: 'A'));
            $activeTab = $activeTab ?? 'lomba';
        @endphp

        <div class="app-shell">
            @include('modules.admin.partials.sidebar', [
                'adminName' => $adminName,
                'adminInitial' => $adminInitial,
                'activeTab' => $activeTab,
            ])

            <div class="page">
                @include('modules.admin.partials.topbar', [
                    'adminName' => $adminName,
                    'adminInitial' => $adminInitial,
                    'activeTab' => $activeTab,
                ])

                @yield('content')
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('.data-panel').forEach((panel) => {
                    const deleteButton = panel.querySelector('.action-button.delete');
                    const clearAllButton = panel.querySelector('.clear-all-button');
                    const form = panel.querySelector('.data-form');
                    const tableBody = panel.querySelector('tbody');
                    const tableElement = panel.querySelector('table');
                    const clearAllInput = form?.querySelector('.clear-all-input');

                    if (!tableBody || !tableElement || !form) {
                        return;
                    }

                    const getRowCheckboxes = () => Array.from(panel.querySelectorAll('.row-checkbox'));

                    const exitSelectionMode = () => {
                        panel.classList.remove('selection-mode');
                        getRowCheckboxes().forEach((checkbox) => {
                            checkbox.checked = false;
                        });
                    };

                    const ensureEmptyState = () => {
                        const emptyText = tableElement.dataset.emptyText || 'Belum ada data.';
                        const existingEmptyRow = tableBody.querySelector('.empty-state');
                        const hasDataRows = tableBody.querySelector('.row-checkbox');

                        if (!hasDataRows && !existingEmptyRow) {
                            const emptyRow = document.createElement('tr');
                            emptyRow.classList.add('empty-state');

                            const emptyCell = document.createElement('td');
                            emptyCell.colSpan = tableElement.tHead ? tableElement.tHead.rows[0].cells.length : 1;
                            emptyCell.textContent = emptyText;

                            emptyRow.appendChild(emptyCell);
                            tableBody.appendChild(emptyRow);
                        } else if (hasDataRows && existingEmptyRow) {
                            existingEmptyRow.remove();
                        }
                    };

                    const updateRowNumbers = () => {
                        const rows = getRowCheckboxes()
                            .map((checkbox) => checkbox.closest('tr'))
                            .filter((row) => row && row.isConnected);

                        rows.forEach((row, index) => {
                            const numberCell = row.querySelector('td');
                            if (numberCell) {
                                numberCell.textContent = index + 1;
                            }
                        });
                    };

                    if (deleteButton) {
                        deleteButton.addEventListener('click', function (event) {
                            event.preventDefault();

                            const isSelectionMode = panel.classList.contains('selection-mode');
                            const checkboxes = getRowCheckboxes();

                            if (!isSelectionMode) {
                                if (checkboxes.length === 0) {
                                    return;
                                }

                                panel.classList.add('selection-mode');
                                return;
                            }

                            const selectedCheckboxes = checkboxes.filter((checkbox) => checkbox.checked);

                            if (selectedCheckboxes.length === 0) {
                                exitSelectionMode();
                                return;
                            }

                            const confirmed = window.confirm('Apakah Anda yakin ingin menghapus data yang dipilih?');

                            if (!confirmed) {
                                return;
                            }

                            if (clearAllInput) {
                                clearAllInput.value = '0';
                            }

                            form.submit();
                        });
                    }

                    if (clearAllButton) {
                        clearAllButton.addEventListener('click', function () {
                            const checkboxes = getRowCheckboxes();

                            if (checkboxes.length === 0) {
                                return;
                            }

                            const confirmed = window.confirm('Apakah Anda yakin ingin menghapus semua data?');

                            if (!confirmed) {
                                return;
                            }

                            if (clearAllInput) {
                                clearAllInput.value = '1';
                            }

                            form.submit();
                        });
                    }

                    ensureEmptyState();
                });
            });
        </script>
    </body>
</html>
