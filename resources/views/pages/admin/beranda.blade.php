<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Beranda - SMAN 2 Balige</title>
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
        .btn-primary, .btn-outline { border-radius: 10px; padding: 12px 18px; font-weight: 900; text-decoration: none; cursor: pointer; }
        .btn-primary { background: #071f3a; color: white; border: 1px solid #071f3a; }
        .btn-outline { background: white; color: #071f3a; border: 1px solid #d9e1ec; }
        .overview-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 16px; margin-bottom: 22px; }
        .management-grid { display: grid; grid-template-columns: minmax(0, 1.35fr) minmax(320px, .75fr); gap: 20px; }
        .card { background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; box-shadow: 0 8px 20px rgba(15,23,42,.06); }
        .card h2 { font-size: 18px; color: #071f3a; font-weight: 900; margin-bottom: 16px; }
        .field-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
        .input-group { display: grid; gap: 8px; margin-bottom: 16px; }
        .input-group label { font-size: 11px; font-weight: 900; color: #64748b; text-transform: uppercase; }
        .custom-input, .custom-select, .custom-textarea { width: 100%; border: 1px solid #d9e1ec; border-radius: 10px; padding: 12px 14px; font: inherit; color: #071f3a; background: white; }
        .custom-textarea { min-height: 118px; resize: vertical; }
        .stack { display: grid; gap: 18px; }
        .content-list { display: grid; gap: 12px; }
        .content-row { display: grid; grid-template-columns: 1fr auto; gap: 14px; align-items: center; border: 1px solid #edf2f7; border-radius: 10px; padding: 14px; background: #fbfdff; }
        .content-row strong { color: #071f3a; display: block; }
        .content-row span { color: #64748b; font-size: 12px; }
        .status-pill { display: inline-flex; border-radius: 999px; padding: 6px 10px; background: #ecfdf5; color: #166534; font-size: 11px; font-weight: 900; }
        .note { border-left: 4px solid #c9962c; background: #fff8e7; padding: 14px; border-radius: 10px; color: #7c5a10; font-size: 13px; line-height: 1.6; }
        @media (max-width: 1080px) { .overview-grid, .management-grid, .field-grid { grid-template-columns: 1fr; } .page-head { flex-direction: column; } }
    </style>
    @include('pages.admin.partials.responsive')
</head>
<body>
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'beranda'])
    <div class="main-content">
        <main class="content-padding">
            <div class="page-head">
                <div>
                    <h1>Manajemen Beranda</h1>
                    <p>Kelola semua bagian yang sekarang tampil di Beranda publik: profil sekolah, sambutan, berita & pengumuman, galeri, dan CTA PPDB.</p>
                </div>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <a href="{{ route('home') }}" class="btn-outline">Lihat Beranda Publik</a>
                    <button type="submit" form="home-form" class="btn-primary">Simpan Beranda</button>
                </div>
            </div>

            <div class="overview-grid">
                <article class="card"><span class="status-pill">Aktif</span><h2 style="margin-top: 18px;">Profil</h2><p>Hero, profil, sejarah, visi, misi, dan sambutan.</p></article>
                <article class="card"><span class="status-pill">Aktif</span><h2 style="margin-top: 18px;">Berita</h2><p>3 pembaruan tampil langsung di section Beranda.</p></article>
                <article class="card"><span class="status-pill">Aktif</span><h2 style="margin-top: 18px;">Galeri</h2><p>4 item galeri ringkas untuk kesan visual sekolah.</p></article>
                <article class="card"><span class="status-pill">Aktif</span><h2 style="margin-top: 18px;">CTA PPDB</h2><p>Tombol diarahkan ke halaman Informasi PPDB.</p></article>
            </div>

            <form id="home-form" method="POST" action="{{ route('admin.pengumuman.store') }}">
                @csrf
                <div class="management-grid">
                    <div class="stack">
                        <section class="card">
                            <h2>Konten Utama Beranda</h2>
                            <div class="field-grid">
                                <div class="input-group">
                                    <label>Judul Hero</label>
                                    <input class="custom-input" name="hero_title" value="Membangun Generasi Unggul & Berkarakter">
                                </div>
                                <div class="input-group">
                                    <label>Label CTA</label>
                                    <input class="custom-input" name="cta_label" value="Informasi PPDB">
                                </div>
                            </div>
                            <div class="input-group">
                                <label>Ringkasan Profil</label>
                                <textarea class="custom-textarea" name="profile_summary">SMAN 2 Balige memadukan keteguhan tradisi, disiplin, literasi digital, dan pendampingan prestasi agar setiap siswa berkembang sebagai pribadi yang cerdas, santun, dan siap bersaing.</textarea>
                            </div>
                        </section>

                        <section class="card">
                            <h2>Berita & Pengumuman di Beranda</h2>
                            <div class="content-list">
                                <div class="content-row"><div><strong>Penerimaan Siswa Baru Tahun Ajaran 2026/2027</strong><span>PPDB / 12 Mei 2026</span></div><button class="btn-outline" type="button">Edit</button></div>
                                <div class="content-row"><div><strong>Tim Sains Sekolah Siap Mengikuti Seleksi Olimpiade</strong><span>Prestasi / 08 Mei 2026</span></div><button class="btn-outline" type="button">Edit</button></div>
                                <div class="content-row"><div><strong>LDKS Menumbuhkan Kepemimpinan yang Berkarakter</strong><span>Kesiswaan / 01 Mei 2026</span></div><button class="btn-outline" type="button">Edit</button></div>
                            </div>
                        </section>
                    </div>

                    <aside class="stack">
                        <section class="card">
                            <h2>Galeri Beranda</h2>
                            <div class="content-list">
                                <div class="content-row"><div><strong>Perpustakaan</strong><span>Tile galeri aktif</span></div><button class="btn-outline" type="button">Edit</button></div>
                                <div class="content-row"><div><strong>Lab Digital</strong><span>Tile galeri aktif</span></div><button class="btn-outline" type="button">Edit</button></div>
                                <div class="content-row"><div><strong>Ruang Belajar</strong><span>Tile galeri aktif</span></div><button class="btn-outline" type="button">Edit</button></div>
                                <div class="content-row"><div><strong>Lapangan Olahraga</strong><span>Tile galeri aktif</span></div><button class="btn-outline" type="button">Edit</button></div>
                            </div>
                        </section>

                        <section class="card">
                            <h2>Status Publikasi</h2>
                            <div class="input-group">
                                <label>Mode Publikasi</label>
                                <select class="custom-select" name="publish_mode">
                                    <option>Publik</option>
                                    <option>Draft</option>
                                </select>
                            </div>
                            <div class="note">Modul Pengumuman dan Galeri tidak dipisah lagi karena keduanya sekarang menjadi bagian dari Beranda publik.</div>
                        </section>
                    </aside>
                </div>
            </form>
        </main>
    </div>
</div>
</body>
</html>
