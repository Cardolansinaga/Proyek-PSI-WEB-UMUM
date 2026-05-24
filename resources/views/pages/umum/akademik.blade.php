@extends('layouts.site', ['active' => 'akademik'])

@section('title', 'Akademik & Prestasi - SMAN 2 Balige')
@section('description', 'Program akademik, kurikulum, prestasi, kalender, layanan, dan fasilitas belajar SMAN 2 Balige.')

@section('content')
    @php($akademikHeroImage = ! empty($settings['akademik_hero_image']) ? asset('storage/'.$settings['akademik_hero_image']) : null)
    <section class="school-hero hero-academic relative overflow-hidden" @if($akademikHeroImage) style="background-image: linear-gradient(90deg, rgb(7 31 58 / 0.86), rgb(7 31 58 / 0.38)), url('{{ $akademikHeroImage }}') !important;" @endif>
        <div class="hero-shade"></div>
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-20 left-10 w-72 h-72 bg-[#d6a63a] rounded-full mix-blend-multiply filter blur-3xl animate-pulse-glow"></div>
            <div class="absolute bottom-20 right-10 w-72 h-72 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl animate-pulse-glow animation-delay-2"></div>
        </div>
        <div class="mx-auto grid min-h-[560px] max-w-7xl items-center px-4 py-20 lg:px-8 relative z-10">
            <div class="relative max-w-3xl animate-fade-in-up">
                <span class="section-pill animate-fade-in" style="animation-delay: 0.1s;">Keunggulan Akademik & Prestasi</span>
                <h1 class="mt-7 text-5xl font-black leading-[0.98] text-white sm:text-6xl lg:text-7xl animate-fade-in-up" style="animation-delay: 0.2s;">
                    Membentuk Intelek <span class="text-[#d6a63a] drop-shadow-lg">Berprestasi Unggul</span>
                </h1>
                <p class="mt-7 max-w-2xl text-base font-semibold leading-8 text-white/78 animate-fade-in-up" style="animation-delay: 0.3s;">Ekosistem belajar yang kompetitif, suportif, dan terukur untuk menumbuhkan karakter, disiplin, serta budaya juara.</p>
                <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                    <a href="#portal-akademik" class="gold-button transition-smooth hover:shadow-2xl hover:shadow-[#d6a63a]/50 hover:scale-105" style="animation-delay: 0.4s;">Layanan Akademik</a>
                    <a href="#prestasi" class="ghost-button transition-smooth hover:bg-white/20 hover:scale-105" style="animation-delay: 0.5s;">Lihat Prestasi</a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto grid max-w-7xl gap-14 px-4 lg:grid-cols-[1fr_0.95fr] lg:items-center lg:px-8">
            <div>
                <div class="h-1 w-16 rounded-full bg-gradient-to-r from-[#d6a63a] to-[#f0d97d] animate-pulse-glow"></div>
                <h2 class="mt-6 text-4xl font-black leading-tight text-[#071f3a] animate-fade-in-up">Komitmen Terhadap Integritas Akademik</h2>
                <p class="mt-7 max-w-2xl text-sm font-semibold leading-7 text-[#6b7f91] animate-fade-in-up" style="animation-delay: 0.1s;">Di SMAN 2 Balige, kami percaya bahwa pendidikan bukan sekadar transfer pengetahuan, melainkan pembentukan pola pikir kritis dan etos kerja yang tinggi.</p>
                <div class="mt-10 grid max-w-md grid-cols-2 gap-8">
                    <div class="big-stat hover-lift"><strong class="text-3xl text-[#d6a63a]">98%</strong><span>Lulusan di PTN Favorit</span></div>
                    <div class="big-stat hover-lift"><strong class="text-3xl text-[#19a99a]">1:20</strong><span>Rasio Guru & Siswa</span></div>
                </div>
            </div>
            <div class="academic-portrait relative">
                <div class="absolute inset-0 rounded-3xl bg-gradient-to-br from-[#d6a63a]/10 to-[#19a99a]/10 animate-pulse"></div>
                <div class="floating-quote animate-float">Standar akademik di sini melatih saya untuk tidak hanya pintar, tapi juga tangguh menghadapi tantangan global.</div>
            </div>
        </div>
    </section>

    <section id="kurikulum" class="bg-gradient-to-b from-[#f6f9fc] to-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <p class="eyebrow">Struktur & Program Akademik</p>
                <h2 class="mt-3 text-4xl font-black text-[#071f3a] animate-fade-in-up">Kurikulum Adaptif dan Terukur</h2>
                <p class="mt-5 text-sm font-semibold leading-7 text-[#6b7f91] animate-fade-in-up" style="animation-delay: 0.1s;">Kurikulum Merdeka dipadukan dengan program pengayaan khusus olimpiade dan riset ilmiah.</p>
            </div>
            <div class="academic-grid mt-12">
                <article class="program-card wide hover-lift animate-fade-in-up stagger-1 group">
                    <span class="round-icon group-hover:rotate-360 transition-transform duration-700"><i class="bi bi-journal-bookmark"></i></span>
                    <h3>Kurikulum Merdeka Plus</h3>
                    <p>Fleksibilitas pembelajaran berbasis proyek, penguatan literasi, numerasi, karakter, dan pemetaan minat siswa.</p>
                </article>
                <article class="program-card dark hover-lift animate-fade-in-up stagger-2 group">
                    <span class="round-icon bg-white/10 text-[#d6a63a] group-hover:scale-125 transition-transform"><i class="bi bi-flask"></i></span>
                    <h3>Riset & Karya Ilmiah</h3>
                    <p>Pembimbingan riset terjadwal agar siswa terbiasa berpikir metodologis dan berani mengikuti kompetisi.</p>
                </article>
                <article class="program-card gold hover-lift animate-fade-in-up stagger-3 group">
                    <span class="round-icon group-hover:rotate-360 transition-transform duration-700"><i class="bi bi-translate"></i></span>
                    <h3>English Mastery</h3>
                    <p>Penguatan bahasa Inggris akademik untuk presentasi, lomba, dan persiapan studi lanjutan.</p>
                </article>
                <article class="program-card hover-lift animate-fade-in-up stagger-4 group">
                    <span class="round-icon group-hover:scale-125 transition-transform"><i class="bi bi-graph-up-arrow"></i></span>
                    <h3>Bimbingan Intensif PTN</h3>
                    <p>Simulasi UTBK, konsultasi jurusan, dan pemantauan progres belajar kelas XII secara berkala.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-[#d6a63a] rounded-full opacity-5 -mr-48 -mt-48"></div>
        <div class="mx-auto grid max-w-7xl gap-12 px-4 lg:grid-cols-[1fr_0.92fr] lg:px-8 relative z-10">
            <div>
                <p class="eyebrow text-left">Kalender Akademik <span class="text-[#d6a63a] font-black">2026/2027</span></p>
                <div class="mt-8 grid gap-5">
                    @foreach ([['13 Jul', 'Awal Semester Ganjil', 'Orientasi siswa baru dan pertemuan orang tua murid.'], ['05 Okt', 'Penilaian Tengah Semester', 'Evaluasi capaian belajar tiga bulan pertama.'], ['18 Des', 'Pembagian Rapor', 'Laporan perkembangan akademik semester 1.']] as $event)
                        <article class="calendar-card hover-lift group">
                            <span class="font-black text-[#d6a63a] text-lg group-hover:text-2xl transition-all">{{ $event[0] }}</span>
                            <div>
                                <h3 class="font-black text-[#071f3a] group-hover:text-[#d6a63a] transition-colors">{{ $event[1] }}</h3>
                                <p class="text-xs text-[#8ca0b0]">{{ $event[2] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
                <a href="{{ route('home') }}#kontak" class="final-link mt-8 group">
                    <span class="group-hover:translate-x-2 transition-transform inline-block">Tanya Bagian Kurikulum</span> <span class="group-hover:translate-x-1 transition-transform inline-block">-></span>
                </a>
            </div>
            <aside id="portal-akademik" class="rounded-[1.6rem] bg-gradient-to-br from-[#071f3a] to-[#0f2847] p-8 text-white shadow-2xl shadow-[#071f3a]/30 hover-lift">
                <h3 class="text-2xl font-black">Layanan Akademik</h3>
                <p class="mt-2 text-xs text-white/60">Dukungan penuh untuk perjalanan akademik Anda</p>
                <div class="mt-8 grid gap-4 sm:grid-cols-2">
                    @foreach (['Legalisir Ijazah', 'Surat Keterangan', 'Transkrip Nilai', 'Konseling Belajar'] as $service)
                        <div class="service-tile group hover:bg-white/10 cursor-pointer">
                            <strong class="group-hover:text-[#d6a63a] transition-colors">{{ $service }}</strong>
                            <p class="text-xs text-white/70">Layanan administrasi dan pendampingan siswa.</p>
                        </div>
                    @endforeach
                </div>
            </aside>
        </div>
    </section>

    <section class="bg-gradient-to-b from-[#071f3a] to-[#0f2847] py-20 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-[#d6a63a] rounded-full filter blur-3xl animate-pulse"></div>
        </div>
        <div class="mx-auto max-w-7xl px-4 lg:px-8 relative z-10">
            <div class="mx-auto max-w-3xl text-center">
                <p class="eyebrow text-white/80">Infrastruktur & Fasilitas</p>
                <h2 class="mt-3 text-4xl font-black animate-fade-in-up">Ruang Belajar Modern</h2>
                <p class="mt-5 text-sm font-semibold leading-7 text-white/78 animate-fade-in-up" style="animation-delay: 0.1s;">Dukungan teknologi modern untuk memastikan pembelajaran teoritis dapat dipraktikkan secara langsung.</p>
            </div>
            <div class="facility-mosaic mt-12">
                <div class="facility-tile science-lab group hover-lift"><span class="group-hover:translate-y-[-8px] transition-transform">Lab Kimia & Fisika Terpadu</span></div>
                <div class="facility-tile lab-real group hover-lift"><span class="group-hover:translate-y-[-8px] transition-transform">Lab Multimedia</span></div>
                <div class="facility-tile library-real group hover-lift"><span class="group-hover:translate-y-[-8px] transition-transform">Perpustakaan Digital</span></div>
                <div class="facility-tile classroom-real group hover-lift"><span class="group-hover:translate-y-[-8px] transition-transform">Smart Classroom</span></div>
            </div>
        </div>
    </section>

    <section id="prestasi" class="bg-gradient-to-b from-white to-[#f6f9fc] py-20 sm:py-24">
        @php($featuredAchievement = $achievements->firstWhere('is_featured', true) ?? $achievements->first())
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="eyebrow">Budaya Prestasi</p>
                    <h2 class="mt-3 text-4xl font-black text-[#071f3a] sm:text-5xl animate-fade-in-up">Prestasi Unggulan</h2>
                    <p class="mt-5 max-w-2xl text-sm font-semibold leading-7 text-[#6b7f91] animate-fade-in-up" style="animation-delay: 0.1s;">Prestasi menjadi bagian dari proses belajar harian melalui pembinaan akademik, seni, olahraga, dan kepemimpinan.</p>
                </div>
                <div class="grid grid-cols-2 gap-6 text-right">
                    <div class="big-stat"><strong class="text-3xl text-[#d6a63a] animate-count">{{ $achievements->count() }}+</strong><span>Prestasi Tercatat</span></div>
                    <div class="big-stat"><strong class="text-3xl text-[#19a99a] animate-count">{{ $achievements->where('level', 'Internasional')->count() }}</strong><span>Level Internasional</span></div>
                </div>
            </div>

            @if ($featuredAchievement)
                <article class="mt-10 grid overflow-hidden rounded-[1.6rem] bg-white shadow-2xl shadow-[#071f3a]/10 lg:grid-cols-[1fr_1fr] hover-lift">
                    @php($featuredImage = ! empty($featuredAchievement->image_path) ? asset('storage/'.$featuredAchievement->image_path) : null)
                    <div class="illustration {{ $featuredAchievement->image_class ?? 'victory' }} min-h-[360px] group-hover:scale-105 transition-transform duration-500" @if($featuredImage) style="background-image: linear-gradient(180deg, rgb(7 31 58 / .08), rgb(7 31 58 / .28)), url('{{ $featuredImage }}') !important;" @endif></div>
                    <div class="p-8 lg:p-12 flex flex-col justify-center">
                        <span class="rounded-full bg-emerald-50 px-4 py-2 text-[10px] font-black uppercase tracking-[0.14em] text-emerald-600 w-fit group-hover:bg-emerald-100 transition-colors">{{ $featuredAchievement->rank }} {{ $featuredAchievement->level }}</span>
                        <h3 class="mt-8 text-3xl font-black text-[#071f3a] animate-fade-in-up">{{ $featuredAchievement->title }}</h3>
                        <p class="mt-5 text-sm font-semibold leading-7 text-[#6b7f91]">{{ $featuredAchievement->description }}</p>
                        <div class="mt-8 rounded-2xl bg-gradient-to-r from-[#f6f9fc] to-[#e8f0f6] p-5 text-sm font-black text-[#071f3a] border-l-4 border-[#d6a63a]">{{ $featuredAchievement->student_name ?? 'Tim Sekolah' }} <span class="block pt-1 text-xs font-bold text-[#8ca0b0]">{{ $featuredAchievement->class_name ?? $featuredAchievement->competition }}</span></div>
                        <a href="{{ route('home') }}#berita" class="mt-8 inline-flex w-full justify-center rounded-full bg-gradient-to-r from-[#071f3a] to-[#0f2847] px-7 py-4 text-sm font-black text-white hover:shadow-xl hover:shadow-[#071f3a]/30 transition-shadow">Baca Kisah Lengkap -></a>
                    </div>
                </article>
            @endif

            <div class="mt-12 grid gap-8 md:grid-cols-3">
                @foreach ($achievements->where('id', '!=', optional($featuredAchievement)->id)->take(3) as $achievement)
                    <article class="achievement-card hover-lift animate-fade-in-up stagger-{{ $loop->index + 1 }} group">
                        @php($achievementImage = ! empty($achievement->image_path) ? asset('storage/'.$achievement->image_path) : null)
                        <div class="illustration {{ $achievement->image_class ?? 'speech' }} group-hover:scale-110 transition-transform duration-500" @if($achievementImage) style="background-image: linear-gradient(180deg, rgb(7 31 58 / .08), rgb(7 31 58 / .28)), url('{{ $achievementImage }}') !important;" @endif></div>
                        <h3 class="group-hover:text-[#d6a63a] transition-colors">{{ $achievement->title }}</h3>
                        <p>{{ $achievement->student_name ?? 'Tim Sekolah' }} - Tingkat {{ $achievement->level }}</p>
                        <span class="inline-block px-3 py-1 rounded-full bg-[#d6a63a]/10 text-[#d6a63a] text-xs font-bold group-hover:bg-[#d6a63a] group-hover:text-white transition-all">{{ $achievement->rank }}</span>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-4xl px-4 lg:px-8">
            <div class="rounded-2xl bg-gradient-to-r from-[#071f3a] to-[#0f2847] p-12 text-center text-white mb-12">
                <h2 class="text-3xl font-black animate-fade-in-up">Informasi Akademik & Prestasi</h2>
                <p class="mt-4 text-white/80 animate-fade-in-up" style="animation-delay: 0.1s;">Temukan jawaban atas pertanyaan seputar program akademik dan berbagai layanan yang tersedia.</p>
            </div>
            <div class="space-y-5">
                @foreach (['Apa saja syarat untuk mengikuti kelas pengayaan olimpiade?', 'Bagaimana sistem penilaian Kurikulum Merdeka di SMAN 2 Balige?', 'Apakah tersedia beasiswa prestasi akademik?'] as $question)
                    <details class="faq-item group">
                        <summary class="cursor-pointer group-open:text-[#d6a63a]">{{ $question }}</summary>
                        <p class="mt-3 text-[#6b7f91]">Informasi lengkap tersedia melalui wali kelas, bagian kurikulum, dan portal akademik sekolah.</p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-4xl px-4 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-black text-[#071f3a]">Butuh Bantuan Akademik?</h2>
                <p class="mt-4 text-sm font-semibold text-[#6b7f91]">Tim kurikulum dan bimbingan sekolah siap membantu perjalanan akademik Anda.</p>
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
        @php($featuredAchievement = $achievements->firstWhere('is_featured', true) ?? $achievements->first())
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="eyebrow">Budaya Prestasi</p>
                    <h2 class="mt-3 text-4xl font-black text-[#071f3a] sm:text-5xl">Prestasi Unggulan</h2>
                    <p class="mt-5 max-w-2xl text-sm font-semibold leading-7 text-[#6b7f91]">Prestasi menjadi bagian dari proses belajar harian melalui pembinaan akademik, seni, olahraga, dan kepemimpinan.</p>
                </div>
                <div class="grid grid-cols-2 gap-6 text-right">
                    <div class="big-stat"><strong>{{ $achievements->count() }}+</strong><span>Prestasi Tercatat</span></div>
                    <div class="big-stat"><strong>{{ $achievements->where('level', 'Internasional')->count() }}</strong><span>Level Internasional</span></div>
                </div>
            </div>

            @if ($featuredAchievement)
                <article class="mt-10 grid overflow-hidden rounded-[1.6rem] bg-white shadow-2xl shadow-[#071f3a]/10 lg:grid-cols-[1fr_1fr]">
                    @php($featuredImage = ! empty($featuredAchievement->image_path) ? asset('storage/'.$featuredAchievement->image_path) : null)
                    <div class="illustration {{ $featuredAchievement->image_class ?? 'victory' }} min-h-[360px]" @if($featuredImage) style="background-image: linear-gradient(180deg, rgb(7 31 58 / .08), rgb(7 31 58 / .28)), url('{{ $featuredImage }}') !important;" @endif></div>
                    <div class="p-8 lg:p-12">
                        <span class="rounded-full bg-emerald-50 px-4 py-2 text-[10px] font-black uppercase tracking-[0.14em] text-emerald-600">{{ $featuredAchievement->rank }} {{ $featuredAchievement->level }}</span>
                        <h3 class="mt-8 text-3xl font-black text-[#071f3a]">{{ $featuredAchievement->title }}</h3>
                        <p class="mt-5 text-sm font-semibold leading-7 text-[#6b7f91]">{{ $featuredAchievement->description }}</p>
                        <div class="mt-8 rounded-2xl bg-[#f6f9fc] p-5 text-sm font-black text-[#071f3a]">{{ $featuredAchievement->student_name ?? 'Tim Sekolah' }} <span class="block pt-1 text-xs font-bold text-[#8ca0b0]">{{ $featuredAchievement->class_name ?? $featuredAchievement->competition }}</span></div>
                        <a href="{{ route('home') }}#berita" class="mt-8 inline-flex w-full justify-center rounded-full bg-[#071f3a] px-7 py-4 text-sm font-black text-white">Baca Kisah Lengkap -></a>
                    </div>
                </article>
            @endif

            <div class="mt-12 grid gap-8 md:grid-cols-3">
                @foreach ($achievements->where('id', '!=', optional($featuredAchievement)->id)->take(3) as $achievement)
                    @php($achievementImage = ! empty($achievement->image_path) ? asset('storage/'.$achievement->image_path) : null)
                    <article class="achievement-card hover-lift animate-fade-in-up stagger-{{ $loop->index + 1 }}"><div class="illustration {{ $achievement->image_class ?? 'speech' }}" @if($achievementImage) style="background-image: linear-gradient(180deg, rgb(7 31 58 / .08), rgb(7 31 58 / .28)), url('{{ $achievementImage }}') !important;" @endif></div><h3>{{ $achievement->title }}</h3><p>{{ $achievement->student_name ?? 'Tim Sekolah' }} - Tingkat {{ $achievement->level }}</p><span>{{ $achievement->rank }}</span></article>
                @endforeach
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
