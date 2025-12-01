@php
    $displayName = $adminName ?? 'Admin';
    $displayInitial = $adminInitial ?? (strtoupper(substr($displayName, 0, 1) ?: 'A'));
    $currentTab = $activeTab ?? 'lomba';
@endphp

<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-mark">RIIB</div>
        <div class="brand-text">
            <span>Dashboard Admin</span>
            <strong>Pendaftaran</strong>
        </div>
    </div>

    <div class="sidebar-user">
        <div class="sidebar-avatar">{{ $displayInitial }}</div>
        <div class="sidebar-user-info">
            <span>Halo,</span>
            <strong>{{ $displayName }}</strong>
        </div>
    </div>

    <nav class="sidebar-nav" aria-label="Menu Dashboard">
        <span class="nav-section-title">Menu</span>
        @include('modules.admin.menus.lomba', [
            'activeTab' => $currentTab,
            'navigationMode' => 'links',
        ])
        @include('modules.admin.menus.sertifikasi', [
            'activeTab' => $currentTab,
            'navigationMode' => 'links',
        ])
        @include('modules.admin.menus.alur', [
            'activeTab' => $currentTab,
            'navigationMode' => 'links',
        ])
        @include('modules.admin.menus.dosen', ['activeTab' => $currentTab])
    </nav>
</aside>
