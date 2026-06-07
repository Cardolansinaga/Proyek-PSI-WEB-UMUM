<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Admin - SMAN 2 Balige</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo-sman2-balige.jpg') }}">
    @vite('resources/css/admin.css')
    @include('pages.admin.partials.admin-polish')
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { overflow: hidden; font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); }
        .admin-container { display: flex; height: 100vh; width: 100vw; }
        .sidebar { width: 260px; background: #071f3a; flex-shrink: 0; display: flex; flex-direction: column; color: white; }
        .main-content { flex: 1; overflow-y: auto; }
        .content-padding { padding: 34px 30px; max-width: 1180px; margin: 0 auto; width: 100%; }
        .page-head { display: flex; justify-content: space-between; gap: 20px; margin-bottom: 32px; }
        .page-head h1 { font-size: 36px; color: #071f3a; font-weight: 900; }
        .page-head p { color: #64748b; margin-top: 8px; font-size: 14px; }
        .settings-grid { display: grid; grid-template-columns: minmax(0, 1fr) 330px; gap: 24px; }
        .card { background: white; border-radius: 14px; padding: 28px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
        .stack { display: grid; gap: 18px; }
        .field-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
        .input-group { display: grid; gap: 10px; margin-bottom: 16px; }
        .input-group label { font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; }
        .custom-input, .custom-select, .custom-textarea { width: 100%; border: 1px solid #d9e1ec; border-radius: 10px; padding: 12px 14px; font: inherit; color: #071f3a; background: white; transition: all 0.3s ease; }
        .custom-input:hover, .custom-select:hover, .custom-textarea:hover { border-color: #d6a63a; box-shadow: 0 2px 8px rgba(214, 166, 58, 0.1); }
        .custom-input:focus, .custom-select:focus, .custom-textarea:focus { outline: none; border-color: #071f3a; box-shadow: 0 4px 12px rgba(7, 31, 58, 0.15); }
        .custom-textarea { min-height: 110px; resize: vertical; }
        .btn-primary, .btn-outline { border-radius: 10px; padding: 12px 18px; font-weight: 900; text-decoration: none; cursor: pointer; transition: all 0.3s ease; }
        .btn-primary { background: linear-gradient(135deg, #071f3a 0%, #0f2847 100%); color: white; border: none; box-shadow: 0 4px 12px rgba(7, 31, 58, 0.2); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(7, 31, 58, 0.3); }
        .btn-outline { background: white; color: #071f3a; border: 1px solid #d9e1ec; box-shadow: 0 2px 8px rgba(0,0,0,0.04); }
        .btn-outline:hover { border-color: #d6a63a; box-shadow: 0 4px 12px rgba(214, 166, 58, 0.15); }
        .setting-note { border-left: 4px solid #c9962c; background: #fff8e7; padding: 16px; border-radius: 10px; color: #7c5a10; font-size: 13px; line-height: 1.6; }
        .card h2 { font-size: 22px; font-weight: 900; color: #071f3a; margin-bottom: 20px; }
        .image-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
        .image-preview { min-height: 120px; border-radius: 12px; border: 1px solid #d9e1ec; background: #f4f7fb center/cover no-repeat; display: grid; place-items: center; color: #64748b; font-size: 12px; font-weight: 800; overflow: hidden; }
        .check-row { display: flex; gap: 10px; align-items: flex-start; color: #071f3a; font-size: 13px; font-weight: 800; line-height: 1.5; }
        .check-row input { width: auto; margin-top: 3px; }
        @media (max-width: 900px) { .settings-grid, .field-grid { grid-template-columns: 1fr; } .page-head { flex-direction: column; } }
        @media (max-width: 640px) { .image-grid { grid-template-columns: 1fr; } }
    </style>
    @include('pages.admin.partials.responsive')
</head>
<body>
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'pengaturan'])
    <div class="main-content">
        <main class="content-padding">
            <div class="page-head">
                <div>
                    <h1>Pengaturan Admin</h1>
                    <p>Atur informasi sekolah, status publikasi, periode PPDB, dan preferensi tampilan situs.</p>
                    @if (session('status'))
                        <p style="margin-top: 12px; color:#166534; font-weight:900; padding:10px 12px; background:#dcfce7; border-radius:8px; display:inline-block; font-size:13px;"><i class="bi bi-check-circle-fill" aria-hidden="true"></i> {{ session('status') }}</p>
                    @endif
                </div>
                <button type="submit" form="settings-form" class="btn-primary"><i class="bi bi-save" aria-hidden="true"></i> Simpan Pengaturan</button>
            </div>

            <form id="settings-form" method="POST" action="{{ route('admin.pengaturan.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="settings-grid">
                    <div class="stack">
                        <section class="card">
                            <h2><i class="bi bi-building" aria-hidden="true"></i> Profil Sekolah</h2>
                            <div class="field-grid">
                                <div class="input-group">
                                    <label>Nama Sekolah</label>
                                    <input class="custom-input" name="school_name" value="{{ old('school_name', $settings['school_name'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Email Resmi</label>
                                    <input type="email" class="custom-input" name="school_email" value="{{ old('school_email', $settings['school_email'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Telepon Sekolah</label>
                                    <input class="custom-input" name="school_phone" value="{{ old('school_phone', $settings['school_phone'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Status Situs</label>
                                    <select class="custom-select" name="site_status">
                                        @foreach (['Aktif', 'Mode Perawatan'] as $status)
                                            <option value="{{ $status }}" @selected(old('site_status', $settings['site_status'] ?? '') === $status)>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="input-group">
                                <label>Alamat Sekolah</label>
                                <textarea class="custom-textarea" name="school_address">{{ old('school_address', $settings['school_address'] ?? '') }}</textarea>
                            </div>
                        </section>

                        <section class="card">
                            <h2><i class="bi bi-journal-check" aria-hidden="true"></i> Pengaturan PPDB</h2>
                            <div class="field-grid">
                                <div class="input-group">
                                    <label>Tahun Ajaran</label>
                                    <input class="custom-input" name="ppdb_year" value="{{ old('ppdb_year', $settings['ppdb_year'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Status PPDB</label>
                                    <select class="custom-select" name="ppdb_status">
                                        @foreach (['Dibuka', 'Ditutup', 'Segera Dibuka'] as $status)
                                            <option value="{{ $status }}" @selected(old('ppdb_status', $settings['ppdb_status'] ?? '') === $status)>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label>Tanggal Buka</label>
                                    <input type="date" class="custom-input" name="ppdb_open_date" value="{{ old('ppdb_open_date', $settings['ppdb_open_date'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Tanggal Tutup</label>
                                    <input type="date" class="custom-input" name="ppdb_close_date" value="{{ old('ppdb_close_date', $settings['ppdb_close_date'] ?? '') }}">
                                </div>
                            </div>
                        </section>

                        <section class="card">
                            <h2><i class="bi bi-image" aria-hidden="true"></i> Gambar Hero Halaman Publik</h2>
                            <div class="image-grid">
                                @foreach ([
                                    'akademik_hero_image' => 'Akademik & Prestasi',
                                    'kesiswaan_hero_image' => 'Kesiswaan & Ekstrakurikuler',
                                    'ppdb_hero_image' => 'PPDB',
                                    'berita_hero_image' => 'Berita & Pengumuman',
                                ] as $field => $label)
                                    <div class="input-group">
                                        <label>{{ $label }}</label>
                                        @if (! empty($settings[$field]))
                                            <div class="image-preview" style="background-image: url('{{ asset('storage/'.$settings[$field]) }}');"></div>
                                            <label class="check-row">
                                                <input type="checkbox" name="remove_{{ $field }}" value="1">
                                                Hapus gambar custom
                                            </label>
                                        @else
                                            <div class="image-preview">Gambar bawaan aktif</div>
                                        @endif
                                        <input class="custom-input" type="file" name="{{ $field }}" accept="image/png,image/jpeg,image/webp">
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    </div>

                    <aside class="stack">
                        <section class="card">
                            <h2><i class="bi bi-person-gear" aria-hidden="true"></i> Akun Admin</h2>
                            <div class="input-group">
                                <label>Nama Admin</label>
                                <input class="custom-input" name="admin_name" value="{{ session('admin_name') ?? 'Admin Utama' }}">
                            </div>
                            <div class="input-group">
                                <label>Email Login</label>
                                <input type="email" class="custom-input" name="admin_email" value="admin@sman2balige.sch.id">
                            </div>
                            <div class="input-group">
                                <label>Logo Situs</label>
                                <div class="image-preview" style="background-image: url('{{ asset('images/logo-sman2-balige.jpg') }}'); background-size: contain; background-color: #ffffff;">Logo resmi aktif</div>
                                <input class="custom-input" type="file" name="logo" accept="image/png,image/jpeg,image/webp">
                            </div>
                            <div class="input-group">
                                <label>Durasi Sesi</label>
                                <select class="custom-select" name="session_duration">
                                    <option>120 menit</option>
                                    <option>240 menit</option>
                                    <option>1 hari</option>
                                </select>
                            </div>
                        </section>

                        <section class="card">
                            <h2><i class="bi bi-broadcast" aria-hidden="true"></i> Publikasi</h2>
                            <div class="input-group">
                                <label>Moderasi Konten</label>
                                <select class="custom-select" name="moderasi">
                                    <option>Wajib review admin</option>
                                    <option>Publikasi otomatis</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <label>Urutan Berita</label>
                                <select class="custom-select" name="urutan_berita">
                                    <option>Terbaru dulu</option>
                                    <option>Prioritas dulu</option>
                                </select>
                            </div>
                            <div class="setting-note">Gunakan pengaturan ini untuk menjaga data publik sekolah tetap konsisten sebelum diberikan ke mitra.</div>
                        </section>

                        <div style="display: flex; gap: 10px;">
                            <a href="{{ route('dashboard') }}" class="btn-outline"><i class="bi bi-x-circle" aria-hidden="true"></i> Batal</a>
                            <button type="submit" class="btn-primary"><i class="bi bi-save" aria-hidden="true"></i> Simpan</button>
                        </div>
                    </aside>
                </div>
            </form>
        </main>
    </div>
</div>
</body>
</html>
