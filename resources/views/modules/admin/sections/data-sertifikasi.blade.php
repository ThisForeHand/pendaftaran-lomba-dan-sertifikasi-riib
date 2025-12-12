@php
    use Illuminate\Support\Facades\Storage;

    $tableExists = $tableExists ?? true;
    $registrations = $registrations ?? collect();
    $panelId = $panelId ?? 'panel-sertifikasi';
@endphp

<section class="card data-panel" id="{{ $panelId }}">
    <div class="card-header">
        <div class="card-title">
            <h2>Pendaftaran Sertifikasi</h2>
            <span>Daftar peserta</span>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.sertifikasi.destroy') }}" class="data-form" id="{{ $panelId }}-form">
        @csrf
        @method('DELETE')

        <input type="hidden" name="clear_all" value="0" class="clear-all-input">

        <div class="table-container">
            <table data-empty-text="Belum ada data pendaftaran sertifikasi.">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Prodi</th>
                        <th>No Wa</th>
                        <th>Tanggal Pelaksanaan</th>
                        <th>Poster Sertifikasi</th>
                        <th class="select-column" aria-label="Pilih">
                            <button type="button" class="clear-all-button">Clear All</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (! $tableExists)
                        <tr>
                            <td colspan="8">
                                Tabel pendaftaran sertifikasi belum tersedia. Jalankan migrasi database terlebih dahulu.
                            </td>
                        </tr>
                    @else
                        @forelse ($registrations as $registration)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $registration->nama }}</td>
                                <td>{{ $registration->nip }}</td>
                                <td>{{ $registration->program_studi }}</td>
                                <td>
                                    <x-contact-link :value="$registration->whatsapp" />
                                </td>
                                <td>{{ $registration->tanggal_pelaksanaan }}</td>
                                <td>
                                    @if ($registration->poster_path)
                                        <a href="{{ Storage::disk('public')->url($registration->poster_path) }}" target="_blank" rel="noopener">Poster</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="select-cell">
                                    <input type="checkbox" name="ids[]" value="{{ $registration->id }}" class="row-checkbox" />
                                </td>
                            </tr>
                        @empty
                            <tr class="empty-state">
                                <td colspan="8">Belum ada data pendaftaran sertifikasi.</td>
                            </tr>
                        @endforelse
                    @endif
                </tbody>
            </table>
        </div>
    </form>

    <div class="footer-actions">
        <div class="footer-actions-left"></div>
        <div class="footer-actions-right">
            <a href="{{ route('admin.sertifikasi.download') }}" class="action-button download">Unduh</a>
            <button type="button" class="action-button delete" form="{{ $panelId }}-form">Hapus</button>
        </div>
    </div>
</section>
