@php
    $displayName = $adminName ?? 'Admin';
    $displayInitial = $adminInitial ?? (strtoupper(substr($displayName, 0, 1) ?: 'A'));
    $currentTab = $activeTab ?? 'lomba';
@endphp

<aside class="sidebar" aria-label="Navigasi Admin">
    <div class="sidebar-brand">
        <div class="brand-mark">RIIB</div>
        <div class="brand-text">
            <span>Dashboard Admin</span>
            <strong>Halo Selamat Datang</strong>
            <p class="brand-highlight">{{ $displayName }}</p>
        </div>
    </div>

    <div class="sidebar-user">
        <div class="sidebar-avatar">{{ $displayInitial }}</div>
        <div class="sidebar-user-info">
            <span>Administrator</span>
            <strong>{{ $displayName }}</strong>
        </div>
    </div>

    <div class="sidebar-divider" role="presentation"></div>

    <nav class="sidebar-nav" aria-label="Menu Dashboard">
        <div class="nav-section">
            <p class="nav-section-title">Menu</p>
            <div class="nav-list">
                @include('modules.admin.menus.lomba', [
                    'activeTab' => $currentTab,
                    'navigationMode' => 'links',
                ])
            </div>
        </div>

        <div class="nav-section">
            <p class="nav-section-title">Pengelolaan</p>
            <div class="nav-list">
                @include('modules.admin.menus.sertifikasi', [
                    'activeTab' => $currentTab,
                    'navigationMode' => 'links',
                ])
                @include('modules.admin.menus.alur', [
                    'activeTab' => $currentTab,
                    'navigationMode' => 'links',
                ])
            </div>
        </div>

        <div class="nav-section">
            <p class="nav-section-title">Users Management</p>
            <div class="nav-list">
                @include('modules.admin.menus.dosen', ['activeTab' => $currentTab])
            </div>
        </div>
    </nav>

    <form class="sidebar-logout" method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Keluar</button>
    </form>
</aside>
