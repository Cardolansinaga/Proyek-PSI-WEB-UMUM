<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ($mode ?? 'upload') === 'edit' ? 'Edit Media Galeri' : 'Upload Galeri' }} - SMAN 2 Balige</title>
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
        .grid { display: grid; grid-template-columns: minmax(0, 1fr) 330px; gap: 22px; }
        .card { background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; box-shadow: 0 8px 20px rgba(15,23,42,.06); }
        .upload-zone { border: 2px dashed #cbd5e1; border-radius: 14px; background: #f8fafc; padding: 42px; text-align: center; margin-bottom: 20px; }
        .field-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
        .input-group { display: grid; gap: 8px; margin-bottom: 16px; }
        .input-group label { font-size: 11px; font-weight: 900; color: #64748b; text-transform: uppercase; }
        .custom-input, .custom-textarea, .custom-select { width: 100%; border: 1px solid #d9e1ec; border-radius: 10px; padding: 12px 14px; font: inherit; color: #071f3a; background: white; }
        .custom-textarea { min-height: 120px; resize: vertical; }
        .btn-primary, .btn-outline { border-radius: 10px; padding: 12px 18px; font-weight: 900; text-decoration: none; cursor: pointer; }
        .btn-primary { background: #071f3a; color: white; border: 1px solid #071f3a; }
        .btn-outline { background: white; color: #071f3a; border: 1px solid #d9e1ec; }
        @media (max-width: 900px) { .grid, .field-grid { grid-template-columns: 1fr; } .page-head { flex-direction: column; } }
    </style>
    @include('pages.admin.partials.responsive')
</head>
<body>
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'galeri'])
    <div class="main-content">
        <main class="content-padding">
            @php($isEdit = ($mode ?? 'upload') === 'edit')
            <div class="page-head">
                <div>
                    <h1>{{ $isEdit ? 'Edit Media Galeri' : 'Upload Media Galeri' }}</h1>
                    <p>Tambahkan dokumentasi kegiatan sekolah dengan judul, kategori, deskripsi, dan status publikasi yang jelas.</p>
                </div>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <a href="{{ route('admin.galeri') }}" class="btn-outline">Kembali</a>
                    <button type="submit" form="galeri-form" class="btn-primary">Simpan Media</button>
                </div>
            </div>

            <form id="galeri-form" method="POST" action="{{ $isEdit ? route('admin.galeri.update', $id ?? 1) : route('admin.galeri.store') }}">
                @csrf
                <div class="grid">
                    <section class="card">
                        <div class="upload-zone">
                            <div style="font-size: 36px; color: #071f3a; margin-bottom: 12px;"><i class="bi bi-cloud-arrow-up"></i></div>
                            <strong>Pilih Foto atau Video</strong>
                            <p style="font-size: 12px; color: #64748b; margin: 8px 0 16px;">Format JPG, PNG, MP4. Gunakan foto asli kegiatan sekolah.</p>
                            <input type="file" class="custom-input" name="media" accept="image/*,video/*">
                        </div>
                        <div class="field-grid">
                            <div class="input-group">
                                <label>Judul Media</label>
                                <input class="custom-input" name="judul" placeholder="Contoh: Upacara Hari Pendidikan Nasional" required>
                            </div>
                            <div class="input-group">
                                <label>Kategori</label>
                                <select class="custom-select" name="kategori">
                                    <option>Kegiatan Akademik</option>
                                    <option>Ekstrakurikuler</option>
                                    <option>Prestasi</option>
                                    <option>Fasilitas</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-group">
                            <label>Deskripsi</label>
                            <textarea class="custom-textarea" name="deskripsi" placeholder="Tuliskan deskripsi singkat dokumentasi."></textarea>
                        </div>
                    </section>

                    <aside class="card">
                        <h2 style="font-size: 18px; color: #071f3a; margin-bottom: 18px;">Pengaturan Publikasi</h2>
                        <div class="input-group">
                            <label>Status</label>
                            <select class="custom-select" name="status">
                                <option>Publik</option>
                                <option>Draft</option>
                                <option>Arsip</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Tanggal Kegiatan</label>
                            <input type="date" class="custom-input" name="tanggal">
                        </div>
                        <div class="input-group">
                            <label>Alt Text Gambar</label>
                            <input class="custom-input" name="alt" placeholder="Deskripsi singkat untuk aksesibilitas">
                        </div>
                        <div style="display: flex; gap: 10px; margin-top: 22px;">
                            <a href="{{ route('admin.galeri') }}" class="btn-outline">Batal</a>
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
