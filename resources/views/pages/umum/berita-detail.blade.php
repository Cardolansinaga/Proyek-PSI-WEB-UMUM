@extends('layouts.site', ['active' => 'berita'])

@section('title', 'Detail Berita - SMAN 2 Balige')
@section('description', 'Detail berita prestasi siswa SMAN 2 Balige.')

@section('content')
    <article class="bg-white py-16 sm:py-20">
        <div class="mx-auto max-w-4xl px-4 lg:px-8">
            <nav class="text-[11px] font-black uppercase tracking-[0.2em] text-[#9aaaba]">Beranda / Berita / Detail Berita</nav>
            <div class="mt-8 flex flex-wrap items-center gap-4">
                <span class="rounded-full bg-[#f4ecd9] px-4 py-2 text-[10px] font-black uppercase tracking-[0.14em] text-[#c59632]">Akademik</span>
                <span class="text-sm font-bold text-[#8396a8]">12 Mei 2026</span>
            </div>
            <h1 class="mt-6 text-4xl font-black leading-[1.02] text-[#071f3a] sm:text-5xl lg:text-6xl">
                Siswa SMAN 2 Balige Perkuat Tradisi Prestasi di Bidang Sains
            </h1>
            <div class="mt-10 flex items-center justify-between border-y border-[#e7edf2] py-6">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 rounded-full bg-[linear-gradient(135deg,#071f3a,#d6a63a)]"></div>
                    <div><strong class="block text-[#071f3a]">Admin Sekolah</strong><span class="text-sm font-semibold text-[#8396a8]">Humas SMAN 2 Balige</span></div>
                </div>
                <div class="flex gap-3">
                    <a class="icon-button" href="{{ route('akademik') }}#prestasi" aria-label="Lihat prestasi"><i class="bi bi-trophy"></i></a>
                    <a class="icon-button" href="{{ route('berita.index') }}" aria-label="Kembali ke berita"><i class="bi bi-newspaper"></i></a>
                </div>
            </div>
            <figure class="mt-12">
                <div class="illustration medalists min-h-[360px] rounded-[1.5rem] shadow-2xl shadow-[#071f3a]/10"></div>
                <figcaption class="mt-5 text-center text-sm font-semibold text-[#8da0b1]">Kebanggaan Sekolah: pembinaan sains menjadi bagian penting dari budaya belajar SMAN 2 Balige.</figcaption>
            </figure>
            <div class="prose-copy mt-14">
                <p>Prestasi dan budaya riset terus menjadi perhatian utama SMAN 2 Balige. Melalui pembinaan terjadwal, siswa didampingi untuk menguatkan kemampuan analisis, keberanian berkompetisi, dan kedisiplinan belajar.</p>
                <p>Kepala sekolah menyampaikan bahwa capaian siswa adalah hasil dari ekosistem yang bekerja bersama: guru pembina, wali kelas, orang tua, dan lingkungan sekolah yang memberi ruang bagi rasa ingin tahu.</p>
                <blockquote>"Kunci keberhasilan adalah konsistensi dalam belajar dan keberanian untuk menghadapi tantangan tersulit sekalipun."</blockquote>
                <p>Program akselerasi sains disusun secara bertahap melalui pendalaman materi, diskusi riset, simulasi kompetisi, dan evaluasi karakter agar siswa siap membawa nama sekolah dengan percaya diri.</p>
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
                <div class="flex flex-wrap gap-3"><span class="tag">#Sains2026</span><span class="tag">#Sains</span><span class="tag">#Prestasi</span></div>
                <div class="flex items-center gap-3">
                    <span class="text-[11px] font-black uppercase tracking-[0.18em] text-[#9aaaba]">Bagikan:</span>
                    <a class="share fb" href="mailto:?subject=Berita SMAN 2 Balige&body={{ route('berita.show', 'pembinaan-sains-sman-2-balige-2026') }}" aria-label="Bagikan lewat email"><i class="bi bi-envelope"></i></a>
                    <a class="share tw" href="https://twitter.com/intent/tweet?url={{ urlencode(route('berita.show', 'pembinaan-sains-sman-2-balige-2026')) }}" target="_blank" rel="noopener" aria-label="Bagikan ke X"><i class="bi bi-twitter-x"></i></a>
                    <a class="share wa" href="https://wa.me/?text={{ urlencode(route('berita.show', 'pembinaan-sains-sman-2-balige-2026')) }}" target="_blank" rel="noopener" aria-label="Bagikan ke WhatsApp"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#f8fafc] py-20">
        <div class="mx-auto max-w-5xl px-4 lg:px-8">
            <h2 class="text-3xl font-black text-[#071f3a]">Berita Terkait</h2>
            <p class="mt-3 text-sm font-semibold text-[#8396a8]">Simak informasi menarik lainnya dari sekolah kami.</p>
            <div class="mt-10 grid gap-8 md:grid-cols-2">
                <article class="news-card hover-lift animate-fade-in-up stagger-1"><div class="illustration graduates"></div><div class="p-7"><p class="meta-line">Pengumuman</p><h3>Persiapan Wisuda Angkatan 2026 Mulai Dimatangkan</h3><p>Rapat koordinasi bersama wali murid telah menyepakati jadwal dan lokasi pelaksanaan.</p></div></article>
                <article class="news-card hover-lift animate-fade-in-up stagger-2"><div class="illustration campus"></div><div class="p-7"><p class="meta-line">Kesiswaan</p><h3>Kegiatan LDKS OSIS Berjalan Lancar di Sipinsur</h3><p>Pelatihan kepemimpinan dasar diikuti seluruh pengurus OSIS baru untuk periode mendatang.</p></div></article>
            </div>
            <div class="mt-12 text-center"><a href="{{ route('berita.index') }}" class="rounded-full bg-[#071f3a] px-8 py-4 text-sm font-black uppercase tracking-[0.08em] text-white">Lihat Berita Lainnya -></a></div>
        </div>
    </section>
@endsection
