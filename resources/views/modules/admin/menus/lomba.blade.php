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
        Data Lomba
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
