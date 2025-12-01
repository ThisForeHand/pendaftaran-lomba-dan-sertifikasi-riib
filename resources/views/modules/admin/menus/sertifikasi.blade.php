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
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="m12 3 2.5 3.5 4.5 1L16 11.5 16.5 16l-4.5-1.5L7.5 16 8 11.5 5 7.5l4.5-1L12 3Z" />
                <path d="M12 17v4" />
                <path d="m9 21 3-1 3 1" />
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
