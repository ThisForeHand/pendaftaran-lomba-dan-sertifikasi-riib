@php
    $currentTab = $activeTab ?? 'lomba';
    $isActive = $currentTab === 'lomba';
    $navigationMode = $navigationMode ?? 'tabs';
@endphp

@if ($navigationMode === 'links')
    <a
        class="nav-link {{ $isActive ? 'active' : '' }}"
        href="{{ route('admin.lomba') }}"
        @if ($isActive) aria-current="page" @endif
    >
        <span class="nav-icon" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 3 3 9l9 6 9-6-9-6Z" />
                <path d="M3 15l9 6 9-6" />
            </svg>
        </span>
        <span class="nav-label">Data Lomba</span>
    </a>
@else
    <button
        type="button"
        class="nav-link {{ $isActive ? 'active' : '' }}"
        data-tab="lomba"
        id="tab-lomba"
        role="tab"
        aria-controls="panel-lomba"
        aria-selected="{{ $isActive ? 'true' : 'false' }}"
    >
        Data Lomba
    </button>
@endif
