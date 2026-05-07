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
            <a href="{{ route('dashboard') }}" class="nav-item {{ ($activeAdmin ?? '') === 'dashboard' ? 'active-nav' : '' }}">Dashboard</a>
            <a href="{{ route('guru.index') }}" class="nav-item {{ ($activeAdmin ?? '') === 'guru' ? 'active-nav' : '' }}">Guru & Staf</a>
            <a href="{{ route('prestasi.index') }}" class="nav-item {{ ($activeAdmin ?? '') === 'prestasi' ? 'active-nav' : '' }}">Prestasi</a>
            <a href="{{ route('pengumuman.index') }}" class="nav-item {{ ($activeAdmin ?? '') === 'pengumuman' ? 'active-nav' : '' }}">Pengumuman</a>
            <a href="{{ route('kesiswaan.index') }}" class="nav-item {{ ($activeAdmin ?? '') === 'kesiswaan' ? 'active-nav' : '' }}">Kesiswaan</a>
            <a href="{{ route('admin.ppdb') }}" class="nav-item {{ ($activeAdmin ?? '') === 'ppdb' ? 'active-nav' : '' }}">PPDB</a>
            <a href="{{ route('admin.galeri') }}" class="nav-item {{ ($activeAdmin ?? '') === 'galeri' ? 'active-nav' : '' }}">Galeri</a>
            <a href="{{ route('admin.pengaturan') }}" class="nav-item {{ ($activeAdmin ?? '') === 'pengaturan' ? 'active-nav' : '' }}">Pengaturan</a>
        </nav>
    </div>
    <div style="margin-top: auto; padding: 32px;">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="color: #f87171; background: none; border: none; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 8px;">Keluar</button>
        </form>
    </div>
</aside>
