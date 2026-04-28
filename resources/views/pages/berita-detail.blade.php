@extends('layouts.site', ['active' => 'berita'])

@section('title', 'Detail Berita - SMAN 2 Balige')
@section('description', 'Detail berita prestasi siswa SMAN 2 Balige.')

@section('content')
    <article class="bg-white py-16 sm:py-20">
        <div class="mx-auto max-w-4xl px-4 lg:px-8">
            <nav class="text-[11px] font-black uppercase tracking-[0.2em] text-[#9aaaba]">Beranda / Berita / Detail Berita</nav>
            <div class="mt-8 flex flex-wrap items-center gap-4">
                <span class="rounded-full bg-[#f4ecd9] px-4 py-2 text-[10px] font-black uppercase tracking-[0.14em] text-[#c59632]">Akademik</span>
                <span class="text-sm font-bold text-[#8396a8]">12 Oktober 2024</span>
            </div>
            <h1 class="mt-6 text-4xl font-black leading-[1.02] text-[#071f3a] sm:text-5xl lg:text-6xl">
                Siswa SMAN 2 Balige Raih Medali Emas di Olimpiade Sains Nasional 2024
            </h1>
            <div class="mt-10 flex items-center justify-between border-y border-[#e7edf2] py-6">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 rounded-full bg-[linear-gradient(135deg,#071f3a,#d6a63a)]"></div>
                    <div><strong class="block text-[#071f3a]">Admin Sekolah</strong><span class="text-sm font-semibold text-[#8396a8]">Humas SMAN 2 Balige</span></div>
                </div>
                <div class="flex gap-3"><button class="icon-button">S</button><button class="icon-button">B</button></div>
            </div>
            <figure class="mt-12">
                <div class="illustration medalists min-h-[360px] rounded-[1.5rem] shadow-2xl shadow-[#071f3a]/10"></div>
                <figcaption class="mt-5 text-center text-sm font-semibold text-[#8da0b1]">Kebanggaan Sekolah: Tim OSN SMAN 2 Balige saat seremoni penghargaan di Jakarta.</figcaption>
            </figure>
            <div class="prose-copy mt-14">
                <p>Prestasi membanggakan kembali ditorehkan oleh putra-putri terbaik SMAN 2 Balige di kancah nasional. Dalam gelaran Olimpiade Sains Nasional 2024 yang berlangsung pekan lalu, perwakilan sekolah berhasil menyabet medali emas di bidang Fisika dan Astronomi.</p>
                <p>Kepala Sekolah menyatakan bahwa pencapaian ini merupakan hasil dari dedikasi tanpa henti para siswa serta bimbingan intensif dari para guru. Kemenangan ini bukan hanya milik para siswa, tetapi milik seluruh komunitas sekolah yang telah memberikan dukungan moral dan material.</p>
                <blockquote>"Kunci keberhasilan adalah konsistensi dalam belajar dan keberanian untuk menghadapi tantangan tersulit sekalipun."</blockquote>
                <p>Persiapan untuk ajang ini telah dilakukan selama enam bulan terakhir melalui program akselerasi sains. Para siswa tidak hanya dilatih secara akademis, tetapi juga dibekali penguatan mental untuk menghadapi tekanan kompetisi tingkat tinggi.</p>
            </div>
        </div>
    </article>

    <section class="bg-white pb-20">
        <div class="mx-auto max-w-4xl px-4 lg:px-8">
            <h2 class="text-2xl font-black text-[#071f3a]">Galeri Kegiatan</h2>
            <div class="mt-8 grid gap-6 sm:grid-cols-2">
                <div class="illustration study min-h-[220px] rounded-2xl"></div>
                <div class="grid gap-6"><div class="illustration class min-h-[220px] rounded-2xl"></div><div class="illustration labroom min-h-[220px] rounded-2xl"></div></div>
            </div>
            <div class="mt-14 flex flex-col gap-6 border-y border-[#e7edf2] py-8 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex flex-wrap gap-3"><span class="tag">#OSN2024</span><span class="tag">#Sains</span><span class="tag">#Prestasi</span></div>
                <div class="flex items-center gap-3"><span class="text-[11px] font-black uppercase tracking-[0.18em] text-[#9aaaba]">Bagikan:</span><a class="share fb" href="#">f</a><a class="share tw" href="#">x</a><a class="share wa" href="#">wa</a></div>
            </div>
        </div>
    </section>

    <section class="bg-[#f8fafc] py-20">
        <div class="mx-auto max-w-5xl px-4 lg:px-8">
            <h2 class="text-3xl font-black text-[#071f3a]">Berita Terkait</h2>
            <p class="mt-3 text-sm font-semibold text-[#8396a8]">Simak informasi menarik lainnya dari sekolah kami.</p>
            <div class="mt-10 grid gap-8 md:grid-cols-2">
                <article class="news-card"><div class="illustration graduates"></div><div class="p-7"><p class="meta-line">Pengumuman</p><h3>Persiapan Wisuda Angkatan 2024 Mulai Dimatangkan</h3><p>Rapat koordinasi bersama wali murid telah menyepakati jadwal dan lokasi pelaksanaan.</p></div></article>
                <article class="news-card"><div class="illustration campus"></div><div class="p-7"><p class="meta-line">Kesiswaan</p><h3>Kegiatan LDKS OSIS Berjalan Lancar di Sipinsur</h3><p>Pelatihan kepemimpinan dasar diikuti seluruh pengurus OSIS baru untuk periode mendatang.</p></div></article>
            </div>
            <div class="mt-12 text-center"><a href="{{ route('berita.index') }}" class="rounded-full bg-[#071f3a] px-8 py-4 text-sm font-black uppercase tracking-[0.08em] text-white">Lihat Berita Lainnya -></a></div>
        </div>
    </section>
@endsection
