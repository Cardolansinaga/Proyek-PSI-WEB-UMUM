<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Guru - SMAN 2 Balige</title>
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

        .content-padding { padding: 32px; max-width: 1200px; margin: 0 auto; width: 100%; }
        
        /* FORM LAYOUT */
        .form-grid { display: grid; grid-template-columns: 320px 1fr; gap: 32px; margin-top: 32px; }
        .card { background: white; border: 1px solid #f1f5f9; border-radius: 20px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 24px; }
        
        .section-title { font-size: 18px; font-weight: 800; color: #071f3a; display: flex; align-items: center; gap: 12px; margin-bottom: 24px; }
        .input-group { margin-bottom: 20px; }
        .input-group label { display: block; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; }
        .custom-input { width: 100%; padding: 12px 16px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; color: #1e293b; outline: none; }
        .custom-textarea { width: 100%; padding: 12px 16px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 14px; color: #1e293b; min-height: 100px; resize: vertical; outline: none; }

        /* BUTTONS */
        .btn-save-top { background: #071f3a; color: white; padding: 12px 24px; border-radius: 12px; font-weight: 700; border: none; cursor: pointer; display: flex; align-items: center; gap: 10px; }
        .btn-cancel { background: white; border: 1px solid #e2e8f0; padding: 12px 24px; border-radius: 12px; font-weight: 700; color: #475569; text-decoration: none; display: inline-block; }
        .btn-delete { background: #f8fafc; border: 1px solid #e2e8f0; padding: 12px 24px; border-radius: 12px; font-weight: 700; color: #1e293b; cursor: pointer; }
        .btn-save-bottom { background: #071f3a; color: white; padding: 12px 40px; border-radius: 12px; font-weight: 700; border: none; cursor: pointer; }

        /* TOGGLE SWITCH */
        .switch { position: relative; display: inline-block; width: 44px; height: 24px; }
        .switch input { opacity: 0; width: 0; height: 0; }
        .slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #e2e8f0; transition: .4s; border-radius: 24px; }
        .slider:before { position: absolute; content: ""; height: 18px; width: 18px; left: 3px; bottom: 3px; background-color: white; transition: .4s; border-radius: 50%; }
        input:checked + .slider { background-color: #10b981; }
        input:checked + .slider:before { transform: translateX(20px); }
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
                <a href="{{ route('guru.index') }}" class="nav-item active-nav">👥 Guru & Staf</a>
                <a href="#" class="nav-item">📰 Berita</a>
                <a href="#" class="nav-item">📢 Pengumuman</a>
                <a href="#" class="nav-item">🏅 Prestasi</a>
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
                PANEL ADMIN <span style="margin: 0 8px; color: #e2e8f0;">/</span> <span style="color: #64748b;">Edit Profil Guru</span>
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
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                <div>
                    <h1 style="font-size: 36px; font-weight: 800; color: #071f3a;">Edit Profile Guru</h1>
                    <p style="color: #64748b; font-size: 14px; margin-top: 8px;">Perbarui informasi personal, kualifikasi akademik, dan kontak staf pengajar SMAN 2 Balige.</p>
                </div>
                <div style="display: flex; gap: 12px;">
                    <a href="{{ route('guru.index') }}" class="btn-cancel">✕ Batal</a>
                    <button class="btn-save-top">💾 Simpan Perubahan</button>
                </div>
            </div>

            <div class="form-grid">
                <!-- PANEL KIRI -->
                <div>
                    <div class="card" style="text-align: center;">
                        <div style="position: relative; width: 160px; height: 160px; margin: 0 auto 20px auto;">
                            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%; border: 4px solid #f8fafc;" alt="Guru">
                            <button style="position: absolute; bottom: 8px; right: 8px; background: #071f3a; color: white; border: none; width: 35px; height: 35px; border-radius: 50%; cursor: pointer; display: grid; place-items: center; font-size: 14px;">📷</button>
                        </div>
                        <h3 style="font-size: 20px; font-weight: 800; color: #071f3a;">Dra. Maria Sinaga</h3>
                        <p style="font-size: 12px; color: #94a3b8; margin-top: 4px;">NIP. 19780512 200501 2 004</p>
                        <div style="display: flex; justify-content: center; gap: 8px; margin-top: 16px;">
                            <span style="background: #dcfce7; color: #166534; padding: 4px 12px; border-radius: 20px; font-size: 10px; font-weight: 800;">AKTIF</span>
                            <span style="background: #fffbeb; color: #92400e; padding: 4px 12px; border-radius: 20px; font-size: 10px; font-weight: 800;">GURU SENIOR</span>
                        </div>
                    </div>

                    <div class="card">
                        <h4 style="font-size: 12px; font-weight: 800; color: #071f3a; letter-spacing: 1px; margin-bottom: 20px;">⚙️ PENGATURAN TAMPILAN</h4>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                            <div>
                                <div style="font-size: 12px; font-weight: 800; color: #1e293b;">Publikasikan Profil</div>
                                <div style="font-size: 10px; color: #94a3b8;">Tampilkan di website sekolah</div>
                            </div>
                            <label class="switch"><input type="checkbox" checked><span class="slider"></span></label>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <div style="font-size: 12px; font-weight: 800; color: #1e293b;">Detail Kontak Publik</div>
                                <div style="font-size: 10px; color: #94a3b8;">Izinkan pengunjung melihat email</div>
                            </div>
                            <label class="switch"><input type="checkbox"><span class="slider"></span></label>
                        </div>
                    </div>

                    <div style="color: #94a3b8; font-size: 11px; line-height: 2;">
                        Dibuat pada: <span style="color: #475569; font-weight: 700; margin-left: 50px;">12 Jan 2021</span><br>
                        Terakhir update: <span style="color: #475569; font-weight: 700; margin-left: 28px;">Kemarin, 14:20</span><br>
                        ID Pegawai: <span style="color: #475569; font-weight: 700; margin-left: 48px;">#STF-2021-099</span>
                    </div>
                </div>

                <!-- PANEL KANAN -->
                <div>
                    <!-- Informasi Personal -->
                    <div class="card">
                        <h3 class="section-title">👤 Informasi Personal</h3>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                            <div class="input-group">
                                <label>Nama Lengkap & Gelar</label>
                                <input type="text" class="custom-input" value="Dra. Maria Sinaga">
                            </div>
                            <div class="input-group">
                                <label>Nomor Induk Pegawai (NIP)</label>
                                <input type="text" class="custom-input" value="19780512 200501 2 004">
                            </div>
                            <div class="input-group">
                                <label>Tempat Lahir</label>
                                <input type="text" class="custom-input" value="Balige">
                            </div>
                            <div class="input-group">
                                <label>Tanggal Lahir</label>
                                <input type="text" class="custom-input" value="05/12/1978">
                            </div>
                        </div>
                    </div>

                    <!-- Peran & Kualifikasi -->
                    <div class="card">
                        <h3 class="section-title">🎓 Peran & Kualifikasi</h3>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                            <div class="input-group">
                                <label>Jabatan / Role</label>
                                <select class="custom-input">
                                    <option>Guru Mata Pelajaran</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <label>Mata Pelajaran Utama</label>
                                <input type="text" class="custom-input" value="Matematika & Kalkulus">
                            </div>
                        </div>
                        <div class="input-group">
                            <label>Pendidikan Terakhir</label>
                            <input type="text" class="custom-input" value="S2 Pendidikan Matematika - Universitas Negeri Medan">
                        </div>
                    </div>

                    <!-- Biografi & Kontak -->
                    <div class="card">
                        <h3 class="section-title">📩 Biografi & Kontak</h3>
                        <div class="input-group">
                            <label>Biografi Singkat</label>
                            <textarea class="custom-textarea">Berpengalaman lebih dari 15 tahun mengajar Matematika di tingkat SMA. Berdedikasi untuk menciptakan metode pembelajaran yang interaktif dan mudah dipahami bagi siswa-siswi SMAN 2 Balige. Fokus pada persiapan olimpiade matematika nasional.</textarea>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                            <div class="input-group">
                                <label>Email Sekolah</label>
                                <input type="email" class="custom-input" value="maria.sinaga@sman2balige.sch.id">
                            </div>
                            <div class="input-group">
                                <label>Nomor Whatsapp</label>
                                <input type="text" class="custom-input" value="+62 812-3456-7890">
                            </div>
                        </div>
                    </div>

                    <!-- FOOTER BUTTONS -->
                    <div style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 20px;">
                        <button class="btn-delete">Hapus Data Guru</button>
                        <button class="btn-save-bottom">Simpan Profil</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

</body>
</html>