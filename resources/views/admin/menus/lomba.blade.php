@php
    $currentTab = $activeTab ?? 'lomba';
    $isActive = $currentTab === 'lomba';
@endphp

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
