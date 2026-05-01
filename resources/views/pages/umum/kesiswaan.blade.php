@extends('layouts.site', ['active' => 'kesiswaan'])

@section('title', 'Kesiswaan & Ekstrakurikuler - SMAN 2 Balige')
@section('description', 'Kesiswaan, OSIS, MPK, ekstrakurikuler, dan pembinaan karakter SMAN 2 Balige.')

@section('content')
    <section class="school-hero hero-student text-center">
        <div class="hero-shade"></div>
        <div class="mx-auto grid min-h-[560px] max-w-7xl place-items-center px-4 py-20 lg:px-8">
            <div class="relative max-w-4xl">
                <span class="section-pill">Ekosistem Kesiswaan</span>
                <h1 class="mt-7 text-5xl font-black leading-[0.98] text-white sm:text-6xl lg:text-7xl">
                    Membentuk Karakter Berlandaskan Integritas
                </h1>
                <p class="mx-auto mt-7 max-w-2xl text-base font-semibold leading-8 text-white/78">Satu wadah kolaboratif untuk mengasah potensi, kepemimpinan, dan kreativitas siswa.</p>
                <div class="mt-10 flex flex-col justify-center gap-4 sm:flex-row">
                    <a href="#ekskul" class="gold-button">Daftar Ekstrakurikuler</a>
                    <a href="#organisasi" class="ghost-button">Lihat Jadwal Kegiatan</a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto grid max-w-7xl gap-14 px-4 lg:grid-cols-[1fr_0.95fr] lg:items-center lg:px-8">
            <div>
                <p class="eyebrow">Nilai Utama Kami</p>
                <h2 class="mt-3 text-4xl font-black leading-tight text-[#071f3a]">Pengembangan Karakter & Potensi Tak Terbatas</h2>
                <p class="mt-7 max-w-2xl text-sm font-semibold leading-7 text-[#6b7f91]">Pendidikan melampaui ruang kelas. Kami percaya setiap siswa memiliki keunikan yang harus diasah melalui sistem pembinaan yang terintegrasi.</p>
                <div class="mt-9 grid max-w-lg grid-cols-2 gap-5">
                    <div class="soft-card"><span>01</span><h3>Integritas</h3><p>Kejujuran dalam setiap tindakan dan keputusan.</p></div>
                    <div class="soft-card"><span>02</span><h3>Kritis</h3><p>Kemampuan berpikir solutif menghadapi tantangan.</p></div>
                </div>
            </div>
            <div class="student-mentoring"></div>
        </div>
    </section>

    <section id="organisasi" class="bg-[#f6f9fc] py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <p class="eyebrow">Kepemimpinan Siswa</p>
                <h2 class="mt-3 text-4xl font-black text-[#071f3a]">Organisasi Strategis</h2>
                <div class="mx-auto mt-5 h-1 w-16 rounded-full bg-[#d6a63a]"></div>
            </div>
            <div class="mt-12 grid gap-8 lg:grid-cols-[0.85fr_1fr_0.75fr]">
                <div class="facility-tile osis-real"><span>OSIS Safework</span></div>
                <article class="program-card"><p class="eyebrow text-left">Lembaga Eksekutif</p><h3>OSIS SMAN 2 Balige</h3><p>Wadah aspirasi dan pelaksana kegiatan siswa yang dinamis untuk mendorong budaya kolaborasi.</p><a href="#" class="mt-6 inline-flex text-sm font-black text-[#071f3a]">Struktur & Visi -></a></article>
                <article class="program-card dark"><p class="eyebrow text-left">Lembaga Legislatif</p><h3>MPK</h3><p>Majelis perwakilan kelas yang mengawal aspirasi siswa secara demokratis.</p><strong class="mt-8 block text-[#d6a63a]">42 Perwakilan Terpilih</strong></article>
            </div>
        </div>
    </section>

    <section id="ekskul" class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
                <div><p class="eyebrow">Eksplorasi Minat & Bakat</p><h2 class="mt-3 text-4xl font-black text-[#071f3a]">Pilih Komunitas Passion-mu</h2><p class="mt-4 max-w-2xl text-sm font-semibold text-[#6b7f91]">Wadah bagi siswa untuk mengeksplorasi hobi, mengasah skill, dan membangun jaringan pertemanan.</p></div>
                <div class="flex gap-3"><button class="pager"><</button><button class="pager active">></button></div>
            </div>
            <div class="mt-12 grid gap-7 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([['basketball-real', 'Smanza Basketball', 'Mengasah teknik, fisik, dan mental juara.'], ['band-real', 'Symphony Band', 'Wadah ekspresi musikalitas modern.'], ['robotics-real', 'Robotics & IoT', 'Berinovasi dengan teknologi masa depan.'], ['dance-real', 'Seni Tari Batak', 'Melestarikan kekayaan budaya lokal.']] as $club)
                    <article class="club-card"><div class="illustration {{ $club[0] }}"></div><h3>{{ $club[1] }}</h3><p>{{ $club[2] }}</p><a href="#">Bergabung</a></article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-[#071f3a] py-20 text-white">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 lg:grid-cols-[1fr_0.95fr] lg:items-center lg:px-8">
            <div>
                <p class="eyebrow">Akreditasi Karakter</p>
                <h2 class="mt-3 text-4xl font-black">Kurikulum Pembinaan Karakter Terpadu</h2>
                <div class="mt-10 grid gap-7">
                    @foreach ([['Latihan Dasar Kepemimpinan (LDK)', 'Pelatihan intensif tahunan bagi pengurus organisasi untuk membentuk karakter leader.'], ['Social Awareness Project', 'Program pengabdian masyarakat untuk menumbuhkan empati dan solidaritas.']] as $program)
                        <div class="partner-line text-white"><span></span><div><strong>{{ $program[0] }}</strong><p class="text-white/58">{{ $program[1] }}</p></div></div>
                    @endforeach
                </div>
            </div>
            <div class="character-collage"></div>
        </div>
    </section>

    <section class="bg-white px-4 py-20 lg:px-8">
        <div class="rounded-[2rem] border-t-4 border-[#d6a63a] bg-[#f6f9fc] p-8 shadow-xl shadow-[#071f3a]/5 sm:p-12 lg:p-16">
            <div class="mx-auto flex max-w-6xl flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 class="text-4xl font-black leading-tight text-[#071f3a]">Siap Menorehkan Prestasi Bersama Kami?</h2>
                    <p class="mt-5 max-w-2xl text-sm font-semibold leading-7 text-[#6b7f91]">Jelajahi lebih jauh pencapaian siswa kami atau ikuti kabar terbaru dari lingkungan sekolah yang penuh semangat.</p>
                </div>
                <div class="flex flex-col gap-4 sm:flex-row">
                    <a href="{{ route('prestasi') }}" class="rounded-full bg-[#071f3a] px-8 py-4 text-sm font-black text-white">Lihat Prestasi</a>
                    <a href="{{ route('berita.index') }}" class="rounded-full bg-white px-8 py-4 text-sm font-black text-[#071f3a] ring-1 ring-[#dfe8ef]">Baca Berita</a>
                </div>
            </div>
        </div>
    </section>
@endsection
