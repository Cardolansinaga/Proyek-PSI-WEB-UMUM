<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ($mode ?? 'create') === 'edit' ? 'Edit Kesiswaan' : 'Tambah Kesiswaan' }} - SMAN 2 Balige</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { overflow: hidden; font-family: 'Inter', sans-serif; background: #f8fafc; }
        .admin-container { display: flex; height: 100vh; width: 100vw; }
        .sidebar { width: 260px; background: #071f3a; flex-shrink: 0; display: flex; flex-direction: column; color: white; }
        .main-content { flex: 1; overflow-y: auto; }
        .content-padding { padding: 34px 30px; max-width: 1120px; margin: 0 auto; width: 100%; }
        .page-head { display: flex; justify-content: space-between; gap: 20px; margin-bottom: 24px; }
        .page-head h1 { font-size: 34px; color: #071f3a; font-weight: 900; }
        .page-head p { color: #64748b; margin-top: 8px; }
        .card { background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; box-shadow: 0 8px 20px rgba(15,23,42,.06); }
        .form-grid { display: grid; grid-template-columns: 1fr 320px; gap: 22px; }
        .field-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
        .input-group { display: grid; gap: 8px; margin-bottom: 16px; }
        .input-group label { font-size: 11px; font-weight: 900; color: #64748b; text-transform: uppercase; }
        .custom-input, .custom-textarea, .custom-select { width: 100%; border: 1px solid #d9e1ec; border-radius: 10px; padding: 12px 14px; font: inherit; color: #071f3a; background: white; }
        .custom-textarea { min-height: 150px; resize: vertical; }
        .btn-primary, .btn-outline { border-radius: 10px; padding: 12px 18px; font-weight: 900; text-decoration: none; cursor: pointer; }
        .btn-primary { background: #071f3a; color: white; border: 1px solid #071f3a; }
        .btn-outline { background: white; color: #071f3a; border: 1px solid #d9e1ec; }
        @media (max-width: 900px) { .form-grid, .field-grid { grid-template-columns: 1fr; } .page-head { flex-direction: column; } }
    </style>
    @include('pages.admin.partials.responsive')
</head>
<body>
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'kesiswaan'])
    <div class="main-content">
        <main class="content-padding">
            @php($isEdit = ($mode ?? 'create') === 'edit')
            <div class="page-head">
                <div>
                    <h1>{{ $isEdit ? 'Edit Data Kesiswaan' : 'Tambah Data Kesiswaan' }}</h1>
                    <p>Kelola organisasi siswa, ekstrakurikuler, pembina, jadwal latihan, dan status publikasi.</p>
                </div>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <a href="{{ route('kesiswaan.index') }}" class="btn-outline">Kembali</a>
                    <button type="submit" form="kesiswaan-form" class="btn-primary">Simpan Data</button>
                </div>
            </div>

            <form id="kesiswaan-form" method="POST" action="{{ $isEdit ? route('admin.kesiswaan.update', $id ?? 1) : route('admin.kesiswaan.store') }}">
                @csrf
                <div class="form-grid">
                    <section class="card">
                        <h2 style="font-size: 18px; color: #071f3a; margin-bottom: 18px;">Informasi Kegiatan</h2>
                        <div class="field-grid">
                            <div class="input-group">
                                <label>Nama Organisasi / Ekstrakurikuler</label>
                                <input class="custom-input" name="nama" placeholder="Contoh: OSIS, MPK, Basket, Paduan Suara" required>
                            </div>
                            <div class="input-group">
                                <label>Jenis Kegiatan</label>
                                <select class="custom-select" name="jenis">
                                    <option>Organisasi Siswa</option>
                                    <option>Ekstrakurikuler Akademik</option>
                                    <option>Ekstrakurikuler Olahraga</option>
                                    <option>Ekstrakurikuler Seni</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <label>Ketua / Koordinator</label>
                                <input class="custom-input" name="ketua" placeholder="Nama ketua atau koordinator siswa">
                            </div>
                            <div class="input-group">
                                <label>Pembina</label>
                                <input class="custom-input" name="pembina" placeholder="Nama guru pembina">
                            </div>
                            <div class="input-group">
                                <label>Jadwal Rutin</label>
                                <input class="custom-input" name="jadwal" placeholder="Contoh: Jumat, 15.30 WIB">
                            </div>
                            <div class="input-group">
                                <label>Lokasi</label>
                                <input class="custom-input" name="lokasi" placeholder="Contoh: Aula, Lapangan, Lab Bahasa">
                            </div>
                        </div>
                        <div class="input-group">
                            <label>Deskripsi Singkat</label>
                            <textarea class="custom-textarea" name="deskripsi" placeholder="Jelaskan tujuan, aktivitas utama, dan manfaat kegiatan bagi siswa."></textarea>
                        </div>
                    </section>
                    <aside class="card">
                        <h2 style="font-size: 18px; color: #071f3a; margin-bottom: 18px;">Publikasi</h2>
                        <div class="input-group">
                            <label>Status</label>
                            <select class="custom-select" name="status">
                                <option>Aktif</option>
                                <option>Draft</option>
                                <option>Arsip</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Tampilkan di Website</label>
                            <select class="custom-select" name="publish">
                                <option>Ya, tampilkan</option>
                                <option>Tidak, simpan internal</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Foto Kegiatan</label>
                            <input type="file" class="custom-input" name="foto" accept="image/*">
                        </div>
                        <div style="display: flex; gap: 10px; margin-top: 22px;">
                            <a href="{{ route('kesiswaan.index') }}" class="btn-outline">Batal</a>
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
