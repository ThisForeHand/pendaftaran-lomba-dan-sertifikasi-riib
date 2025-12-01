@php
    $currentTab = $activeTab ?? 'lomba';
    $isActive = $currentTab === 'sertifikasi';
    $navigationMode = $navigationMode ?? 'tabs';
@endphp

@if ($navigationMode === 'links')
    <a
        class="nav-link {{ $isActive ? 'active' : '' }}"
        href="{{ route('admin.sertifikasi') }}"
        @if ($isActive) aria-current="page" @endif
    >
        <span class="nav-icon" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 4.5h12a1.5 1.5 0 0 1 1.5 1.5v12a1.5 1.5 0 0 1-1.5 1.5H6A1.5 1.5 0 0 1 4.5 18V6A1.5 1.5 0 0 1 6 4.5Z" />
                <path d="M9 9h6" />
                <path d="M9 12h6" />
                <path d="m9.5 16 2.5-2 2.5 2" />
            </svg>
        </span>
        <span class="nav-label">Data Sertifikasi</span>
    </a>
@else
    <button
        type="button"
        class="nav-link {{ $isActive ? 'active' : '' }}"
        data-tab="sertifikasi"
        id="tab-sertifikasi"
        role="tab"
        aria-controls="panel-sertifikasi"
        aria-selected="{{ $isActive ? 'true' : 'false' }}"
    >
        Data Sertifikasi
    </button>
@endif
