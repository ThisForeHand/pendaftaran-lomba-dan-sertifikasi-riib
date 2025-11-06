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
        Data Sertifikasi
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
