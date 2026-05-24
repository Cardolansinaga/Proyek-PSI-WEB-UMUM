<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="@yield('description', 'Portal resmi SMAN 2 Balige.')">

        <title>@yield('title', 'SMAN 2 Balige')</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @include('layouts.partials.public-polish')
    </head>
    <body class="public-site min-w-80 bg-[#f6f9fc] font-sans text-[#102a43] antialiased">
        @php
            $active = $active ?? '';
            $newsSlug = 'pembinaan-sains-sman-2-balige-2026';
            $navItems = [
                ['label' => 'Beranda', 'href' => route('home'), 'key' => 'home'],
                ['label' => 'Akademik & Prestasi', 'href' => route('akademik'), 'key' => 'akademik'],
                ['label' => 'Kesiswaan & Ekstrakurikuler', 'href' => route('kesiswaan'), 'key' => 'kesiswaan'],
                ['label' => 'PPDB', 'href' => route('ppdb'), 'key' => 'ppdb'],
            ];
        @endphp

        <header class="site-header sticky-top shadow-sm" style="z-index: 1030;">
            <nav class="navbar navbar-expand-xl bg-white bg-opacity-95" style="backdrop-filter: blur(12px);">
                <div class="container-fluid mx-0 px-4 px-lg-5">
                    <!-- Brand -->
                    <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center gap-3 ms-0">
                        <span class="d-flex align-items-center justify-content-center rounded-circle fw-black" style="width: 44px; height: 44px; background-color: #071f3a; color: #d6a63a; font-size: 0.875rem; box-shadow: 0 4px 12px rgba(7, 31, 58, 0.2);">S2</span>
                        <div class="d-none d-sm-block">
                            <div style="font-size: 1rem; font-weight: 900; color: #071f3a; line-height: 1.2;">SMAN 2 Balige</div>
                            <div style="font-size: 0.5625rem; font-weight: 900; letter-spacing: 0.32em; color: #d6a63a;">Unggul & Berkarakter</div>
                        </div>
                    </a>

                    <!-- Toggler for mobile -->
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Navigation Items -->
                    <div class="collapse navbar-collapse ms-3 ms-xl-auto" id="navbarNav">
                        <ul class="navbar-nav ms-auto gap-1 gap-xl-3">
                            @foreach ($navItems as $item)
                                <li class="nav-item">
                                    <a class="nav-link fw-bold {{ $active === $item['key'] ? 'active' : '' }}" href="{{ $item['href'] }}" style="font-size: 0.75rem; color: #496176;">
                                        {{ $item['label'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main>
            @yield('content')
        </main>

        <footer id="kontak" class="bg-[#071f3a] text-white">
            <div class="mx-auto grid max-w-7xl gap-10 px-4 py-16 sm:grid-cols-2 lg:grid-cols-[1.35fr_1fr_1.25fr] lg:px-8">
                <div>
                    <div class="flex items-center gap-3">
                        <span class="grid h-11 w-11 place-items-center rounded-full bg-white text-sm font-black text-[#071f3a]">S2</span>
                        <span class="text-xl font-black">SMAN 2 <span class="text-[#d6a63a]">Balige</span></span>
                    </div>
                    <p class="mt-6 max-w-sm text-sm font-semibold leading-7 text-white/78">
                        Portal resmi informasi sekolah untuk profil, akademik, kesiswaan dan ekstrakurikuler, PPDB, dan kontak SMAN 2 Balige.
                    </p>
                    <div class="mt-7 flex gap-3">
                        <a class="footer-social" href="mailto:info@sman2balige.sch.id" aria-label="Kirim email ke sekolah"><i class="bi bi-envelope"></i></a>
                        <a class="footer-social" href="https://maps.google.com/?q=SMAN%202%20Balige" target="_blank" rel="noopener" aria-label="Lihat lokasi sekolah"><i class="bi bi-geo-alt"></i></a>
                    </div>
                </div>
                <div>
                    <h3 class="dark-footer-title">Navigasi Utama</h3>
                    <ul class="dark-footer-list">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('akademik') }}">Akademik & Prestasi</a></li>
                        <li><a href="{{ route('kesiswaan') }}">Kesiswaan & Ekstrakurikuler</a></li>
                        <li><a href="{{ route('ppdb') }}">Pendaftaran PPDB</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="dark-footer-title">Kontak Resmi</h3>
                    <ul class="dark-footer-list">
                        <li>Jl. Sopo Surung, Kec. Balige, Kab. Toba, Sumatera Utara.</li>
                        <li>(0632) 213456</li>
                        <li>info@sman2balige.sch.id</li>
                    </ul>
                    <div class="mt-7 flex flex-wrap gap-3">
                        <a href="{{ route('ppdb') }}" class="footer-text-link">Informasi PPDB</a>
                        <a href="{{ route('login') }}" class="footer-internal-link" aria-label="Akses portal internal sekolah">Portal Internal</a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
