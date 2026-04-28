@extends('layouts.site', ['active' => 'prestasi'])

@section('title', 'Prestasi - SMAN 2 Balige')
@section('description', 'Prestasi unggulan dan budaya juara SMAN 2 Balige.')

@section('content')
    <section class="school-hero hero-achievement">
        <div class="hero-shade"></div>
        <div class="mx-auto grid min-h-[520px] max-w-7xl items-center px-4 py-20 lg:px-8">
            <div class="relative max-w-3xl">
                <span class="section-pill">Legacy of Excellence</span>
                <h1 class="mt-7 text-5xl font-black leading-[0.98] text-white sm:text-6xl lg:text-7xl">
                    Membina Generasi, <span class="text-[#d6a63a]">Mengukir Prestasi</span> Dunia.
                </h1>
                <p class="mt-7 max-w-2xl text-base font-semibold leading-8 text-white/76">
                    Kumpulan dedikasi, disiplin, dan kerja keras para putra-putri terbaik SMAN 2 Balige di kancah nasional maupun internasional.
                </p>
                <a href="#galeri-prestasi" class="gold-button mt-10">Jelajahi Prestasi</a>
            </div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 lg:grid-cols-[1fr_0.95fr] lg:items-center lg:px-8">
            <div>
                <h2 class="text-4xl font-black leading-tight text-[#071f3a]">Budaya Prestasi Sebagai Identitas</h2>
                <p class="mt-6 max-w-xl text-sm font-semibold leading-7 text-[#6b7f91]">Di SMAN 2 Balige, prestasi bukan sekadar tujuan akhir, melainkan sebuah kebiasaan yang dipupuk sejak hari pertama.</p>
                <div class="mt-10 grid max-w-md grid-cols-2 gap-8">
                    <div class="big-stat"><strong>500+</strong><span>Penghargaan Nasional</span></div>
                    <div class="big-stat"><strong>12</strong><span>Medali Internasional</span></div>
                </div>
            </div>
            <div class="achievement-portrait">
                <div class="quote-card">"Unggul dalam karakter, tangguh dalam prestasi."</div>
            </div>
        </div>
    </section>

    <section class="bg-[#f6f9fc] py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
                <div><p class="eyebrow">Kebanggaan Terkini</p><h2 class="mt-3 text-4xl font-black text-[#071f3a] sm:text-5xl">Prestasi Unggulan 2024</h2></div>
                <a href="#galeri-prestasi" class="inline-flex text-sm font-black text-[#071f3a]">Lihat Arsip Tahunan -></a>
            </div>
            <article class="mt-10 grid overflow-hidden rounded-[1.6rem] bg-white shadow-2xl shadow-[#071f3a]/10 lg:grid-cols-[1fr_1fr]">
                <div class="illustration victory min-h-[360px]"></div>
                <div class="p-8 lg:p-12">
                    <span class="rounded-full bg-emerald-50 px-4 py-2 text-[10px] font-black uppercase tracking-[0.14em] text-emerald-600">Juara 1 Internasional</span>
                    <h3 class="mt-8 text-3xl font-black text-[#071f3a]">Olimpiade Riset Internasional 2024</h3>
                    <p class="mt-5 text-sm font-semibold leading-7 text-[#6b7f91]">Tim Riset SMAN 2 Balige berhasil memenangkan medali emas di Tokyo melalui inovasi sistem purifikasi air berbasis kearifan lokal Danau Toba.</p>
                    <div class="mt-8 rounded-2xl bg-[#f6f9fc] p-5 text-sm font-black text-[#071f3a]">Togu Simanjuntak & Tim <span class="block pt-1 text-xs font-bold text-[#8ca0b0]">Siswa Kelas XI MIPA</span></div>
                    <a href="{{ route('berita.index') }}" class="mt-8 inline-flex w-full justify-center rounded-full bg-[#071f3a] px-7 py-4 text-sm font-black text-white">Baca Kisah Lengkap -></a>
                </div>
            </article>
        </div>
    </section>

    <section id="galeri-prestasi" class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
                <div><h2 class="text-3xl font-black text-[#071f3a]">Galeri Prestasi</h2><p class="mt-3 max-w-xl text-sm font-semibold text-[#6b7f91]">Dedikasi siswa dalam mengukir karya di berbagai bidang.</p></div>
                <div class="flex flex-wrap gap-3">@foreach (['Semua', 'Akademik', 'Olahraga', 'Seni'] as $filter)<button class="filter-pill {{ $loop->first ? 'active' : '' }}">{{ $filter }}</button>@endforeach</div>
            </div>
            <div class="mt-12 grid gap-8 md:grid-cols-3">
                <article class="achievement-card"><div class="illustration speech"></div><h3>Juara 1 Debat Bahasa Inggris Nasional</h3><p>Arisandi P. Hutabarat - Tingkat Nasional</p><span>Medali Emas</span></article>
                <article class="achievement-card"><div class="illustration runner"></div><h3>Medali Perak Lari 100m O2SN</h3><p>Samuel Siahaan - Tingkat Provinsi</p><span>Medali Perak</span></article>
                <article class="achievement-card"><div class="illustration dance"></div><h3>Penampil Terbaik Festival Budaya</h3><p>Sanggar Tari SMAN 2 - Tingkat Nasional</p><span>Penghargaan Utama</span></article>
            </div>
            <div class="mt-12 text-center"><a href="{{ route('berita.index') }}" class="outline-button">Lihat Semua Prestasi</a></div>
        </div>
    </section>

    <section class="bg-[#071f3a] py-16">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 text-center sm:grid-cols-2 lg:grid-cols-4 lg:px-8">
            <div class="stat-item"><strong>1,240</strong><span>Lulusan PTN Favorit</span></div>
            <div class="stat-item"><strong>85</strong><span>Trofi Tahun Ini</span></div>
            <div class="stat-item"><strong>15</strong><span>Medali Internasional</span></div>
            <div class="stat-item"><strong>42</strong><span>Ekskul Aktif</span></div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-6xl px-4 text-center lg:px-8">
            <p class="eyebrow">Suara Mereka</p>
            <h2 class="mt-3 text-4xl font-black text-[#071f3a]">Inspirasi Alumni & Siswa</h2>
            <div class="mt-12 grid gap-8 md:grid-cols-2">
                <blockquote class="testimonial">"Lingkungan di SMAN 2 Balige sangat kompetitif namun suportif. Guru-guru di sini tidak hanya mengajar, tapi membimbing kami untuk memiliki visi global."<span>Kevin Marbun</span></blockquote>
                <blockquote class="testimonial">"Meraih emas di Olimpiade Sains adalah mimpi yang jadi nyata. Dukungan fasilitas laboratorium dan pembinaan intensif sekolah adalah kunci keberhasilan saya."<span>Siti Napitupulu</span></blockquote>
            </div>
        </div>
    </section>

    <section class="bg-white px-4 pb-24 lg:px-8">
        <div class="cta-panel">
            <h2>Siap Menjadi Bagian dari Kami?</h2>
            <p>Jelajahi potensi diri Anda dan ukir prestasi bersama ribuan siswa berbakat lainnya di SMAN 2 Balige.</p>
            <div class="mt-10 flex flex-col justify-center gap-4 sm:flex-row">
                <a href="{{ route('ppdb') }}" class="gold-button">Info PPDB 2025</a>
                <a href="{{ route('kontak') }}" class="ghost-button">Kegiatan Kesiswaan</a>
            </div>
        </div>
    </section>
@endsection
