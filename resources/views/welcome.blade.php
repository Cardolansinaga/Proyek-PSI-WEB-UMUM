@extends('layouts.site', ['active' => 'home'])

@section('title', 'Beranda - SMAN 2 Balige')
@section('description', 'Situs resmi SMAN 2 Balige yang memuat profil sekolah, informasi akademik, kegiatan siswa, berita, dan penerimaan murid baru.')
@section('canonical', route('home'))
@section('image', ! empty($settings['hero_image']) ? asset('storage/'.$settings['hero_image']) : asset('images/logo-sman2-balige.jpg'))

@php
    $hasCustomHomeHero = ! empty($settings['hero_image']);
    $homeHeroImage = $hasCustomHomeHero ? asset('storage/'.$settings['hero_image']) : null;
    $visibleGalleries = $galleries->filter(fn ($gallery) => ! empty($gallery->image_path));
    $principalName = trim($settings['principal_name'] ?? '');
    if ($principalName === '' || $principalName === 'Drs. Horas Balige, M.Pd.') {
        $principalName = 'Kepala Sekolah SMAN 2 Balige';
    }
@endphp

@push('head')
    @if($hasCustomHomeHero)
        <link rel="preload" as="image" href="{{ $homeHeroImage }}" fetchpriority="high">
    @endif
@endpush

