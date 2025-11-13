@php
    $tableExists = $tableExists ?? true;
    $registrations = $registrations ?? collect();
    $panelId = $panelId ?? 'panel-lomba';
@endphp

<section class="card data-panel" id="{{ $panelId }}">
    <div class="card-header">
        <div class="card-title">
            <h2>Pendaftaran Lomba</h2>
            <span>Daftar peserta</span>
        </div>
    </div>

    <div class="table-container">
        <table data-empty-text="Belum ada data pendaftaran lomba.">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Prodi</th>
                    <th>No Wa</th>
                    <th>Peran</th>
                    <th>Status Tim</th>
                    <th class="select-column" aria-label="Pilih">
                        <button type="button" class="clear-all-button">Clear All</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (! $tableExists)
                    <tr>
                        <td colspan="8">
                            Tabel pendaftaran lomba belum tersedia. Jalankan migrasi database terlebih dahulu.
                        </td>
                    </tr>
                @else
                    @forelse ($registrations as $registration)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $registration->nama }}</td>
                            <td>{{ $registration->nim }}</td>
                            <td>{{ $registration->program_studi }}</td>
                            <td>
                                <x-contact-link :value="$registration->whatsapp" />
                            </td>
                            <td>{{ $registration->pilihan_peran }}</td>
                            <td>
                                <span class="badge">{{ $registration->status_tim }}</span>
                            </td>
                            <td class="select-cell"><input type="checkbox" class="row-checkbox" /></td>
                        </tr>
                    @empty
                        <tr class="empty-state">
                            <td colspan="8">Belum ada data pendaftaran lomba.</td>
                        </tr>
                    @endforelse
                @endif
            </tbody>
        </table>
    </div>

    <div class="footer-actions">
        <div class="footer-actions-left">
            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="logout-button">Keluar</button>
            </form>
        </div>
        <div class="footer-actions-right">
            <a href="{{ route('admin.lomba.download') }}" class="action-button download">Unduh</a>
            <a href="#" class="action-button delete">Hapus</a>
        </div>
    </div>
</section>
