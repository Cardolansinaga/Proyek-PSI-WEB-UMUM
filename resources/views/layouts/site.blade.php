<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="@yield('description', 'Portal resmi SMAN 2 Balige.')">

        <title>@yield('title', 'SMAN 2 Balige')</title>

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

        <header class="site-header sticky top-0 z-50 shadow-[0_8px_30px_rgba(15,35,55,0.08)]">
            <nav class="bg-white/95 backdrop-blur-xl">
                <div class="mx-auto flex max-w-7xl items-center justify-between gap-6 px-4 py-4 lg:px-8 xl:justify-start xl:gap-14">
                    <a href="{{ route('home') }}" class="flex min-w-0 items-center gap-3">
                        <span class="grid h-11 w-11 shrink-0 place-items-center rounded-full bg-[#071f3a] text-sm font-extrabold text-[#d6a63a] shadow-lg shadow-[#071f3a]/20">S2</span>
                        <span class="min-w-0">
                            <span class="block text-base font-black leading-tight text-[#071f3a]">SMAN 2 Balige</span>
                            <span class="block text-[9px] font-black uppercase tracking-[0.32em] text-[#d6a63a]">Unggul & Berkarakter</span>
                        </span>
                    </a>

                    <div class="hidden flex-1 items-center justify-end gap-5 text-xs font-extrabold text-[#496176] xl:flex">
                        @foreach ($navItems as $item)
                            <a class="nav-link {{ $active === $item['key'] ? 'active' : '' }}" href="{{ $item['href'] }}">{{ $item['label'] }}</a>
                        @endforeach
                    </div>

                    <details class="mobile-menu relative xl:hidden">
                        <summary class="grid h-11 w-11 cursor-pointer list-none place-items-center rounded-full border border-[#e4ebf2] text-[#071f3a]">
                            <span class="sr-only">Buka menu</span>
                            <span class="h-0.5 w-5 rounded-full bg-current shadow-[0_6px_0_currentColor,0_-6px_0_currentColor]"></span>
                        </summary>
                        <div class="absolute right-0 mt-3 w-64 rounded-lg border border-[#e4ebf2] bg-white p-3 text-sm font-bold text-[#496176] shadow-2xl shadow-[#071f3a]/15">
                            @foreach ($navItems as $item)
                                <a class="mobile-link {{ $active === $item['key'] ? 'text-[#071f3a]' : '' }}" href="{{ $item['href'] }}">{{ $item['label'] }}</a>
                            @endforeach
                        </div>
                    </details>
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
    </body>
</html>
