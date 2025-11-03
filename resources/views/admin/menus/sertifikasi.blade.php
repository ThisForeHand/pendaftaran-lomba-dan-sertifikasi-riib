@php
    $currentTab = $activeTab ?? 'lomba';
    $isActive = $currentTab === 'sertifikasi';
@endphp

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
