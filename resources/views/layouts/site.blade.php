<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @php
            $siteSettings = $settings ?? [];
            $siteLogo = ! empty($siteSettings['logo']) ? asset('storage/'.$siteSettings['logo']) : asset('images/logo-sman2-balige-96.webp');
            $siteName = $siteSettings['school_name'] ?? 'SMAN 2 Balige';
            $siteTagline = $siteSettings['school_tagline'] ?? 'Unggul & Berkarakter';
            $footerDescription = $siteSettings['footer_description'] ?? 'Portal resmi informasi sekolah untuk profil, akademik, kesiswaan dan ekstrakurikuler, PPDB, dan kontak SMAN 2 Balige.';
            $instagramUrl = $siteSettings['instagram_url'] ?? 'https://www.instagram.com/sman2_balige';
            $facebookUrl = $siteSettings['facebook_url'] ?? \App\Models\SiteSetting::OFFICIAL_FACEBOOK_URL;
            $mapsUrl = $siteSettings['maps_url'] ?? 'https://www.google.com/maps/search/?api=1&query=SMAN%202%20Balige';
            $schoolAddress = $siteSettings['school_address'] ?? 'Jl. Kartini Soposurung, Sangkar Nihuta, Balige, Kabupaten Toba, Sumatera Utara 22312';
            $schoolPhone = $siteSettings['school_phone'] ?? '0632 4320052';
            $schoolPhoneDigits = preg_replace('/\D+/', '', $schoolPhone);
            $schoolPhoneTel = str_starts_with($schoolPhoneDigits, '0') ? '+62'.substr($schoolPhoneDigits, 1) : '+'.$schoolPhoneDigits;
            $schoolEmail = trim((string) ($siteSettings['school_email'] ?? ''));
            $seoTitle = html_entity_decode(
                trim($__env->yieldContent('title')),
                ENT_QUOTES | ENT_HTML5,
                'UTF-8',
            ) ?: $siteName;
            $seoDescription = html_entity_decode(
                trim($__env->yieldContent('description')),
                ENT_QUOTES | ENT_HTML5,
                'UTF-8',
            ) ?: $footerDescription;
            $seoImage = trim($__env->yieldContent('image')) ?: $siteLogo;
            $canonicalUrl = trim($__env->yieldContent('canonical')) ?: url()->current();
            $ogType = trim($__env->yieldContent('og_type')) ?: 'website';
            $schoolSchema = [
                '@context' => 'https://schema.org',
                '@type' => 'EducationalOrganization',
                '@id' => route('home').'#school',
                'name' => $siteName,
                'alternateName' => 'SMA Negeri 2 Balige',
                'url' => route('home'),
                'logo' => $siteLogo,
                'image' => $seoImage,
                'description' => $footerDescription,
                'identifier' => [
                    '@type' => 'PropertyValue',
                    'propertyID' => 'NPSN',
                    'value' => $siteSettings['school_npsn'] ?? '10208520',
                ],
                'telephone' => $schoolPhone,
                'email' => $schoolEmail ?: null,
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => 'Jl. Kartini Soposurung',
                    'addressLocality' => 'Balige',
                    'addressRegion' => 'Sumatera Utara',
                    'postalCode' => $siteSettings['school_postal_code'] ?? '22312',
                    'addressCountry' => 'ID',
                ],
                'geo' => [
                    '@type' => 'GeoCoordinates',
                    'latitude' => $siteSettings['school_latitude'] ?? '2.324300000000',
                    'longitude' => $siteSettings['school_longitude'] ?? '99.048800000000',
                ],
                'sameAs' => array_values(array_filter([$instagramUrl, $facebookUrl, $mapsUrl])),
            ];
        @endphp

        <title>{{ $seoTitle }}</title>
        <meta name="description" content="{{ $seoDescription }}">
        <meta name="robots" content="@yield('robots', 'index,follow')">
        <link rel="canonical" href="{{ $canonicalUrl }}">

        <meta property="og:locale" content="id_ID">
        <meta property="og:type" content="{{ $ogType }}">
        <meta property="og:site_name" content="{{ $siteName }}">
        <meta property="og:title" content="{{ $seoTitle }}">
        <meta property="og:description" content="{{ $seoDescription }}">
        <meta property="og:url" content="{{ $canonicalUrl }}">
        <meta property="og:image" content="{{ $seoImage }}">
        <meta property="og:image:alt" content="{{ $seoTitle }}">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $seoTitle }}">
        <meta name="twitter:description" content="{{ $seoDescription }}">
        <meta name="twitter:image" content="{{ $seoImage }}">

        @stack('head')
        <link rel="icon" type="image/jpeg" href="{{ $siteLogo }}">

        @vite(['resources/css/app.css', 'resources/css/public-natural.css', 'resources/js/app.js'])
        <script type="application/ld+json">{!! json_encode($schoolSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) !!}</script>
        @stack('structured-data')
    </head>
    <body class="public-site public-site-natural bg-[#f6f9fc] font-sans text-[#102a43] antialiased">
        <a class="skip-link" href="#main-content">Lewati ke konten utama</a>
        @php
            $active = $active ?? '';
            $newsSlug = 'pembinaan-sains-sman-2-balige-2026';
            $navItems = [
                ['label' => 'Beranda', 'href' => route('home'), 'key' => 'home', 'icon' => 'bi-house-door'],
                ['label' => 'Akademik & Prestasi', 'href' => route('akademik'), 'key' => 'akademik', 'icon' => 'bi-mortarboard'],
                ['label' => 'Kesiswaan & Ekstrakurikuler', 'href' => route('kesiswaan'), 'key' => 'kesiswaan', 'icon' => 'bi-people'],
                ['label' => 'PPDB', 'href' => route('ppdb'), 'key' => 'ppdb', 'icon' => 'bi-journal-check'],
                ['label' => 'Berita', 'href' => route('berita.index'), 'key' => 'berita', 'icon' => 'bi-newspaper'],
            ];
        @endphp

        <header class="site-header sticky-top">
            <nav class="navbar navbar-expand-xl site-navbar">
                <div class="container-fluid px-3 px-lg-5">
                    <a href="{{ route('home') }}" class="navbar-brand site-brand">
                        <img class="site-brand-logo" src="{{ $siteLogo }}" alt="Logo {{ $siteName }}" width="44" height="44" decoding="async" fetchpriority="high">
                        <div class="site-brand-copy">
                            <strong>{{ $siteName }}</strong>
                            <span>{{ $siteTagline }}</span>
                        </div>
                    </a>

                    <button class="site-menu-toggle-standalone" type="button" data-nav-toggle data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Buka navigasi">
                        <span class="site-menu-bars" aria-hidden="true"><span></span></span>
                    </button>

                    <div class="collapse navbar-collapse site-nav-panel" id="navbarNav">
                        <div class="site-nav-intro" aria-hidden="true">
                            <span>Navigasi</span>
                            <small>Pilih halaman yang ingin dibuka</small>
                        </div>
                        <ul class="navbar-nav site-nav-list ms-xl-auto">
                            @foreach ($navItems as $item)
                                <li class="nav-item">
                                    <a class="nav-link fw-bold {{ $active === $item['key'] ? 'active' : '' }}" href="{{ $item['href'] }}" @if ($active === $item['key']) aria-current="page" @endif>
                                        <i class="bi {{ $item['icon'] }} site-nav-icon" aria-hidden="true"></i>
                                        <span>{{ $item['label'] }}</span>
                                        <i class="bi bi-chevron-right site-nav-arrow" aria-hidden="true"></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main id="main-content" tabindex="-1">
            @yield('content')
        </main>

        <footer id="kontak" class="bg-[#071f3a] text-white">
            <div class="mx-auto grid max-w-7xl gap-10 px-4 py-16 sm:grid-cols-2 lg:grid-cols-[1.35fr_1fr_1.25fr] lg:px-8">
                <div>
                    <div class="flex items-center gap-3">
                        <img src="{{ $siteLogo }}" alt="Logo {{ $siteName }}" width="44" height="44" class="footer-brand-logo" loading="lazy" decoding="async">
                        <span class="text-xl font-black">{{ $siteName }}</span>
                    </div>
                    <p class="mt-6 max-w-sm text-sm font-semibold leading-7 text-white/78">
                        {{ $footerDescription }}
                    </p>
                    <div class="mt-7 flex gap-3">
                        <a class="footer-social" href="{{ $instagramUrl }}" target="_blank" rel="noopener" aria-label="Kunjungi Instagram {{ $siteName }}"><i class="bi bi-instagram" aria-hidden="true"></i></a>
                        <a class="footer-social" href="{{ $facebookUrl }}" target="_blank" rel="noopener" aria-label="Kunjungi Facebook {{ $siteName }}"><i class="bi bi-facebook" aria-hidden="true"></i></a>
                        <a class="footer-social" href="{{ $mapsUrl }}" target="_blank" rel="noopener" aria-label="Lihat lokasi sekolah"><i class="bi bi-geo-alt" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div>
                    <h3 class="dark-footer-title">Navigasi Utama</h3>
                    <ul class="dark-footer-list">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('akademik') }}">Akademik & Prestasi</a></li>
                        <li><a href="{{ route('kesiswaan') }}">Kesiswaan & Ekstrakurikuler</a></li>
                        <li><a href="{{ route('ppdb') }}">Informasi PPDB</a></li>
                        <li><a href="{{ route('berita.index') }}">Berita & Pengumuman</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="dark-footer-title">Kontak Resmi</h3>
                    <ul class="dark-footer-list">
                        <li>{{ $schoolAddress }}</li>
                        <li><a href="tel:{{ $schoolPhoneTel }}">{{ $schoolPhone }}</a></li>
                        @if ($schoolEmail !== '')
                            <li><a href="mailto:{{ $schoolEmail }}">{{ $schoolEmail }}</a></li>
                        @endif
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
