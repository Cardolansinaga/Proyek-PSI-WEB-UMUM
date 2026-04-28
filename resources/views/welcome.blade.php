@extends('layouts.site', ['active' => 'home'])

@section('title', 'Beranda - SMAN 2 Balige')
@section('description', 'Beranda resmi SMAN 2 Balige, sekolah unggul yang membangun generasi berkarakter dan berprestasi.')

@section('content')
    @php($newsSlug = 'siswa-sman-2-balige-raih-medali-emas-di-olimpiade-sains-nasional-2024')

    <section class="school-hero hero-home">
        <div class="hero-shade"></div>
        <div class="mx-auto grid min-h-[620px] max-w-7xl items-center px-4 py-24 lg:px-8">
            <div class="relative max-w-3xl">
                <span class="section-pill">Institusi Pendidikan Prestisius</span>
                <h1 class="mt-7 text-5xl font-black leading-[0.98] text-white sm:text-6xl lg:text-7xl">
                    Membangun Generasi Unggul & Berkarakter
                </h1>
                <p class="mt-7 max-w-2xl text-base font-semibold leading-8 text-white/78">
                    Membentuk pemimpin masa depan melalui standar akademik internasional, kedisiplinan tinggi, dan pengembangan bakat komprehensif di jantung kota Balige.
                </p>
                <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                    <a href="{{ route('ppdb') }}" class="gold-button">Info PPDB 2024 -></a>
                    <a href="{{ route('guru') }}" class="ghost-button">Lihat Profil Sekolah</a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="text-3xl font-black text-[#071f3a] sm:text-5xl">Mengapa SMAN 2 Balige?</h2>
                <div class="mx-auto mt-5 h-1 w-16 rounded-full bg-[#d6a63a]"></div>
                <p class="mt-6 text-sm font-semibold leading-7 text-[#6b7f91] sm:text-base">
                    Dedikasi kami untuk memberikan pendidikan terbaik berstandar global dengan tetap menjunjung tinggi nilai budaya lokal.
                </p>
            </div>
            <div class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-5">
                <article class="feature-card"><span class="feature-icon">BK</span><h3>Akademik</h3><p>Kurikulum unggulan persiapan masuk PTN terbaik dan luar negeri.</p></article>
                <article class="feature-card"><span class="feature-icon">KR</span><h3>Karakter</h3><p>Penanaman nilai luhur, disiplin, dan etika berintegritas.</p></article>
                <article class="feature-card"><span class="feature-icon">TR</span><h3>Prestasi</h3><p>Ragam jejak juara kompetisi sains, seni, dan olahraga.</p></article>
                <article class="feature-card"><span class="feature-icon">GD</span><h3>Fasilitas</h3><p>Kampus asri modern dengan ruang belajar yang nyaman.</p></article>
                <article id="kesiswaan" class="feature-card"><span class="feature-icon">OS</span><h3>Ekskul</h3><p>20+ pilihan pengembangan diri mulai robotik hingga seni.</p></article>
            </div>
        </div>
    </section>

    <section class="bg-[#f6f9fc] py-20 sm:py-24">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 lg:grid-cols-[0.95fr_1fr] lg:items-center lg:px-8">
            <div class="portrait-card">
                <div class="portrait-visual">
                    <div class="portrait-face"></div>
                    <div class="portrait-suit"></div>
                    <div class="portrait-flag"></div>
                </div>
            </div>
            <div>
                <p class="eyebrow">Sambutan Hangat</p>
                <h2 class="mt-5 max-w-2xl text-4xl font-black leading-tight text-[#071f3a] sm:text-5xl">
                    Pendidikan Adalah Investasi Masa Depan Terbesar
                </h2>
                <blockquote class="relative mt-7 max-w-2xl text-lg font-semibold italic leading-8 text-[#6b7f91]">
                    "Di SMAN 2 Balige, kami tidak hanya mengajar mata pelajaran, kami membentuk karakter pemimpin. Kami percaya bahwa setiap anak memiliki potensi yang perlu dipupuk dengan disiplin, kasih sayang, dan fasilitas terbaik."
                </blockquote>
                <div class="mt-8">
                    <h3 class="text-xl font-black text-[#071f3a]">Drs. Edison Siregar, M.Pd.</h3>
                    <p class="mt-1 text-xs font-black uppercase tracking-[0.16em] text-[#d6a63a]">Kepala Sekolah SMAN 2 Balige</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#071f3a] py-14">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 text-center sm:grid-cols-2 lg:grid-cols-5 lg:px-8">
            <div class="stat-item"><strong>950+</strong><span>Siswa Aktif</span></div>
            <div class="stat-item"><strong>75+</strong><span>Guru Ahli</span></div>
            <div class="stat-item"><strong>120</strong><span>Prestasi/Tahun</span></div>
            <div class="stat-item"><strong>24</strong><span>Ekstrakurikuler</span></div>
            <div class="stat-item"><strong>5K+</strong><span>Alumni Sukses</span></div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="eyebrow">Pembaruan Terkini</p>
                    <h2 class="mt-3 text-4xl font-black text-[#071f3a] sm:text-5xl">Berita & Pengumuman</h2>
                </div>
                <a href="{{ route('berita.index') }}" class="outline-button">Lihat Semua Berita -></a>
            </div>
            <div class="mt-12 grid gap-8 lg:grid-cols-3">
                <article class="news-card"><div class="illustration graduates"></div><div class="p-7"><p class="meta-line">Pendidikan / 12 Okt 2024</p><h3>Penerimaan Siswa Baru Jalur Prestasi 2024</h3><p>SMAN 2 Balige mengundang putra-putri terbaik bangsa untuk bergabung melalui jalur prestasi.</p><a href="{{ route('ppdb') }}">Baca Selengkapnya -></a></div></article>
                <article class="news-card"><div class="illustration olympiad"></div><div class="p-7"><p class="meta-line">Prestasi / 08 Okt 2024</p><h3>Juara Umum Olimpiade Sains Nasional Provinsi</h3><p>Kembali mengukir sejarah, tim sains SMAN 2 Balige meraih gelar juara umum.</p><a href="{{ route('berita.show', $newsSlug) }}">Baca Selengkapnya -></a></div></article>
                <article class="news-card"><div class="illustration workshop"></div><div class="p-7"><p class="meta-line">Kesiswaan / 01 Okt 2024</p><h3>Workshop Kepemimpinan: Karakter Visioner</h3><p>Melalui program LDKS intensif, OSIS menyiapkan generasi pelayan yang tangguh.</p><a href="{{ route('berita.index') }}">Baca Selengkapnya -></a></div></article>
            </div>
        </div>
    </section>

    <section class="bg-[#f6f9fc] py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="text-4xl font-black text-[#071f3a] sm:text-5xl">Galeri Kampus</h2>
                <div class="mx-auto mt-5 h-1 w-16 rounded-full bg-[#d6a63a]"></div>
                <p class="mt-6 text-sm font-semibold text-[#6b7f91] sm:text-base">Potret kehidupan akademik dan kreativitas siswa SMAN 2 Balige.</p>
            </div>
            <div class="gallery-grid mt-12">
                <div class="gallery-tile library"><span>Perpustakaan</span></div>
                <div class="gallery-tile lab"><span>Lab Digital</span></div>
                <div class="gallery-tile hall"><span>Ruang Belajar</span></div>
                <div class="gallery-tile court"><span>Lapangan Olahraga</span></div>
            </div>
            <div class="mt-10 text-center">
                <a href="{{ route('galeri') }}" class="outline-button">Buka Galeri Lengkap -></a>
            </div>
        </div>
    </section>

    <section class="bg-white px-4 py-20 sm:py-24 lg:px-8">
        <div class="cta-panel">
            <h2>Siap Menjadi Bagian Dari Generasi Unggul?</h2>
            <p>Bergabunglah dengan komunitas pembelajar terbaik dan wujudkan cita-citamu bersama SMAN 2 Balige.</p>
            <div class="mt-10 flex flex-col justify-center gap-4 sm:flex-row">
                <a href="{{ route('ppdb') }}" class="gold-button">Daftar Sekarang</a>
                <a href="{{ route('galeri') }}" class="ghost-button">Lihat Galeri</a>
            </div>
        </div>
    </section>
@endsection
