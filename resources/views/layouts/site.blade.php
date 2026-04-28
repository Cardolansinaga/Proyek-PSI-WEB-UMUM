<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="@yield('description', 'Portal resmi SMAN 2 Balige.')">

        <title>@yield('title', 'SMAN 2 Balige')</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800,900" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-w-80 bg-[#f6f9fc] font-sans text-[#102a43] antialiased">
        @php
            $active = $active ?? '';
            $newsSlug = 'siswa-sman-2-balige-raih-medali-emas-di-olimpiade-sains-nasional-2024';
            $navItems = [
                ['label' => 'Beranda', 'href' => route('home'), 'key' => 'home'],
                ['label' => 'Profil', 'href' => route('guru'), 'key' => 'guru'],
                ['label' => 'Akademik', 'href' => route('guru') . '#direktori', 'key' => 'akademik'],
                ['label' => 'Prestasi', 'href' => route('prestasi'), 'key' => 'prestasi'],
                ['label' => 'Kesiswaan', 'href' => route('home') . '#kesiswaan', 'key' => 'kesiswaan'],
                ['label' => 'PPDB', 'href' => route('ppdb'), 'key' => 'ppdb'],
                ['label' => 'Berita', 'href' => route('berita.index'), 'key' => 'berita'],
                ['label' => 'Galeri', 'href' => route('galeri'), 'key' => 'galeri'],
                ['label' => 'Alumni', 'href' => route('alumni'), 'key' => 'alumni'],
                ['label' => 'Kontak', 'href' => route('kontak'), 'key' => 'kontak'],
            ];
        @endphp

        <header class="sticky top-0 z-50 shadow-[0_8px_30px_rgba(15,35,55,0.08)]">
            <div class="bg-[#071f3a] text-white">
                <div class="mx-auto flex max-w-7xl flex-col gap-2 px-4 py-2 text-[11px] font-extrabold uppercase tracking-[0.08em] sm:flex-row sm:items-center sm:justify-between lg:px-8">
                    <div class="flex flex-wrap items-center gap-x-5 gap-y-1 text-white/75">
                        <span>Tel. (0632) 213456</span>
                        <span>info@sman2balige.sch.id</span>
                    </div>
                    <a href="#portal" class="text-white/80 transition hover:text-[#d6a63a]">Portal Staff</a>
                </div>
            </div>

            <nav class="bg-white">
                <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 lg:px-8">
                    <a href="{{ route('home') }}" class="flex min-w-0 items-center gap-3">
                        <span class="grid h-11 w-11 shrink-0 place-items-center rounded-full bg-[#071f3a] text-sm font-extrabold text-[#d6a63a] shadow-lg shadow-[#071f3a]/20">S2</span>
                        <span class="min-w-0">
                            <span class="block text-base font-black leading-tight text-[#071f3a]">SMAN 2 Balige</span>
                            <span class="block text-[9px] font-black uppercase tracking-[0.32em] text-[#d6a63a]">Unggul & Berkarakter</span>
                        </span>
                    </a>

                    <div class="hidden items-center gap-5 text-xs font-extrabold text-[#496176] xl:flex">
                        @foreach ($navItems as $item)
                            <a class="nav-link {{ $active === $item['key'] ? 'active' : '' }}" href="{{ $item['href'] }}">{{ $item['label'] }}</a>
                        @endforeach
                    </div>

                    <a href="{{ route('kontak') }}" class="hidden rounded-full bg-[#071f3a] px-5 py-2.5 text-xs font-black text-white transition hover:bg-[#103a63] lg:inline-flex">
                        Kontak
                    </a>

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

        <footer class="bg-[#071f3a] text-white">
            <div class="mx-auto grid max-w-7xl gap-10 px-4 py-16 sm:grid-cols-2 lg:grid-cols-[1.4fr_1fr_1fr_1fr] lg:px-8">
                <div>
                    <div class="flex items-center gap-3">
                        <span class="grid h-11 w-11 place-items-center rounded-full bg-white text-sm font-black text-[#071f3a]">S2</span>
                        <span class="text-xl font-black">SMAN 2 <span class="text-[#d6a63a]">Balige</span></span>
                    </div>
                    <p class="mt-6 max-w-sm text-sm font-semibold leading-7 text-white/58">
                        Membentuk insan berkarakter, berprestasi, dan berwawasan global di tanah Toba.
                    </p>
                    <div class="mt-7 flex gap-3">
                        <a class="footer-social" href="{{ route('kontak') }}">f</a>
                        <a class="footer-social" href="{{ route('kontak') }}">ig</a>
                        <a class="footer-social" href="{{ route('kontak') }}">yt</a>
                    </div>
                </div>
                <div>
                    <h3 class="dark-footer-title">Eksplorasi</h3>
                    <ul class="dark-footer-list">
                        <li><a href="{{ route('guru') }}">Profil Sekolah</a></li>
                        <li><a href="{{ route('ppdb') }}">Pendaftaran PPDB</a></li>
                        <li><a href="{{ route('berita.index') }}">Berita & Pengumuman</a></li>
                        <li><a href="{{ route('galeri') }}">Galeri Kampus</a></li>
                        <li><a href="{{ route('prestasi') }}">Prestasi Siswa</a></li>
                        <li><a href="{{ route('kontak') }}">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="dark-footer-title">Informasi Kontak</h3>
                    <ul class="dark-footer-list">
                        <li>Jl. Sopo Surung, Kec. Balige, Kab. Toba, Sumatera Utara.</li>
                        <li>(0632) 213456</li>
                        <li>info@sman2balige.sch.id</li>
                    </ul>
                </div>
                <div id="portal">
                    <h3 class="dark-footer-title">Portal Akademik</h3>
                    <a href="#" class="mt-6 inline-flex rounded-2xl bg-[#d6a63a] px-7 py-4 text-sm font-black text-[#071f3a] transition hover:bg-[#efc861]">Login SIAKAD</a>
                </div>
            </div>
            <div class="border-t border-white/8">
                <div class="mx-auto flex max-w-7xl flex-col gap-4 px-4 py-8 text-[10px] font-black uppercase tracking-[0.22em] text-white/30 sm:flex-row sm:items-center sm:justify-between lg:px-8">
                    <p>(c) 2024 SMAN 2 Balige. All rights reserved.</p>
                    <div class="flex gap-6">
                        <a href="{{ route('kontak') }}">Privacy Policy</a>
                        <a href="{{ route('kontak') }}">Terms of Service</a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
