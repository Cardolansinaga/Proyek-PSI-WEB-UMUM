<aside class="sidebar">
    <div style="padding: 32px;">
        <div class="admin-sidebar-brand" style="display: flex; align-items: center; gap: 12px; margin-bottom: 32px;">
            <img src="{{ asset('images/logo-sman2-balige-96.webp') }}" alt="Logo SMAN 2 Balige" width="44" height="44" style="width:44px;height:44px;border-radius:8px;object-fit:contain;background:#ffffff;padding:3px;box-shadow:0 8px 18px rgba(0,0,0,.18);">
            <div>
                <div style="font-size: 14px; font-weight: 900; line-height: 1; color: #ffffff;">SMAN 2 Balige</div>
                <div style="font-size: 10px; color: #94a3b8;">Halaman Pengelola</div>
            </div>
        </div>
        <button class="admin-sidebar-toggle" type="button" aria-controls="admin-sidebar-navigation" aria-expanded="false">
            <span>Menu Admin</span>
            <i class="bi bi-list" aria-hidden="true"></i>
        </button>
        <nav id="admin-sidebar-navigation" style="display: flex; flex-direction: column; gap: 4px;">
            <a href="{{ route('dashboard') }}" class="nav-item {{ ($activeAdmin ?? '') === 'dashboard' ? 'active-nav' : '' }}" title="Ringkasan semua menu admin"><span class="admin-nav-icon" aria-hidden="true"><i class="bi bi-speedometer2"></i></span><span>Ringkasan</span></a>
            <a href="{{ route('admin.beranda') }}" class="nav-item {{ ($activeAdmin ?? '') === 'beranda' ? 'active-nav' : '' }}" title="Ubah isi halaman Beranda"><span class="admin-nav-icon" aria-hidden="true"><i class="bi bi-house-door"></i></span><span>Isi Beranda</span></a>
            <a href="{{ route('admin.posts.index') }}" class="nav-item {{ ($activeAdmin ?? '') === 'berita' ? 'active-nav' : '' }}" title="Kelola berita dan pengumuman"><span class="admin-nav-icon" aria-hidden="true"><i class="bi bi-newspaper"></i></span><span>Berita</span></a>
            <a href="{{ route('prestasi.index') }}" class="nav-item {{ ($activeAdmin ?? '') === 'prestasi' ? 'active-nav' : '' }}" title="Kelola prestasi siswa"><span class="admin-nav-icon" aria-hidden="true"><i class="bi bi-trophy"></i></span><span>Prestasi</span></a>
            <a href="{{ route('admin.kesiswaan.index') }}" class="nav-item {{ ($activeAdmin ?? '') === 'kesiswaan' ? 'active-nav' : '' }}" title="Kelola organisasi dan ekstrakurikuler"><span class="admin-nav-icon" aria-hidden="true"><i class="bi bi-people"></i></span><span>Kegiatan Siswa</span></a>
            <a href="{{ route('admin.ppdb') }}" class="nav-item {{ ($activeAdmin ?? '') === 'ppdb' ? 'active-nav' : '' }}" title="Pantau dan ubah informasi PPDB"><span class="admin-nav-icon" aria-hidden="true"><i class="bi bi-journal-check"></i></span><span>Info PPDB</span></a>
            <a href="{{ route('admin.galeri') }}" class="nav-item {{ ($activeAdmin ?? '') === 'galeri' ? 'active-nav' : '' }}" title="Tambah dan ubah foto galeri"><span class="admin-nav-icon" aria-hidden="true"><i class="bi bi-images"></i></span><span>Foto Galeri</span></a>
            <a href="{{ route('admin.pengaturan') }}" class="nav-item {{ ($activeAdmin ?? '') === 'pengaturan' ? 'active-nav' : '' }}" title="Ubah identitas, kontak, dan teks halaman"><span class="admin-nav-icon" aria-hidden="true"><i class="bi bi-gear"></i></span><span>Pengaturan</span></a>
        </nav>
        <p class="sidebar-helper">Alur aman: pilih menu, ubah isi seperlunya, klik tombol simpan, lalu cek halaman publik.</p>
    </div>
    <div style="margin-top: auto; padding: 32px;">
        <div class="sidebar-actions">
            <a class="sidebar-view-site" href="{{ route('home') }}" target="_blank" rel="noopener">
                <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i>
                <span>Lihat Website</span>
            </a>
            <a class="sidebar-password-link" href="{{ route('admin.password.edit') }}">
                <i class="bi bi-shield-lock" aria-hidden="true"></i>
                <span>Ganti Password</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="admin-logout-button" type="submit" onclick="return confirm('Keluar dari halaman admin? Data yang sudah disimpan tetap aman.')">
                    <i class="bi bi-box-arrow-left" aria-hidden="true"></i>
                    <span>Keluar dari Admin</span>
                </button>
            </form>
            <p class="logout-note">Keluar hanya menutup sesi login. Data website tidak terhapus.</p>
        </div>
    </div>
</aside>
