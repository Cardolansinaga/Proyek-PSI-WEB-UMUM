@extends('layouts.site', ['active' => 'kesiswaan'])

@section('title', 'Kesiswaan & Ekstrakurikuler - SMAN 2 Balige')
@section('description', 'Kesiswaan, OSIS, MPK, ekstrakurikuler, dan pembinaan karakter SMAN 2 Balige.')

@section('content')
    <section class="school-hero hero-kesiswaan">
        <div class="hero-shade"></div>
        <div class="mx-auto grid min-h-[520px] max-w-7xl items-center px-4 py-20 lg:px-8">
            <div class="relative max-w-3xl text-white">
                <span class="section-pill">Ekosistem Kesiswaan</span>
                <h1 class="mt-7 text-5xl font-black leading-[0.98] text-white sm:text-5xl lg:text-6xl">Kesiswaan & Ekstrakurikuler — SMAN 2 Balige</h1>
                <p class="mt-6 max-w-2xl text-base font-semibold leading-7 text-white/80">Informasi kegiatan OSIS, MPK, ekstrakurikuler, pembinaan karakter, dan program partisipasi siswa.</p>
                <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                    <a href="#organisasi" class="gold-button">Organisasi & Agenda</a>
                    <a href="#ekskul" class="ghost-button">Ekstrakurikuler</a>
                </div>
            </div>
        </div>
    </section>

    <section id="organisasi" class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <h2 class="text-4xl font-black text-[#071f3a]">Organisasi Siswa & Agenda</h2>
            <p class="mt-4 max-w-2xl text-sm font-semibold text-[#6b7f91]">OSIS dan MPK memfasilitasi kegiatan kepemimpinan, agenda tahunan, dan pembinaan karakter siswa.</p>

            <div class="mt-10 grid gap-6 lg:grid-cols-3">
                <div class="rounded-lg border p-4">
                    <h4 class="font-black">OSIS</h4>
                    <p class="text-sm text-gray-600 mt-2">Program kerja dan agenda tahunan OSIS.</p>
                </div>
                <div class="rounded-lg border p-4">
                    <h4 class="font-black">MPK</h4>
                    <p class="text-sm text-gray-600 mt-2">Perwakilan siswa dan forum aspirasi.</p>
                </div>
                <div class="rounded-lg border p-4">
                    <h4 class="font-black">Agenda</h4>
                    <p class="text-sm text-gray-600 mt-2">Kalender kegiatan dan pengumuman kesiswaan.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="ekskul" class="bg-[#f6f9fc] py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <h2 class="text-4xl font-black text-[#071f3a]">Ekstrakurikuler</h2>
            <p class="mt-4 max-w-2xl text-sm font-semibold text-[#6b7f91]">Daftar ekskul aktif dan informasi pendaftaran untuk siswa baru.</p>

            <div class="mt-10 grid gap-6 lg:grid-cols-3">
                @foreach (['Olahraga', 'Seni & Budaya', 'Sains & Riset'] as $club)
                    <article class="rounded-lg border p-6">
                        <h3 class="font-black">{{ $club }}</h3>
                        <p class="text-sm text-gray-600 mt-2">Informasi program, jadwal latihan, dan kontak pembina.</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
