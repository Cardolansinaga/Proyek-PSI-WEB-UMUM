@extends('layouts.site', ['active' => 'guru'])

@section('title', 'Guru & Tenaga Kependidikan - SMAN 2 Balige')
@section('description', 'Profil guru, pimpinan sekolah, tenaga kependidikan, dan budaya kerja SMAN 2 Balige.')

@section('content')
    <section class="teacher-hero page-hero text-center">
        <div class="page-hero-overlay"></div>
        <div class="mx-auto max-w-7xl px-4 py-24 sm:py-32 lg:px-8">
            <div class="relative mx-auto max-w-5xl">
                <span class="section-pill">Sumber Daya Manusia</span>
                <h1 class="mt-7 text-5xl font-black leading-[1] text-white sm:text-6xl lg:text-7xl">Guru & Tenaga Kependidikan</h1>
                <p class="mx-auto mt-7 max-w-3xl text-base font-semibold leading-8 text-white/74">
                    Menghimpun tenaga pengajar profesional dan berdedikasi untuk membentuk masa depan generasi bangsa yang unggul dan berintegritas.
                </p>
            </div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto grid max-w-7xl gap-14 px-4 lg:grid-cols-[0.95fr_1fr] lg:items-center lg:px-8">
            <div>
                <h2 class="section-title">Mencetak Generasi Berkarakter Bersama Para Pendidik Terbaik</h2>
                <p class="mt-7 text-sm font-semibold leading-7 text-[#6b7f91]">
                    Di SMAN 2 Balige, kualitas pengajaran adalah prioritas utama. Kami memiliki jajaran pendidik yang tidak hanya ahli di bidangnya, tetapi juga memiliki integritas tinggi sebagai panutan bagi siswa.
                </p>
                <div class="mt-9 rounded-xl bg-[#f6f9fc] p-6">
                    <div class="partner-line text-[#071f3a]"><span>i</span><div><strong>Inovasi Pedagogik</strong><p class="text-[#6b7f91]">Penerapan kurikulum berbasis teknologi yang dipadukan dengan nilai budaya lokal Sumatera Utara.</p></div></div>
                </div>
            </div>
            <div class="teaching-visual"></div>
        </div>
    </section>

    <section class="bg-[#f6f9fc] py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 text-center lg:px-8">
            <p class="eyebrow">Kepemimpinan</p>
            <h2 class="mt-3 text-4xl font-black text-[#071f3a]">Struktur Pimpinan Sekolah</h2>
            <div class="mx-auto mt-6 h-1 w-16 rounded-full bg-[#d6a63a]"></div>
            <div class="mt-14 grid gap-8 md:grid-cols-3">
                <article class="leader-card"><div class="avatar male"></div><h3>Drs. J. Marpaung, M.Pd</h3><p>Kepala Sekolah</p></article>
                <article class="leader-card"><div class="avatar female"></div><h3>S. Simanjuntak, S.Pd</h3><p>Waka. Kurikulum</p></article>
                <article class="leader-card"><div class="avatar male alt"></div><h3>R. Hutapea, M.Si</h3><p>Waka. Kesiswaan</p></article>
            </div>
        </div>
    </section>

    <section id="direktori" class="bg-white py-20">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="eyebrow text-left">Direktori</p>
                    <h2 class="mt-3 text-3xl font-black text-[#071f3a] sm:text-4xl">Guru Mata Pelajaran</h2>
                </div>
                <div class="segmented">
                    <button>Semua</button><button>Sains</button><button>Bahasa</button><button>Seni</button>
                </div>
            </div>
            <div class="mt-12 grid gap-7 sm:grid-cols-2 lg:grid-cols-4">
                <article class="teacher-card teacher-a"><div></div><h3>Ani Siahaan, S.Pd</h3><p>Matematika & Kalkulus</p><a href="#">Profil Lengkap -></a></article>
                <article class="teacher-card teacher-b"><div></div><h3>Dr. David Pardede</h3><p>Fisika Terapan</p><a href="#">Profil Lengkap -></a></article>
                <article class="teacher-card teacher-c"><div></div><h3>M. Napitupulu, M.Hum</h3><p>Bahasa & Sastra</p><a href="#">Profil Lengkap -></a></article>
                <article class="teacher-card teacher-d"><div></div><h3>T. Siregar, S.Kom</h3><p>Informatika & TIK</p><a href="#">Profil Lengkap -></a></article>
            </div>
        </div>
    </section>

    <section class="bg-[#071f3a] py-20 text-center text-white">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <p class="eyebrow">Tim Pendukung</p>
            <h2 class="mt-3 text-4xl font-black">Tenaga Kependidikan</h2>
            <p class="mx-auto mt-5 max-w-2xl text-sm font-semibold leading-7 text-white/55">Pilar operasional yang memastikan seluruh aktivitas sekolah berjalan dengan prima setiap harinya.</p>
            <div class="mt-16 grid gap-10 sm:grid-cols-2 lg:grid-cols-4">
                <article class="staff-card"><div class="avatar female"></div><h3>H. Tobing</h3><p>Kepala Tata Usaha</p></article>
                <article class="staff-card"><div class="avatar male"></div><h3>B. Situmorang</h3><p>Pustakawan Utama</p></article>
                <article class="staff-card"><div class="avatar female alt"></div><h3>D. Tambunan</h3><p>Bendahara Sekolah</p></article>
                <article class="staff-card"><div class="avatar male alt"></div><h3>R. Pangaribuan</h3><p>Koordinator Laboran</p></article>
            </div>
        </div>
    </section>

    <section class="bg-white py-20">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 lg:grid-cols-[1.1fr_1fr] lg:items-center lg:px-8">
            <div>
                <h2 class="text-3xl font-black leading-tight text-[#071f3a] sm:text-4xl">Membangun Budaya Kerja Berbasis Keunggulan</h2>
                <p class="mt-6 text-sm font-semibold leading-7 text-[#6b7f91]">Komitmen kami tercermin dalam etos kerja harian yang menjunjung tinggi profesionalisme, kejujuran, dan semangat melayani.</p>
                <div class="mt-10 space-y-5">
                    <div class="value-line"><span></span>Integritas Akademik Tanpa Kompromi</div>
                    <div class="value-line"><span></span>Kolaborasi Antar Disiplin Ilmu</div>
                    <div class="value-line"><span></span>Inovasi Berkelanjutan di Ruang Kelas</div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="metric-card light"><strong>95%</strong><span>Sertifikasi Guru</span></div>
                <div class="metric-card dark"><strong>15+</strong><span>Inovasi Digital</span></div>
                <div class="metric-card dark"><strong>100%</strong><span>Kepuasan Siswa</span></div>
                <div class="metric-card light"><strong>30+</strong><span>Mitra Industri</span></div>
            </div>
        </div>
    </section>

    <section class="bg-[#f6f9fc] px-4 py-20 text-center lg:px-8">
        <h2 class="text-3xl font-black text-[#071f3a]">Siap Bergabung dengan Komunitas Belajar Kami?</h2>
        <div class="mt-9 flex flex-col justify-center gap-4 sm:flex-row">
            <a class="rounded-full bg-[#071f3a] px-8 py-4 text-sm font-black text-white shadow-xl shadow-[#071f3a]/15" href="{{ route('home') }}#akademik">Pelajari Kurikulum</a>
            <a class="rounded-full bg-white px-8 py-4 text-sm font-black text-[#071f3a] ring-1 ring-[#dfe8ef]" href="{{ route('kontak') }}">Hubungi Kami</a>
        </div>
    </section>
@endsection
