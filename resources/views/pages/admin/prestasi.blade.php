<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Prestasi - SMAN 2 Balige</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { overflow: hidden; font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        .admin-container { display: flex; height: 100vh; width: 100vw; }

        /* SIDEBAR KONSISTEN */
        .sidebar { width: 260px; background-color: #071f3a; flex-shrink: 0; display: flex; flex-direction: column; color: white; }
        .nav-item { padding: 12px 16px; display: flex; align-items: center; gap: 12px; font-size: 14px; font-weight: 500; color: #94a3b8; text-decoration: none; transition: 0.2s; }
        .nav-item:hover { color: white; background: rgba(255,255,255,0.05); border-radius: 12px; }
        .active-nav { background: rgba(255,255,255,0.1); color: white; border-radius: 12px; font-weight: 700; border-left: 4px solid #10b981; }

        /* CONTENT AREA */
        .main-content { flex-grow: 1; overflow-y: auto; display: flex; flex-direction: column; }
        .header { height: 70px; background: white; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; padding: 0 32px; position: sticky; top: 0; z-index: 10; }
        .content-padding { padding: 32px; }

        /* DASHBOARD ELEMENTS */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 32px; }
        .card { background: white; border: 1px solid #f1f5f9; border-radius: 20px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        
        .main-grid { display: grid; grid-template-columns: 1fr 350px; gap: 24px; }
        .data-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .data-table th { text-align: left; padding: 12px; border-bottom: 2px solid #f1f5f9; color: #94a3b8; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; }
        .data-table td { padding: 16px 12px; border-bottom: 1px solid #f1f5f9; font-size: 14px; color: #1e293b; }

        /* BADGES */
        .badge { padding: 4px 12px; border-radius: 6px; font-size: 10px; font-weight: 800; text-transform: uppercase; }
        .badge-nasional { background: #ffedd5; color: #9a3412; }
        .badge-provinsi { background: #e0e7ff; color: #3730a3; }
        .badge-internasional { background: #071f3a; color: white; }

        .preview-card { background: linear-gradient(180deg, rgba(7,31,58,0) 0%, rgba(7,31,58,0.95) 100%), url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=400'); background-size: cover; border-radius: 20px; height: 400px; color: white; padding: 24px; display: flex; flex-direction: column; justify-content: flex-end; position: relative; }
        
        /* Tombol Tambah */
        .btn-add { background: #071f3a; color: white; padding: 12px 24px; border-radius: 12px; font-weight: 700; text-decoration: none; display: flex; align-items: center; gap: 8px; transition: 0.3s; }
        .btn-add:hover { background: #0c2d54; transform: translateY(-1px); }
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
                <a href="{{ route('guru.index') }}" class="nav-item">👥 Guru & Staf</a>
                <a href="{{ route('prestasi.index') }}" class="nav-item active-nav">🏅 Prestasi</a>
                <a href="#" class="nav-item">📰 Berita</a>
                <a href="#" class="nav-item">📢 Pengumuman</a>
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
                PANEL ADMIN <span style="margin: 0 8px; color: #e2e8f0;">/</span> <span style="color: #64748b;">Manajemen Prestasi</span>
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
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 32px;">
                <div>
                    <h1 style="font-size: 32px; font-weight: 800; color: #071f3a;">Manajemen Prestasi</h1>
                    <p style="color: #64748b; font-size: 14px; margin-top: 8px;">Kelola pencapaian akademik dan non-akademik siswa SMAN 2 Balige.</p>
                </div>
                <div style="display: flex; gap: 12px;">
                    <button style="background: white; border: 1px solid #e2e8f0; padding: 12px 24px; border-radius: 12px; font-weight: 700; color: #475569;">📥 Export PDF</button>
                    <!-- SEKARANG BISA DITEKAN: Diarahkan ke form tambah -->
                    <a href="{{ route('prestasi.create') }}" class="btn-add">+ Tambah Prestasi</a>
                </div>
            </div>

            <!-- STATS GRID -->
            <div class="stats-grid">
                <div class="card">
                    <div style="color: #3b82f6; font-size: 24px; margin-bottom: 12px;">🏆</div>
                    <div style="color: #94a3b8; font-size: 11px; font-weight: 800; text-transform: uppercase;">Total Prestasi</div>
                    <div style="font-size: 28px; font-weight: 900; color: #071f3a;">142</div>
                </div>
                <div class="card">
                    <div style="color: #f59e0b; font-size: 24px; margin-bottom: 12px;">🌏</div>
                    <div style="color: #94a3b8; font-size: 11px; font-weight: 800; text-transform: uppercase;">Tingkat Internasional</div>
                    <div style="font-size: 28px; font-weight: 900; color: #071f3a;">08</div>
                </div>
                <div class="card">
                    <div style="color: #10b981; font-size: 24px; margin-bottom: 12px;">🥇</div>
                    <div style="color: #94a3b8; font-size: 11px; font-weight: 800; text-transform: uppercase;">Juara Umum</div>
                    <div style="font-size: 28px; font-weight: 900; color: #071f3a;">24</div>
                </div>
                <div class="card">
                    <div style="color: #ef4444; font-size: 24px; margin-bottom: 12px;">🔔</div>
                    <div style="color: #94a3b8; font-size: 11px; font-weight: 800; text-transform: uppercase;">Perlu Review</div>
                    <div style="font-size: 28px; font-weight: 900; color: #071f3a;">03</div>
                </div>
            </div>

            <div class="main-grid">
                <!-- TABLE SECTION -->
                <div class="card">
                    <h3 style="font-size: 18px; font-weight: 800; color: #071f3a; margin-bottom: 24px;">Riwayat Prestasi Terbaru</h3>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Nama Siswa / Tim</th>
                                <th>Kompetisi</th>
                                <th>Level</th>
                                <th>Peringkat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="font-weight: 700;">Andini Putri<br><span style="font-weight: 400; color: #94a3b8; font-size: 11px;">Kelas XII MIPA 1</span></td>
                                <td>OSN Astronomi<br><span style="font-weight: 400; color: #94a3b8; font-size: 11px;">Nasional</span></td>
                                <td><span class="badge badge-nasional">Nasional</span></td>
                                <td style="color: #d6a63a; font-weight: 700;">🥇 Juara 1</td>
                            </tr>
                            <tr>
                                <td style="font-weight: 700;">Budi Santoso<br><span style="font-weight: 400; color: #94a3b8; font-size: 11px;">Kelas XI IPS 3</span></td>
                                <td>FLS2N Seni Lukis<br><span style="font-weight: 400; color: #94a3b8; font-size: 11px;">Provinsi</span></td>
                                <td><span class="badge badge-provinsi">Provinsi</span></td>
                                <td style="color: #64748b; font-weight: 700;">🥉 Juara 3</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- PREVIEW SECTION -->
                <div style="display: flex; flex-direction: column; gap: 24px;">
                    <div class="card" style="padding: 0; overflow: hidden; border: none;">
                        <div class="preview-card">
                            <span style="background: #d6a63a; padding: 4px 12px; border-radius: 4px; font-size: 10px; font-weight: 800; position: absolute; top: 24px; left: 24px;">TERBARU</span>
                            <h4 style="font-size: 20px; font-weight: 800; margin-bottom: 12px;">OSN Astronomi: Juara 1 Nasional</h4>
                            <a href="#" style="color: white; font-size: 11px; font-weight: 800; text-decoration: none;">SELENGKAPNYA →</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

</body>
</html>