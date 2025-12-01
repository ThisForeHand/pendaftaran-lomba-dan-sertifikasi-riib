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
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 5.5h9a3 3 0 0 1 0 6H9" />
                <path d="M19 18.5h-9a3 3 0 0 1 0-6h5" />
                <path d="M7.5 5.5V3.5" />
                <path d="M16.5 20.5v-2" />
                <path d="m8 10.5-2-2-2 2" />
                <path d="m16 13.5 2 2 2-2" />
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
