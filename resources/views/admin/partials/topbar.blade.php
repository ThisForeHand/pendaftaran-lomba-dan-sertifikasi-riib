@php
    $displayName = $adminName ?? 'Admin';
    $displayInitial = $adminInitial ?? (strtoupper(substr($displayName, 0, 1) ?: 'A'));
    $currentTab = $activeTab ?? 'lomba';
@endphp

<div class="dashboard-header-card">
    <header>
        <div class="title-group">
            <span>Dashboard Admin</span>
            <h1>Halo, {{ $displayName }}</h1>
        </div>
        <div class="admin-info">
            <div class="admin-avatar">{{ $displayInitial }}</div>
            <span class="admin-name">{{ $displayName }}</span>
        </div>
    </header>

    <div class="card-navigation">
        <nav
            class="dashboard-tabs"
            role="tablist"
            aria-label="Navigasi data pendaftaran"
        >
            @include('admin.menus.lomba', ['activeTab' => $currentTab])
            @include('admin.menus.sertifikasi', ['activeTab' => $currentTab])
            @include('admin.menus.dosen')
        </nav>
    </div>
</div>
