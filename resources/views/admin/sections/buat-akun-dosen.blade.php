<section class="card">
    <header class="card-header">
        <div class="card-title">
            <span>Manajemen Akun</span>
            <h1>Buat Akun Dosen</h1>
        </div>
        <div class="card-actions">
            <a class="card-action-button secondary" href="{{ route('admin.lomba') }}">
                &larr; Kembali ke Dashboard
            </a>
        </div>
    </header>

    @if (session('status'))
        <div class="status-message" role="status">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="error-message" role="alert">
            <strong>Terjadi kesalahan pada data yang Anda masukkan:</strong>
            <ul class="error-list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('admin.dosen.store') }}">
        @csrf

        <fieldset>
            <div class="form-row two-columns">
                <div class="form-field">
                    <label for="name">Nama Lengkap</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autocomplete="name"
                    />
                </div>
                <div class="form-field">
                    <label for="username">Username</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="{{ old('username') }}"
                        required
                        autocomplete="username"
                    />
                </div>
            </div>

            <div class="form-row two-columns">
                <div class="form-field">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                    />
                </div>
                <div class="form-field">
                    <label for="phone">No. Telepon</label>
                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="Opsional"
                        autocomplete="tel"
                    />
                </div>
            </div>

            <div class="form-field">
                <label for="program_studi">Program Studi</label>
                <input
                    type="text"
                    id="program_studi"
                    name="program_studi"
                    value="{{ old('program_studi') }}"
                    placeholder="Opsional"
                    autocomplete="organization-title"
                />
            </div>

            <div class="form-row two-columns">
                <div class="form-field">
                    <label for="password">Kata Sandi</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        autocomplete="new-password"
                    />
                    <p class="form-help">Minimal 8 karakter dan gunakan kombinasi huruf &amp; angka.</p>
                </div>
                <div class="form-field">
                    <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                    />
                </div>
            </div>
        </fieldset>

        <button type="submit">Simpan &amp; Buat Akun</button>
    </form>
</section>
