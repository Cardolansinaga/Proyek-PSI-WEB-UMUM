<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Akademik & Prestasi - SMAN 2 Balige</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo-sman2-balige.jpg') }}">
    @vite('resources/css/admin.css')
    @include('pages.admin.partials.admin-polish')
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { overflow: hidden; font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); }
        .admin-container { display: flex; height: 100vh; width: 100vw; }
        .main-content { flex: 1; overflow-y: auto; }
        .content-padding { padding: 32px; }
        .page-head { display: flex; justify-content: space-between; gap: 20px; align-items: flex-start; margin-bottom: 32px; }
        .page-head h1 { font-size: 36px; font-weight: 900; color: #071f3a; }
        .page-head p { color: #64748b; margin-top: 8px; font-size: 14px; }
        .btn-add, .btn-light, .btn-danger { border-radius: 10px; padding: 11px 18px; font-weight: 900; text-decoration: none; border: none; cursor: pointer; transition: all 0.3s ease; }
        .btn-add { background: linear-gradient(135deg, #071f3a 0%, #0f2847 100%); color: white; box-shadow: 0 4px 12px rgba(7, 31, 58, 0.2); }
        .btn-add:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(7, 31, 58, 0.3); }
        .btn-light { background: white; color: #071f3a; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .btn-light:hover { background: #f8fafc; border-color: #d6a63a; box-shadow: 0 4px 12px rgba(214, 166, 58, 0.1); }
        .btn-danger { background: #fff1f2; color: #be123c; border: 1px solid #fecdd3; }
        .btn-danger:hover { background: #ffe4e6; box-shadow: 0 4px 12px rgba(190, 18, 60, 0.1); transform: translateY(-1px); }
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 32px; }
        .stat-card { background: white; border-radius: 14px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); border-left: 4px solid; transition: all 0.3s ease; }
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 12px 24px rgba(0,0,0,0.1); }
        .stat-card.total { border-left-color: #d6a63a; }
        .stat-card.international { border-left-color: #3b82f6; }
        .stat-card.featured { border-left-color: #19a99a; }
        .stat-card.draft { border-left-color: #f97316; }
        .stat-label { color: #94a3b8; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 10px; }
        .stat-value { font-size: 32px; font-weight: 900; color: #071f3a; }
        .card { background: white; border-radius: 14px; padding: 28px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
        .card h2 { font-size: 22px; color: #071f3a; font-weight: 900; margin-bottom: 20px; }
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table thead tr { background: linear-gradient(90deg, #f8fafc 0%, #f1f5f9 100%); }
        .data-table th { text-align: left; padding: 14px 12px; color: #64748b; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; }
        .data-table td { padding: 16px 12px; border-bottom: 1px solid #f1f5f9; font-size: 14px; color: #1e293b; vertical-align: middle; }
        .data-table tbody tr { transition: all 0.2s ease; }
        .data-table tbody tr:hover { background-color: #f8fafc; }
        .badge { display: inline-flex; align-items: center; padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 900; text-transform: uppercase; }
        @media (max-width: 900px) { .stats-grid { grid-template-columns: 1fr; } .page-head { flex-direction: column; } }
    </style>
    @include('pages.admin.partials.responsive')
</head>
<body>
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'prestasi'])
    <div class="main-content">
        <main class="content-padding">
            <div class="page-head">
                <div>
                    <h1>Manajemen Akademik & Prestasi</h1>
                    <p>Kelola prestasi siswa yang ditampilkan pada halaman Akademik & Prestasi publik.</p>
                    @if (session('status'))
                        <p style="color:#166534; font-weight:900;">{{ session('status') }}</p>
                    @endif
                </div>
                <div style="display:flex; gap:12px; flex-wrap:wrap;">
                    <a href="{{ route('akademik') }}#prestasi" class="btn-light"><i class="bi bi-box-arrow-up-right" aria-hidden="true"></i> Lihat Publik</a>
                    <a href="{{ route('prestasi.create') }}" class="btn-add"><i class="bi bi-plus-circle" aria-hidden="true"></i> Tambah Prestasi</a>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card total"><div class="stat-label"><i class="bi bi-bar-chart" aria-hidden="true"></i> Total Prestasi</div><div class="stat-value">{{ $achievements->count() }}</div></div>
                <div class="stat-card international"><div class="stat-label"><i class="bi bi-globe2" aria-hidden="true"></i> Internasional</div><div class="stat-value">{{ $achievements->where('level', 'Internasional')->count() }}</div></div>
                <div class="stat-card featured"><div class="stat-label"><i class="bi bi-star-fill" aria-hidden="true"></i> Unggulan</div><div class="stat-value">{{ $achievements->where('is_featured', true)->count() }}</div></div>
                <div class="stat-card draft"><div class="stat-label"><i class="bi bi-file-earmark-text" aria-hidden="true"></i> Draft</div><div class="stat-value">{{ $achievements->where('status', '!=', 'published')->count() }}</div></div>
            </div>

            <section class="card">
                <h2>Riwayat Prestasi</h2>
                <table class="data-table">
                    <thead><tr><th>Nama Siswa / Tim</th><th>Kompetisi</th><th>Level</th><th>Peringkat</th><th>Aksi</th></tr></thead>
                    <tbody>
                    @forelse ($achievements as $achievement)
                        <tr>
                            <td style="font-weight:900;">{{ $achievement->student_name ?? 'Tim Sekolah' }}<br><span style="font-weight:500; color:#94a3b8; font-size:11px;">{{ $achievement->class_name ?? $achievement->year }}</span></td>
                            <td>{{ $achievement->title }}<br><span style="font-size:11px; color:#94a3b8;">{{ $achievement->competition }}</span></td>
                            <td><span class="badge">{{ $achievement->level }}</span></td>
                            <td style="font-weight:900; color:#c59632;">{{ $achievement->rank }}</td>
                            <td>
                                <div style="display:flex; gap:8px; flex-wrap:wrap;">
                                    <a class="btn-light" href="{{ route('prestasi.edit', $achievement) }}"><i class="bi bi-pencil-square" aria-hidden="true"></i> Edit</a>
                                    <form method="POST" action="{{ route('admin.prestasi.destroy', $achievement) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-danger" type="submit"><i class="bi bi-trash" aria-hidden="true"></i> Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5">Belum ada data prestasi.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</div>
</body>
</html>
