@php
    $currentTab = $activeTab ?? 'lomba';
    $isActive = $currentTab === 'alur';
    $navigationMode = $navigationMode ?? 'links';
@endphp

@if ($navigationMode === 'links')
    <a
        class="nav-link {{ $isActive ? 'active' : '' }}"
        href="{{ route('admin.alur') }}"
        @if ($isActive) aria-current="page" @endif
    >
        <span class="nav-icon" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 4.5h10a3.5 3.5 0 1 1 0 7H9" />
                <path d="M19 19.5H9a3.5 3.5 0 1 1 0-7h6" />
                <path d="M8 9 5 6 8 3" />
                <path d="m16 15 3 3-3 3" />
            </svg>
        </span>
        <span class="nav-label">Kelola Alur</span>
    </a>
@else
    <button
        type="button"
        class="nav-link {{ $isActive ? 'active' : '' }}"
        data-tab="alur"
        id="tab-alur"
        role="tab"
        aria-controls="panel-alur"
        aria-selected="{{ $isActive ? 'true' : 'false' }}"
    >
        Kelola Alur
    </button>
@endif
