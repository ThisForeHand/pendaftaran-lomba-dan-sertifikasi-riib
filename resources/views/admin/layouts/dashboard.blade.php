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
            select {
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
            select:focus {
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

        <div class="page">
            @include('admin.partials.topbar', [
                'adminName' => $adminName,
                'adminInitial' => $adminInitial,
                'activeTab' => $activeTab,
                'navigationMode' => $navigationMode ?? 'links',
            ])

            @yield('content')
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('.data-panel').forEach((panel) => {
                    const deleteButton = panel.querySelector('.action-button.delete');
                    const clearAllButton = panel.querySelector('.clear-all-button');
                    const tableBody = panel.querySelector('tbody');
                    const tableElement = panel.querySelector('table');

                    if (!tableBody || !tableElement) {
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

                            selectedCheckboxes.forEach((checkbox) => {
                                const row = checkbox.closest('tr');
                                if (row) {
                                    row.remove();
                                }
                            });

                            exitSelectionMode();
                            ensureEmptyState();
                            updateRowNumbers();
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

                            checkboxes.forEach((checkbox) => {
                                const row = checkbox.closest('tr');
                                if (row) {
                                    row.remove();
                                }
                            });

                            exitSelectionMode();
                            ensureEmptyState();
                        });
                    }

                    ensureEmptyState();
                });
            });
        </script>
    </body>
</html>
