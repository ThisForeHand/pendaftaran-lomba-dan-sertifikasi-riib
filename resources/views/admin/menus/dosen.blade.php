@php
    $currentTab = $activeTab ?? 'lomba';
    $isActive = $currentTab === 'dosen';
@endphp

<a
    class="nav-link {{ $isActive ? 'active' : '' }}"
    href="{{ route('admin.dosen.create') }}"
    @if ($isActive) aria-current="page" @endif
>
    Buat Akun Dosen
</a>