@section('content')
    <section
        class="school-hero hero-home {{ $hasCustomHomeHero ? 'has-custom-photo' : 'default-school-hero' }}"
        @if($hasCustomHomeHero)
            style="background-image: linear-gradient(90deg, rgb(11 42 68 / 0.92), rgb(11 42 68 / 0.62)), url('{{ $homeHeroImage }}') !important;"
        @else
            style="background-color: #12324d !important; background-image: none !important;"
        @endif
    >
        <div class="home-hero-inner">
            <div class="home-hero-copy">
                <p class="hero-kicker">{{ $settings['hero_badge'] ?? 'Situs Resmi Sekolah' }}</p>
                <h1>{{ $settings['hero_title'] ?? 'Selamat Datang di SMAN 2 Balige' }}</h1>
                <p>{{ $settings['hero_subtitle'] ?? 'Informasi resmi mengenai profil sekolah, kegiatan akademik, kesiswaan, berita, dan penerimaan murid baru.' }}</p>
                <div class="home-hero-actions">
                    <a href="{{ route('ppdb') }}" class="gold-button">{{ $settings['cta_label'] ?? 'Informasi PPDB' }}</a>
                    <a href="#profil" class="ghost-button">Profil Sekolah</a>
                </div>
            </div>
            <aside class="home-hero-info" aria-label="Informasi singkat sekolah">
                <p>Informasi Sekolah</p>
                <dl>
                    <div>
                        <dt>NPSN</dt>
                        <dd>{{ $settings['school_npsn'] ?? '10208520' }}</dd>
                    </div>
                    <div>
                        <dt>Akreditasi</dt>
                        <dd>{{ $settings['school_accreditation'] ?? 'A' }}</dd>
                    </div>
                    <div>
                        <dt>Lokasi</dt>
                        <dd>Balige, Kabupaten Toba</dd>
                    </div>
                </dl>
                <a href="{{ $settings['maps_url'] ?? 'https://www.google.com/maps/search/?api=1&query=SMAN%202%20Balige' }}" target="_blank" rel="noopener">
                    Lihat lokasi sekolah <i class="bi bi-arrow-up-right" aria-hidden="true"></i>
                </a>
            </aside>
        </div>
    </section>

    <section id="profil" class="natural-section bg-white">
        <div class="natural-container home-about-grid">
            <div>
                <p class="eyebrow">Profil Sekolah</p>
                <h2>Tentang SMAN 2 Balige</h2>
                <p class="section-lead">
                    {{ $settings['profile_summary'] ?? 'SMAN 2 Balige merupakan sekolah menengah atas negeri di Balige yang menyelenggarakan pembelajaran, pembinaan karakter, dan kegiatan pengembangan diri bagi siswa.' }}
                </p>
                <p>
                    {{ $settings['profile_detail'] ?? 'Situs ini menyediakan informasi sekolah yang dibutuhkan siswa, orang tua, alumni, dan masyarakat.' }}
                </p>
            </div>
            <div class="school-facts">
                <div>
                    <span>Nama Sekolah</span>
                    <strong>{{ $settings['school_name'] ?? 'SMAN 2 Balige' }}</strong>
                </div>
                <div>
                    <span>Alamat</span>
                    <strong>{{ $settings['school_address'] ?? 'Jl. Kartini Soposurung, Balige, Kabupaten Toba' }}</strong>
                </div>
                <div>
                    <span>Email</span>
                    <strong>{{ $settings['school_email'] ?? 'smanegeri2balige01@gmail.com' }}</strong>
                </div>
                <div>
                    <span>Telepon</span>
                    <strong>{{ $settings['school_phone'] ?? '0632 4320052' }}</strong>
                </div>
            </div>
        </div>
    </section>

    <section class="natural-section natural-muted-section">
        <div class="natural-container">
            <div class="natural-section-heading">
                <div>
                    <p class="eyebrow">Informasi Utama</p>
                    <h2>Layanan dan informasi sekolah</h2>
                </div>
                <p>Pilih bagian yang ingin Anda lihat.</p>
            </div>
            <div class="home-service-grid">
                <a href="{{ route('akademik') }}">
                    <span>01</span>
                    <div>
                        <h3>Akademik & Prestasi</h3>
                        <p>Program pembelajaran, kalender akademik, layanan, dan prestasi siswa.</p>
                    </div>
                    <i class="bi bi-arrow-right" aria-hidden="true"></i>
                </a>
                <a href="{{ route('kesiswaan') }}">
                    <span>02</span>
                    <div>
                        <h3>Kesiswaan & Ekstrakurikuler</h3>
                        <p>Informasi organisasi siswa, kegiatan, dan pilihan ekstrakurikuler.</p>
                    </div>
                    <i class="bi bi-arrow-right" aria-hidden="true"></i>
                </a>
                <a href="{{ route('ppdb') }}">
                    <span>03</span>
                    <div>
                        <h3>Informasi PPDB</h3>
                        <p>Jadwal, jalur pendaftaran, persyaratan, dan kontak panitia.</p>
                    </div>
                    <i class="bi bi-arrow-right" aria-hidden="true"></i>
                </a>
                <a href="{{ route('berita.index') }}">
                    <span>04</span>
                    <div>
                        <h3>Berita & Pengumuman</h3>
                        <p>Pembaruan kegiatan dan pengumuman resmi sekolah.</p>
                    </div>
                    <i class="bi bi-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>

    <section class="natural-section bg-white">
        <div class="natural-container home-message-grid">
            <article class="home-vision">
                <p class="eyebrow">Visi Sekolah</p>
                <h2>Arah pendidikan sekolah</h2>
                <p>{{ $settings['vision'] ?? 'Terwujudnya insan pendidikan yang bertaqwa, cerdas, terampil, kompetitif, dan berwawasan lingkungan.' }}</p>
            </article>
            <article class="home-principal">
                <p class="eyebrow">Sambutan Kepala Sekolah</p>
                <h2>{{ $principalName }}</h2>
                <p>{{ $settings['principal_message'] ?? 'Kami berupaya menyediakan lingkungan belajar yang tertib, aman, dan mendukung perkembangan setiap siswa.' }}</p>
            </article>
        </div>
    </section>

    <section id="berita" class="natural-section natural-muted-section">
        <div class="natural-container">
            <div class="natural-section-heading">
                <div>
                    <p class="eyebrow">Pembaruan Sekolah</p>
                    <h2>Berita & Pengumuman</h2>
                </div>
                <a href="{{ route('berita.index') }}" class="text-link">Lihat semua berita <i class="bi bi-arrow-right" aria-hidden="true"></i></a>
            </div>
            <div class="natural-news-grid">
                @forelse ($posts as $post)
                    @php($postImage = ! empty($post->image_path) ? asset('storage/'.$post->image_path) : null)
                    <article class="news-card">
                        @if($postImage)
                            <div class="illustration" style="background-image: url('{{ $postImage }}') !important;"></div>
                        @endif
                        <div class="p-7">
                            <p class="meta-line home-news-meta">
                                <span class="home-news-category">{{ $post->category }}</span>
                                <time datetime="{{ optional($post->published_at)->toDateString() }}">{{ optional($post->published_at)->translatedFormat('d M Y') }}</time>
                            </p>
                            <h3>{{ $post->title }}</h3>
                            <p>{{ $post->excerpt }}</p>
                            <a href="{{ route('berita.show', $post->slug) }}">Baca selengkapnya <i class="bi bi-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </article>
                @empty
                    <p>Belum ada berita yang diterbitkan.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section id="galeri" class="natural-section bg-white">
            <div class="natural-container">
                <div class="natural-section-heading">
                    <div>
                        <p class="eyebrow">Dokumentasi</p>
                        <h2>Galeri Sekolah</h2>
                    </div>
                    <p>Kegiatan akademik dan kesiswaan di lingkungan sekolah.</p>
                </div>
                <div class="gallery-grid natural-gallery-grid">
                    @forelse ($visibleGalleries as $gallery)
                        @php($galleryImage = ! empty($gallery->image_path) ? asset('storage/'.$gallery->image_path) : null)
                        <div
                            class="gallery-tile"
                            @if($galleryImage)
                                style="background-image: linear-gradient(180deg, rgb(7 31 58 / .02), rgb(7 31 58 / .38)), url('{{ $galleryImage }}') !important;"
                            @endif
                        >
                            <span>{{ $gallery->title }}</span>
                        </div>
                    @empty
                        <p class="gallery-empty-state">Belum ada foto galeri yang diterbitkan oleh admin.</p>
                    @endforelse
                </div>
            </div>
        </section>

    <section id="kontak" class="home-contact-strip">
        <div class="natural-container">
            <div>
                <p class="eyebrow">Kontak Sekolah</p>
                <h2>Perlu informasi lebih lanjut?</h2>
                <p>Hubungi sekolah melalui telepon atau email yang tercantum pada situs ini.</p>
            </div>
            <div>
                <a href="tel:{{ preg_replace('/\s+/', '', $settings['school_phone'] ?? '06324320052') }}" class="gold-button">Hubungi Sekolah</a>
                <a href="{{ route('ppdb') }}" class="outline-button">Informasi PPDB</a>
            </div>
        </div>
    </section>
@endsection
