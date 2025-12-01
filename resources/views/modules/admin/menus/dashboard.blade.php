@php
    $currentTab = $activeTab ?? 'dashboard';
    $isActive = $currentTab === 'dashboard';
    $navigationMode = $navigationMode ?? 'links';
@endphp

@if ($navigationMode === 'links')
    <a
        class="nav-link {{ $isActive ? 'active' : '' }}"
        href="{{ route('admin.dashboard') }}"
        @if ($isActive) aria-current="page" @endif
    >
        <span class="nav-icon" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 3h7v7H3z" />
                <path d="M14 3h7v11h-7z" />
                <path d="M3 14h7v7H3z" />
                <path d="M14 17h7v4h-7z" />
            </svg>
        </span>
        <span class="nav-label">Dashboard</span>
    </a>
@else
    <button
        type="button"
        class="nav-link {{ $isActive ? 'active' : '' }}"
        data-tab="dashboard"
        id="tab-dashboard"
        role="tab"
        aria-controls="panel-dashboard"
        aria-selected="{{ $isActive ? 'true' : 'false' }}"
    >
        Dashboard
    </button>
@endif
