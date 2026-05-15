@extends('layouts.site', ['active' => 'kesiswaan'])

@section('title', 'Kesiswaan & Ekstrakurikuler - SMAN 2 Balige')
@section('description', 'Kesiswaan, OSIS, MPK, ekstrakurikuler, dan pembinaan karakter SMAN 2 Balige.')

@section('content')
    <section class="school-hero hero-kesiswaan">
        <div class="hero-shade"></div>
        <div class="mx-auto grid min-h-[520px] max-w-7xl items-center px-4 py-20 lg:px-8">
            <div class="relative max-w-3xl text-white animate-fade-in-up">
                <span class="section-pill animate-fade-in" style="animation-delay: 0.1s;">Ekosistem Kesiswaan</span>
                <h1 class="mt-7 text-5xl font-black leading-[0.98] text-white sm:text-5xl lg:text-6xl animate-fade-in-up" style="animation-delay: 0.2s;">Kesiswaan & Ekstrakurikuler SMAN 2 Balige</h1>
                <p class="mt-6 max-w-2xl text-base font-semibold leading-7 text-white/80 animate-fade-in-up" style="animation-delay: 0.3s;">Informasi kegiatan OSIS, MPK, ekstrakurikuler, pembinaan karakter, dan program partisipasi siswa.</p>
                <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                    <a href="#organisasi" class="gold-button transition-smooth" style="animation-delay: 0.4s;">Organisasi & Agenda</a>
                    <a href="#ekskul" class="ghost-button transition-smooth" style="animation-delay: 0.5s;">Ekstrakurikuler</a>
                </div>
            </div>
        </div>
    </section>

    <section id="organisasi" class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="eyebrow">Kepemimpinan Siswa</p>
                    <h2 class="mt-3 text-4xl font-black text-[#071f3a]">Organisasi Siswa & Agenda</h2>
                    <p class="mt-4 max-w-2xl text-sm font-semibold text-[#6b7f91]">OSIS dan MPK memfasilitasi kegiatan kepemimpinan, agenda tahunan, dan pembinaan karakter siswa.</p>
                </div>
                <a href="{{ route('home') }}#berita" class="outline-button">Lihat Agenda Terbaru</a>
            </div>

            <div class="mt-10 grid gap-6 lg:grid-cols-3">
                @foreach ([['bi-people-fill', 'OSIS', 'Penggerak program kepemimpinan, kreativitas, bakti sosial, dan budaya sekolah.'], ['bi-chat-square-heart-fill', 'MPK', 'Forum aspirasi siswa yang membantu menjaga komunikasi antara siswa dan sekolah.'], ['bi-calendar2-week-fill', 'Agenda Kesiswaan', 'Kalender kegiatan, pembinaan karakter, lomba, dan pengembangan diri siswa.']] as $item)
                    <article class="info-card hover-lift animate-fade-in-up stagger-{{ $loop->index + 1 }}">
                        <span class="round-icon"><i class="bi {{ $item[0] }}"></i></span>
                        <h3>{{ $item[1] }}</h3>
                        <p>{{ $item[2] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section id="ekskul" class="bg-[#f6f9fc] py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <p class="eyebrow">Pengembangan Diri</p>
                <h2 class="mt-3 text-4xl font-black text-[#071f3a]">Ekstrakurikuler Unggulan</h2>
                <p class="mt-4 text-sm font-semibold text-[#6b7f91]">Pilihan kegiatan yang membantu siswa menemukan bakat, membangun relasi, dan mengasah karakter.</p>
            </div>

            <div class="mt-12 grid gap-6 lg:grid-cols-3">
                @foreach ([['Olahraga', 'Basket, futsal, atletik, dan latihan fisik terarah untuk membangun sportivitas.'], ['Seni & Budaya', 'Musik, tari, teater, dan eksplorasi budaya Toba dalam kegiatan sekolah.'], ['Sains & Riset', 'Klub sains, robotik, karya ilmiah, dan pendampingan lomba akademik.']] as $club)
                    <article class="club-card hover-lift animate-fade-in-up stagger-{{ $loop->index + 1 }}">
                        <span class="round-icon"><i class="bi bi-stars"></i></span>
                        <h3>{{ $club[0] }}</h3>
                        <p>{{ $club[1] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
