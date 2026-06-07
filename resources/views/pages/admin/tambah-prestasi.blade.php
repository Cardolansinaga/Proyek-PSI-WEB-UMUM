<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ($mode ?? 'create') === 'edit' ? 'Edit Prestasi' : 'Tambah Prestasi' }} - SMAN 2 Balige</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo-sman2-balige.jpg') }}">
    @vite('resources/css/admin.css')
    @include('pages.admin.partials.admin-polish')
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { overflow-x: hidden; font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif; background-color: #f8fafc; }
        .admin-container { display: flex; min-height: 100vh; width: 100vw; }
        .main-content { flex: 1; }
        .content-padding { padding: 40px; max-width: 1200px; margin: 0 auto; width: 100%; }
        .form-grid { display: grid; grid-template-columns: 1fr 320px; gap: 32px; margin-top: 32px; }
        .card { background: white; border: 1px solid #f1f5f9; border-radius: 16px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 24px; }
        .input-group { margin-bottom: 20px; }
        .input-group label { display: block; font-size: 11px; font-weight: 900; color: #64748b; text-transform: uppercase; margin-bottom: 8px; }
        .custom-input, .custom-textarea { width: 100%; padding: 12px 16px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; color: #1e293b; outline: none; }
        .custom-textarea { min-height: 150px; resize: vertical; }
        .btn-save, .btn-cancel { padding: 12px 24px; border-radius: 12px; font-weight: 900; text-decoration: none; cursor: pointer; }
        .btn-save { background: #071f3a; color: white; border: 1px solid #071f3a; }
        .btn-cancel { background: white; border: 1px solid #e2e8f0; color: #475569; }
        .image-preview { min-height: 150px; border-radius: 12px; border: 1px solid #d9e1ec; background: #f4f7fb center/cover no-repeat; display: grid; place-items: center; color: #64748b; font-size: 12px; font-weight: 800; overflow: hidden; }
        .check-row { display: flex; gap: 10px; align-items: flex-start; color: #071f3a; font-size: 13px; font-weight: 800; line-height: 1.5; }
        .check-row input { width: auto; margin-top: 3px; }
        @media (max-width: 900px) { .form-grid { grid-template-columns: 1fr; } }
    </style>
    @include('pages.admin.partials.responsive')
</head>
<body>
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'prestasi'])
    <div class="main-content">
        <main class="content-padding">
            @php($isEdit = ($mode ?? 'create') === 'edit')
            <form id="achievement-form" method="POST" action="{{ $isEdit ? route('admin.prestasi.update', $achievement) : route('admin.prestasi.store') }}" enctype="multipart/form-data">
                @csrf
                <div style="display:flex; justify-content:space-between; gap:20px; align-items:flex-start; margin-bottom:32px;">
                    <div>
                        <h1 style="font-size:36px; font-weight:900; color:#071f3a;">{{ $isEdit ? 'Edit Prestasi' : 'Tambah Prestasi' }}</h1>
                        <p style="color:#64748b; margin-top:8px;">Data yang disimpan akan langsung tersedia untuk halaman publik jika statusnya published.</p>
                    </div>
                    <div style="display:flex; gap:12px;">
                        <a href="{{ route('prestasi.index') }}" class="btn-cancel"><i class="bi bi-x-circle" aria-hidden="true"></i> Batal</a>
                        <button class="btn-save" type="submit"><i class="bi bi-save" aria-hidden="true"></i> Simpan Data</button>
                    </div>
                </div>

                <div class="form-grid">
                    <section class="card">
                        <h2 style="font-size:18px; font-weight:900; color:#071f3a; margin-bottom:24px;"><i class="bi bi-trophy" aria-hidden="true"></i> Informasi Utama</h2>
                        <div class="input-group">
                            <label>Nama Prestasi / Nama Lomba</label>
                            <input name="title" class="custom-input" value="{{ old('title', $achievement->title) }}" required>
                        </div>
                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                            <div class="input-group">
                                <label>Tingkat Prestasi</label>
                                <select name="level" class="custom-input">
                                    @foreach (['Sekolah', 'Kabupaten', 'Provinsi', 'Nasional', 'Internasional'] as $level)
                                        <option value="{{ $level }}" @selected(old('level', $achievement->level) === $level)>{{ $level }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group">
                                <label>Tahun Perolehan</label>
                                <input type="number" name="year" class="custom-input" value="{{ old('year', $achievement->year ?? now()->year) }}" required>
                            </div>
                        </div>
                        <div class="input-group">
                            <label>Nama Siswa atau Tim</label>
                            <input name="student_name" class="custom-input" value="{{ old('student_name', $achievement->student_name) }}">
                        </div>
                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                            <div class="input-group">
                                <label>Kelas</label>
                                <input name="class_name" class="custom-input" value="{{ old('class_name', $achievement->class_name) }}">
                            </div>
                            <div class="input-group">
                                <label>Peringkat</label>
                                <input name="rank" class="custom-input" value="{{ old('rank', $achievement->rank) }}">
                            </div>
                        </div>
                        <div class="input-group">
                            <label>Kompetisi</label>
                            <input name="competition" class="custom-input" value="{{ old('competition', $achievement->competition) }}">
                        </div>
                        <div class="input-group">
                            <label>Deskripsi & Narasi</label>
                            <textarea name="description" class="custom-textarea">{{ old('description', $achievement->description) }}</textarea>
                        </div>
                    </section>

                    <aside class="card">
                        <h2 style="font-size:18px; font-weight:900; color:#071f3a; margin-bottom:24px;"><i class="bi bi-broadcast" aria-hidden="true"></i> Publikasi</h2>
                        <div class="input-group">
                            <label>Status</label>
                            <select name="status" class="custom-input">
                                <option value="published" @selected(old('status', $achievement->status) === 'published')>Published</option>
                                <option value="draft" @selected(old('status', $achievement->status) === 'draft')>Draft</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Visual Card</label>
                            <select name="image_class" class="custom-input">
                                @foreach (['victory', 'speech', 'runner', 'dance'] as $visual)
                                    <option value="{{ $visual }}" @selected(old('image_class', $achievement->image_class) === $visual)>{{ ucfirst($visual) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Gambar Prestasi</label>
                            @if (! empty($achievement->image_path))
                                <div class="image-preview" style="background-image: url('{{ asset('storage/'.$achievement->image_path) }}');"></div>
                                <label class="check-row">
                                    <input type="checkbox" name="remove_image" value="1">
                                    Hapus gambar custom
                                </label>
                            @else
                                <div class="image-preview">Belum ada gambar custom</div>
                            @endif
                            <input type="file" name="image" class="custom-input" accept="image/png,image/jpeg,image/webp">
                        </div>
                        <label style="display:flex; gap:10px; align-items:center; font-weight:900; color:#071f3a;">
                            <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $achievement->is_featured))>
                            Tampilkan sebagai prestasi unggulan
                        </label>
                    </aside>
                </div>
            </form>
        </main>
    </div>
</div>
</body>
</html>
