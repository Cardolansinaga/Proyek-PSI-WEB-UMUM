<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Prestasi - SMAN 2 Balige</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { overflow-x: hidden; font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        .admin-container { display: flex; min-height: 100vh; width: 100vw; }

        /* SIDEBAR KONSISTEN */
        .sidebar { width: 260px; background-color: #071f3a; flex-shrink: 0; display: flex; flex-direction: column; color: white; position: sticky; top: 0; height: 100vh; }
        .nav-item { padding: 12px 16px; display: flex; align-items: center; gap: 12px; font-size: 14px; font-weight: 500; color: #94a3b8; text-decoration: none; transition: 0.2s; }
        .active-nav { background: rgba(255,255,255,0.1); color: white; border-radius: 12px; font-weight: 700; border-left: 4px solid #10b981; }

        /* CONTENT AREA */
        .main-content { flex-grow: 1; display: flex; flex-direction: column; }
        .header { height: 70px; background: white; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; padding: 0 32px; position: sticky; top: 0; z-index: 10; }
        .content-padding { padding: 40px; max-width: 1200px; margin: 0 auto; width: 100%; }

        /* FORM STYLES */
        .form-grid { display: grid; grid-template-columns: 1fr 320px; gap: 32px; margin-top: 32px; }
        .card { background: white; border: 1px solid #f1f5f9; border-radius: 20px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 24px; }
        .section-title { font-size: 18px; font-weight: 800; color: #071f3a; display: flex; align-items: center; gap: 12px; margin-bottom: 24px; }
        
        .input-group { margin-bottom: 20px; }
        .input-group label { display: block; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; }
        .custom-input { width: 100%; padding: 12px 16px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; color: #1e293b; outline: none; }
        .custom-textarea { width: 100%; padding: 12px 16px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; color: #1e293b; min-height: 150px; resize: vertical; outline: none; }

        /* UPLOAD BOX */
        .upload-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .upload-box { border: 2px dashed #e2e8f0; border-radius: 16px; padding: 32px; text-align: center; cursor: pointer; transition: 0.2s; }
        .upload-box:hover { border-color: #071f3a; background: #f8fafc; }

        /* TOGGLE SWITCH */
        .switch { position: relative; display: inline-block; width: 40px; height: 22px; }
        .switch input { opacity: 0; width: 0; height: 0; }
        .slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #e2e8f0; transition: .4s; border-radius: 24px; }
        .slider:before { position: absolute; content: ""; height: 16px; width: 16px; left: 3px; bottom: 3px; background-color: white; transition: .4s; border-radius: 50%; }
        input:checked + .slider { background-color: #10b981; }
        input:checked + .slider:before { transform: translateX(18px); }

        .btn-save { background: #071f3a; color: white; padding: 12px 32px; border-radius: 12px; font-weight: 700; border: none; cursor: pointer; }
        .btn-cancel { background: white; border: 1px solid #e2e8f0; padding: 12px 32px; border-radius: 12px; font-weight: 700; color: #475569; text-decoration: none; }
        
        .preview-web-card { background: linear-gradient(180deg, rgba(7,31,58,0) 0%, rgba(7,31,58,1) 100%), url('https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?w=400'); background-size: cover; border-radius: 20px; height: 320px; color: white; padding: 24px; display: flex; flex-direction: column; justify-content: flex-end; }
    </style>
</head>
<body>

<div class="admin-container">
    <aside class="sidebar">
        <div style="padding: 32px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 32px;">
                <div style="background: #d6a63a; width: 40px; height: 40px; border-radius: 10px; display: grid; place-items: center; font-weight: 900;">S2</div>
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
                <a href="#" class="nav-item">⚙️ Pengaturan</a>
            </nav>
        </div>
    </aside>

    <div class="main-content">
        <header class="header">
            <div style="font-size: 12px; font-weight: 800; color: #94a3b8; letter-spacing: 1px;">
                PANEL ADMIN <span style="margin: 0 8px; color: #e2e8f0;">/</span> <span style="color: #64748b;">Kelola Prestasi Siswa</span>
            </div>
        </header>

        <main class="content-padding">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 32px;">
                <div>
                    <h1 style="font-size: 36px; font-weight: 800; color: #071f3a;">Tambah Prestasi</h1>
                    <p style="color: #64748b; font-size: 14px; margin-top: 8px;">Publikasikan pencapaian gemilang siswa SMAN 2 Balige di kancah nasional maupun internasional.</p>
                </div>
                <div style="display: flex; gap: 12px;">
                    <a href="{{ route('prestasi.index') }}" class="btn-cancel">Batal</a>
                    <button class="btn-save">Simpan Data</button>
                </div>
            </div>

            <div class="form-grid">
                <div>
                    <!-- Informasi Utama -->
                    <div class="card">
                        <h3 class="section-title">🟢 Informasi Utama</h3>
                        <div class="input-group">
                            <label>Nama Prestasi / Nama Lomba</label>
                            <input type="text" class="custom-input" placeholder="Contoh: Juara 1 Olimpiade Sains Nasional (OSN) Bidang Astronomi">
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                            <div class="input-group">
                                <label>Tingkat Prestasi</label>
                                <select class="custom-input">
                                    <option>Pilih Tingkat</option>
                                    <option>Nasional</option>
                                    <option>Internasional</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <label>Tahun Perolehan</label>
                                <input type="number" class="custom-input" value="2024">
                            </div>
                        </div>
                        <div class="input-group">
                            <label>Nama Siswa atau Tim</label>
                            <input type="text" class="custom-input" placeholder="Masukkan nama lengkap siswa atau nama tim/ekstrakurikuler">
                            <p style="font-size: 10px; color: #94a3b8; margin-top: 5px;">Pisahkan dengan koma jika lebih dari satu siswa.</p>
                        </div>
                        <div class="input-group">
                            <label>Deskripsi & Narasi</label>
                            <textarea class="custom-textarea" placeholder="Ceritakan bagaimana perjuangan dan detail kemenangan yang diraih..."></textarea>
                        </div>
                    </div>

                    <!-- Media & Sertifikat -->
                    <div class="card">
                        <h3 class="section-title">🖼️ Media & Sertifikat</h3>
                        <div class="upload-grid">
                            <div class="upload-box">
                                <div style="font-size: 24px; margin-bottom: 10px;">📤</div>
                                <div style="font-size: 12px; font-weight: 800; color: #1e293b;">Klik untuk unggah foto</div>
                                <div style="font-size: 10px; color: #94a3b8; margin-top: 5px;">Format JPG, PNG (Maks 5MB)</div>
                            </div>
                            <div class="upload-box">
                                <div style="font-size: 24px; margin-bottom: 10px;">📄</div>
                                <div style="font-size: 12px; font-weight: 800; color: #1e293b;">Klik untuk unggah berkas</div>
                                <div style="font-size: 10px; color: #94a3b8; margin-top: 5px;">Format PDF, JPG (Maks 10MB)</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <!-- Status Publikasi -->
                    <div class="card">
                        <h4 style="font-size: 16px; font-weight: 800; color: #071f3a; margin-bottom: 20px;">Status Publikasi</h4>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                            <div>
                                <div style="font-size: 12px; font-weight: 800; color: #1e293b;">Tampilkan di Website</div>
                                <div style="font-size: 10px; color: #94a3b8;">Aktifkan untuk dilihat publik</div>
                            </div>
                            <label class="switch"><input type="checkbox" checked><span class="slider"></span></label>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                            <div>
                                <div style="font-size: 12px; font-weight: 800; color: #1e293b;">Prestasi Unggulan</div>
                                <div style="font-size: 10px; color: #94a3b8;">Pin di halaman utama (Home)</div>
                            </div>
                            <label class="switch"><input type="checkbox"><span class="slider"></span></label>
                        </div>
                        <div class="input-group">
                            <label>Prioritas Tampilan</label>
                            <select class="custom-input">
                                <option>Medium</option>
                                <option>High</option>
                            </select>
                        </div>
                    </div>

                    <!-- Informasi Tambahan -->
                    <div class="card">
                        <h4 style="font-size: 16px; font-weight: 800; color: #071f3a; margin-bottom: 15px;">Informasi Tambahan</h4>
                        <div style="display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 20px;">
                            <span style="background: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 4px; font-size: 10px; font-weight: 800;">AKADEMIK</span>
                            <span style="background: #f1f5f9; color: #475569; padding: 4px 10px; border-radius: 4px; font-size: 10px; font-weight: 800;">NON-AKADEMIK</span>
                            <span style="background: #fffbeb; color: #92400e; padding: 4px 10px; border-radius: 4px; font-size: 10px; font-weight: 800;">SAINS</span>
                        </div>
                        <div style="font-size: 11px; color: #94a3b8; line-height: 2;">
                            🕒 Tgl. Input: 24 May 2024<br>
                            👤 Input Oleh: Admin Akademik
                        </div>
                    </div>

                    <!-- Preview Card -->
                    <div class="preview-web-card">
                        <span style="background: #d6a63a; padding: 4px 12px; border-radius: 4px; font-size: 10px; font-weight: 800; align-self: flex-start; margin-bottom: auto;">PREVIEW WEBSITE</span>
                        <h4 style="font-size: 18px; font-weight: 800; margin-bottom: 10px;">Nama Prestasi Muncul Disini...</h4>
                        <p style="font-size: 11px; color: #cbd5e1; line-height: 1.6; margin-bottom: 15px;">Deskripsi singkat prestasi akan ditampilkan di card website seperti ini.</p>
                        <div style="display: flex; justify-content: space-between; align-items: center; font-size: 10px; font-weight: 800;">
                            <span>2024 • NASIONAL</span>
                            <span>→</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

</body>
</html>