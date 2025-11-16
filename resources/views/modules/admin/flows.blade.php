@extends('modules.admin.layouts.dashboard', [
    'activeTab' => 'alur',
    'navigationMode' => 'links',
])

@section('title', 'Kelola Alur Pendaftaran - Dashboard Admin')

@section('content')
    @php
        $flowCollections = collect($flows ?? []);
        $typeLabels = [
            'lomba' => 'Portal Lomba',
            'sertifikasi' => 'Portal Sertifikasi',
        ];
        $statusMessage = session('status');
        $currentEditor = (string) old('flow_id');
    @endphp

    <section class="card">
        <header class="card-header">
            <div class="card-title">
                <span>Konten Publik</span>
                <h2>Tambah Kotak Alur</h2>
            </div>
        </header>

        @if ($statusMessage)
            <div class="status-message" role="status">{{ $statusMessage }}</div>
        @endif

        @if ($errors->any())
            <div class="error-message" role="alert">
                <strong>Periksa kembali data yang Anda masukkan:</strong>
                <ul class="error-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.alur.store') }}" class="flow-create-form">
            @csrf
            <fieldset>
                <div class="form-row two-columns">
                    <div class="form-field">
                        <label for="type">Jenis Portal</label>
                        <select id="type" name="type" required>
                            <option value="" disabled @selected(blank(old('type')))>
                                Pilih jenis portal
                            </option>
                            @foreach ($typeLabels as $type => $label)
                                <option value="{{ $type }}" @selected(old('type') === $type)>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-field">
                        <label for="sequence">Urutan Tampil</label>
                        <input
                            type="number"
                            id="sequence"
                            name="sequence"
                            min="1"
                            max="99"
                            value="{{ old('sequence', 1) }}"
                            required
                        />
                        <p class="form-help">Gunakan angka kecil untuk posisi paling awal.</p>
                    </div>
                </div>

                <div class="form-field">
                    <label for="title">Judul Alur</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        required
                    />
                </div>

                <div class="form-field">
                    <label for="description">Penjelasan Alur</label>
                    <textarea id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                    <p class="form-help">Gunakan maksimal 2-3 kalimat agar ringkas.</p>
                </div>

                <div class="form-field">
                    <label for="link">Link Pendukung (Opsional)</label>
                    <input
                        type="url"
                        id="link"
                        name="link"
                        value="{{ old('link') }}"
                        placeholder="https://contoh.link"
                        inputmode="url"
                    />
                </div>
            </fieldset>

            <button type="submit">Simpan Kotak Alur</button>
        </form>
    </section>

    <section class="card">
        <header class="card-header">
            <div class="card-title">
                <span>Alur Aktif</span>
                <h2>Kelola Konten</h2>
            </div>
        </header>

        <div class="flow-management-grid">
            @foreach ($typeLabels as $type => $label)
                @php
                    /** @var \Illuminate\Support\Collection<int, \App\Models\RegistrationFlow> $entries */
                    $entries = $flowCollections[$type] ?? collect();
                @endphp
                <article class="flow-column">
                    <h3>{{ $label }}</h3>

                    @forelse ($entries as $entry)
                        @php
                            $formId = 'flow-update-' . $entry->id;
                            $deleteFormId = 'flow-delete-' . $entry->id;
                            $isEditingThis = $currentEditor === (string) $entry->id;
                        @endphp
                        <div class="flow-entry">
                            <form
                                method="POST"
                                action="{{ route('admin.alur.update', $entry) }}"
                                id="{{ $formId }}"
                                class="flow-edit-form"
                            >
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="flow_id" value="{{ $entry->id }}" />
                                <div class="form-row two-columns">
                                    <div class="form-field">
                                        <label for="type-{{ $entry->id }}">Jenis Portal</label>
                                        <select id="type-{{ $entry->id }}" name="type" required>
                                            @foreach ($typeLabels as $value => $optionLabel)
                                                <option
                                                    value="{{ $value }}"
                                                    @selected(($isEditingThis ? old('type') : $entry->type) === $value)
                                                >
                                                    {{ $optionLabel }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-field">
                                        <label for="sequence-{{ $entry->id }}">Urutan Tampil</label>
                                        <input
                                            type="number"
                                            id="sequence-{{ $entry->id }}"
                                            name="sequence"
                                            min="1"
                                            max="99"
                                            value="{{ $isEditingThis ? old('sequence') : $entry->sequence }}"
                                            required
                                        />
                                    </div>
                                </div>

                                <div class="form-field">
                                    <label for="title-{{ $entry->id }}">Judul Alur</label>
                                    <input
                                        type="text"
                                        id="title-{{ $entry->id }}"
                                        name="title"
                                        value="{{ $isEditingThis ? old('title') : $entry->title }}"
                                        required
                                    />
                                </div>

                                <div class="form-field">
                                    <label for="description-{{ $entry->id }}">Penjelasan Alur</label>
                                    <textarea id="description-{{ $entry->id }}" name="description" rows="4" required>{{ $isEditingThis ? old('description') : $entry->description }}</textarea>
                                </div>

                                <div class="form-field">
                                    <label for="link-{{ $entry->id }}">Link Pendukung</label>
                                    <input
                                        type="url"
                                        id="link-{{ $entry->id }}"
                                        name="link"
                                        value="{{ $isEditingThis ? old('link') : $entry->link }}"
                                        placeholder="Opsional"
                                        inputmode="url"
                                    />
                                </div>
                            </form>

                            <form
                                method="POST"
                                action="{{ route('admin.alur.destroy', $entry) }}"
                                id="{{ $deleteFormId }}"
                            >
                                @csrf
                                @method('DELETE')
                            </form>

                            <div class="flow-item-actions">
                                <button type="submit" form="{{ $formId }}">Simpan Perubahan</button>
                                <button
                                    type="submit"
                                    form="{{ $deleteFormId }}"
                                    class="button-danger"
                                    onclick="return confirm('Hapus kotak alur ini? Tindakan tidak dapat dibatalkan.');"
                                >
                                    Hapus Kotak
                                </button>
                            </div>
                        </div>
                    @empty
                        <p class="empty-flow-state">Belum ada alur yang ditampilkan.</p>
                    @endforelse
                </article>
            @endforeach
        </div>
    </section>
@endsection
