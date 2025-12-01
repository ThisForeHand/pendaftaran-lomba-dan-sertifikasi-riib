@php
    $currentTab = $activeTab ?? 'lomba';
    $isActive = $currentTab === 'dosen';
@endphp

<a
    class="nav-link {{ $isActive ? 'active' : '' }}"
    href="{{ route('admin.dosen.create') }}"
    @if ($isActive) aria-current="page" @endif
>
    <span class="nav-icon" aria-hidden="true">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4Z" />
            <path d="M4.5 20a7.5 7.5 0 0 1 15 0" />
            <path d="M16 8h3" />
            <path d="M17.5 6.5v3" />
        </svg>
    </span>
    <span class="nav-label">Buat Akun Dosen</span>
</a>
