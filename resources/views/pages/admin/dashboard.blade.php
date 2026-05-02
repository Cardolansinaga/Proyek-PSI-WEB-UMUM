<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SMAN 2 Balige</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { overflow: hidden; font-family: 'Inter', sans-serif; background-color: #f8fafc; }

        .admin-container { display: flex; height: 100vh; width: 100vw; }

        /* Sidebar Style */
        .sidebar { width: 260px; background-color: #071f3a; flex-shrink: 0; display: flex; flex-direction: column; color: white; }
        .nav-item { padding: 12px 16px; display: flex; align-items: center; gap: 12px; font-size: 14px; font-weight: 500; color: #94a3b8; text-decoration: none; transition: all 0.2s; }
        .nav-item:hover { color: white; background: rgba(255,255,255,0.05); border-radius: 12px; }
        .active-nav { background: rgba(255,255,255,0.1); color: white; border-radius: 12px; font-weight: 700; border-left: 4px solid #10b981; }

        /* Content Area */
        .main-content { flex-grow: 1; overflow-y: auto; display: flex; flex-direction: column; }
        .header { height: 70px; background: white; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; padding: 0 32px; position: sticky; top: 0; z-index: 10; }

        /* Dashboard Components */
        .content-padding { padding: 32px; }
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 32px; }
        .quick-access-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 15px; margin-bottom: 32px; }
        .card { background: white; border: 1px solid #f1f5f9; border-radius: 20px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); transition: transform 0.2s; }
        .card:hover { transform: translateY(-2px); }

        /* Table Style */
        .data-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .data-table th { text-align: left; padding: 12px; border-bottom: 2px solid #f1f5f9; color: #94a3b8; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; }
        .data-table td { padding: 16px 12px; border-bottom: 1px solid #f1f5f9; font-size: 14px; color: #1e293b; }
        .status-badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; }
        .status-waiting { background: #fef3c7; color: #92400e; }
        .status-verified { background: #dcfce7; color: #166534; }
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
                    <div style="font-size: 10px; color: #94a3b8;">Admin Portal</div>
                </div>
            </div>
            
            <nav style="display: flex; flex-direction: column; gap: 4px;">
                <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active-nav' : '' }}">📊 Dashboard</a>
                <a href="{{ route('guru.index') }}" class="nav-item {{ request()->routeIs('guru.*') ? 'active-nav' : '' }}">👥 Guru & Staf</a>
                <a href="{{ route('prestasi.index') }}" class="nav-item {{ request()->routeIs('prestasi.*') ? 'active-nav' : '' }}">🏅 Prestasi</a>
                <a href="{{ route('pengumuman.index') }}" class="nav-item {{ request()->routeIs('pengumuman.*') ? 'active-nav' : '' }}">📢 Pengumuman</a>
                <a href="#" class="nav-item">📰 Berita</a>
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
                    <span>🚪 Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <div class="main-content">
        <header class="header">
            <div style="font-size: 12px; font-weight: 800; color: #94a3b8; letter-spacing: 1px;">
                PANEL ADMIN <span style="margin: 0 8px; color: #e2e8f0;">/</span> <span style="color: #64748b;">Dashboard Utama</span>
            </div>
            <div style="display: flex; align-items: center; gap: 24px;">
                <div style="position: relative;">
                    <input type="text" placeholder="Search data..." style="background: #f1f5f9; border: none; padding: 8px 16px 8px 35px; border-radius: 20px; font-size: 13px; width: 250px;">
                </div>
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div style="text-align: right;">
                        <div style="font-size: 13px; font-weight: 900; color: #071f3a;">{{ Auth::user()->name }}</div>
                        <div style="font-size: 10px; font-weight: 700; color: #3b82f6;">ADMIN UTAMA</div>
                    </div>
                    <div style="width: 35px; height: 35px; background: #071f3a; border-radius: 50%; display: grid; place-items: center; color: white; font-size: 12px; font-weight: 800;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                </div>
            </div>
        </header>

        <main class="content-padding">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h2 style="font-size: 24px; font-weight: 900; color: #071f3a;">Selamat Datang, Admin</h2>
                <div style="display: flex; gap: 12px;">
                    <button style="background: white; border: 1px solid #e2e8f0; padding: 8px 16px; border-radius: 10px; font-size: 13px; font-weight: 700; color: #475569;">Laporan Bulanan</button>
                    <button style="background: #071f3a; border: none; padding: 8px 16px; border-radius: 10px; font-size: 13px; font-weight: 700; color: white;">+ Tambah Berita</button>
                </div>
            </div>

            <p style="color: #64748b; font-size: 14px; margin-bottom: 24px;">Berikut adalah ringkasan performa SMAN 2 Balige hari ini.</p>

            <div class="stats-grid">
                <div class="card">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 12px;"><span style="background: #eff6ff; padding: 8px; border-radius: 10px;">📰</span><span style="color: #22c55e; font-size: 12px; font-weight: 700;">+12%</span></div>
                    <div style="color: #94a3b8; font-size: 10px; font-weight: 800; text-transform: uppercase;">Total Berita</div>
                    <div style="font-size: 24px; font-weight: 900; color: #071f3a;">1.284</div>
                </div>
                <div class="card">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 12px;"><span style="background: #fffbeb; padding: 8px; border-radius: 10px;">📢</span><span style="color: #22c55e; font-size: 12px; font-weight: 700;">+5%</span></div>
                    <div style="color: #94a3b8; font-size: 10px; font-weight: 800; text-transform: uppercase;">Pengumuman</div>
                    <div style="font-size: 24px; font-weight: 900; color: #071f3a;">452</div>
                </div>
                <div class="card">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 12px;"><span style="background: #f0fdf4; padding: 8px; border-radius: 10px;">🏅</span><span style="color: #22c55e; font-size: 12px; font-weight: 700;">+8%</span></div>
                    <div style="color: #94a3b8; font-size: 10px; font-weight: 800; text-transform: uppercase;">Prestasi</div>
                    <div style="font-size: 24px; font-weight: 900; color: #071f3a;">86</div>
                </div>
                <div class="card" style="background: #071f3a; color: white;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 12px;"><span style="background: rgba(255,255,255,0.1); padding: 8px; border-radius: 10px;">👤</span><span style="color: #94a3b8; font-size: 10px; font-weight: 700;">LIVE</span></div>
                    <div style="color: rgba(255,255,255,0.4); font-size: 10px; font-weight: 800; text-transform: uppercase;">Pendaftar PPDB</div>
                    <div style="font-size: 24px; font-weight: 900;">248</div>
                </div>
            </div>

            <!-- Quick Access -->
            <h3 style="font-size: 18px; font-weight: 900; color: #071f3a; margin-bottom: 20px;">Akses Cepat</h3>
            <div class="quick-access-grid">
                <div class="card" style="text-align: center; cursor: pointer;">
                    <div style="color: #3b82f6; font-size: 20px; margin-bottom: 8px;">➕</div>
                    <div style="font-size: 10px; font-weight: 800; text-transform: uppercase;">Buat Pengumuman</div>
                </div>
                <!-- AKSES CEPAT GURU -->
                <a href="{{ route('guru.index') }}" class="card" style="text-align: center; cursor: pointer; text-decoration: none; color: inherit;">
                    <div style="color: #10b981; font-size: 20px; margin-bottom: 8px;">👤</div>
                    <div style="font-size: 10px; font-weight: 800; text-transform: uppercase;">Manajemen Guru</div>
                </a>
                <!-- AKSES CEPAT PRESTASI -->
                <a href="{{ route('prestasi.index') }}" class="card" style="text-align: center; cursor: pointer; text-decoration: none; color: inherit;">
                    <div style="color: #f59e0b; font-size: 20px; margin-bottom: 8px;">🏆</div>
                    <div style="font-size: 10px; font-weight: 800; text-transform: uppercase;">Tambah Prestasi</div>
                </a>
                <div class="card" style="text-align: center; cursor: pointer;">
                    <div style="color: #8b5cf6; font-size: 20px; margin-bottom: 8px;">☁️</div>
                    <div style="font-size: 10px; font-weight: 800; text-transform: uppercase;">Upload Galeri</div>
                </div>
                <div class="card" style="text-align: center; cursor: pointer;">
                    <div style="color: #6366f1; font-size: 20px; margin-bottom: 8px;">✔️</div>
                    <div style="font-size: 10px; font-weight: 800; text-transform: uppercase;">Verif PPDB</div>
                </div>
                <div class="card" style="text-align: center; cursor: pointer;">
                    <div style="color: #ef4444; font-size: 20px; margin-bottom: 8px;">⚙️</div>
                    <div style="font-size: 10px; font-weight: 800; text-transform: uppercase;">Atur Admin</div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="card" style="padding: 32px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                    <div>
                        <h3 style="font-size: 18px; font-weight: 900; color: #071f3a;">Pendaftar PPDB Terbaru</h3>
                        <p style="font-size: 12px; color: #94a3b8;">Status verifikasi pendaftaran calon siswa baru</p>
                    </div>
                    <button style="background: #071f3a; color: white; padding: 8px 16px; border-radius: 8px; font-size: 12px; font-weight: 700;">Manajemen PPDB</button>
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No. Registrasi</th>
                            <th>Nama Lengkap</th>
                            <th>Jalur Pendaftaran</th>
                            <th>Asal Sekolah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-weight: 800;">REG-2024-001</td>
                            <td style="display: flex; align-items: center; gap: 10px;"><div style="width: 28px; height: 28px; background: #e0e7ff; border-radius: 50%; display: grid; place-items: center; font-size: 10px; font-weight: 800; color: #4338ca;">AW</div> Andi Wijaya</td>
                            <td>Zonasi</td>
                            <td>SMPN 1 Balige</td>
                            <td><span class="status-badge status-waiting">Menunggu</span></td>
                            <td><button style="color: #94a3b8; border: none; background: none; font-size: 18px; cursor: pointer;">⋮</button></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 800;">REG-2024-002</td>
                            <td style="display: flex; align-items: center; gap: 10px;"><div style="width: 28px; height: 28px; background: #fef3c7; border-radius: 50%; display: grid; place-items: center; font-size: 10px; font-weight: 800; color: #92400e;">BR</div> Budi Ramadhan</td>
                            <td>Prestasi</td>
                            <td>SMP Swasta Bintang</td>
                            <td><span class="status-badge status-verified">Terverifikasi</span></td>
                            <td><button style="color: #94a3b8; border: none; background: none; font-size: 18px; cursor: pointer;">⋮</button></td>
                        </tr>
                    </tbody>
                </table>
                <div style="text-align: center; margin-top: 24px;">
                    <a href="#" style="color: #3b82f6; text-decoration: none; font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Lihat Seluruh Pendaftar (248)</a>
                </div>
            </div>
        </main>
    </div>
</div>

</body>
</html>