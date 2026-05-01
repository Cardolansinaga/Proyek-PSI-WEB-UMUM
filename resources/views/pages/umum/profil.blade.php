@extends('layouts.site', ['active' => 'profil'])

@section('title', 'Profil Sekolah - SMAN 2 Balige')
@section('description', 'Profil SMAN 2 Balige, sejarah, visi misi, fasilitas, dan struktur organisasi sekolah.')

@section('content')
    <section class="school-hero hero-profile">
        <div class="hero-shade"></div>
        <div class="mx-auto grid min-h-[540px] max-w-7xl items-center px-4 py-20 lg:px-8">
            <div class="relative max-w-3xl">
                <span class="section-pill">Tentang Kami</span>
                <h1 class="mt-7 text-5xl font-black leading-[0.98] text-white sm:text-6xl lg:text-7xl">
                    Profil <span class="text-[#d6a63a]">Sekolah</span>
                </h1>
                <p class="mt-7 max-w-2xl text-base font-semibold leading-8 text-white/78">
                    Membentuk generasi unggul, berkarakter, dan siap bersaing di era global melalui pendidikan berkualitas tinggi yang berlandaskan integritas.
                </p>
            </div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 lg:grid-cols-[1fr_0.92fr] lg:items-center lg:px-8">
            <div>
                <p class="eyebrow">Sekilas Mengenai</p>
                <h2 class="mt-3 text-4xl font-black leading-tight text-[#071f3a]">SMAN 2 <span class="text-[#d6a63a]">Balige</span></h2>
                <p class="mt-7 max-w-2xl text-sm font-semibold leading-7 text-[#6b7f91]">
                    SMAN 2 Balige berdiri sebagai lembaga pendidikan yang memadukan keteguhan tradisi, disiplin, dan pendekatan pembelajaran modern. Setiap siswa didampingi untuk tumbuh sebagai pribadi yang cerdas, santun, dan kompetitif.
                </p>
                <p class="mt-5 max-w-2xl text-sm font-semibold leading-7 text-[#6b7f91]">
                    Sejak berdiri, sekolah ini konsisten menorehkan prestasi akademik maupun non-akademik di tingkat regional, nasional, dan internasional.
                </p>
                <a href="#sejarah" class="mt-8 inline-flex text-sm font-black text-[#071f3a]">Pelajari Selengkapnya -></a>
            </div>
            <div class="grid gap-5 sm:grid-cols-2">
                @foreach ([['1990', 'Tahun Berdiri'], ['A+', 'Akreditasi'], ['800+', 'Siswa Aktif'], ['50+', 'Tenaga Pendidik']] as $stat)
                    <div class="profile-stat {{ $loop->index === 1 ? 'dark' : '' }}"><strong>{{ $stat[0] }}</strong><span>{{ $stat[1] }}</span></div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="sejarah" class="bg-[#f6f9fc] py-20 sm:py-24">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 lg:grid-cols-[0.86fr_1.1fr] lg:items-center lg:px-8">
            <div class="campus-photo historic"></div>
            <div>
                <p class="eyebrow">Timeline</p>
                <h2 class="mt-3 text-4xl font-black text-[#071f3a]">Jejak Langkah & Sejarah</h2>
                <div class="mt-10 space-y-7">
                    @foreach ([['Masa Pembentukan (1990)', 'Berawal dari semangat menghadirkan sekolah unggulan untuk masyarakat Balige.'], ['Era Transformasi Digital (2015)', 'Penguatan pembelajaran berbasis teknologi dan akses literasi modern.'], ['Masa Kini (2024)', 'Menghadirkan kurikulum Merdeka, pembinaan karakter, dan program prestasi terpadu.']] as $item)
                        <div class="timeline-row"><span></span><div><h3>{{ $item[0] }}</h3><p>{{ $item[1] }}</p></div></div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="text-4xl font-black text-[#071f3a]">Visi & Misi</h2>
                <p class="mt-5 text-sm font-semibold leading-7 text-[#6b7f91]">Panduan fundamental sekolah dalam mencetak generasi berprestasi.</p>
            </div>
            <div class="mt-14 grid gap-6 lg:grid-cols-[1.35fr_0.75fr]">
                <article class="rounded-2xl bg-[#071f3a] p-8 text-white shadow-2xl shadow-[#071f3a]/18">
                    <span class="round-icon bg-white/10 text-[#d6a63a]">V</span>
                    <h3 class="mt-8 text-2xl font-black">Visi Utama</h3>
                    <p class="mt-5 text-lg font-semibold italic leading-8 text-white/76">Terwujudnya insan pendidikan yang bertaqwa, cerdas, terampil, kompetitif, dan berwawasan lingkungan dalam kancah global yang dinamis.</p>
                </article>
                <article class="rounded-2xl bg-[#bd9140] p-8 text-white shadow-xl shadow-[#bd9140]/20">
                    <h3 class="text-xl font-black">Nilai Inti</h3>
                    <ul class="mt-7 grid gap-4 text-xs font-black uppercase tracking-[0.16em] text-white/85">
                        <li>Disiplin</li><li>Tanggung Jawab</li><li>Berkarakter</li><li>Visioner</li>
                    </ul>
                </article>
            </div>
            <div class="mt-6 grid gap-6 md:grid-cols-3">
                @foreach ([['01', 'Kualitas Akademik'], ['02', 'Pembangunan Karakter'], ['03', 'Inovasi Berkelanjutan']] as $mission)
                    <article class="soft-card"><span>{{ $mission[0] }}</span><h3>{{ $mission[1] }}</h3><p>Menguatkan fondasi siswa melalui layanan pembelajaran yang terukur, humanis, dan relevan.</p></article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-[#071f3a] py-20 text-white">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 lg:grid-cols-[0.72fr_1fr] lg:items-center lg:px-8">
            <div class="principal-photo"></div>
            <div>
                <p class="section-pill">Sambutan Kepala Sekolah</p>
                <h2 class="mt-6 text-4xl font-black">Drs. Horas Balige, M.Pd.</h2>
                <p class="mt-6 max-w-3xl text-lg font-semibold italic leading-9 text-white/68">Pendidikan adalah kunci pembuka pintu masa depan. Di SMAN 2 Balige, kami berkomitmen untuk tidak hanya mengajar, tetapi menginspirasi setiap jiwa untuk menemukan potensi terbaik mereka.</p>
                <a href="{{ route('guru') }}" class="gold-button mt-8">Baca Profil Lengkap</a>
            </div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div><p class="eyebrow">Lingkungan Belajar</p><h2 class="mt-3 text-4xl font-black text-[#071f3a]">Fasilitas Unggulan</h2></div>
                <a href="{{ route('galeri') }}" class="text-sm font-black text-[#071f3a]">Lihat Semua Fasilitas</a>
            </div>
            <div class="facility-mosaic mt-10">
                <div class="facility-tile big library-real"><span>Perpustakaan Digital Terintegrasi</span></div>
                <div class="facility-tile lab-real"><span>Lab. Sains Modern</span></div>
                <div class="facility-tile gym-real"><span>Gedung Olahraga Multi-Fungsi</span></div>
            </div>
        </div>
    </section>

    <section class="bg-[#f6f9fc] py-20 sm:py-24">
        <div class="mx-auto max-w-6xl px-4 text-center lg:px-8">
            <h2 class="text-4xl font-black text-[#071f3a]">Struktur Organisasi</h2>
            <div class="org-chart mt-14">
                <div class="org-node top">Kepala Sekolah<span>Drs. Horas Balige, M.Pd.</span></div>
                <div class="org-line"></div>
                <div class="grid gap-5 md:grid-cols-4">
                    @foreach (['Waka Kurikulum', 'Waka Kesiswaan', 'Waka Sarpras', 'Waka Humas'] as $role)
                        <div class="org-node">{{ $role }}<span>Koordinator Program</span></div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white px-4 py-20 lg:px-8">
        <div class="cta-panel">
            <h2>Mulai Perjalanan Akademik Anda Bersama Kami</h2>
            <p>Jadilah bagian dari komunitas pembelajar yang berdedikasi tinggi untuk meraih masa depan yang gemilang di kancah global.</p>
            <div class="mt-10 flex flex-col justify-center gap-4 sm:flex-row">
                <a href="{{ route('ppdb') }}" class="gold-button">Daftar PPDB Online</a>
                <a href="{{ route('prestasi') }}" class="ghost-button">Lihat Prestasi Siswa</a>
            </div>
        </div>
    </section>
@endsection
