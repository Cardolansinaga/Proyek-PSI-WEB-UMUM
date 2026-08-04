@extends('layouts.site', ['active' => 'akademik'])

@section('title', 'Akademik & Prestasi - SMAN 2 Balige')
@section('canonical', route('akademik'))
@section('description', 'Program akademik, kurikulum, prestasi, kalender, layanan, dan fasilitas belajar SMAN 2 Balige.')

@php
    $hasCustomAkademikHero = ! empty($settings['akademik_hero_image']);
    $akademikHeroImage = $hasCustomAkademikHero ? asset('storage/'.$settings['akademik_hero_image']) : null;
@endphp

@push('head')
    @if($hasCustomAkademikHero)
        <link rel="preload" as="image" href="{{ $akademikHeroImage }}" fetchpriority="high">
    @endif
@endpush

@section('content')
    @php
        $decodeList = function (string $key, array $fallback = []) use ($settings): array {
            $decoded = json_decode($settings[$key] ?? '', true);

            return is_array($decoded) ? $decoded : $fallback;
        };
        $resolveImageUrl = function (?string $value): ?string {
            $candidate = trim((string) $value);
            if ($candidate === '') {
                return null;
            }

            if (str_starts_with($candidate, 'http://') || str_starts_with($candidate, 'https://')) {
                return $candidate;
            }

            if (str_starts_with($candidate, '/')) {
                return asset(ltrim($candidate, '/'));
            }

            return asset('storage/'.$candidate);
        };
        $programs = $decodeList('academic_programs_json');
        $calendarItems = $decodeList('academic_calendar_json');
        $services = $decodeList('academic_services_json');
        $facilities = $decodeList('academic_facilities_json');
        $faqs = $decodeList('academic_faq_json');
    @endphp
    <section
        class="school-hero hero-academic relative overflow-hidden {{ $hasCustomAkademikHero ? 'has-custom-photo' : 'default-school-hero' }}"
        @if($hasCustomAkademikHero)
            style="background-image: linear-gradient(90deg, rgb(11 42 68 / 0.92), rgb(11 42 68 / 0.62)), url('{{ $akademikHeroImage }}') !important;"
        @else
            style="background-color: #12324d !important; background-image: none !important;"
        @endif
    >
        <div class="hero-shade"></div>
        <div class="mx-auto grid min-h-[560px] max-w-7xl items-center px-4 py-20 lg:px-8 relative z-10">
            <div class="relative max-w-3xl">
                <span class="section-pill">{{ $settings['academic_hero_badge'] ?? 'Informasi Akademik' }}</span>
                <h1 class="mt-7 text-5xl font-black leading-[0.98] text-white sm:text-6xl lg:text-7xl">
                    {{ $settings['academic_hero_title'] ?? 'Akademik' }} <span>{{ $settings['academic_hero_highlight'] ?? '& Prestasi' }}</span>
                </h1>
                <p class="mt-7 max-w-2xl text-base font-semibold leading-8 text-white/78">{{ $settings['academic_hero_subtitle'] ?? 'Informasi mengenai kurikulum, layanan akademik, kalender pendidikan, fasilitas belajar, dan prestasi siswa.' }}</p>
                <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                    <a href="#kurikulum" class="gold-button">Program Akademik</a>
                    <a href="#prestasi" class="ghost-button">Prestasi Siswa</a>
                </div>
            </div>
        </div>
    </section>

    <section class="academic-intro-section bg-white py-20 sm:py-24">
        <div class="mx-auto grid max-w-7xl gap-14 px-4 lg:grid-cols-[1fr_0.95fr] lg:items-center lg:px-8">
            <div>
                <p class="eyebrow">Pembelajaran</p>
                <h2 class="mt-6 text-4xl font-black leading-tight text-[#071f3a]">{{ $settings['academic_intro_title'] ?? 'Pembelajaran di SMAN 2 Balige' }}</h2>
                <p class="mt-7 max-w-2xl text-sm font-semibold leading-7 text-[#6b7f91]">{{ $settings['academic_intro_body'] ?? 'Kegiatan akademik dilaksanakan melalui pembelajaran di kelas, penugasan, evaluasi berkala, dan pendampingan sesuai kebutuhan siswa.' }}</p>
                <ul class="academic-intro-list">
                    <li>Pembelajaran sesuai kurikulum yang berlaku</li>
                    <li>Pendampingan akademik dan pengembangan minat</li>
                    <li>Evaluasi hasil belajar secara berkala</li>
                </ul>
            </div>
            <div class="academic-intro-note">
                <p class="eyebrow">Informasi untuk siswa</p>
                <h3>Kalender dan layanan akademik</h3>
                <p>Jadwal kegiatan serta layanan administrasi akademik dapat dilihat pada bagian berikutnya.</p>
                <a href="#portal-akademik" class="text-link">Lihat layanan akademik <i class="bi bi-arrow-right" aria-hidden="true"></i></a>
            </div>
        </div>
    </section>

    <section id="kurikulum" class="academic-curriculum-section bg-gradient-to-b from-[#f6f9fc] to-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <p class="eyebrow">Struktur & Program Akademik</p>
                <h2 class="mt-3 text-4xl font-black text-[#071f3a]">{{ $settings['academic_curriculum_title'] ?? 'Program Akademik' }}</h2>
                <p class="mt-5 text-sm font-semibold leading-7 text-[#6b7f91]">{{ $settings['academic_curriculum_description'] ?? 'Program pembelajaran dan pendampingan akademik yang tersedia bagi siswa SMAN 2 Balige.' }}</p>
            </div>
            <div class="academic-grid mt-12">
                @foreach ($programs as $program)
                    <article class="program-card {{ $program['variant'] ?? '' }} hover-lift group">
                        <span class="round-icon group-hover:scale-125 transition-transform"><i class="bi {{ $program['icon'] ?? 'bi-journal-bookmark' }}"></i></span>
                        <h3>{{ $program['title'] ?? '' }}</h3>
                        <p>{{ $program['description'] ?? '' }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="academic-calendar-section bg-white py-20 sm:py-24 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-[#d6a63a] rounded-full opacity-5 -mr-48 -mt-48"></div>
        <div class="mx-auto grid max-w-7xl gap-12 px-4 lg:grid-cols-[1fr_0.92fr] lg:px-8 relative z-10">
            <div>
                <p class="eyebrow text-left">Kalender Akademik <span class="text-[#d6a63a] font-black">{{ $settings['academic_calendar_year'] ?? '2026/2027' }}</span></p>
                <h2 class="academic-calendar-title mt-4 text-3xl font-black leading-tight text-[#071f3a] sm:text-4xl">Agenda Akademik Terdekat</h2>
                <p class="academic-calendar-copy mt-3 max-w-2xl text-sm font-semibold leading-7 text-[#526b80]">Tanggal penting ditampilkan ringkas agar siswa dan orang tua mudah mengikuti ritme pembelajaran semester berjalan.</p>
                <div class="mt-8 grid gap-5">
                    @foreach ($calendarItems as $event)
                        <article class="calendar-card hover-lift group">
                            <span class="font-black text-[#d6a63a] text-lg group-hover:text-2xl transition-all">{{ $event['date'] ?? '' }}</span>
                            <div>
                                <h3 class="font-black text-[#071f3a] group-hover:text-[#d6a63a] transition-colors">{{ $event['title'] ?? '' }}</h3>
                                <p class="text-xs text-[#8ca0b0]">{{ $event['description'] ?? '' }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
                <a href="{{ route('home') }}#kontak" class="final-link mt-8 group">
                    <i class="bi bi-chat-dots" aria-hidden="true"></i><span class="group-hover:translate-x-2 transition-transform inline-block">Tanya Bagian Kurikulum</span>
                </a>
            </div>
            <aside id="portal-akademik" class="rounded-[1.6rem] bg-gradient-to-br from-[#071f3a] to-[#0f2847] p-8 text-white shadow-2xl shadow-[#071f3a]/30 hover-lift">
                <h3 class="text-2xl font-black">Layanan Akademik</h3>
                <p class="mt-2 text-xs text-white/60">Dukungan penuh untuk perjalanan akademik Anda</p>
                <div class="mt-8 grid gap-4 sm:grid-cols-2">
                    @foreach ($services as $service)
                        <div class="service-tile group hover:bg-white/10 cursor-pointer">
                            <i class="bi {{ $service['icon'] ?? 'bi-file-earmark-check' }} text-[#d6a63a]" aria-hidden="true"></i>
                            <strong class="group-hover:text-[#d6a63a] transition-colors">{{ $service['title'] ?? '' }}</strong>
                            <p class="text-xs text-white/70">{{ $service['description'] ?? '' }}</p>
                        </div>
                    @endforeach
                </div>
            </aside>
        </div>
    </section>

    <section class="academic-facilities-section bg-gradient-to-b from-[#071f3a] to-[#0f2847] py-20 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-[#d6a63a] rounded-full filter blur-3xl"></div>
        </div>
        <div class="mx-auto max-w-7xl px-4 lg:px-8 relative z-10">
            <div class="mx-auto max-w-3xl text-center">
                <p class="eyebrow text-white/80">Infrastruktur & Fasilitas</p>
                <h2 class="mt-3 text-4xl font-black">Fasilitas Pembelajaran</h2>
                <p class="mt-5 text-sm font-semibold leading-7 text-white/78">Ruang dan fasilitas yang mendukung kegiatan belajar siswa.</p>
            </div>
            <div class="facility-mosaic mt-12">
                @foreach ($facilities as $facility)
                    @php($facilityImage = $resolveImageUrl($facility['image'] ?? null))
                    <div
                        class="facility-tile {{ $facility['class'] ?? 'classroom-real' }} group hover-lift"
                        @if($facilityImage)
                            style="background-image: linear-gradient(180deg, rgb(7 31 58 / .10), rgb(7 31 58 / .42)), url('{{ $facilityImage }}') !important;"
                        @endif
                    >
                        <span>{{ $facility['title'] ?? '' }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="prestasi" class="academic-achievement-section bg-gradient-to-b from-white to-[#f6f9fc] py-20 sm:py-24">
        @php($featuredAchievement = $achievements->firstWhere('is_featured', true) ?? $achievements->first())
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="eyebrow">Budaya Prestasi</p>
                    <h2 class="mt-3 text-4xl font-black text-[#071f3a] sm:text-5xl">Prestasi Siswa</h2>
                    <p class="mt-5 max-w-2xl text-sm font-semibold leading-7 text-[#6b7f91]">Catatan prestasi siswa dalam kegiatan akademik dan nonakademik.</p>
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
                        <h3 class="mt-8 text-3xl font-black text-[#071f3a]">{{ $featuredAchievement->title }}</h3>
                        <p class="mt-5 text-sm font-semibold leading-7 text-[#6b7f91]">{{ $featuredAchievement->description }}</p>
                        <div class="mt-8 rounded-2xl bg-gradient-to-r from-[#f6f9fc] to-[#e8f0f6] p-5 text-sm font-black text-[#071f3a] border-l-4 border-[#d6a63a]">{{ $featuredAchievement->student_name ?? 'Tim Sekolah' }} <span class="block pt-1 text-xs font-bold text-[#8ca0b0]">{{ $featuredAchievement->class_name ?? $featuredAchievement->competition }}</span></div>
                        <a href="{{ route('home') }}#berita" class="mt-8 inline-flex w-full items-center justify-center gap-2 rounded-full bg-gradient-to-r from-[#071f3a] to-[#0f2847] px-7 py-4 text-sm font-black text-white hover:shadow-xl hover:shadow-[#071f3a]/30 transition-shadow">Lihat Berita Sekolah <i class="bi bi-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </article>
            @endif

            <div class="mt-12 grid gap-8 md:grid-cols-3">
                @foreach ($achievements->where('id', '!=', optional($featuredAchievement)->id)->take(3) as $achievement)
                    <article class="achievement-card hover-lift group">
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

    <section class="academic-faq-section bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-4xl px-4 lg:px-8">
            <div class="rounded-2xl bg-gradient-to-r from-[#071f3a] to-[#0f2847] p-12 text-center text-white mb-12">
                <h2 class="text-3xl font-black">Pertanyaan Akademik</h2>
                <p class="mt-4 text-white/80">Jawaban singkat mengenai program dan layanan akademik sekolah.</p>
            </div>
            <div class="space-y-5">
                @foreach ($faqs as $faq)
                    <details class="faq-item group">
                        <summary class="cursor-pointer group-open:text-[#d6a63a]">{{ $faq['question'] ?? '' }}</summary>
                        <p class="mt-3 text-[#6b7f91]">{{ $faq['answer'] ?? '' }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

@endsection
