<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Guru & Staf - SMAN 2 Balige</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { overflow: hidden; font-family: 'Inter', sans-serif; background-color: #f8fafc; }

        .admin-container { display: flex; height: 100vh; width: 100vw; }

        /* SIDEBAR */
        .sidebar { width: 260px; background-color: #071f3a; flex-shrink: 0; display: flex; flex-direction: column; color: white; }
        .nav-item { padding: 12px 16px; display: flex; align-items: center; gap: 12px; font-size: 14px; font-weight: 500; color: #94a3b8; text-decoration: none; transition: all 0.2s; }
        .nav-item:hover { color: white; background: rgba(255,255,255,0.05); border-radius: 12px; }
        .active-nav { background: rgba(255,255,255,0.1); color: white; border-radius: 12px; font-weight: 700; border-left: 4px solid #10b981; }

        /* CONTENT AREA */
        .main-content { flex-grow: 1; overflow-y: auto; display: flex; flex-direction: column; }
        .header { height: 70px; background: white; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; padding: 0 32px; position: sticky; top: 0; z-index: 10; }

        /* DIRECTORY STYLES */
        .content-padding { padding: 32px; }
        .faculty-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px; margin-top: 32px; }
        .faculty-card { background: white; border-radius: 20px; overflow: hidden; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); position: relative; }
        .faculty-image { height: 220px; width: 100%; object-fit: cover; }
        
        /* SEARCH & FILTER */
        .filter-container { background: white; padding: 20px; border-radius: 16px; display: flex; gap: 16px; align-items: center; margin-top: 24px; border: 1px solid #f1f5f9; }
        .search-box { flex-grow: 1; position: relative; }
        .search-box input { width: 100%; padding: 12px 16px 12px 40px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 14px; }
        .filter-select { padding: 12px; border: 1px solid #e2e8f0; border-radius: 12px; background: #f8fafc; font-size: 14px; color: #64748b; outline: none; }

        .btn-primary { background: #071f3a; color: white; padding: 12px 20px; border-radius: 12px; font-weight: 700; border: none; cursor: pointer; display: flex; align-items: center; gap: 8px; transition: 0.3s; }
        .btn-primary:hover { background: #0c2d54; }
        .btn-outline { background: white; border: 1px solid #e2e8f0; padding: 12px 20px; border-radius: 12px; font-weight: 700; color: #475569; cursor: pointer; display: flex; align-items: center; gap: 8px; transition: 0.3s; }
        .btn-outline:hover { background: #f8fafc; }

        /* PAGINATION STYLES */
        .pagination-container { display: flex; justify-content: space-between; align-items: center; margin-top: 40px; padding: 24px 0; border-top: 1px solid #e2e8f0; }
        .pagination-info { font-size: 14px; color: #64748b; }
        .pagination-info span { font-weight: 700; color: #1e293b; }
        .pagination-buttons { display: flex; gap: 8px; align-items: center; }
        .page-btn { width: 40px; height: 40px; display: grid; place-items: center; border-radius: 10px; border: 1px solid #e2e8f0; background: white; color: #64748b; font-weight: 600; cursor: pointer; text-decoration: none; transition: 0.2s; }
        .page-btn:hover { background: #f8fafc; border-color: #cbd5e1; }
        .page-btn.active { background: #071f3a; color: white; border-color: #071f3a; box-shadow: 0 4px 12px rgba(7, 31, 58, 0.2); }
        .arrow-btn { width: 40px; height: 40px; display: grid; place-items: center; border-radius: 10px; background: #f8fafc; color: #94a3b8; border: none; cursor: pointer; }
        
        .floating-add-btn { position: fixed; bottom: 32px; right: 32px; width: 60px; height: 60px; background: #071f3a; color: white; border-radius: 50%; display: grid; place-items: center; font-size: 24px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.3); cursor: pointer; border: none; z-index: 100; transition: 0.3s; }
        .floating-add-btn:hover { transform: scale(1.1); background: #d6a63a; }
    </style>
</head>
<body>

<div class="admin-container">
    <aside class="sidebar">
        <div style="padding: 32px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 32px;">
                <div style="background: #d6a63a; width: 40px; height: 40px; border-radius: 10px; display: grid; place-items: center; font-weight: 900; color: white;">S2</div>
                <div>
                    <div style="font-size: 14px; font-weight: 900; line-height: 1;">SMAN 2 Balige</div>
                    <div style="font-size: 10px; color: #94a3b8;">Portal Admin</div>
                </div>
            </div>
            
            <nav style="display: flex; flex-direction: column; gap: 4px;">
                <a href="{{ route('dashboard') }}" class="nav-item">📊 Dashboard</a>
                <a href="#" class="nav-item">📰 Berita</a>
                <a href="#" class="nav-item">📢 Pengumuman</a>
                <a href="#" class="nav-item">🏅 Prestasi</a>
                <a href="{{ route('guru.index') }}" class="nav-item active-nav">👥 Guru & Staf</a>
                <a href="#" class="nav-item">🎓 Kesiswaan</a>
                <a href="#" class="nav-item">📝 PPDB</a>
                <a href="#" class="nav-item">🖼️ Galeri</a>
                <a href="#" class="nav-item">⚙️ Pengaturan</a>
            </nav>
        </div>
        
        <div style="margin-top: auto; padding: 32px;">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="color: #f87171; background: none; border: none; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                    <span>🚪 Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <div class="main-content">
        <header class="header">
            <div style="font-size: 12px; font-weight: 800; color: #94a3b8; letter-spacing: 1px;">
                PANEL ADMIN <span style="margin: 0 8px; color: #e2e8f0;">/</span> <span style="color: #64748b;">Manajemen Guru & Staf</span>
            </div>
            <div style="display: flex; align-items: center; gap: 24px;">
                <div style="text-align: right;">
                    <div style="font-size: 13px; font-weight: 900; color: #071f3a;">{{ Auth::user()->name }}</div>
                    <div style="font-size: 10px; font-weight: 700; color: #3b82f6;">ADMIN UTAMA</div>
                </div>
                <div style="width: 35px; height: 35px; background: #071f3a; border-radius: 50%; display: grid; place-items: center; color: white; font-size: 12px; font-weight: 800;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
            </div>
        </header>

        <main class="content-padding">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                <div>
                    <h1 style="font-size: 36px; font-weight: 800; color: #071f3a;">Direktori Akademik</h1>
                    <p style="color: #64748b; font-size: 14px; margin-top: 8px;">Kelola data guru, kepala departemen, dan staf administrasi SMAN 2 Balige.</p>
                </div>
                <div style="display: flex; gap: 12px;">
                    <button class="btn-outline">📥 Ekspor Daftar</button>
                    <button class="btn-primary">👤 Tambah Anggota Guru</button>
                </div>
            </div>

            <!-- SEARCH & FILTER -->
            <div class="filter-container">
                <div class="search-box">
                    <span style="position: absolute; left: 15px; top: 12px; color: #94a3b8;">🔍</span>
                    <input type="text" placeholder="Cari berdasarkan nama, mata pelajaran, atau NIP...">
                </div>
                <select class="filter-select">
                    <option>Semua Departemen</option>
                    <option>Matematika</option>
                    <option>Sains</option>
                    <option>Bahasa</option>
                </select>
                <select class="filter-select">
                    <option>Status: Aktif</option>
                    <option>Status: Cuti</option>
                </select>
            </div>

            <div class="faculty-grid">
                <!-- Card Guru 1 -->
                <div class="faculty-card">
                    <div style="position: relative;">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400" class="faculty-image" alt="Guru">
                        <span style="position: absolute; top: 15px; right: 15px; background: #dcfce7; color: #166534; padding: 4px 12px; border-radius: 20px; font-size: 10px; font-weight: 800;">AKTIF</span>
                    </div>
                    <div style="padding: 24px;">
                        <div style="font-size: 10px; font-weight: 800; color: #94a3b8; letter-spacing: 1px; margin-bottom: 8px;">DEPARTEMEN MATEMATIKA</div>
                        <h3 style="font-size: 18px; font-weight: 800; color: #071f3a;">Dra. Marianna Sitorus</h3>
                        <p style="font-size: 12px; font-weight: 700; color: #d6a63a; margin: 4px 0 16px 0;">Guru Senior • Wali Kelas VII</p>
                        <div style="font-size: 12px; color: #64748b; line-height: 1.8;">
                            <div>✉️ marianna.s@sman2balige.sch.id</div>
                            <div>📞 +62 812-3456-7890</div>
                            <div style="font-family: monospace; background: #f1f5f9; padding: 4px 8px; border-radius: 4px; display: inline-block; margin-top: 8px;">NIP. 19750812 199903 2 004</div>
                        </div>
                        <div style="margin-top: 20px; padding-top: 15px; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
                            <a href="#" style="color: #071f3a; text-decoration: none; font-size: 12px; font-weight: 800;">Lihat Profil</a>
                            <!-- SEKARANG BISA DITEKAN: Diubah dari button ke tag a -->
                            <a href="{{ route('guru.edit') }}" style="border: none; background: #f8fafc; padding: 8px; border-radius: 8px; cursor: pointer; text-decoration: none; display: flex; align-items: center; justify-content: center;">✏️</a>
                        </div>
                    </div>
                </div>

                <!-- Card Guru 2 -->
                <div class="faculty-card">
                    <div style="position: relative;">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400" class="faculty-image" alt="Guru">
                        <span style="position: absolute; top: 15px; right: 15px; background: #dcfce7; color: #166534; padding: 4px 12px; border-radius: 20px; font-size: 10px; font-weight: 800;">AKTIF</span>
                    </div>
                    <div style="padding: 24px;">
                        <div style="font-size: 10px; font-weight: 800; color: #94a3b8; letter-spacing: 1px; margin-bottom: 8px;">DEPARTEMEN SAINS</div>
                        <h3 style="font-size: 18px; font-weight: 800; color: #071f3a;">Dr. Robert Siahaan</h3>
                        <p style="font-size: 12px; font-weight: 700; color: #d6a63a; margin: 4px 0 16px 0;">Kepala Laboratorium • Fisika</p>
                        <div style="font-size: 12px; color: #64748b; line-height: 1.8;">
                            <div>✉️ r.siahaan@sman2balige.sch.id</div>
                            <div>📞 +62 811-9876-5432</div>
                            <div style="font-family: monospace; background: #f1f5f9; padding: 4px 8px; border-radius: 4px; display: inline-block; margin-top: 8px;">NIP. 19820515 200501 1 012</div>
                        </div>
                        <div style="margin-top: 20px; padding-top: 15px; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
                            <a href="#" style="color: #071f3a; text-decoration: none; font-size: 12px; font-weight: 800;">Lihat Profil</a>
                            <!-- SEKARANG BISA DITEKAN: Diubah dari button ke tag a -->
                            <a href="{{ route('guru.edit') }}" style="border: none; background: #f8fafc; padding: 8px; border-radius: 8px; cursor: pointer; text-decoration: none; display: flex; align-items: center; justify-content: center;">✏️</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- STAF ADMINISTRASI -->
            <div style="background: #071f3a; border-radius: 24px; padding: 32px; margin-top: 48px; color: white; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h2 style="font-size: 24px; font-weight: 800; margin-bottom: 8px;">Staf Administrasi & Operasional</h2>
                    <p style="font-size: 14px; color: #94a3b8; max-width: 500px;">Tim berdedikasi yang mengelola keuangan, fasilitas, dan operasional harian sekolah.</p>
                </div>
                <div style="display: flex; gap: 32px;">
                    <div style="text-align: center;">
                        <div style="font-size: 32px; font-weight: 900;">14</div>
                        <div style="font-size: 10px; font-weight: 700; color: #94a3b8; text-transform: uppercase;">ADMIN</div>
                    </div>
                    <div style="text-align: center;">
                        <div style="font-size: 32px; font-weight: 900;">08</div>
                        <div style="font-size: 10px; font-weight: 700; color: #94a3b8; text-transform: uppercase;">FASILITAS</div>
                    </div>
                </div>
            </div>

            <!-- PAGINATION -->
            <div class="pagination-container">
                <div class="pagination-info">
                    Menampilkan <span>6</span> dari <span>42</span> anggota staf
                </div>

                <div class="pagination-buttons">
                    <button class="arrow-btn">❮</button>
                    <a href="#" class="page-btn active">1</a>
                    <a href="#" class="page-btn">2</a>
                    <a href="#" class="page-btn">3</a>
                    <button class="arrow-btn" style="color: #071f3a;">❯</button>
                </div>
            </div>
        </main>
    </div>
</div>

<button class="floating-add-btn" title="Tambah Guru Baru">+</button>

</body>
</html>