@extends('layouts.site', ['active' => 'ppdb'])

@section('title', 'PPDB Online - SMAN 2 Balige')
@section('description', 'Informasi penerimaan peserta didik baru SMAN 2 Balige.')

@section('content')
    <section class="school-hero hero-ppdb text-center">
        <div class="hero-shade"></div>
        <div class="mx-auto grid min-h-[520px] max-w-7xl place-items-center px-4 py-20 lg:px-8">
            <div class="relative max-w-4xl">
                <span class="section-pill">Tahun Ajaran 2024/2025</span>
                <h1 class="mt-7 text-5xl font-black leading-[0.98] text-white sm:text-6xl lg:text-7xl">
                    Penerimaan Peserta <span class="text-[#d6a63a]">Didik Baru</span>
                </h1>
                <p class="mx-auto mt-7 max-w-2xl text-base font-semibold leading-8 text-white/76">
                    Bergabunglah dengan institusi pendidikan unggulan yang berfokus pada karakter, prestasi, dan masa depan gemilang.
                </p>
                <div class="mt-9 flex flex-col justify-center gap-4 sm:flex-row">
                    <a href="#formulir" class="gold-button">Daftar Sekarang</a>
                    <a href="#syarat" class="ghost-button">Unduh Panduan</a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="text-3xl font-black text-[#071f3a] sm:text-4xl">Mengapa Memilih SMAN 2 Balige?</h2>
                <div class="mx-auto mt-5 h-1 w-16 rounded-full bg-[#d6a63a]"></div>
            </div>
            <div class="mt-14 grid gap-8 md:grid-cols-3">
                <article class="info-card"><span class="round-icon">A</span><h2>Akreditasi A</h2><p>Kualitas pendidikan terstandarisasi nasional dengan kurikulum relevan dan adaptif.</p></article>
                <article class="info-card"><span class="round-icon">P</span><h2>Prestasi Internasional</h2><p>Siswa kami konsisten meraih medali di ajang olimpiade sains dan kompetisi global.</p></article>
                <article class="info-card"><span class="round-icon">I</span><h2>Lingkungan Inklusif</h2><p>Pembentukan karakter melalui lingkungan aman, disiplin, dan penuh rasa persaudaraan.</p></article>
            </div>
        </div>
    </section>

    <section class="bg-[#071f3a] py-20 text-center text-white">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <h2 class="text-3xl font-black sm:text-4xl">Alur Pendaftaran Online</h2>
            <p class="mx-auto mt-4 max-w-2xl text-sm font-semibold leading-7 text-white/56">Ikuti langkah-langkah mudah untuk menjadi bagian dari civitas akademika SMAN 2 Balige.</p>
            <div class="mt-12 grid gap-6 md:grid-cols-4">
                @foreach ([['Registrasi Akun', 'Buat akun pada portal PPDB.'], ['Unggah Dokumen', 'Lengkapi formulir biodata dan berkas.'], ['Verifikasi Berkas', 'Tim panitia memeriksa kelengkapan dokumen.'], ['Pengumuman', 'Cek status kelulusan melalui dashboard.']] as $index => $step)
                    <article class="step-card"><span>{{ $index + 1 }}</span><h3>{{ $step[0] }}</h3><p>{{ $step[1] }}</p></article>
                @endforeach
            </div>
        </div>
    </section>

    <section id="syarat" class="bg-white py-20 sm:py-24">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 lg:grid-cols-[1.35fr_0.8fr] lg:px-8">
            <div>
                <h2 class="mini-heading">Persyaratan & Dokumen</h2>
                <div class="mt-8 grid gap-5">
                    @foreach (['Scan Ijazah / SKL', 'Akta Kelahiran & Kartu Keluarga', 'Pas Foto Terbaru', 'Rapor Semester 1-5'] as $doc)
                        <div class="document-row"><span></span><div><strong>{{ $doc }}</strong><p>Dokumen dipindai dengan jelas dan diunggah melalui portal pendaftaran.</p></div></div>
                    @endforeach
                </div>
            </div>
            <aside class="rounded-[1.6rem] bg-[#071f3a] p-8 text-white shadow-2xl shadow-[#071f3a]/20">
                <h3 class="text-2xl font-black">Jadwal Penting</h3>
                <div class="mt-8 grid gap-5">
                    @foreach ([['15 Mei', 'Sosialisasi PPDB'], ['01 Jun', 'Pembukaan Pendaftaran'], ['10 Jul', 'Seleksi Akademik'], ['20 Jul', 'Pengumuman Akhir']] as $date)
                        <div class="schedule-row"><span>{{ $date[0] }}</span><strong>{{ $date[1] }}</strong></div>
                    @endforeach
                </div>
            </aside>
        </div>
    </section>

    <section class="bg-[#f6f9fc] py-20">
        <div class="mx-auto max-w-4xl px-4 text-center lg:px-8">
            <h2 class="text-3xl font-black text-[#071f3a] sm:text-4xl">Pertanyaan Umum</h2>
            <p class="mt-4 text-sm font-semibold text-[#6b7f91]">Semua informasi yang Anda butuhkan tentang PPDB SMAN 2 Balige.</p>
            <div class="mt-12 space-y-5 text-left">
                <details class="faq-item" open><summary>Apakah ada biaya pendaftaran PPDB?</summary><p>Pendaftaran PPDB di SMAN 2 Balige tidak dipungut biaya apa pun. Mohon waspada terhadap segala bentuk penipuan yang mengatasnamakan panitia sekolah.</p></details>
                <details class="faq-item"><summary>Jalur apa saja yang tersedia tahun ini?</summary><p>Tersedia jalur prestasi akademik, prestasi non-akademik, zonasi, afirmasi, dan perpindahan tugas orang tua sesuai aturan dinas pendidikan.</p></details>
                <details class="faq-item"><summary>Bagaimana jika mengalami kendala teknis?</summary><p>Calon siswa dapat menghubungi sekretariat PPDB melalui email atau datang langsung ke kampus pada jam kerja.</p></details>
            </div>
        </div>
    </section>

    <section id="formulir" class="bg-white px-4 py-20 lg:px-8">
        <div class="cta-panel">
            <h2>Siap Menjadi Bagian Dari Generasi Unggul?</h2>
            <p>Jangan lewatkan kesempatan berharga untuk menempuh pendidikan di salah satu SMA terbaik di Sumatera Utara.</p>
            <div class="mt-10 flex flex-col justify-center gap-4 sm:flex-row">
                <a href="{{ route('kontak') }}" class="gold-button">Daftar PPDB Sekarang</a>
                <a href="{{ route('kontak') }}" class="ghost-button">Hubungi Panitia</a>
            </div>
        </div>
    </section>
@endsection
