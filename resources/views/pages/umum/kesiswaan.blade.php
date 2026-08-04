@extends('layouts.site', ['active' => 'kesiswaan'])

@section('title', 'Kesiswaan & Ekstrakurikuler - SMAN 2 Balige')
@section('canonical', route('kesiswaan'))
@section('description', 'Kesiswaan, OSIS, MPK, ekstrakurikuler, dan pembinaan karakter SMAN 2 Balige.')

@php
    $hasCustomKesiswaanHero = ! empty($settings['kesiswaan_hero_image']);
    $kesiswaanHeroImage = $hasCustomKesiswaanHero ? asset('storage/'.$settings['kesiswaan_hero_image']) : null;
@endphp

@push('head')
    @if($hasCustomKesiswaanHero)
        <link rel="preload" as="image" href="{{ $kesiswaanHeroImage }}" fetchpriority="high">
    @endif
@endpush

@section('content')
    @php
        $decodeList = function (string $key, array $fallback = []) use ($settings): array {
            $decoded = json_decode($settings[$key] ?? '', true);

            return is_array($decoded) ? $decoded : $fallback;
        };
        $characterPrograms = $decodeList('student_character_json');
        $faqs = $decodeList('student_faq_json');
    @endphp
    <section
        class="school-hero hero-kesiswaan relative overflow-hidden {{ $hasCustomKesiswaanHero ? 'has-custom-photo' : 'default-school-hero' }}"
        @if($hasCustomKesiswaanHero)
            style="background-image: linear-gradient(90deg, rgb(11 42 68 / 0.92), rgb(11 42 68 / 0.62)), url('{{ $kesiswaanHeroImage }}') !important;"
        @else
            style="background-color: #12324d !important; background-image: none !important;"
        @endif
    >
        <div class="hero-shade"></div>
        <div class="mx-auto grid min-h-[520px] max-w-7xl items-center px-4 py-20 lg:px-8 relative z-10">
            <div class="relative max-w-3xl text-white">
                <span class="section-pill">{{ $settings['student_hero_badge'] ?? 'Kegiatan Siswa' }}</span>
                <h1 class="mt-7 text-5xl font-black leading-[0.98] text-white sm:text-5xl lg:text-6xl">
                    {{ $settings['student_hero_title'] ?? 'Kesiswaan' }} <span>{{ $settings['student_hero_highlight'] ?? '& Ekstrakurikuler' }}</span>
                </h1>
                <p class="mt-6 max-w-2xl text-base font-semibold leading-7 text-white/80">{{ $settings['student_hero_subtitle'] ?? 'Informasi organisasi siswa, kegiatan sekolah, pembinaan karakter, dan pilihan ekstrakurikuler.' }}</p>
                <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                    <a href="#organisasi" class="gold-button">Organisasi Siswa</a>
                    <a href="#ekskul" class="ghost-button">Ekstrakurikuler</a>
                </div>
            </div>
        </div>
    </section>

    <section id="organisasi" class="student-organization-section bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="eyebrow">Organisasi Siswa</p>
                    <h2 class="mt-3 text-4xl font-black text-[#071f3a]">{{ $settings['student_org_title'] ?? 'Organisasi dan Kegiatan Siswa' }}</h2>
                    <p class="mt-4 max-w-2xl text-sm font-semibold text-[#6b7f91]">{{ $settings['student_org_description'] ?? 'Informasi OSIS, MPK, dan kegiatan siswa yang berlangsung di lingkungan sekolah.' }}</p>
                </div>
                <a href="{{ route('home') }}#berita" class="outline-button hover:scale-105 transition-transform hover:shadow-lg"><i class="bi bi-newspaper" aria-hidden="true"></i>Lihat Berita Terbaru</a>
            </div>

            <div class="mt-10 grid gap-6 lg:grid-cols-3">
                @foreach ($organizations as $item)
                    <article class="info-card hover-lift group">
                        @php($organizationImage = ! empty($item->image_path) ? asset('storage/'.$item->image_path) : null)
                        <div class="activity-media {{ $organizationImage ? '' : 'media-placeholder' }}" @if($organizationImage) style="background-image: linear-gradient(180deg, rgb(7 31 58 / .04), rgb(7 31 58 / .22)), url('{{ $organizationImage }}') !important;" @endif>
                            @unless($organizationImage)<span><i class="bi bi-image" aria-hidden="true"></i> Foto belum tersedia</span>@endunless
                        </div>
                        <span class="round-icon"><i class="bi {{ $item->image_class ?? 'bi-people-fill' }}"></i></span>
                        <h3 class="group-hover:text-[#19a99a] transition-colors">{{ $item->name }}</h3>
                        <p>{{ $item->description }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="student-character-section bg-gradient-to-r from-[#071f3a] to-[#0f2847] py-20 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-[#19a99a] rounded-full filter blur-3xl"></div>
        </div>
        <div class="mx-auto max-w-7xl px-4 lg:px-8 relative z-10">
            <div class="mx-auto max-w-3xl text-center">
                <p class="eyebrow text-white/80">Program Pembinaan</p>
                <h2 class="mt-3 text-4xl font-black">{{ $settings['student_character_title'] ?? 'Pembinaan Karakter' }}</h2>
                <p class="mt-5 text-sm font-semibold leading-7 text-white/78">{{ $settings['student_character_description'] ?? 'Kegiatan pembinaan membantu siswa membangun disiplin, tanggung jawab, dan kemampuan bekerja sama.' }}</p>
            </div>
            <div class="mt-12 grid gap-6 md:grid-cols-2">
                @foreach ($characterPrograms as $program)
                    <div class="student-character-card bg-white/10 backdrop-blur-sm rounded-2xl p-8 hover-lift group cursor-pointer">
                        <span class="round-icon bg-white/10 {{ ($program['accent'] ?? '') === 'gold' ? 'text-[#d6a63a]' : 'text-[#19a99a]' }}"><i class="bi {{ $program['icon'] ?? 'bi-person-raised-hand' }}" aria-hidden="true"></i></span>
                        <h3 class="text-xl font-black transition-colors">{{ $program['title'] ?? '' }}</h3>
                        <p class="mt-3 text-sm text-white/80">{{ $program['description'] ?? '' }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="ekskul" class="student-clubs-section bg-gradient-to-b from-white to-[#f6f9fc] py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <p class="eyebrow">Pengembangan Diri</p>
                <h2 class="mt-3 text-4xl font-black text-[#071f3a]">{{ $settings['student_clubs_title'] ?? 'Pilihan Ekstrakurikuler' }}</h2>
                <p class="mt-4 text-sm font-semibold text-[#6b7f91]">{{ $settings['student_clubs_description'] ?? 'Kegiatan ekstrakurikuler dapat diikuti siswa sesuai minat dan jadwal yang tersedia.' }}</p>
            </div>

            <div class="mt-12 grid gap-6 lg:grid-cols-3">
                @foreach ($clubs as $club)
                    <article class="club-card hover-lift group">
                        @php($clubImage = ! empty($club->image_path) ? asset('storage/'.$club->image_path) : null)
                        <div class="activity-media {{ $clubImage ? '' : 'media-placeholder' }}" @if($clubImage) style="background-image: linear-gradient(180deg, rgb(7 31 58 / .04), rgb(7 31 58 / .22)), url('{{ $clubImage }}') !important;" @endif>
                            @unless($clubImage)<span><i class="bi bi-image" aria-hidden="true"></i> Foto belum tersedia</span>@endunless
                        </div>
                        <span class="round-icon bg-gradient-to-br from-[#19a99a]/20 to-[#d6a63a]/20">
                            <i class="bi {{ $club->image_class ?? 'bi-stars' }}"></i>
                        </span>
                        <h3 class="group-hover:text-[#19a99a] transition-colors">{{ $club->name }}</h3>
                        <p class="text-sm">{{ $club->description }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="student-faq-section bg-[#f6f9fc] py-20">
        <div class="mx-auto max-w-4xl px-4 lg:px-8">
            <div class="rounded-2xl bg-gradient-to-r from-[#071f3a] to-[#0f2847] p-12 text-center text-white mb-12">
                <h2 class="text-3xl font-black">Pertanyaan Kesiswaan</h2>
                <p class="mt-4 text-white/80">Jawaban singkat mengenai kegiatan dan pendaftaran ekstrakurikuler.</p>
            </div>
            <div class="space-y-5">
                @foreach ($faqs as $faq)
                    <details class="faq-item group">
                        <summary class="cursor-pointer group-open:text-[#19a99a]">{{ $faq['question'] ?? '' }}</summary>
                        <p class="mt-3 text-[#6b7f91]">{{ $faq['answer'] ?? '' }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    <section class="student-cta-section bg-white px-4 py-20 lg:px-8">
        <div class="cta-panel">
            <h2>{{ $settings['student_cta_title'] ?? 'Informasi Kegiatan Siswa' }}</h2>
            <p>{{ $settings['student_cta_description'] ?? 'Hubungi bagian kesiswaan untuk menanyakan jadwal, pendaftaran, atau ketentuan kegiatan.' }}</p>
            <div class="mt-10 flex flex-col justify-center gap-4 sm:flex-row">
                <a href="{{ route('home') }}#kontak" class="gold-button hover:shadow-xl"><i class="bi bi-headset" aria-hidden="true"></i>Hubungi Bagian Kesiswaan</a>
                <a href="{{ route('home') }}#berita" class="ghost-button hover:bg-white/10"><i class="bi bi-newspaper" aria-hidden="true"></i>Lihat Berita Kegiatan</a>
            </div>
        </div>
    </section>
@endsection
