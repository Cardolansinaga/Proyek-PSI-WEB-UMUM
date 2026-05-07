<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail PPDB - SMAN 2 Balige</title>
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
        .grid { display: grid; grid-template-columns: minmax(0, 1fr) 340px; gap: 22px; }
        .card { background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; box-shadow: 0 8px 20px rgba(15,23,42,.06); }
        .info-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 14px; }
        .info { padding: 14px; border: 1px solid #edf2f7; border-radius: 10px; background: #f8fafc; }
        .info span { display: block; font-size: 11px; color: #64748b; font-weight: 900; text-transform: uppercase; margin-bottom: 6px; }
        .info strong { color: #071f3a; }
        .doc-row { display: flex; justify-content: space-between; gap: 12px; padding: 14px 0; border-bottom: 1px solid #edf2f7; }
        .badge { border-radius: 999px; padding: 6px 10px; font-size: 11px; font-weight: 900; background: #dcfce7; color: #166534; }
        .btn-primary, .btn-outline, .btn-danger { border-radius: 10px; padding: 12px 16px; font-weight: 900; text-decoration: none; cursor: pointer; border: 1px solid transparent; }
        .btn-primary { background: #071f3a; color: white; }
        .btn-outline { background: white; color: #071f3a; border-color: #d9e1ec; }
        .btn-danger { background: #fff1f2; color: #be123c; border-color: #fecdd3; }
        @media (max-width: 900px) { .grid, .info-grid { grid-template-columns: 1fr; } .page-head { flex-direction: column; } }
    </style>
    @include('pages.admin.partials.responsive')
</head>
<body>
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'ppdb'])
    <div class="main-content">
        <main class="content-padding">
            <div class="page-head">
                <div>
                    <h1>Detail Pendaftar PPDB</h1>
                    <p>Periksa data calon siswa, kelengkapan berkas, dan status verifikasi pendaftaran.</p>
                </div>
                <a href="{{ route('admin.ppdb') }}" class="btn-outline">Kembali ke PPDB</a>
            </div>

            <div class="grid">
                <section class="card">
                    <h2 style="font-size: 18px; color: #071f3a; margin-bottom: 18px;">Data Calon Siswa</h2>
                    <div class="info-grid">
                        <div class="info"><span>No. Registrasi</span><strong>REG-2026-{{ str_pad((string)($id ?? 1), 3, '0', STR_PAD_LEFT) }}</strong></div>
                        <div class="info"><span>Status</span><strong>Menunggu Verifikasi</strong></div>
                        <div class="info"><span>Nama Lengkap</span><strong>Andi Wijaya</strong></div>
                        <div class="info"><span>Jalur Pendaftaran</span><strong>Zonasi</strong></div>
                        <div class="info"><span>Asal Sekolah</span><strong>SMPN 1 Balige</strong></div>
                        <div class="info"><span>Nomor Kontak</span><strong>+62 812-1234-5678</strong></div>
                        <div class="info"><span>Nama Orang Tua</span><strong>Parningotan Wijaya</strong></div>
                        <div class="info"><span>Alamat</span><strong>Jl. Sisingamangaraja, Balige</strong></div>
                    </div>
                </section>

                <aside class="card">
                    <h2 style="font-size: 18px; color: #071f3a; margin-bottom: 18px;">Aksi Verifikasi</h2>
                    <form method="POST" action="{{ route('admin.ppdb.verify', $id ?? 1) }}" style="display: grid; gap: 12px;">
                        @csrf
                        <button type="submit" name="status" value="verified" class="btn-primary">Terverifikasi</button>
                        <button type="submit" name="status" value="revision" class="btn-outline">Minta Revisi Berkas</button>
                        <button type="submit" name="status" value="rejected" class="btn-danger">Tolak Pendaftaran</button>
                    </form>
                </aside>

                <section class="card" style="grid-column: 1 / -1;">
                    <h2 style="font-size: 18px; color: #071f3a; margin-bottom: 10px;">Kelengkapan Berkas</h2>
                    <div class="doc-row"><strong>Akta Kelahiran</strong><span class="badge">Lengkap</span></div>
                    <div class="doc-row"><strong>Kartu Keluarga</strong><span class="badge">Lengkap</span></div>
                    <div class="doc-row"><strong>Rapor Semester Terakhir</strong><span class="badge">Lengkap</span></div>
                    <div class="doc-row"><strong>Pas Foto</strong><span class="badge">Lengkap</span></div>
                </section>
            </div>
        </main>
    </div>
</div>
</body>
</html>
