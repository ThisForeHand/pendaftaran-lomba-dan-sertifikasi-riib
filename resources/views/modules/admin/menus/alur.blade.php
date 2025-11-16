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
        Kelola Alur
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
