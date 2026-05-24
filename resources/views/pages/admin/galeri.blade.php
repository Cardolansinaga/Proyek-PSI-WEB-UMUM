<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Galeri - SMAN 2 Balige</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('pages.admin.partials.admin-polish')
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { overflow:hidden; font-family:Inter, sans-serif; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); }
        .admin-container { display:flex; height:100vh; }
        main { flex:1; overflow-y:auto; padding:32px; max-width:1320px; margin:0 auto; width:100%; }
        .page-header { margin-bottom: 32px; }
        .page-header h1 { font-size:36px; font-weight:900; color:#071f3a; }
        .page-header p { color:#64748b; margin:8px 0 0; font-size: 14px; }
        .status-message { margin:12px 0 0; color:#166534; font-weight:900; padding:10px 12px; background:#dcfce7; border-radius:8px; display:inline-block; font-size:13px; }
        .grid { display:grid; grid-template-columns:380px 1fr; gap:24px; }
        .card { background:white; border-radius:14px; padding:28px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
        .card h2 { font-size:22px; font-weight:900; color:#071f3a; margin-bottom:20px; }
        label { display:block; font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing: 0.5px; margin-bottom:10px; }
        input, select, textarea { width:100%; border:1px solid #d9e1ec; border-radius:10px; padding:12px 14px; font:inherit; margin-bottom:16px; color: #071f3a; background: white; transition: all 0.3s ease; }
        input:hover, select:hover, textarea:hover { border-color: #d6a63a; box-shadow: 0 2px 8px rgba(214, 166, 58, 0.1); }
        input:focus, select:focus, textarea:focus { outline: none; border-color: #071f3a; box-shadow: 0 4px 12px rgba(7, 31, 58, 0.15); }
        textarea { min-height:90px; }
        .btn { border-radius:10px; padding:12px 18px; font-weight:900; text-decoration:none; background: linear-gradient(135deg, #071f3a 0%, #0f2847 100%); color:white; border:0; cursor:pointer; box-shadow: 0 4px 12px rgba(7, 31, 58, 0.2); transition: all 0.3s ease; }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(7, 31, 58, 0.3); }
        .image-preview { min-height: 130px; border-radius: 12px; border: 1px solid #d9e1ec; background: #f4f7fb center/cover no-repeat; display: grid; place-items: center; color: #64748b; font-size: 12px; font-weight: 800; overflow: hidden; margin-bottom: 14px; }
        .check-row { display: flex; gap: 10px; align-items: flex-start; color: #071f3a; font-size: 13px; font-weight: 800; line-height: 1.5; margin-bottom: 14px; }
        .check-row input { width: auto; margin-top: 3px; margin-bottom: 0; }
        .row { display:grid; grid-template-columns:1fr auto; gap:12px; align-items:flex-start; border-bottom:1px solid #f1f5f9; padding:18px 0; transition: all 0.2s ease; }
        .row:hover { background-color: #f8fafc; padding: 18px 12px; border-radius: 8px; margin: 0 -12px; }
        .row form { margin: 0; }
        @media (max-width:900px) { .grid { grid-template-columns:1fr; } .row { grid-template-columns: 1fr; } }
        @media (max-width:520px) {
            main { padding: 20px 14px; }
            .card { padding: 20px; }
            .row [style*="grid-template-columns: 1fr 1fr"] { grid-template-columns: 1fr !important; }
            .row [style*="display: flex"] { width: 100%; }
            .row .btn { width: 100%; }
        }
    </style>
    @include('pages.admin.partials.responsive')
</head>
<body>
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'galeri'])
    <main>
        <div class="page-header">
            <h1>Manajemen Galeri</h1>
            <p>Galeri yang disimpan tampil pada Beranda publik.</p>
            @if (session('status'))
                <p class="status-message">✓ {{ session('status') }}</p>
            @endif
        </div>
        <div class="grid">
            <form class="card" method="POST" action="{{ route('admin.galeri.store') }}" enctype="multipart/form-data">
                @csrf
                <h2>Tambah Galeri Baru</h2>
                <label>Judul Galeri</label><input name="title" required placeholder="Masukkan judul galeri">
                <label>Deskripsi</label><textarea name="description" placeholder="Masukkan deskripsi singkat galeri"></textarea>
                <label>Tipe Visual</label><select name="image_class">@foreach(['library' => 'Perpustakaan','lab' => 'Laboratorium','hall' => 'Aula','court' => 'Lapangan'] as $val => $label)<option value="{{ $val }}">{{ $label }}</option>@endforeach</select>
                <label>Upload Gambar</label><input type="file" name="image" accept="image/png,image/jpeg,image/webp">
                <label>Status Publikasi</label><select name="status"><option value="published">Dipublikasikan</option><option value="draft">Draft</option></select>
                <button class="btn" type="submit">Simpan Galeri Baru</button>
            </form>
            <section class="card">
                <h2>Daftar Galeri ({{ $galleries->count() }})</h2>
                @if($galleries->count() > 0)
                    @foreach ($galleries as $gallery)
                        <div class="row">
                            <form id="gallery-update-{{ $gallery->id }}" method="POST" action="{{ route('admin.galeri.update', $gallery) }}" enctype="multipart/form-data">
                                @csrf
                                <div style="display: grid; gap: 10px; flex: 1;">
                                    <input name="title" value="{{ $gallery->title }}" required placeholder="Judul galeri">
                                    <textarea name="description" placeholder="Deskripsi" style="margin-bottom: 0; min-height: 60px;">{{ $gallery->description }}</textarea>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                                        <select name="image_class">@foreach(['library' => 'Perpustakaan','lab' => 'Laboratorium','hall' => 'Aula','court' => 'Lapangan'] as $val => $label)<option value="{{ $val }}" @selected($gallery->image_class === $val)>{{ $label }}</option>@endforeach</select>
                                        <select name="status"><option value="published" @selected($gallery->status === 'published')>Dipublikasikan</option><option value="draft" @selected($gallery->status === 'draft')>Draft</option></select>
                                    </div>
                                    @if (! empty($gallery->image_path))
                                        <div class="image-preview" style="background-image: url('{{ asset('storage/'.$gallery->image_path) }}');"></div>
                                        <label class="check-row">
                                            <input type="checkbox" name="remove_image" value="1">
                                            Hapus gambar custom
                                        </label>
                                    @else
                                        <div class="image-preview">Gambar bawaan aktif</div>
                                    @endif
                                    <input type="file" name="image" accept="image/png,image/jpeg,image/webp">
                                </div>
                            </form>
                            <div style="display: flex; gap: 8px; align-items: flex-start; padding-top: 4px; flex-wrap: wrap;">
                                <button class="btn" type="submit" form="gallery-update-{{ $gallery->id }}" style="padding: 12px 16px; white-space: nowrap;">Update</button>
                                <form method="POST" action="{{ route('admin.galeri.destroy', $gallery) }}" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" style="padding: 12px 16px; background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%); white-space: nowrap;" onclick="return confirm('Hapus galeri ini?')">Hapus</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p style="color: #94a3b8; font-size: 14px; padding: 20px 0; text-align: center;">Belum ada galeri yang ditambahkan</p>
                @endif
            </section>
        </div>
    </main>
</div>
</body>
</html>
