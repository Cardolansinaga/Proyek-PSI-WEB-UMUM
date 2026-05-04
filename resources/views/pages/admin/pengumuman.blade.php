<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengumuman - SMAN 2 Balige</title>
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

        /* DASHBOARD COMPONENTS */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 32px; }
        .card { background: white; border: 1px solid #f1f5f9; border-radius: 20px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        
        /* TABLE STYLES */
        .table-container { background: white; border-radius: 20px; border: 1px solid #f1f5f9; padding: 24px; }
        .filter-tabs { display: flex; gap: 8px; margin-bottom: 24px; border-bottom: 1px solid #f1f5f9; padding-bottom: 16px; }
        .tab { padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 700; cursor: pointer; border: none; background: none; color: #64748b; }
        .tab.active { background: #071f3a; color: white; }

        .announcement-table { width: 100%; border-collapse: collapse; }
        .announcement-table th { text-align: left; padding: 12px; color: #94a3b8; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; border-bottom: 1px solid #f1f5f9; }
        .announcement-table td { padding: 16px 12px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }

        /* BADGES */
        .badge-target { padding: 2px 8px; border-radius: 4px; font-size: 9px; font-weight: 800; margin-right: 4px; }
        .bg-siswa { background: #e0e7ff; color: #4338ca; }
        .bg-ortu { background: #ffedd5; color: #9a3412; }
        .bg-guru { background: #dcfce7; color: #166534; }
        
        .priority-dot { display: inline-block; width: 8px; height: 8px; border-radius: 50%; margin-right: 6px; }
        .status-pill { padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; }
        
        .btn-action { background: none; border: none; cursor: pointer; color: #94a3b8; font-size: 16px; padding: 4px; transition: 0.2s; }
        .btn-action:hover { color: #071f3a; }

        /* Tombol Tambah yang sudah diperbaiki */
        .btn-create { background: #071f3a; color: white; padding: 12px 24px; border-radius: 12px; font-weight: 700; text-decoration: none; display: flex; align-items: center; gap: 8px; transition: 0.3s; }
        .btn-create:hover { background: #0c2d54; transform: translateY(-1px); }

        .footer-banner { background: #071f3a; border-radius: 20px; padding: 24px; color: white; display: flex; justify-content: space-between; align-items: center; margin-top: 32px; }
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
                <a href="{{ route('prestasi.index') }}" class="nav-item">🏅 Prestasi</a>
                <a href="{{ route('pengumuman.index') }}" class="nav-item active-nav">📢 Pengumuman</a>
                <a href="{{ route('kesiswaan.index') }}" class="nav-item">🎓 Kesiswaan</a>
                <a href="#" class="nav-item">📝 PPDB</a>
                <a href="#" class="nav-item">🖼️ Galeri</a>
                <a href="#" class="nav-item">⚙️ Pengaturan</a>
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
            <div style="font-size: 12px; font-weight: 800; color: #94a3b8; letter-spacing: 1px;">PANEL ADMIN <span style="margin: 0 8px;">/</span> <span style="color: #64748b;">Manajemen Pengumuman</span></div>
            <div style="display: flex; align-items: center; gap: 24px;">
                <div style="position: relative;">
                    <input type="text" placeholder="Cari pengumuman..." style="background: #f1f5f9; border: none; padding: 8px 16px 8px 35px; border-radius: 20px; font-size: 13px; width: 250px;">
                </div>
                @php
                    $adminName = optional(Auth::user())->name ?? session('admin_name') ?? 'Admin';
                @endphp
                <div style="width: 35px; height: 35px; background: #071f3a; border-radius: 50%; display: grid; place-items: center; color: white; font-weight: 800;">{{ strtoupper(substr($adminName, 0, 2)) }}</div>
            </div>
        </header>

        <main class="content-padding">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 32px;">
                <div>
                    <h1 style="font-size: 32px; font-weight: 800; color: #071f3a;">Daftar Pengumuman</h1>
                    <p style="color: #64748b; font-size: 14px; margin-top: 8px;">Kelola semua pengumuman sekolah untuk siswa, guru, dan orang tua.</p>
                </div>
                <div style="display: flex; gap: 12px;">
                    <button style="background: white; border: 1px solid #e2e8f0; padding: 12px 24px; border-radius: 12px; font-weight: 700; color: #475569;">📑 Filter</button>
                    <button style="background: white; border: 1px solid #e2e8f0; padding: 12px 24px; border-radius: 12px; font-weight: 700; color: #475569;">📥 Export</button>
                    
                    <!-- TOMBOL SUDAH PERBAIKI KE RUTE TAMBAH -->
                    <a href="{{ route('pengumuman.create') }}" class="btn-create">+ Buat Pengumuman</a>
                </div>
            </div>

            <!-- STATS GRID -->
            <div class="stats-grid">
                <div class="card">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                        <span style="font-size: 20px;">📢</span>
                        <span style="color: #22c55e; font-size: 11px; font-weight: 800;">+12%</span>
                    </div>
                    <div style="color: #94a3b8; font-size: 11px; font-weight: 800; text-transform: uppercase;">Total Pengumuman</div>
                    <div style="font-size: 28px; font-weight: 900; color: #071f3a;">128</div>
                </div>
                <div class="card">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                        <span style="font-size: 20px;">✅</span>
                        <span style="color: #94a3b8; font-size: 11px; font-weight: 800;">AKTIF</span>
                    </div>
                    <div style="color: #94a3b8; font-size: 11px; font-weight: 800; text-transform: uppercase;">Aktif Saat Ini</div>
                    <div style="font-size: 28px; font-weight: 900; color: #071f3a;">42</div>
                </div>
                <div class="card">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                        <span style="font-size: 20px;">🕒</span>
                        <span style="color: #f59e0b; font-size: 11px; font-weight: 800;">3 SEGERA</span>
                    </div>
                    <div style="color: #94a3b8; font-size: 11px; font-weight: 800; text-transform: uppercase;">Terjadwal</div>
                    <div style="font-size: 28px; font-weight: 900; color: #071f3a;">15</div>
                </div>
                <div class="card">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                        <span style="font-size: 20px;">👁️</span>
                        <span style="color: #ef4444; font-size: 11px; font-weight: 800;">TREND</span>
                    </div>
                    <div style="color: #94a3b8; font-size: 11px; font-weight: 800; text-transform: uppercase;">Total Dilihat</div>
                    <div style="font-size: 28px; font-weight: 900; color: #071f3a;">8.4k</div>
                </div>
            </div>

            <div class="table-container">
                <div class="filter-tabs">
                    <button class="tab active">Semua</button>
                    <button class="tab">Publik</button>
                    <button class="tab">Draft</button>
                    <button class="tab">Arsip</button>
                </div>

                <table class="announcement-table">
                    <thead>
                        <tr>
                            <th>Pengumuman</th>
                            <th>Target</th>
                            <th>Prioritas</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div style="background: #eff6ff; padding: 10px; border-radius: 10px; font-size: 18px;">📄</div>
                                    <div>
                                        <div style="font-size: 14px; font-weight: 800; color: #071f3a;">Pelaksanaan Ujian...</div>
                                        <div style="font-size: 11px; color: #94a3b8;">Jadwal lengkap dan...</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge-target bg-siswa">SISWA</span>
                                <span class="badge-target bg-ortu">ORANG TUA</span>
                            </td>
                            <td><span class="priority-dot" style="background: #ef4444;"></span><span style="font-size: 12px; color: #475569;">Tinggi</span></td>
                            <td><span class="status-pill" style="background: #dcfce7; color: #166534;">Published</span></td>
                            <td><div style="font-size: 12px; font-weight: 700;">12 Okt 2023</div><div style="font-size: 10px; color: #94a3b8;">08:30 AM</div></td>
                            <td>
                                <button class="btn-action">✏️</button>
                                <button class="btn-action">🗑️</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

</body>
</html>