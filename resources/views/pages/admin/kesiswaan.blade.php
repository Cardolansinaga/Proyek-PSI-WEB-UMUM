<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Manajemen Kesiswaan & Ekstrakurikuler - SMAN 2 Balige">
    <title>Manajemen Kesiswaan & Ekstrakurikuler - SMAN 2 Balige</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('pages.admin.partials.admin-polish')
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { overflow: hidden; font-family: Inter, sans-serif; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); }
        .admin-container { display: flex; height: 100vh; width: 100vw; }
        .main-content { flex: 1; min-width: 0; overflow-y: auto; }
        .content-padding { width: 100%; max-width: 1320px; margin: 0 auto; padding: 32px; }
        .page-head { display: flex; justify-content: space-between; align-items: flex-start; gap: 20px; margin-bottom: 32px; }
        .page-head h1 { color: #071f3a; font-size: 36px; line-height: 1.15; font-weight: 900; }
        .page-head p { max-width: 720px; margin-top: 8px; color: #64748b; line-height: 1.65; font-size: 14px; }
        .actions { display: flex; flex-wrap: wrap; gap: 12px; }
        .btn-primary, .btn-light { display: inline-flex; align-items: center; justify-content: center; min-height: 44px; border-radius: 10px; padding: 10px 18px; font-weight: 900; text-decoration: none; border: none; cursor: pointer; transition: all 0.3s ease; }
        .btn-primary { background: linear-gradient(135deg, #071f3a 0%, #0f2847 100%); color: #ffffff; box-shadow: 0 4px 12px rgba(7, 31, 58, 0.2); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(7, 31, 58, 0.3); }
        .btn-light { background: #ffffff; color: #071f3a; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .btn-light:hover { background: #f8fafc; border-color: #d6a63a; box-shadow: 0 4px 12px rgba(214, 166, 58, 0.1); transform: translateY(-1px); }
        .stats-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 18px; margin-bottom: 32px; }
        .stat-card { background: white; border-radius: 14px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); border-left: 4px solid; transition: all 0.3s ease; }
        .stat-card:nth-child(1) { border-left-color: #d6a63a; }
        .stat-card:nth-child(2) { border-left-color: #3b82f6; }
        .stat-card:nth-child(3) { border-left-color: #19a99a; }
        .stat-card:nth-child(4) { border-left-color: #8b5cf6; }
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 12px 24px rgba(0,0,0,0.1); }
        .stat-label { color: #94a3b8; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 10px; }
        .stat-value { color: #071f3a; font-size: 32px; font-weight: 900; }
        .card { background: #ffffff; border-radius: 14px; padding: 28px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
        .card h2 { color:#071f3a; font-size:22px; font-weight:900; margin-bottom: 20px; }
        .table-container { overflow-x: auto; }
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table thead tr { background: linear-gradient(90deg, #f8fafc 0%, #f1f5f9 100%); }
        .data-table th, .data-table td { padding: 14px 12px; border-bottom: 1px solid #f1f5f9; text-align: left; vertical-align: middle; }
        .data-table th { color: #64748b; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
        .data-table td { color: #1e293b; font-size: 14px; }
        .data-table tbody tr { transition: all 0.2s ease; }
        .data-table tbody tr:hover { background-color: #f8fafc; }
        .badge { display: inline-flex; align-items: center; border-radius: 8px; padding: 6px 12px; background: #ecfdf5; color: #166534; font-size: 11px; font-weight: 900; }
        .badge-muted { background: #f1f5f9; color: #475569; }
        .status-message { margin-top: 12px; color: #166534; font-weight: 900; padding:10px 12px; background:#dcfce7; border-radius:8px; display:inline-block; font-size:13px; }
        @media (max-width: 900px) {
            .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .page-head { flex-direction: column; }
        }
        @media (max-width: 560px) {
            .stats-grid { grid-template-columns: 1fr; }
            .content-padding { padding: 22px 16px; }
            .actions, .btn-primary, .btn-light { width: 100%; }
        }
    </style>
    @include('pages.admin.partials.responsive')
</head>
<body>
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'kesiswaan'])
    <div class="main-content">
        <main class="content-padding">
            <div class="page-head">
                <div>
                    <h1>Manajemen Kesiswaan & Ekstrakurikuler</h1>
                    <p>Kelola organisasi siswa, kegiatan pembinaan, dan ekstrakurikuler yang tampil di halaman publik.</p>
                    @if (session('status'))
                        <p class="status-message">✓ {{ session('status') }}</p>
                    @endif
                </div>
                <div class="actions">
                    <a href="{{ route('kesiswaan') }}" class="btn-light">Lihat Publik</a>
                    <a href="{{ route('admin.kesiswaan.create') }}" class="btn-primary">+ Tambah Data</a>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">📊 Total Data</div>
                    <div class="stat-value">{{ $activities->count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">🏢 Organisasi</div>
                    <div class="stat-value">{{ $activities->where('type', 'Organisasi Siswa')->count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">⚽ Ekstrakurikuler</div>
                    <div class="stat-value">{{ $activities->where('type', '!=', 'Organisasi Siswa')->count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">👁 Tampil Publik</div>
                    <div class="stat-value">{{ $activities->where('is_published', true)->count() }}</div>
                </div>
            </div>

            <section class="card">
                <h2 style="color:#071f3a; font-size:20px; font-weight:900;">Daftar Kegiatan</h2>
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tipe</th>
                                <th>Pembina</th>
                                <th>Jadwal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($activities as $activity)
                            <tr>
                                <td>
                                    <strong>{{ $activity->name }}</strong>
                                    <div style="margin-top:4px; color:#64748b; font-size:12px;">{{ \Illuminate\Support\Str::limit($activity->description, 90) }}</div>
                                </td>
                                <td>{{ $activity->type }}</td>
                                <td>{{ $activity->mentor ?: $activity->coordinator ?: '-' }}</td>
                                <td>
                                    {{ $activity->schedule ?: '-' }}
                                    <div style="margin-top:4px; color:#94a3b8; font-size:12px;">{{ $activity->location ?: '' }}</div>
                                </td>
                                <td>
                                    <span class="badge {{ $activity->is_published ? '' : 'badge-muted' }}">
                                        {{ $activity->is_published ? 'Tampil' : 'Draft' }}
                                    </span>
                                </td>
                                <td>
                                    <a class="btn-light" href="{{ route('admin.kesiswaan.edit', $activity) }}">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Belum ada data kesiswaan.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</div>
</body>
</html>
