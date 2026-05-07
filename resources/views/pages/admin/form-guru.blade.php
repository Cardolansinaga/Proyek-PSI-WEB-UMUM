<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ($mode ?? 'create') === 'edit' ? 'Edit Guru' : 'Tambah Guru' }} - SMAN 2 Balige</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { overflow: hidden; font-family: 'Inter', sans-serif; background: #f8fafc; }
        .admin-container { display: flex; height: 100vh; width: 100vw; }
        .sidebar { width: 260px; background: #071f3a; flex-shrink: 0; display: flex; flex-direction: column; color: white; }
        .main-content { flex: 1; overflow-y: auto; }
        .content-padding { padding: 34px 30px; max-width: 1180px; margin: 0 auto; width: 100%; }
        .page-head { display: flex; justify-content: space-between; gap: 20px; align-items: flex-start; margin-bottom: 26px; }
        .page-head h1 { font-size: 34px; color: #071f3a; font-weight: 900; }
        .page-head p { color: #64748b; margin-top: 8px; line-height: 1.6; }
        .form-grid { display: grid; grid-template-columns: 320px minmax(0, 1fr); gap: 22px; }
        .card { background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; box-shadow: 0 8px 20px rgba(15,23,42,.06); }
        .stack { display: grid; gap: 18px; }
        .field-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
        .input-group { display: grid; gap: 8px; }
        .input-group label { font-size: 11px; font-weight: 900; color: #64748b; text-transform: uppercase; }
        .custom-input, .custom-textarea, .custom-select { width: 100%; border: 1px solid #d9e1ec; border-radius: 10px; padding: 12px 14px; font: inherit; color: #071f3a; background: #fff; }
        .custom-textarea { min-height: 130px; resize: vertical; }
        .photo-box { border: 1px dashed #cbd5e1; border-radius: 12px; padding: 22px; text-align: center; background: #f8fafc; }
        .photo-preview { width: 120px; height: 120px; border-radius: 999px; margin: 0 auto 14px; background: #e2e8f0; display: grid; place-items: center; color: #071f3a; font-size: 34px; }
        .actions { display: flex; justify-content: flex-end; gap: 12px; margin-top: 20px; flex-wrap: wrap; }
        .btn-primary, .btn-outline { border-radius: 10px; padding: 12px 18px; font-weight: 900; text-decoration: none; cursor: pointer; }
        .btn-primary { background: #071f3a; color: white; border: 1px solid #071f3a; }
        .btn-outline { background: white; color: #071f3a; border: 1px solid #d9e1ec; }
        @media (max-width: 920px) { .form-grid, .field-grid { grid-template-columns: 1fr; } .page-head { flex-direction: column; } }
    </style>
    @include('pages.admin.partials.responsive')
</head>
<body>
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'guru'])
    <div class="main-content">
        <main class="content-padding">
            @php
                $isEdit = ($mode ?? 'create') === 'edit';
                $guruName = $isEdit ? 'Dra. Marianna Sitorus' : '';
            @endphp
            <div class="page-head">
                <div>
                    <h1>{{ $isEdit ? 'Edit Data Guru' : 'Tambah Guru Baru' }}</h1>
                    <p>{{ $isEdit ? 'Perbarui biodata, jabatan, kontak, dan status publikasi guru.' : 'Isi data guru secara lengkap agar profilnya siap tampil di halaman publik sekolah.' }}</p>
                </div>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <a href="{{ route('guru.index') }}" class="btn-outline">Kembali</a>
                    <button type="submit" form="guru-form" class="btn-primary">Simpan Guru</button>
                </div>
            </div>

            <form id="guru-form" method="POST" action="{{ $isEdit ? route('admin.guru.update', $id ?? 1) : route('admin.guru.store') }}">
                @csrf
                <div class="form-grid">
                    <aside class="stack">
                        <section class="card">
                            <div class="photo-box">
                                <div class="photo-preview"><i class="bi bi-person"></i></div>
                                <strong>Foto Profil Guru</strong>
                                <p style="font-size: 12px; color: #64748b; margin-top: 6px;">Unggah foto formal rasio 1:1, format JPG/PNG.</p>
                                <input type="file" class="custom-input" name="foto" accept="image/*" style="margin-top: 14px;">
                            </div>
                        </section>
                        <section class="card stack">
                            <div class="input-group">
                                <label>Status Profil</label>
                                <select class="custom-select" name="status">
                                    <option>Aktif</option>
                                    <option>Cuti</option>
                                    <option>Nonaktif</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <label>Tampilkan di Website</label>
                                <select class="custom-select" name="publish">
                                    <option>Ya, tampilkan</option>
                                    <option>Simpan sebagai draft</option>
                                </select>
                            </div>
                        </section>
                    </aside>

                    <div class="stack">
                        <section class="card">
                            <h2 style="font-size: 18px; color: #071f3a; margin-bottom: 18px;">Biodata Utama</h2>
                            <div class="field-grid">
                                <div class="input-group">
                                    <label>Nama Lengkap dan Gelar</label>
                                    <input class="custom-input" name="nama" value="{{ $guruName }}" placeholder="Contoh: Dra. Marianna Sitorus" required>
                                </div>
                                <div class="input-group">
                                    <label>NIP / ID Pegawai</label>
                                    <input class="custom-input" name="nip" value="{{ $isEdit ? '19750812 199903 2 004' : '' }}" placeholder="Masukkan NIP atau ID pegawai">
                                </div>
                                <div class="input-group">
                                    <label>Tempat Lahir</label>
                                    <input class="custom-input" name="tempat_lahir" placeholder="Contoh: Balige">
                                </div>
                                <div class="input-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" class="custom-input" name="tanggal_lahir">
                                </div>
                            </div>
                        </section>

                        <section class="card">
                            <h2 style="font-size: 18px; color: #071f3a; margin-bottom: 18px;">Jabatan dan Akademik</h2>
                            <div class="field-grid">
                                <div class="input-group">
                                    <label>Jabatan</label>
                                    <select class="custom-select" name="jabatan">
                                        <option>Guru Mata Pelajaran</option>
                                        <option>Wali Kelas</option>
                                        <option>Kepala Laboratorium</option>
                                        <option>Staf Administrasi</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label>Mata Pelajaran / Unit</label>
                                    <input class="custom-input" name="mapel" placeholder="Contoh: Matematika">
                                </div>
                                <div class="input-group">
                                    <label>Departemen</label>
                                    <select class="custom-select" name="departemen">
                                        <option>Matematika</option>
                                        <option>Sains</option>
                                        <option>Bahasa</option>
                                        <option>Sosial</option>
                                        <option>Administrasi</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label>Pendidikan Terakhir</label>
                                    <input class="custom-input" name="pendidikan" placeholder="Contoh: S2 Pendidikan Matematika">
                                </div>
                            </div>
                        </section>

                        <section class="card">
                            <h2 style="font-size: 18px; color: #071f3a; margin-bottom: 18px;">Kontak dan Biografi</h2>
                            <div class="field-grid">
                                <div class="input-group">
                                    <label>Email Sekolah</label>
                                    <input type="email" class="custom-input" name="email" placeholder="nama@sman2balige.sch.id">
                                </div>
                                <div class="input-group">
                                    <label>Nomor WhatsApp</label>
                                    <input class="custom-input" name="telepon" placeholder="+62 812-0000-0000">
                                </div>
                            </div>
                            <div class="input-group" style="margin-top: 16px;">
                                <label>Biografi Singkat</label>
                                <textarea class="custom-textarea" name="biografi" placeholder="Tuliskan ringkasan pengalaman, bidang keahlian, dan peran guru di sekolah."></textarea>
                            </div>
                        </section>

                        <div class="actions">
                            <a href="{{ route('guru.index') }}" class="btn-outline">Batal</a>
                            <button type="submit" class="btn-primary">Simpan Guru</button>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </div>
</div>
</body>
</html>
