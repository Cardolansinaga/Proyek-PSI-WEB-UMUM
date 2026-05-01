@extends('layouts.site', ['active' => 'akademik'])

@section('title', 'Akademik - SMAN 2 Balige')
@section('description', 'Program akademik, kurikulum, kalender, layanan, dan fasilitas belajar SMAN 2 Balige.')

@section('content')
    <section class="school-hero hero-academic">
        <div class="hero-shade"></div>
        <div class="mx-auto grid min-h-[560px] max-w-7xl items-center px-4 py-20 lg:px-8">
            <div class="relative max-w-3xl">
                <span class="section-pill">Keunggulan Akademik</span>
                <h1 class="mt-7 text-5xl font-black leading-[0.98] text-white sm:text-6xl lg:text-7xl">
                    Membentuk Intelek <span class="text-[#d6a63a]">Berkarakter Unggul</span>
                </h1>
                <p class="mt-7 max-w-2xl text-base font-semibold leading-8 text-white/78">Ekosistem belajar yang kompetitif, suportif, dan berbasis standar nasional pendidikan yang ditingkatkan untuk masa depan global.</p>
                <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                    <a href="#portal-akademik" class="gold-button">E-Learning Portal</a>
                    <a href="#kurikulum" class="ghost-button">Unduh Kurikulum</a>
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
                <article class="program-card wide"><span class="round-icon">KM</span><h3>Kurikulum Merdeka Plus</h3><p>Fleksibilitas pembelajaran yang berfokus pada pengembangan bakat, minat, dan Profil Pelajar Pancasila.</p></article>
                <article class="program-card dark"><span class="round-icon bg-white/10 text-[#d6a63a]">RI</span><h3>Riset & Karya Ilmiah</h3><p>Mewajibkan setiap siswa menghasilkan karya tulis ilmiah tahunan untuk mengasah metodologi.</p></article>
                <article class="program-card gold"><h3>English Mastery</h3><p>Integrasi kurikulum internasional untuk persiapan studi dan kompetisi global.</p></article>
                <article class="program-card"><h3>Bimbingan Intensif PTN</h3><p>Pendampingan khusus kelas XII dengan simulasi UTBK dan konsultasi jurusan personal.</p></article>
            </div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 lg:grid-cols-[1fr_0.92fr] lg:px-8">
            <div>
                <p class="eyebrow text-left">Kalender Akademik <span class="text-[#d6a63a]">2024/2025</span></p>
                <div class="mt-8 grid gap-5">
                    @foreach ([['15 Jul', 'Awal Semester Ganjil', 'Orientasi siswa baru dan pertemuan orang tua murid.'], ['02 Okt', 'Penilaian Tengah Semester', 'Evaluasi capaian belajar tiga bulan pertama.'], ['18 Des', 'Pembagian Rapor', 'Laporan perkembangan akademik semester 1.']] as $event)
                        <article class="calendar-card"><span>{{ $event[0] }}</span><div><h3>{{ $event[1] }}</h3><p>{{ $event[2] }}</p></div></article>
                    @endforeach
                </div>
                <a href="#" class="mt-8 inline-flex text-sm font-black text-[#071f3a]">Lihat Selengkapnya -></a>
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
                <p class="mt-5 text-sm font-semibold leading-7 text-white/58">Dukungan teknologi modern untuk memastikan pembelajaran teoritis dapat dipraktikkan secara langsung.</p>
            </div>
            <div class="facility-mosaic mt-12">
                <div class="facility-tile dog-lab"><span>Lab Kimia & Fisika Terpadu</span></div>
                <div class="facility-tile lab-real"><span>Lab Multimedia</span></div>
                <div class="facility-tile library-real"><span>Perpustakaan Digital</span></div>
                <div class="facility-tile classroom-real"><span>Smart Classroom</span></div>
            </div>
        </div>
    </section>

    <section class="bg-white py-20">
        <div class="mx-auto max-w-4xl px-4 lg:px-8">
            <h2 class="text-center text-3xl font-black text-[#071f3a]">Informasi Akademik</h2>
            <div class="mt-10 space-y-5">
                @foreach (['Apa saja syarat untuk mengikuti kelas pengayaan olimpiade?', 'Bagaimana sistem penilaian Kurikulum Merdeka di SMAN 2 Balige?', 'Apakah tersedia beasiswa prestasi akademik?'] as $question)
                    <details class="faq-item"><summary>{{ $question }}</summary><p>Informasi lengkap tersedia melalui wali kelas, bagian kurikulum, dan portal akademik sekolah.</p></details>
                @endforeach
            </div>
        </div>
    </section>
@endsection
