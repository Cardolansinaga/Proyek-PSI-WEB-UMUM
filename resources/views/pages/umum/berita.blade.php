@extends('layouts.site', ['active' => 'berita'])

@section('title', 'Berita & Pengumuman - SMAN 2 Balige')
@section('description', 'Informasi dan update terbaru kampus SMAN 2 Balige.')

@section('content')
    @php
        $slug = 'siswa-sman-2-balige-raih-medali-emas-di-olimpiade-sains-nasional-2024';
        $cards = [
            ['Akademik', 'Persiapan Menuju Ujian Semester Ganjil 2024/2025', 'Informasi jadwal belajar tambahan dan konsultasi guru untuk siswa kelas XII.', 'library'],
            ['Kesiswaan', 'Kegiatan Bakti Sosial & Lingkungan Hidup', 'Siswa-siswi melakukan penanaman pohon di lingkungan sekitar Danau Toba.', 'campus'],
            ['Inovasi', 'Inovasi Robotik Siswa SMAN 2 Balige Nasional', 'Tim robotik berhasil menciptakan alat penyaring air otomatis.', 'robot'],
            ['Ekstrakurikuler', 'Pameran Seni Budaya Tahunan 2024', 'Karya terbaik siswa dipamerkan dalam berbagai media seni rupa.', 'art'],
            ['Olahraga', 'Kompetisi Atletik Pelajar Daerah', 'Kontingen sekolah mengirimkan wakil terbaik untuk cabang lari dan lompat jauh.', 'sports'],
            ['Alumni', 'Seminar Motivasi Karir Alumni 2024', 'Alumni sukses berbagi pengalaman karir dan perkuliahan.', 'alumni'],
        ];
    @endphp
    <section class="school-hero hero-news text-center">
        <div class="hero-shade"></div>
        <div class="mx-auto grid min-h-[430px] max-w-7xl place-items-center px-4 py-20 lg:px-8">
            <div class="relative max-w-4xl">
                <span class="section-pill">Warta Sekolah</span>
                <h1 class="mt-7 text-5xl font-black leading-[1] text-white sm:text-6xl">Informasi & Update Terbaru Kampus</h1>
                <p class="mx-auto mt-6 max-w-2xl text-base font-semibold leading-8 text-white/72">Ikuti perkembangan prestasi, pengumuman akademik, dan agenda kesiswaan dalam satu portal terpadu.</p>
            </div>
        </div>
    </section>

    <section class="bg-white py-8">
        <div class="mx-auto flex max-w-7xl flex-col gap-5 px-4 md:flex-row md:items-center md:justify-between lg:px-8">
            <div class="flex flex-wrap gap-3">
                @foreach (['Semua', 'Berita', 'Pengumuman', 'Prestasi'] as $filter)
                    <button class="filter-pill {{ $loop->first ? 'active' : '' }}">{{ $filter }}</button>
                @endforeach
            </div>
            <label class="search-box"><span>Cari</span><input type="search" placeholder="Cari berita atau agenda..."></label>
        </div>
    </section>

    <section class="bg-[#f8fafc] py-16 sm:py-20">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <article class="featured-news">
                <div class="illustration trophy"></div>
                <div class="p-8 lg:p-12">
                    <p class="meta-line">15 Oktober 2024</p>
                    <h2>SMAN 2 Balige Raih Juara Umum Olimpiade Sains Nasional</h2>
                    <p>Keberhasilan ini menjadi tonggak sejarah baru bagi sekolah dalam mempertahankan tradisi unggul di bidang akademik se-Sumatera Utara.</p>
                    <a href="{{ route('berita.show', $slug) }}">Baca Selengkapnya -></a>
                </div>
            </article>
            <div class="mt-14 grid gap-8 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($cards as $card)
                    <article class="news-card">
                        <div class="illustration {{ $card[3] }}"><span class="visual-label">{{ $card[0] }}</span></div>
                        <div class="p-7">
                            <h3>{{ $card[1] }}</h3>
                            <p>{{ $card[2] }}</p>
                            <div class="mt-6 flex items-center justify-between text-[11px] font-black uppercase tracking-[0.12em]">
                                <span class="text-[#9aaaba]">{{ sprintf('%02d', $loop->index + 1) }} Okt 2024</span>
                                <a class="!mt-0 text-[#c59632]" href="{{ route('berita.show', $slug) }}">Detail -></a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="mt-16 flex justify-center gap-3">
                <span class="pager active">1</span><span class="pager">2</span><span class="pager">3</span>
            </div>
        </div>
    </section>

    <section class="bg-white px-4 py-20 lg:px-8">
        <div class="cta-panel">
            <h2>Siap Menjadi Bagian Dari Kami?</h2>
            <p>Penerimaan Peserta Didik Baru tahun ajaran 2025/2026 telah dibuka. Daftarkan putra-putri Anda sekarang.</p>
            <a href="{{ route('ppdb') }}" class="gold-button mt-10">Daftar PPDB Online</a>
        </div>
    </section>
@endsection
