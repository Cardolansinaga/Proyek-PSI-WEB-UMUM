<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail PPDB - SMAN 2 Balige</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo-sman2-balige.jpg') }}">
    @vite('resources/css/admin.css')
    @include('pages.admin.partials.admin-polish')
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { overflow: hidden; font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); }
        .admin-container { display: flex; height: 100vh; width: 100vw; }
        .sidebar { width: 260px; background: #071f3a; flex-shrink: 0; display: flex; flex-direction: column; color: white; }
        .main-content { flex: 1; overflow-y: auto; }
        .content-padding { padding: 34px 30px; max-width: 1120px; margin: 0 auto; width: 100%; }
        .page-head { display: flex; justify-content: space-between; gap: 20px; margin-bottom: 32px; }
        .page-head h1 { font-size: 36px; color: #071f3a; font-weight: 900; }
        .page-head p { color: #64748b; margin-top: 8px; font-size: 14px; }
        .grid { display: grid; grid-template-columns: minmax(0, 1fr) 340px; gap: 24px; }
        .card { background: white; border-radius: 14px; padding: 28px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
        .card h2 { font-size: 22px; color: #071f3a; font-weight: 900; margin-bottom: 20px; }
        .info-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 14px; }
        .info { padding: 16px; border: 1px solid #f1f5f9; border-radius: 10px; background: #fbfdff; transition: all 0.2s ease; }
        .info:hover { background: #f8fafc; border-color: #d6a63a; }
        .info span { display: block; font-size: 11px; color: #94a3b8; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; }
        .info strong { color: #071f3a; font-size: 14px; }
        .doc-row { display: flex; justify-content: space-between; gap: 12px; padding: 16px 0; border-bottom: 1px solid #f1f5f9; transition: all 0.2s ease; }
        .doc-row:hover { background: #fbfdff; padding: 16px 12px; margin: 0 -12px; border-radius: 8px; }
        .doc-row strong { color: #071f3a; }
        .badge { border-radius: 999px; padding: 8px 12px; font-size: 11px; font-weight: 900; background: #dcfce7; color: #166534; }
        .btn-primary, .btn-outline, .btn-danger { border-radius: 10px; padding: 12px 18px; font-weight: 900; text-decoration: none; cursor: pointer; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.08); transition: all 0.3s ease; }
        .btn-primary { background: linear-gradient(135deg, #071f3a 0%, #0f2847 100%); color: white; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(7, 31, 58, 0.3); }
        .btn-outline { background: white; color: #071f3a; border: 1px solid #d9e1ec; box-shadow: 0 2px 8px rgba(0,0,0,0.04); }
        .btn-outline:hover { border-color: #d6a63a; box-shadow: 0 4px 12px rgba(214, 166, 58, 0.15); }
        .btn-danger { background: #fff1f2; color: #be123c; border: 1px solid #fecdd3; }
        .btn-danger:hover { background: #ffe4e6; box-shadow: 0 4px 12px rgba(190, 18, 60, 0.15); }
        @media (max-width: 900px) { .grid, .info-grid { grid-template-columns: 1fr; } .page-head { flex-direction: column; } }
    </style>
    @include('pages.admin.partials.responsive')
</head>
<body>
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'ppdb'])
    <div class="main-content">
        <main class="content-padding">
            <div class="page-head">
                <div>
                    <h1>Detail Pendaftar PPDB</h1>
                    <p>Periksa data calon siswa, kelengkapan berkas, dan status verifikasi pendaftaran.</p>
                </div>
                <a href="{{ route('admin.ppdb') }}" class="btn-outline"><i class="bi bi-arrow-left" aria-hidden="true"></i> Kembali ke PPDB</a>
            </div>

            <div class="grid">
                <section class="card">
                    <h2><i class="bi bi-person-vcard" aria-hidden="true"></i> Data Calon Siswa</h2>
                    <div class="info-grid">
                        <div class="info"><span>No. Registrasi</span><strong>{{ $application->registration_number }}</strong></div>
                        <div class="info"><span>Status</span><strong>{{ ucfirst($application->status) }}</strong></div>
                        <div class="info"><span>Nama Lengkap</span><strong>{{ $application->full_name }}</strong></div>
                        <div class="info"><span>Jalur Pendaftaran</span><strong>{{ $application->pathway }}</strong></div>
                        <div class="info"><span>Asal Sekolah</span><strong>{{ $application->origin_school }}</strong></div>
                        <div class="info"><span>Nomor Kontak</span><strong>{{ $application->phone }}</strong></div>
                        <div class="info"><span>Nama Orang Tua</span><strong>{{ $application->parent_name }}</strong></div>
                        <div class="info"><span>Alamat</span><strong>{{ $application->address }}</strong></div>
                    </div>
                </section>

                <aside class="card">
                    <h2><i class="bi bi-shield-check" aria-hidden="true"></i> Aksi Verifikasi</h2>
                    <form method="POST" action="{{ route('admin.ppdb.verify', $application) }}" style="display: grid; gap: 12px;">
                        @csrf
                        <button type="submit" name="status" value="verified" class="btn-primary"><i class="bi bi-check-circle" aria-hidden="true"></i> Terverifikasi</button>
                        <button type="submit" name="status" value="revision" class="btn-outline"><i class="bi bi-arrow-repeat" aria-hidden="true"></i> Minta Revisi Berkas</button>
                        <button type="submit" name="status" value="rejected" class="btn-danger"><i class="bi bi-x-circle" aria-hidden="true"></i> Tolak Pendaftaran</button>
                    </form>
                </aside>

                <section class="card" style="grid-column: 1 / -1;">
                    <h2><i class="bi bi-folder-check" aria-hidden="true"></i> Kelengkapan Berkas</h2>
                    @foreach (($application->documents ?? []) as $document => $isComplete)
                        <div class="doc-row"><strong>{{ $document }}</strong><span class="badge" style="{{ $isComplete ? '' : 'background:#fee2e2;color:#991b1b;' }}">{{ $isComplete ? 'Lengkap' : 'Belum Lengkap' }}</span></div>
                    @endforeach
                </section>
            </div>
        </main>
    </div>
</div>
</body>
</html>
