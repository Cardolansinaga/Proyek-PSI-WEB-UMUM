<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SMAN 2 Balige</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo-sman2-balige.jpg') }}">
    @vite('resources/css/admin.css')
    @include('pages.admin.partials.admin-polish')
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { overflow: hidden; font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); }
        .admin-container { display: flex; height: 100vh; width: 100vw; }
        .sidebar { width: 260px; background: #071f3a; flex-shrink: 0; display: flex; flex-direction: column; color: white; }
        .main-content { flex: 1; overflow-y: auto; scrollbar-width: thin; scrollbar-color: #d6a63a #f8fafc; }
        .main-content::-webkit-scrollbar { width: 8px; }
        .main-content::-webkit-scrollbar-track { background: #f8fafc; }
        .main-content::-webkit-scrollbar-thumb { background: #d6a63a; border-radius: 10px; }
        .content-padding { padding: 34px 30px; max-width: 1320px; margin: 0 auto; width: 100%; }
        .page-head { display: flex; justify-content: space-between; align-items: flex-start; gap: 20px; margin-bottom: 32px; animation: fadeInUp 0.6s ease-out; }
        .page-head h1 { font-size: 36px; color: #071f3a; font-weight: 900; }
        .page-head p { color: #64748b; margin-top: 8px; max-width: 720px; font-size: 14px; line-height: 1.6; }
        .module-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 20px; }
        .card { background: white; border-radius: 14px; padding: 28px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); text-decoration: none; color: inherit; transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: hidden; border-left: 4px solid transparent; }
        .card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 0px; background: linear-gradient(90deg, #d6a63a, #071f3a); opacity: 0; transition: opacity 0.3s ease; }
        .card:hover { transform: translateY(-8px); box-shadow: 0 12px 24px rgba(0,0,0,0.1); border-left-color: #d6a63a; }
        .card:hover::before { opacity: 0; }
        .card span { display: inline-grid; place-items: center; width: 56px; height: 56px; border-radius: 12px; background: linear-gradient(135deg, #d6a63a 0%, #c9962c 100%); color: #071f3a; font-weight: 900; margin-bottom: 16px; font-size: 28px; box-shadow: 0 4px 12px rgba(214, 166, 58, 0.3); }
        .card h2 { font-size: 18px; color: #071f3a; font-weight: 900; margin-top: 12px; }
        .card p { color: #64748b; margin-top: 10px; line-height: 1.65; font-size: 14px; }
        .card:nth-child(1) span { background: linear-gradient(135deg, #d6a63a 0%, #c9962c 100%); }
        .card:nth-child(2) span { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); }
        .card:nth-child(3) span { background: linear-gradient(135deg, #19a99a 0%, #0d9488 100%); }
        .card:nth-child(4) span { background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); }
        .card:nth-child(5) span { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); }
        .status-row { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 18px; margin-bottom: 32px; }
        .status-card { border-left: 4px solid #d6a63a; background: white; border-radius: 14px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); position: relative; overflow: hidden; animation: fadeInUp 0.6s ease-out; }
        .status-card::before { display: none; }
        .status-card > * { position: relative; z-index: 1; color: #071f3a; }
        .status-card strong { display: block; font-size: 32px; font-weight: 900; color: #071f3a; }
        .status-card small { display: block; margin-top: 8px; color: #94a3b8; font-weight: 700; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; }
        .status-card:nth-child(1) { border-left-color: #d6a63a; animation-delay: 0.1s; }
        .status-card:nth-child(2) { border-left-color: #3b82f6; animation-delay: 0.2s; }
        .status-card:nth-child(3) { border-left-color: #19a99a; animation-delay: 0.3s; }
        .status-card:nth-child(4) { border-left-color: #8b5cf6; animation-delay: 0.4s; }
        .card:nth-child(1) { animation: fadeInUp 0.6s ease-out 0.5s both; }
        .card:nth-child(2) { animation: fadeInUp 0.6s ease-out 0.6s both; }
        .card:nth-child(3) { animation: fadeInUp 0.6s ease-out 0.7s both; }
        .card:nth-child(4) { animation: fadeInUp 0.6s ease-out 0.8s both; }
        .card:nth-child(5) { animation: fadeInUp 0.6s ease-out 0.9s both; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
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
                <a href="{{ route('home') }}" class="card" style="padding: 12px 18px; font-weight: 900;"><i class="bi bi-box-arrow-up-right" aria-hidden="true"></i> Lihat Situs Publik</a>
            </div>

            <div class="status-row">
                <div class="status-card"><strong>5</strong><small>Modul aktif</small></div>
                <div class="status-card"><strong>3</strong><small>Section Beranda</small></div>
                <div class="status-card"><strong>200</strong><small>Halaman utama aktif</small></div>
                <div class="status-card"><strong>302</strong><small>Route lama dialihkan</small></div>
            </div>

            <div class="module-grid">
                <a href="{{ route('admin.beranda') }}" class="card"><span><i class="bi bi-house-door" aria-hidden="true"></i></span><h2>Beranda</h2><p>Profil sekolah, berita & pengumuman, galeri, sambutan, dan CTA PPDB.</p></a>
                <a href="{{ route('prestasi.index') }}" class="card"><span><i class="bi bi-mortarboard" aria-hidden="true"></i></span><h2>Akademik & Prestasi</h2><p>Kurikulum, fasilitas akademik, layanan belajar, dan prestasi siswa.</p></a>
                <a href="{{ route('admin.kesiswaan.index') }}" class="card"><span><i class="bi bi-people" aria-hidden="true"></i></span><h2>Kesiswaan & Ekstrakurikuler</h2><p>OSIS, MPK, agenda kesiswaan, pembinaan karakter, dan ekstrakurikuler.</p></a>
                <a href="{{ route('admin.ppdb') }}" class="card"><span><i class="bi bi-journal-check" aria-hidden="true"></i></span><h2>PPDB</h2><p>Informasi penerimaan, jadwal, dokumen, dan verifikasi pendaftar.</p></a>
                <a href="{{ route('admin.pengaturan') }}" class="card"><span><i class="bi bi-gear" aria-hidden="true"></i></span><h2>Pengaturan Situs</h2><p>Identitas sekolah, kontak resmi, status situs, dan akun admin.</p></a>
            </div>
        </main>
    </div>
</div>
</body>
</html>
