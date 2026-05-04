<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kesiswaan - SMAN 2 Balige</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { overflow: hidden; font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        .admin-container { display: flex; height: 100vh; width: 100vw; }
        .sidebar { width: 260px; background-color: #071f3a; flex-shrink: 0; display: flex; flex-direction: column; color: white; }
        .nav-item { padding: 12px 16px; display: flex; align-items: center; gap: 12px; font-size: 14px; font-weight: 500; color: #94a3b8; text-decoration: none; transition: 0.2s; }
        .nav-item:hover { color: white; background: rgba(255,255,255,0.05); border-radius: 12px; }
        .active-nav { background: rgba(255,255,255,0.1); color: white; border-radius: 12px; font-weight: 700; border-left: 4px solid #10b981; }
        .main-content { flex-grow: 1; overflow-y: auto; display: flex; flex-direction: column; }
        .header { height: 70px; background: white; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; padding: 0 32px; position: sticky; top: 0; z-index: 10; }
        .content-padding { padding: 32px; }
        .card { background: white; border: 1px solid #f1f5f9; border-radius: 20px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 24px; }
        .data-table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        .data-table th { text-align: left; padding: 12px; border-bottom: 2px solid #f1f5f9; color: #94a3b8; font-size: 11px; text-transform: uppercase; }
        .data-table td { padding: 12px; border-bottom: 1px solid #f1f5f9; font-size: 14px; color: #1e293b; }
        .btn-add { background: #071f3a; color: white; padding: 10px 18px; border-radius: 10px; font-weight: 700; text-decoration: none; }
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
                <a href="{{ route('pengumuman.index') }}" class="nav-item">📢 Pengumuman</a>
                <a href="{{ route('kesiswaan.index') ?? '#' }}" class="nav-item active-nav">🎓 Kesiswaan</a>
                <a href="#" class="nav-item">📝 PPDB</a>
                <a href="#" class="nav-item">🖼️ Galeri</a>
                <a href="#" class="nav-item">⚙️ Pengaturan</a>
            </nav>
        </div>
        <div style="margin-top: auto; padding: 32px;">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="color: #f87171; background: none; border: none; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 8px;">🚪 Keluar</button>
            </form>
        </div>
    </aside>

    <div class="main-content">
        <header class="header">
            <div style="font-size: 12px; font-weight: 800; color: #94a3b8; letter-spacing: 1px;">PANEL ADMIN <span style="margin: 0 8px; color: #e2e8f0;">/</span> <span style="color: #64748b;">Kesiswaan</span></div>
            <div style="display: flex; align-items: center; gap: 24px;">
                @php $adminName = optional(Auth::user())->name ?? session('admin_name') ?? 'Admin'; @endphp
                <div style="text-align: right;">
                    <div style="font-size: 13px; font-weight: 900; color: #071f3a;">{{ $adminName }}</div>
                    <div style="font-size: 10px; font-weight: 700; color: #3b82f6;">ADMIN UTAMA</div>
                </div>
                <div style="width: 35px; height: 35px; background: #071f3a; border-radius: 50%; display: grid; place-items: center; color: white; font-weight: 800;">{{ strtoupper(substr($adminName,0,2)) }}</div>
            </div>
        </header>

        <main class="content-padding">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:18px;">
                <div>
                    <h1 style="font-size:28px; font-weight:800; color:#071f3a;">Kesiswaan</h1>
                    <p style="color:#64748b;">Kelola organisasi siswa, ekstrakurikuler, dan agenda kegiatan.</p>
                </div>
                <a href="#" class="btn-add">+ Add New Entry</a>
            </div>

            <div class="stats-grid">
                <div class="card">
                    <div style="color:#94a3b8; font-size:11px; font-weight:800; text-transform:uppercase;">Total Organisasi</div>
                    <div style="font-size:24px; font-weight:900; color:#071f3a;">12</div>
                </div>
                <div class="card">
                    <div style="color:#94a3b8; font-size:11px; font-weight:800; text-transform:uppercase;">Ekstrakurikuler</div>
                    <div style="font-size:24px; font-weight:900; color:#071f3a;">24</div>
                </div>
                <div class="card">
                    <div style="color:#94a3b8; font-size:11px; font-weight:800; text-transform:uppercase;">Upcoming Events</div>
                    <div style="font-size:24px; font-weight:900; color:#071f3a;">08</div>
                </div>
                <div class="card">
                    <div style="color:#94a3b8; font-size:11px; font-weight:800; text-transform:uppercase;">Active Participation</div>
                    <div style="font-size:24px; font-weight:900; color:#071f3a;">1.2k</div>
                </div>
            </div>

            <div class="card" style="margin-top: 12px;">
                <h3 style="font-size:16px; font-weight:800; color:#071f3a; margin-bottom:12px;">Daftar Organisasi</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Nama Organisasi</th>
                            <th>Ketua Umum</th>
                            <th>Jadwal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-weight:700;">OSIS</td>
                            <td>Andi Wijaya</td>
                            <td>Mon, 16:00</td>
                            <td style="color:#16a34a; font-weight:800;">Aktif</td>
                        </tr>
                        <tr>
                            <td style="font-weight:700;">MPK</td>
                            <td>Siti Aminah</td>
                            <td>Fri, 14:00</td>
                            <td style="color:#16a34a; font-weight:800;">Aktif</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
</body>
</html>
