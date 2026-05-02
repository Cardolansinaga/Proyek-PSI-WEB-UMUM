<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pengumuman - SMAN 2 Balige</title>
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

        /* FORM LAYOUT */
        .form-grid { display: grid; grid-template-columns: 1fr 320px; gap: 32px; margin-top: 32px; }
        .card { background: white; border: 1px solid #f1f5f9; border-radius: 20px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 24px; }
        
        .input-group { margin-bottom: 24px; }
        .input-group label { display: block; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; }
        .custom-input { width: 100%; padding: 14px 16px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; color: #1e293b; outline: none; }
        
        /* TEXT EDITOR SIMULATION */
        .editor-box { border: 1px solid #e2e8f0; border-radius: 10px; overflow: hidden; }
        .editor-toolbar { background: #f8fafc; padding: 10px; border-bottom: 1px solid #e2e8f0; display: flex; gap: 15px; color: #64748b; }
        .editor-content { padding: 16px; min-height: 250px; background: white; font-size: 14px; color: #1e293b; outline: none; }

        /* UPLOAD AREA */
        .upload-area { border: 2px dashed #e2e8f0; border-radius: 16px; padding: 40px; text-align: center; cursor: pointer; background: #f8fafc; transition: 0.2s; }
        .upload-area:hover { border-color: #071f3a; }

        /* CHECKBOX LIST */
        .target-item { background: #f8fafc; padding: 12px 16px; border-radius: 10px; display: flex; align-items: center; gap: 12px; margin-bottom: 10px; cursor: pointer; transition: 0.2s; }
        .target-item:hover { background: #f1f5f9; }

        /* TOGGLE SWITCH */
        .switch { position: relative; display: inline-block; width: 44px; height: 24px; }
        .switch input { opacity: 0; width: 0; height: 0; }
        .slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #e2e8f0; transition: .4s; border-radius: 24px; }
        .slider:before { position: absolute; content: ""; height: 18px; width: 18px; left: 3px; bottom: 3px; background-color: white; transition: .4s; border-radius: 50%; }
        input:checked + .slider { background-color: #ef4444; }
        input:checked + .slider:before { transform: translateX(20px); }

        .btn-publish { background: #071f3a; color: white; padding: 14px 32px; border-radius: 12px; font-weight: 700; border: none; cursor: pointer; }
        .btn-draft { background: white; border: 1px solid #e2e8f0; padding: 14px 32px; border-radius: 12px; font-weight: 700; color: #475569; text-decoration: none; }
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
                <a href="#" class="nav-item">📰 Berita</a>
                <a href="#" class="nav-item">⚙️ Pengaturan</a>
            </nav>
        </div>
    </aside>

    <div class="main-content">
        <header class="header">
            <div style="font-size: 12px; font-weight: 800; color: #94a3b8; letter-spacing: 1px;">
                PENGUMUMAN <span style="margin: 0 8px; color: #e2e8f0;">/</span> <span style="color: #64748b;">Buat Pengumuman Baru</span>
            </div>
        </header>

        <main class="content-padding">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 32px;">
                <div>
                    <h1 style="font-size: 40px; font-weight: 800; color: #071f3a;">Buat Pengumuman</h1>
                    <p style="color: #64748b; font-size: 14px; margin-top: 8px;">Lengkapi detail informasi untuk pengumuman akademik terbaru.</p>
                </div>
                <div style="display: flex; gap: 12px;">
                    <a href="{{ route('pengumuman.index') }}" class="btn-draft">Simpan Draft</a>
                    <button class="btn-publish">Terbitkan Sekarang</button>
                </div>
            </div>

            <div class="form-grid">
                <!-- PANEL KIRI -->
                <div>
                    <div class="card">
                        <div class="input-group">
                            <label>Judul Pengumuman</label>
                            <input type="text" class="custom-input" placeholder="Masukkan judul yang jelas dan informatif">
                        </div>
                        <div class="input-group">
                            <label>Konten Pengumuman</label>
                            <div class="editor-box">
                                <div class="editor-toolbar">
                                    <span style="font-weight: 900; cursor: pointer;">B</span>
                                    <span style="font-style: italic; cursor: pointer;">I</span>
                                    <span style="cursor: pointer;">≡</span>
                                    <span style="cursor: pointer;">🔗</span>
                                </div>
                                <div class="editor-content" contenteditable="true">Tuliskan detail pengumuman di sini...</div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <label style="display: block; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 16px;">Lampiran Dokumen</label>
                        <div class="upload-area">
                            <div style="background: #e0e7ff; width: 48px; height: 48px; border-radius: 12px; display: grid; place-items: center; margin: 0 auto 16px auto; color: #4338ca;">📄</div>
                            <div style="font-size: 14px; font-weight: 800; color: #1e293b;">Klik untuk unggah atau seret file ke sini</div>
                            <div style="font-size: 12px; color: #94a3b8; margin-top: 8px;">PDF, DOCX, JPG atau PNG (Maks. 5MB)</div>
                        </div>
                    </div>
                </div>

                <!-- PANEL KANAN -->
                <div>
                    <div class="card">
                        <label style="display: block; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 16px;">Pengaturan Status</label>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                            <div style="display: flex; align-items: center; gap: 8px; font-size: 14px; font-weight: 700; color: #071f3a;">
                                <span style="color: #ef4444;">❗</span> Penting
                            </div>
                            <label class="switch"><input type="checkbox"><span class="slider"></span></label>
                        </div>
                        <div class="input-group">
                            <label>Kategori</label>
                            <select class="custom-input">
                                <option>Akademik</option>
                                <option>Kegiatan</option>
                            </select>
                        </div>
                    </div>

                    <div class="card">
                        <label style="display: block; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 16px;">Target Audiens</label>
                        <div class="target-item">
                            <input type="checkbox" checked> <span style="font-size: 13px; font-weight: 700; color: #475569;">Semua Siswa</span>
                        </div>
                        <div class="target-item">
                            <input type="checkbox"> <span style="font-size: 13px; font-weight: 700; color: #475569;">Semua Orang Tua</span>
                        </div>
                        <div class="target-item">
                            <input type="checkbox"> <span style="font-size: 13px; font-weight: 700; color: #475569;">Guru & Staff</span>
                        </div>
                        <div class="target-item">
                            <input type="checkbox"> <span style="font-size: 13px; font-weight: 700; color: #475569;">Siswa Kelas XII Saja</span>
                        </div>
                    </div>

                    <div class="card">
                        <label style="display: block; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 16px;">Periode Tampil</label>
                        <div class="input-group">
                            <label>Tanggal Mulai</label>
                            <input type="date" class="custom-input">
                        </div>
                        <div class="input-group">
                            <label>Tanggal Berakhir</label>
                            <input type="date" class="custom-input">
                        </div>
                    </div>

                    <div style="background: #fffbeb; border-radius: 16px; padding: 20px; border: 1px solid #fef3c7;">
                        <div style="display: flex; gap: 12px;">
                            <span style="font-size: 20px;">💡</span>
                            <div>
                                <div style="font-size: 13px; font-weight: 800; color: #92400e; margin-bottom: 4px;">Tips Formalitas</div>
                                <div style="font-size: 11px; color: #b45309; line-height: 1.5;">Gunakan bahasa yang lugas dan objektif. Pastikan tanggal ujian atau deadline ditulis tebal agar mudah terbaca.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

</body>
</html>