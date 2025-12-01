@php
    $displayName = $adminName ?? 'Admin';
    $displayInitial = $adminInitial ?? (strtoupper(substr($displayName, 0, 1) ?: 'A'));
    $currentTab = $activeTab ?? 'lomba';
@endphp

<aside class="sidebar" aria-label="Navigasi Admin">
    <div class="sidebar-logo" aria-label="Beranda Admin">
        <div class="sidebar-logo-mark">RIIB</div>
    </div>

    <nav class="sidebar-nav" aria-label="Menu Dashboard">
        <div class="sidebar-nav-group">
            <p class="sidebar-section-title">Menu</p>
            <div class="sidebar-nav-list">
                @include('modules.admin.menus.lomba', [
                    'activeTab' => $currentTab,
                    'navigationMode' => 'links',
                ])
            </div>
        </div>

        <div class="sidebar-nav-group">
            <p class="sidebar-section-title">Pengelolaan</p>
            <div class="sidebar-nav-list">
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

        <div class="sidebar-nav-group">
            <p class="sidebar-section-title">Users Management</p>
            <div class="sidebar-nav-list">
                @include('modules.admin.menus.dosen', ['activeTab' => $currentTab])
            </div>
        </div>
    </nav>

    <div class="sidebar-footer">
        <form class="sidebar-logout" method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-link">
                <span class="logout-icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 3.5H7.75A2.75 2.75 0 0 0 5 6.25v11.5A2.75 2.75 0 0 0 7.75 20.5H15" />
                        <path d="M10 12h11m0 0-3-3m3 3-3 3" />
                    </svg>
                </span>
                Keluar
            </button>
        </form>
    </div>
</aside>
