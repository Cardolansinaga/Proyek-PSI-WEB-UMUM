@extends('layouts.site', ['active' => 'galeri'])

@section('title', 'Galeri - SMAN 2 Balige')
@section('description', 'Galeri visual kegiatan, fasilitas, dan multimedia SMAN 2 Balige.')

@section('content')
    <section class="school-hero hero-gallery text-center">
        <div class="hero-shade"></div>
        <div class="mx-auto grid min-h-[430px] max-w-7xl place-items-center px-4 py-20 lg:px-8">
            <div class="relative max-w-4xl">
                <span class="section-pill">Momen Berharga</span>
                <h1 class="mt-7 text-5xl font-black leading-[1] text-white sm:text-6xl">Galeri Visual</h1>
                <p class="mx-auto mt-6 max-w-2xl text-base font-semibold leading-8 text-white/72">Menelusuri jejak langkah, prestasi, dan setiap momen emas dalam perjalanan pendidikan di SMAN 2 Balige.</p>
            </div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 lg:grid-cols-[0.95fr_1.05fr] lg:items-center lg:px-8">
            <div>
                <p class="eyebrow">Dokumentasi Kegiatan</p>
                <h2 class="mt-4 text-4xl font-black leading-tight text-[#071f3a] sm:text-5xl">Merekam Jejak Keunggulan dan Kolaborasi</h2>
                <p class="mt-7 max-w-xl text-sm font-semibold leading-7 text-[#6b7f91]">Setiap sudut kampus dan aktivitas siswa adalah bagian dari narasi besar kami.</p>
                <div class="mt-10 grid max-w-sm grid-cols-2 gap-8">
                    <div class="big-stat"><strong>5,000+</strong><span>Foto Kegiatan</span></div>
                    <div class="big-stat"><strong>200+</strong><span>Video Dokumenter</span></div>
                </div>
            </div>
            <div class="gallery-showcase">
                <div class="illustration lab"></div>
                <div class="illustration culture"></div>
                <div class="showcase-card">Kualitas pendidikan terbaik di Tanah Toba</div>
            </div>
        </div>
    </section>

    <section class="bg-[#f6f9fc] py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between">
                <div class="flex flex-wrap gap-3">
                    @foreach (['Semua', 'Akademik', 'Prestasi', 'Event', 'Fasilitas'] as $filter)
                        <button class="filter-pill {{ $loop->first ? 'active' : '' }}">{{ $filter }}</button>
                    @endforeach
                </div>
                <label class="search-box"><span>Cari</span><input type="search" placeholder="Cari momen..."></label>
            </div>
            <div class="masonry-gallery mt-10">
                <div class="illustration meeting"></div>
                <div class="illustration robot"></div>
                <div class="illustration library tall"></div>
                <div class="illustration graduation"></div>
                <div class="illustration sports"></div>
            </div>
            <div class="mt-14 text-center"><button class="outline-button">Muat Lebih Banyak</button></div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <p class="eyebrow">Cinematic Experience</p>
                <h2 class="mt-3 text-4xl font-black text-[#071f3a] sm:text-5xl">Galeri Multimedia</h2>
                <div class="mx-auto mt-5 h-1 w-16 rounded-full bg-[#d6a63a]"></div>
                <p class="mt-6 text-sm font-semibold text-[#6b7f91]">Saksikan dinamika sekolah melalui dokumentasi video premium.</p>
            </div>
            <div class="video-hero mt-12">
                <div class="play-button">Play</div>
                <div class="absolute bottom-8 left-8 right-8 text-white">
                    <p class="text-sm font-black uppercase tracking-[0.16em] text-[#d6a63a]">Video Utama</p>
                    <h3 class="mt-2 text-3xl font-black">SMAN 2 Balige: A Year in Review 2023</h3>
                    <p class="mt-2 max-w-xl text-sm font-semibold text-white/72">Saksikan pencapaian akademik dan prestasi non-akademik siswa kami dalam satu tahun terakhir.</p>
                </div>
            </div>
            <div class="mt-8 grid gap-8 md:grid-cols-3">
                <article class="mini-video"><div class="illustration presentation"></div><strong>Inovasi Siswa 2024</strong><p>Eksplorasi proyek teknologi terbaru buatan siswa.</p></article>
                <article class="mini-video"><div class="illustration assembly"></div><strong>Dies Natalis SMAN 2</strong><p>Perayaan ulang tahun sekolah yang penuh kehangatan.</p></article>
                <article class="mini-video"><div class="illustration class"></div><strong>Digital Campus Tour</strong><p>Jelajahi fasilitas modern melalui tur virtual.</p></article>
            </div>
        </div>
    </section>

    <section class="bg-white px-4 pb-24 lg:px-8">
        <div class="cta-panel">
            <p class="eyebrow text-[#d6a63a]">Ayo Bergabung</p>
            <h2>Ingin Tahu Lebih Banyak Tentang Kami?</h2>
            <p>Jelajahi berita terbaru dan daftar prestasi membanggakan yang telah diraih oleh putra-putri terbaik SMAN 2 Balige.</p>
            <div class="mt-10 flex flex-col justify-center gap-4 sm:flex-row">
                <a href="{{ route('berita.index') }}" class="gold-button bg-white text-[#071f3a]">Berita Terbaru -></a>
                <a href="{{ route('prestasi') }}" class="ghost-button">Lihat Prestasi</a>
            </div>
        </div>
    </section>
@endsection
