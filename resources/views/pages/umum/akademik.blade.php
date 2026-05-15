@extends('layouts.site', ['active' => 'akademik'])

@section('title', 'Akademik & Prestasi - SMAN 2 Balige')
@section('description', 'Program akademik, kurikulum, prestasi, kalender, layanan, dan fasilitas belajar SMAN 2 Balige.')

@section('content')
    <section class="school-hero hero-academic">
        <div class="hero-shade"></div>
        <div class="mx-auto grid min-h-[560px] max-w-7xl items-center px-4 py-20 lg:px-8">
            <div class="relative max-w-3xl animate-fade-in-up">
                <span class="section-pill animate-fade-in" style="animation-delay: 0.1s;">Keunggulan Akademik & Prestasi</span>
                <h1 class="mt-7 text-5xl font-black leading-[0.98] text-white sm:text-6xl lg:text-7xl animate-fade-in-up" style="animation-delay: 0.2s;">
                    Membentuk Intelek <span class="text-[#d6a63a]">Berprestasi Unggul</span>
                </h1>
                <p class="mt-7 max-w-2xl text-base font-semibold leading-8 text-white/78 animate-fade-in-up" style="animation-delay: 0.3s;">Ekosistem belajar yang kompetitif, suportif, dan terukur untuk menumbuhkan karakter, disiplin, serta budaya juara.</p>
                <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                    <a href="#portal-akademik" class="gold-button transition-smooth" style="animation-delay: 0.4s;">Layanan Akademik</a>
                    <a href="#prestasi" class="ghost-button transition-smooth" style="animation-delay: 0.5s;">Lihat Prestasi</a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto grid max-w-7xl gap-14 px-4 lg:grid-cols-[1fr_0.95fr] lg:items-center lg:px-8">
            <div>
                <div class="h-1 w-16 rounded-full bg-[#d6a63a]"></div>
                <h2 class="mt-6 text-4xl font-black leading-tight text-[#071f3a]">Komitmen Terhadap Integritas Akademik</h2>
                <p class="mt-7 max-w-2xl text-sm font-semibold leading-7 text-[#6b7f91]">Di SMAN 2 Balige, kami percaya bahwa pendidikan bukan sekadar transfer pengetahuan, melainkan pembentukan pola pikir kritis dan etos kerja yang tinggi.</p>
                <div class="mt-10 grid max-w-md grid-cols-2 gap-8">
                    <div class="big-stat"><strong>98%</strong><span>Lulusan di PTN Favorit</span></div>
                    <div class="big-stat"><strong>1:20</strong><span>Rasio Guru & Siswa</span></div>
                </div>
            </div>
            <div class="academic-portrait">
                <div class="floating-quote">Standar akademik di sini melatih saya untuk tidak hanya pintar, tapi juga tangguh menghadapi tantangan global.</div>
            </div>
        </div>
    </section>

    <section id="kurikulum" class="bg-[#f6f9fc] py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <p class="eyebrow">Struktur & Program Akademik</p>
                <h2 class="mt-3 text-4xl font-black text-[#071f3a]">Kurikulum Adaptif dan Terukur</h2>
                <p class="mt-5 text-sm font-semibold leading-7 text-[#6b7f91]">Kurikulum Merdeka dipadukan dengan program pengayaan khusus olimpiade dan riset ilmiah.</p>
            </div>
            <div class="academic-grid mt-12">
                <article class="program-card wide hover-lift animate-fade-in-up stagger-1">
                    <span class="round-icon"><i class="bi bi-journal-bookmark"></i></span>
                    <h3>Kurikulum Merdeka Plus</h3>
                    <p>Fleksibilitas pembelajaran berbasis proyek, penguatan literasi, numerasi, karakter, dan pemetaan minat siswa.</p>
                </article>
                <article class="program-card dark hover-lift animate-fade-in-up stagger-2">
                    <span class="round-icon bg-white/10 text-[#d6a63a]"><i class="bi bi-flask"></i></span>
                    <h3>Riset & Karya Ilmiah</h3>
                    <p>Pembimbingan riset terjadwal agar siswa terbiasa berpikir metodologis dan berani mengikuti kompetisi.</p>
                </article>
                <article class="program-card gold hover-lift animate-fade-in-up stagger-3">
                    <span class="round-icon"><i class="bi bi-translate"></i></span>
                    <h3>English Mastery</h3>
                    <p>Penguatan bahasa Inggris akademik untuk presentasi, lomba, dan persiapan studi lanjutan.</p>
                </article>
                <article class="program-card hover-lift animate-fade-in-up stagger-4">
                    <span class="round-icon"><i class="bi bi-graph-up-arrow"></i></span>
                    <h3>Bimbingan Intensif PTN</h3>
                    <p>Simulasi UTBK, konsultasi jurusan, dan pemantauan progres belajar kelas XII secara berkala.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 lg:grid-cols-[1fr_0.92fr] lg:px-8">
            <div>
                <p class="eyebrow text-left">Kalender Akademik <span class="text-[#d6a63a]">2026/2027</span></p>
                <div class="mt-8 grid gap-5">
                    @foreach ([['13 Jul', 'Awal Semester Ganjil', 'Orientasi siswa baru dan pertemuan orang tua murid.'], ['05 Okt', 'Penilaian Tengah Semester', 'Evaluasi capaian belajar tiga bulan pertama.'], ['18 Des', 'Pembagian Rapor', 'Laporan perkembangan akademik semester 1.']] as $event)
                        <article class="calendar-card"><span>{{ $event[0] }}</span><div><h3>{{ $event[1] }}</h3><p>{{ $event[2] }}</p></div></article>
                    @endforeach
                </div>
                <a href="{{ route('home') }}#kontak" class="final-link mt-8">Tanya Bagian Kurikulum -></a>
            </div>
            <aside id="portal-akademik" class="rounded-[1.6rem] bg-[#071f3a] p-8 text-white shadow-2xl shadow-[#071f3a]/20">
                <h3 class="text-2xl font-black">Layanan Akademik</h3>
                <div class="mt-8 grid gap-4 sm:grid-cols-2">
                    @foreach (['Legalisir Ijazah', 'Surat Keterangan', 'Transkrip Nilai', 'Konseling Belajar'] as $service)
                        <div class="service-tile"><strong>{{ $service }}</strong><p>Layanan administrasi dan pendampingan siswa.</p></div>
                    @endforeach
                </div>
            </aside>
        </div>
    </section>

    <section class="bg-[#071f3a] py-20 text-white">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <p class="eyebrow">Infrastruktur & Fasilitas</p>
                <h2 class="mt-3 text-4xl font-black">Ruang Belajar Modern</h2>
                <p class="mt-5 text-sm font-semibold leading-7 text-white/78">Dukungan teknologi modern untuk memastikan pembelajaran teoritis dapat dipraktikkan secara langsung.</p>
            </div>
            <div class="facility-mosaic mt-12">
                <div class="facility-tile science-lab"><span>Lab Kimia & Fisika Terpadu</span></div>
                <div class="facility-tile lab-real"><span>Lab Multimedia</span></div>
                <div class="facility-tile library-real"><span>Perpustakaan Digital</span></div>
                <div class="facility-tile classroom-real"><span>Smart Classroom</span></div>
            </div>
        </div>
    </section>

    <section id="prestasi" class="bg-[#f6f9fc] py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="eyebrow">Budaya Prestasi</p>
                    <h2 class="mt-3 text-4xl font-black text-[#071f3a] sm:text-5xl">Prestasi Unggulan</h2>
                    <p class="mt-5 max-w-2xl text-sm font-semibold leading-7 text-[#6b7f91]">Prestasi menjadi bagian dari proses belajar harian melalui pembinaan akademik, seni, olahraga, dan kepemimpinan.</p>
                </div>
                <div class="grid grid-cols-2 gap-6 text-right">
                    <div class="big-stat"><strong>500+</strong><span>Penghargaan Nasional</span></div>
                    <div class="big-stat"><strong>12</strong><span>Medali Internasional</span></div>
                </div>
            </div>

            <article class="mt-10 grid overflow-hidden rounded-[1.6rem] bg-white shadow-2xl shadow-[#071f3a]/10 lg:grid-cols-[1fr_1fr]">
                <div class="illustration victory min-h-[360px]"></div>
                <div class="p-8 lg:p-12">
                    <span class="rounded-full bg-emerald-50 px-4 py-2 text-[10px] font-black uppercase tracking-[0.14em] text-emerald-600">Juara 1 Internasional</span>
                    <h3 class="mt-8 text-3xl font-black text-[#071f3a]">Pembinaan Riset dan Olimpiade Sains 2026</h3>
                    <p class="mt-5 text-sm font-semibold leading-7 text-[#6b7f91]">Tim Riset SMAN 2 Balige meraih capaian membanggakan melalui program mentoring rutin, simulasi kompetisi, dan pendampingan guru pembina.</p>
                    <div class="mt-8 rounded-2xl bg-[#f6f9fc] p-5 text-sm font-black text-[#071f3a]">Togu Simanjuntak & Tim <span class="block pt-1 text-xs font-bold text-[#8ca0b0]">Siswa Kelas XI MIPA</span></div>
                    <a href="{{ route('home') }}#berita" class="mt-8 inline-flex w-full justify-center rounded-full bg-[#071f3a] px-7 py-4 text-sm font-black text-white">Baca Kisah Lengkap -></a>
                </div>
            </article>

            <div class="mt-12 grid gap-8 md:grid-cols-3">
                <article class="achievement-card hover-lift animate-fade-in-up stagger-1"><div class="illustration speech"></div><h3>Juara 1 Debat Bahasa Inggris Nasional</h3><p>Arisandi P. Hutabarat - Tingkat Nasional</p><span>Medali Emas</span></article>
                <article class="achievement-card hover-lift animate-fade-in-up stagger-2"><div class="illustration runner"></div><h3>Medali Perak Lari 100m O2SN</h3><p>Samuel Siahaan - Tingkat Provinsi</p><span>Medali Perak</span></article>
                <article class="achievement-card hover-lift animate-fade-in-up stagger-3"><div class="illustration dance"></div><h3>Penampil Terbaik Festival Budaya</h3><p>Sanggar Tari SMAN 2 - Tingkat Nasional</p><span>Penghargaan Utama</span></article>
            </div>
        </div>
    </section>

    <section class="bg-white py-20">
        <div class="mx-auto max-w-4xl px-4 lg:px-8">
            <h2 class="text-center text-3xl font-black text-[#071f3a]">Informasi Akademik & Prestasi</h2>
            <div class="mt-10 space-y-5">
                @foreach (['Apa saja syarat untuk mengikuti kelas pengayaan olimpiade?', 'Bagaimana sistem penilaian Kurikulum Merdeka di SMAN 2 Balige?', 'Apakah tersedia beasiswa prestasi akademik?'] as $question)
                    <details class="faq-item"><summary>{{ $question }}</summary><p>Informasi lengkap tersedia melalui wali kelas, bagian kurikulum, dan portal akademik sekolah.</p></details>
                @endforeach
            </div>
        </div>
    </section>
@endsection
