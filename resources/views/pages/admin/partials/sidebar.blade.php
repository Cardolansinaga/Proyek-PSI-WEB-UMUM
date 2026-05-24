<aside class="sidebar">
    <div style="padding: 32px;">
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 32px;">
            <div style="background: #d6a63a; width: 40px; height: 40px; border-radius: 10px; display: grid; place-items: center; font-weight: 900; color: white;">S2</div>
            <div>
                <div style="font-size: 14px; font-weight: 900; line-height: 1; color: #ffffff;">SMAN 2 Balige</div>
                <div style="font-size: 10px; color: #94a3b8;">Portal Admin</div>
            </div>
        </div>
        <nav style="display: flex; flex-direction: column; gap: 4px;">
            <a href="{{ route('dashboard') }}" class="nav-item {{ ($activeAdmin ?? '') === 'dashboard' ? 'active-nav' : '' }}"><span class="admin-nav-icon" aria-hidden="true"><i class="bi bi-speedometer2"></i></span><span>Dashboard</span></a>
            <a href="{{ route('admin.beranda') }}" class="nav-item {{ ($activeAdmin ?? '') === 'beranda' ? 'active-nav' : '' }}"><span class="admin-nav-icon" aria-hidden="true"><i class="bi bi-house-door"></i></span><span>Beranda</span></a>
            <a href="{{ route('prestasi.index') }}" class="nav-item {{ ($activeAdmin ?? '') === 'prestasi' ? 'active-nav' : '' }}"><span class="admin-nav-icon" aria-hidden="true"><i class="bi bi-trophy"></i></span><span>Akademik & Prestasi</span></a>
            <a href="{{ route('kesiswaan.index') }}" class="nav-item {{ ($activeAdmin ?? '') === 'kesiswaan' ? 'active-nav' : '' }}"><span class="admin-nav-icon" aria-hidden="true"><i class="bi bi-people"></i></span><span>Kesiswaan & Ekstrakurikuler</span></a>
            <a href="{{ route('admin.ppdb') }}" class="nav-item {{ ($activeAdmin ?? '') === 'ppdb' ? 'active-nav' : '' }}"><span class="admin-nav-icon" aria-hidden="true"><i class="bi bi-journal-check"></i></span><span>PPDB</span></a>
            <a href="{{ route('admin.galeri') }}" class="nav-item {{ ($activeAdmin ?? '') === 'galeri' ? 'active-nav' : '' }}"><span class="admin-nav-icon" aria-hidden="true"><i class="bi bi-images"></i></span><span>Galeri</span></a>
            <a href="{{ route('admin.pengaturan') }}" class="nav-item {{ ($activeAdmin ?? '') === 'pengaturan' ? 'active-nav' : '' }}"><span class="admin-nav-icon" aria-hidden="true"><i class="bi bi-gear"></i></span><span>Pengaturan</span></a>
        </nav>
    </div>
    <div style="margin-top: auto; padding: 32px;">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="color: #f87171; background: none; border: none; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 8px;">Keluar</button>
        </form>
    </div>
</aside>
