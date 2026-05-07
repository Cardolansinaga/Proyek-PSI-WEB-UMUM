<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Admin - SMAN 2 Balige</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { overflow: hidden; font-family: 'Inter', sans-serif; background: #f8fafc; }
        .admin-container { display: flex; height: 100vh; width: 100vw; }
        .sidebar { width: 260px; background: #071f3a; flex-shrink: 0; display: flex; flex-direction: column; color: white; }
        .main-content { flex: 1; overflow-y: auto; }
        .content-padding { padding: 34px 30px; max-width: 1180px; margin: 0 auto; width: 100%; }
        .page-head { display: flex; justify-content: space-between; gap: 20px; margin-bottom: 24px; }
        .page-head h1 { font-size: 34px; color: #071f3a; font-weight: 900; }
        .page-head p { color: #64748b; margin-top: 8px; }
        .settings-grid { display: grid; grid-template-columns: minmax(0, 1fr) 330px; gap: 22px; }
        .card { background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; box-shadow: 0 8px 20px rgba(15,23,42,.06); }
        .stack { display: grid; gap: 18px; }
        .field-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
        .input-group { display: grid; gap: 8px; margin-bottom: 16px; }
        .input-group label { font-size: 11px; font-weight: 900; color: #64748b; text-transform: uppercase; }
        .custom-input, .custom-select, .custom-textarea { width: 100%; border: 1px solid #d9e1ec; border-radius: 10px; padding: 12px 14px; font: inherit; color: #071f3a; background: white; }
        .custom-textarea { min-height: 110px; resize: vertical; }
        .btn-primary, .btn-outline { border-radius: 10px; padding: 12px 18px; font-weight: 900; text-decoration: none; cursor: pointer; }
        .btn-primary { background: #071f3a; color: white; border: 1px solid #071f3a; }
        .btn-outline { background: white; color: #071f3a; border: 1px solid #d9e1ec; }
        .setting-note { border-left: 4px solid #c9962c; background: #fff8e7; padding: 14px; border-radius: 10px; color: #7c5a10; font-size: 13px; line-height: 1.6; }
        @media (max-width: 900px) { .settings-grid, .field-grid { grid-template-columns: 1fr; } .page-head { flex-direction: column; } }
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
                </div>
                <button type="submit" form="settings-form" class="btn-primary">Simpan Pengaturan</button>
            </div>

            <form id="settings-form" method="POST" action="{{ route('admin.pengaturan.update') }}">
                @csrf
                <div class="settings-grid">
                    <div class="stack">
                        <section class="card">
                            <h2 style="font-size: 18px; color: #071f3a; margin-bottom: 18px;">Profil Sekolah</h2>
                            <div class="field-grid">
                                <div class="input-group">
                                    <label>Nama Sekolah</label>
                                    <input class="custom-input" name="nama_sekolah" value="SMAN 2 Balige">
                                </div>
                                <div class="input-group">
                                    <label>Email Resmi</label>
                                    <input type="email" class="custom-input" name="email" value="info@sman2balige.sch.id">
                                </div>
                                <div class="input-group">
                                    <label>Telepon Sekolah</label>
                                    <input class="custom-input" name="telepon" value="(0632) 213456">
                                </div>
                                <div class="input-group">
                                    <label>Status Situs</label>
                                    <select class="custom-select" name="status_situs">
                                        <option>Aktif</option>
                                        <option>Mode Perawatan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group">
                                <label>Alamat Sekolah</label>
                                <textarea class="custom-textarea" name="alamat">Jl. Kartini Soposurung, Balige, Toba, Sumatera Utara</textarea>
                            </div>
                        </section>

                        <section class="card">
                            <h2 style="font-size: 18px; color: #071f3a; margin-bottom: 18px;">Pengaturan PPDB</h2>
                            <div class="field-grid">
                                <div class="input-group">
                                    <label>Tahun Ajaran</label>
                                    <input class="custom-input" name="tahun_ajaran" value="2026/2027">
                                </div>
                                <div class="input-group">
                                    <label>Status PPDB</label>
                                    <select class="custom-select" name="status_ppdb">
                                        <option>Dibuka</option>
                                        <option>Ditutup</option>
                                        <option>Segera Dibuka</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label>Tanggal Buka</label>
                                    <input type="date" class="custom-input" name="tanggal_buka" value="2026-06-01">
                                </div>
                                <div class="input-group">
                                    <label>Tanggal Tutup</label>
                                    <input type="date" class="custom-input" name="tanggal_tutup" value="2026-07-15">
                                </div>
                            </div>
                        </section>
                    </div>

                    <aside class="stack">
                        <section class="card">
                            <h2 style="font-size: 18px; color: #071f3a; margin-bottom: 18px;">Akun Admin</h2>
                            <div class="input-group">
                                <label>Nama Admin</label>
                                <input class="custom-input" name="admin_name" value="{{ session('admin_name') ?? 'Admin Utama' }}">
                            </div>
                            <div class="input-group">
                                <label>Email Login</label>
                                <input type="email" class="custom-input" name="admin_email" value="admin@sman2balige.sch.id">
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
                            <h2 style="font-size: 18px; color: #071f3a; margin-bottom: 18px;">Publikasi</h2>
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
                            <a href="{{ route('dashboard') }}" class="btn-outline">Batal</a>
                            <button type="submit" class="btn-primary">Simpan</button>
                        </div>
                    </aside>
                </div>
            </form>
        </main>
    </div>
</div>
</body>
</html>
