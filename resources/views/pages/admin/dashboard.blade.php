<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SMAN 2 Balige</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { overflow: hidden; font-family: 'Inter', sans-serif; background: #f8fafc; }
        .admin-container { display: flex; height: 100vh; width: 100vw; }
        .sidebar { width: 260px; background: #071f3a; flex-shrink: 0; display: flex; flex-direction: column; color: white; }
        .main-content { flex: 1; overflow-y: auto; }
        .content-padding { padding: 34px 30px; max-width: 1320px; margin: 0 auto; width: 100%; }
        .page-head { display: flex; justify-content: space-between; align-items: flex-start; gap: 20px; margin-bottom: 24px; }
        .page-head h1 { font-size: 34px; color: #071f3a; font-weight: 900; }
        .page-head p { color: #64748b; margin-top: 8px; max-width: 720px; }
        .module-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px; }
        .card { background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; box-shadow: 0 8px 20px rgba(15,23,42,.06); text-decoration: none; color: inherit; }
        .card:hover { transform: translateY(-2px); box-shadow: 0 14px 28px rgba(15,23,42,.09); }
        .card span { display: inline-grid; place-items: center; width: 42px; height: 42px; border-radius: 10px; background: #eef6ff; color: #071f3a; font-weight: 900; margin-bottom: 18px; }
        .card h2 { font-size: 20px; color: #071f3a; font-weight: 900; }
        .card p { color: #64748b; margin-top: 8px; line-height: 1.65; }
        .status-row { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 16px; margin-bottom: 22px; }
        .status-card { background: #071f3a; color: white; border-radius: 12px; padding: 20px; }
        .status-card strong { display: block; font-size: 26px; }
        .status-card small { display: block; margin-top: 6px; color: rgba(255,255,255,.72); font-weight: 800; }
        @media (max-width: 1080px) { .module-grid, .status-row { grid-template-columns: 1fr; } .page-head { flex-direction: column; } }
    </style>
    @include('pages.admin.partials.responsive')
</head>
<body>
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'dashboard'])
    <div class="main-content">
        <main class="content-padding">
            <div class="page-head">
                <div>
                    <h1>Dashboard Admin</h1>
                    <p>Panel admin sekarang mengikuti struktur website publik. Gunakan modul di bawah untuk mengelola Beranda, Akademik & Prestasi, Kesiswaan & Ekstrakurikuler, PPDB, dan pengaturan situs.</p>
                </div>
                <a href="{{ route('home') }}" class="card" style="padding: 12px 18px; font-weight: 900;">Lihat Situs Publik</a>
            </div>

            <div class="status-row">
                <div class="status-card"><strong>5</strong><small>Modul aktif</small></div>
                <div class="status-card"><strong>3</strong><small>Section Beranda</small></div>
                <div class="status-card"><strong>200</strong><small>Halaman utama aktif</small></div>
                <div class="status-card"><strong>302</strong><small>Route lama dialihkan</small></div>
            </div>

            <div class="module-grid">
                <a href="{{ route('admin.beranda') }}" class="card"><span>B</span><h2>Beranda</h2><p>Profil sekolah, berita & pengumuman, galeri, sambutan, dan CTA PPDB.</p></a>
                <a href="{{ route('prestasi.index') }}" class="card"><span>A</span><h2>Akademik & Prestasi</h2><p>Kurikulum, fasilitas akademik, layanan belajar, dan prestasi siswa.</p></a>
                <a href="{{ route('admin.kesiswaan.index') }}" class="card"><span>K</span><h2>Kesiswaan & Ekstrakurikuler</h2><p>OSIS, MPK, agenda kesiswaan, pembinaan karakter, dan ekstrakurikuler.</p></a>
                <a href="{{ route('admin.ppdb') }}" class="card"><span>P</span><h2>PPDB</h2><p>Informasi penerimaan, jadwal, dokumen, dan verifikasi pendaftar.</p></a>
                <a href="{{ route('admin.pengaturan') }}" class="card"><span>S</span><h2>Pengaturan Situs</h2><p>Identitas sekolah, kontak resmi, status situs, dan akun admin.</p></a>
            </div>
        </main>
    </div>
</div>
</body>
</html>
