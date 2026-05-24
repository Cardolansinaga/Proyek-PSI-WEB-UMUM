<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen PPDB - SMAN 2 Balige</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('pages.admin.partials.admin-polish')
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { overflow: hidden; font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); }
        .admin-container { display: flex; height: 100vh; width: 100vw; }
        .main-content { flex: 1; overflow-y: auto; }
        .content-padding { padding: 32px; }
        .card { background: white; border-radius: 14px; padding: 28px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
        .card h2 { font-size: 22px; color: #071f3a; font-weight: 900; margin-bottom: 20px; }
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin: 32px 0; }
        .stat-card { background: white; border-radius: 14px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); border-left: 4px solid; transition: all 0.3s ease; }
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 12px 24px rgba(0,0,0,0.1); }
        .stat-card.total { border-left-color: #d6a63a; }
        .stat-card.verified { border-left-color: #16a34a; }
        .stat-card.waiting { border-left-color: #d97706; }
        .stat-card.revision { border-left-color: #dc2626; }
        .stat-label { color: #94a3b8; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 10px; }
        .stat-value { font-size: 32px; font-weight: 900; color: #071f3a; }
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table thead tr { background: linear-gradient(90deg, #f8fafc 0%, #f1f5f9 100%); }
        .data-table th { padding: 14px 12px; color: #64748b; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; text-align: left; }
        .data-table td { padding: 16px 12px; border-bottom: 1px solid #f1f5f9; font-size: 14px; color: #1e293b; text-align: left; vertical-align: middle; }
        .data-table tbody tr { transition: all 0.2s ease; }
        .data-table tbody tr:hover { background-color: #f8fafc; }
        .badge { display: inline-flex; align-items: center; border-radius: 8px; padding: 6px 12px; font-size: 11px; font-weight: 900; }
        @media (max-width: 900px) { .stats-grid { grid-template-columns: 1fr; } }
    </style>
    @include('pages.admin.partials.responsive')
</head>
<body>
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'ppdb'])
    <div class="main-content">
        <main class="content-padding">
            <div style="display:flex; justify-content:space-between; gap:20px; align-items:flex-start; flex-wrap:wrap; margin-bottom:32px;">
                <div>
                    <h1 style="font-size:36px; font-weight:900; color:#071f3a;">Manajemen PPDB</h1>
                    <p style="margin-top:8px; color:#64748b; font-size:14px;">Pantau pendaftar, verifikasi berkas, dan status penerimaan tahun ajaran {{ $settings['ppdb_year'] ?? '2026/2027' }}.</p>
                    @if (session('status'))
                        <p style="margin-top:12px; color:#166534; font-weight:900; padding:10px 12px; background:#dcfce7; border-radius:8px; display:inline-block; font-size:13px;">✓ {{ session('status') }}</p>
                    @endif
                </div>
                <a href="{{ route('ppdb') }}" style="border-radius:10px; background: linear-gradient(135deg, #071f3a 0%, #0f2847 100%); color:white; padding:12px 20px; font-weight:900; text-decoration:none; box-shadow: 0 4px 12px rgba(7, 31, 58, 0.2); transition: all 0.3s; display:inline-block;" onmouseover="this.style.boxShadow='0 8px 20px rgba(7, 31, 58, 0.3)'; this.style.transform='translateY(-2px)';" onmouseout="this.style.boxShadow='0 4px 12px rgba(7, 31, 58, 0.2)'; this.style.transform='translateY(0)';">Lihat Halaman Publik</a>
            </div>

            <div class="stats-grid">
                <div class="stat-card total"><div class="stat-label">📋 Total Pendaftar</div><div class="stat-value">{{ $applications->count() }}</div></div>
                <div class="stat-card verified"><div class="stat-label">✓ Terverifikasi</div><div class="stat-value">{{ $applications->where('status', 'verified')->count() }}</div></div>
                <div class="stat-card waiting"><div class="stat-label">⏳ Menunggu</div><div class="stat-value">{{ $applications->where('status', 'waiting')->count() }}</div></div>
                <div class="stat-card revision"><div class="stat-label">⚠ Perlu Revisi</div><div class="stat-value">{{ $applications->where('status', 'revision')->count() }}</div></div>
            </div>

            <div class="card">
                <h2>Pendaftar Terbaru</h2>
                <table class="data-table">
                    <thead><tr><th>No. Registrasi</th><th>Nama</th><th>Jalur</th><th>Asal Sekolah</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                    @forelse ($applications as $application)
                        @php
                            $statusMap = [
                                'waiting' => ['Menunggu', '#fef3c7', '#92400e'],
                                'verified' => ['Terverifikasi', '#dcfce7', '#166534'],
                                'revision' => ['Revisi', '#ffedd5', '#9a3412'],
                                'rejected' => ['Ditolak', '#fee2e2', '#991b1b'],
                            ];
                            $status = $statusMap[$application->status] ?? $statusMap['waiting'];
                        @endphp
                        <tr>
                            <td style="font-weight:900;">{{ $application->registration_number }}</td>
                            <td>{{ $application->full_name }}</td>
                            <td>{{ $application->pathway }}</td>
                            <td>{{ $application->origin_school }}</td>
                            <td><span class="badge" style="background:{{ $status[1] }}; color:{{ $status[2] }};">{{ $status[0] }}</span></td>
                            <td><a href="{{ route('admin.ppdb.show', $application) }}" style="color:#071f3a; font-weight:900; text-decoration:none;">Detail</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="6">Belum ada pendaftar PPDB.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
</body>
</html>
