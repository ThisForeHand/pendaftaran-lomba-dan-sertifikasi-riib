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
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 4h6v6H4z" />
                <path d="M14 4h6v6h-6z" />
                <path d="M4 14h6v6H4z" />
                <path d="M14 14h6v6h-6z" />
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
