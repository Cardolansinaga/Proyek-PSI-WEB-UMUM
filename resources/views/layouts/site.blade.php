<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="@yield('description', 'Portal resmi SMAN 2 Balige.')">
        @stack('head')

        <title>@yield('title', 'SMAN 2 Balige')</title>
        <link rel="icon" type="image/jpeg" href="{{ asset('images/logo-sman2-balige.jpg') }}">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @include('layouts.partials.public-polish')
    </head>
    <body class="public-site min-w-80 bg-[#f6f9fc] font-sans text-[#102a43] antialiased">
        @php
            $active = $active ?? '';
            $newsSlug = 'pembinaan-sains-sman-2-balige-2026';
            $navItems = [
                ['label' => 'Beranda', 'href' => route('home'), 'key' => 'home', 'icon' => 'bi-house-door'],
                ['label' => 'Akademik & Prestasi', 'href' => route('akademik'), 'key' => 'akademik', 'icon' => 'bi-mortarboard'],
                ['label' => 'Kesiswaan & Ekstrakurikuler', 'href' => route('kesiswaan'), 'key' => 'kesiswaan', 'icon' => 'bi-people'],
                ['label' => 'PPDB', 'href' => route('ppdb'), 'key' => 'ppdb', 'icon' => 'bi-journal-check'],
            ];
        @endphp

        <header class="site-header sticky-top shadow-sm">
            <nav class="navbar navbar-expand-xl site-navbar">
                <div class="container-fluid px-3 px-lg-5">
                    <a href="{{ route('home') }}" class="navbar-brand site-brand">
                        <img class="site-brand-logo" src="{{ asset('images/logo-sman2-balige.jpg') }}" alt="Logo SMAN 2 Balige" width="44" height="44">
                        <div class="site-brand-copy">
                            <div style="font-size: 1rem; font-weight: 900; color: #071f3a; line-height: 1.2;">SMAN 2 Balige</div>
                            <div style="font-size: 0.5625rem; font-weight: 900; letter-spacing: 0.32em; color: #d6a63a;">Unggul & Berkarakter</div>
                        </div>
                    </a>

                    <div class="collapse navbar-collapse site-nav-panel" id="navbarNav">
                        <ul class="navbar-nav site-nav-list ms-xl-auto">
                            @foreach ($navItems as $item)
                                <li class="nav-item">
                                    <a class="nav-link fw-bold {{ $active === $item['key'] ? 'active' : '' }}" href="{{ $item['href'] }}">
                                        <i class="bi {{ $item['icon'] }}" aria-hidden="true"></i>
                                        <span>{{ $item['label'] }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </nav>
            <button class="site-menu-toggle-standalone" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Buka navigasi">
                <span class="site-menu-bars" aria-hidden="true"><span></span></span>
            </button>
        </header>

        <main>
            @yield('content')
        </main>

        <footer id="kontak" class="bg-[#071f3a] text-white">
            <div class="mx-auto grid max-w-7xl gap-10 px-4 py-16 sm:grid-cols-2 lg:grid-cols-[1.35fr_1fr_1.25fr] lg:px-8">
                <div>
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo-sman2-balige.jpg') }}" alt="Logo SMAN 2 Balige" width="44" height="44" class="footer-brand-logo">
                        <span class="text-xl font-black">SMAN 2 <span class="text-[#d6a63a]">Balige</span></span>
                    </div>
                    <p class="mt-6 max-w-sm text-sm font-semibold leading-7 text-white/78">
                        Portal resmi informasi sekolah untuk profil, akademik, kesiswaan dan ekstrakurikuler, PPDB, dan kontak SMAN 2 Balige.
                    </p>
                    <div class="mt-7 flex gap-3">
                        <a class="footer-social" href="mailto:info@sman2balige.sch.id" aria-label="Kirim email ke sekolah"><i class="bi bi-envelope" aria-hidden="true"></i></a>
                        <a class="footer-social" href="https://maps.google.com/?q=SMAN%202%20Balige" target="_blank" rel="noopener" aria-label="Lihat lokasi sekolah"><i class="bi bi-geo-alt" aria-hidden="true"></i></a>
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
    </body>
</html>
