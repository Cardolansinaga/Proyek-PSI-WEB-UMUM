@extends('layouts.site', ['active' => 'kesiswaan'])

@section('title', 'Kesiswaan & Ekstrakurikuler - SMAN 2 Balige')
@section('description', 'Kesiswaan, OSIS, MPK, ekstrakurikuler, dan pembinaan karakter SMAN 2 Balige.')

@section('content')
    @php($kesiswaanHeroImage = ! empty($settings['kesiswaan_hero_image']) ? asset('storage/'.$settings['kesiswaan_hero_image']) : null)
    <section class="school-hero hero-kesiswaan relative overflow-hidden" @if($kesiswaanHeroImage) style="background-image: linear-gradient(90deg, rgb(7 31 58 / 0.86), rgb(7 31 58 / 0.38)), url('{{ $kesiswaanHeroImage }}') !important;" @endif>
        <div class="hero-shade"></div>
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-20 left-10 w-72 h-72 bg-[#19a99a] rounded-full mix-blend-multiply filter blur-3xl animate-pulse-glow"></div>
            <div class="absolute bottom-20 right-10 w-72 h-72 bg-[#d6a63a] rounded-full mix-blend-multiply filter blur-3xl animate-pulse-glow animation-delay-2"></div>
        </div>
        <div class="mx-auto grid min-h-[520px] max-w-7xl items-center px-4 py-20 lg:px-8 relative z-10">
            <div class="relative max-w-3xl text-white animate-fade-in-up">
                <span class="section-pill animate-fade-in" style="animation-delay: 0.1s;">Ekosistem Kesiswaan</span>
                <h1 class="mt-7 text-5xl font-black leading-[0.98] text-white sm:text-5xl lg:text-6xl animate-fade-in-up drop-shadow-lg" style="animation-delay: 0.2s;">
                    Kesiswaan & <span class="text-[#19a99a]">Ekstrakurikuler</span>
                </h1>
                <p class="mt-6 max-w-2xl text-base font-semibold leading-7 text-white/80 animate-fade-in-up" style="animation-delay: 0.3s;">Informasi kegiatan OSIS, MPK, ekstrakurikuler, pembinaan karakter, dan program partisipasi siswa dalam mengembangkan potensi diri.</p>
                <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                    <a href="#organisasi" class="gold-button transition-smooth hover:shadow-2xl hover:shadow-[#d6a63a]/50 hover:scale-105" style="animation-delay: 0.4s;">Organisasi & Agenda</a>
                    <a href="#ekskul" class="ghost-button transition-smooth hover:bg-white/20 hover:scale-105" style="animation-delay: 0.5s;">Ekstrakurikuler</a>
                </div>
            </div>
        </div>
    </section>

    <section id="organisasi" class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="eyebrow">Kepemimpinan Siswa</p>
                    <h2 class="mt-3 text-4xl font-black text-[#071f3a] animate-fade-in-up">Organisasi Siswa & Agenda</h2>
                    <p class="mt-4 max-w-2xl text-sm font-semibold text-[#6b7f91] animate-fade-in-up" style="animation-delay: 0.1s;">OSIS dan MPK memfasilitasi kegiatan kepemimpinan, agenda tahunan, dan pembinaan karakter siswa melalui partisipasi aktif.</p>
                </div>
                <a href="{{ route('home') }}#berita" class="outline-button hover:scale-105 transition-transform hover:shadow-lg">Lihat Agenda Terbaru</a>
            </div>

            <div class="mt-10 grid gap-6 lg:grid-cols-3">
                @foreach ($organizations as $item)
                    <article class="info-card hover-lift animate-fade-in-up stagger-{{ $loop->index + 1 }} group">
                        @if (! empty($item->image_path))
                            <div class="mb-5 h-36 rounded-2xl bg-cover bg-center" style="background-image: linear-gradient(180deg, rgb(7 31 58 / .04), rgb(7 31 58 / .18)), url('{{ asset('storage/'.$item->image_path) }}') !important;"></div>
                        @endif
                        <span class="round-icon group-hover:scale-125 transition-transform group-hover:rotate-12"><i class="bi {{ $item->image_class ?? 'bi-people-fill' }}"></i></span>
                        <h3 class="group-hover:text-[#19a99a] transition-colors">{{ $item->name }}</h3>
                        <p>{{ $item->description }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-gradient-to-r from-[#071f3a] to-[#0f2847] py-20 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-[#19a99a] rounded-full filter blur-3xl animate-pulse"></div>
        </div>
        <div class="mx-auto max-w-7xl px-4 lg:px-8 relative z-10">
            <div class="mx-auto max-w-3xl text-center">
                <p class="eyebrow text-white/80">Program Pembinaan</p>
                <h2 class="mt-3 text-4xl font-black animate-fade-in-up">Karakter & Kepemimpinan</h2>
                <p class="mt-5 text-sm font-semibold leading-7 text-white/78 animate-fade-in-up" style="animation-delay: 0.1s;">Setiap siswa adalah pemimpin masa depan yang perlu dibina dengan penuh perhatian dan dedikasi.</p>
            </div>
            <div class="mt-12 grid gap-6 md:grid-cols-2">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 hover-lift group cursor-pointer">
                    <h3 class="text-xl font-black group-hover:text-[#19a99a] transition-colors">Program Kepemimpinan</h3>
                    <p class="mt-3 text-sm text-white/80">Pelatihan rutin untuk mengembangkan skill kepemimpinan, komunikasi, dan manajemen konflik.</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 hover-lift group cursor-pointer">
                    <h3 class="text-xl font-black group-hover:text-[#d6a63a] transition-colors">Pembinaan Karakter</h3>
                    <p class="mt-3 text-sm text-white/80">Pengembangan nilai-nilai integritas, tanggung jawab, dan gotong royong melalui kegiatan nyata.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="ekskul" class="bg-gradient-to-b from-white to-[#f6f9fc] py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <p class="eyebrow">Pengembangan Diri</p>
                <h2 class="mt-3 text-4xl font-black text-[#071f3a] animate-fade-in-up">Ekstrakurikuler Unggulan</h2>
                <p class="mt-4 text-sm font-semibold text-[#6b7f91] animate-fade-in-up" style="animation-delay: 0.1s;">Pilihan kegiatan yang membantu siswa menemukan bakat, membangun relasi, dan mengasah karakter melalui pengalaman praktis.</p>
            </div>

            <div class="mt-12 grid gap-6 lg:grid-cols-3">
                @foreach ($clubs as $club)
                    <article class="club-card hover-lift animate-fade-in-up stagger-{{ $loop->index + 1 }} group">
                        @if (! empty($club->image_path))
                            <div class="mb-5 h-36 rounded-2xl bg-cover bg-center" style="background-image: linear-gradient(180deg, rgb(7 31 58 / .04), rgb(7 31 58 / .18)), url('{{ asset('storage/'.$club->image_path) }}') !important;"></div>
                        @endif
                        <span class="round-icon bg-gradient-to-br from-[#19a99a]/20 to-[#d6a63a]/20 group-hover:scale-125 transition-transform group-hover:rotate-360">
                            <i class="bi {{ $club->image_class ?? 'bi-stars' }}"></i>
                        </span>
                        <h3 class="group-hover:text-[#19a99a] transition-colors">{{ $club->name }}</h3>
                        <p class="text-sm">{{ $club->description }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-[#f6f9fc] py-20">
        <div class="mx-auto max-w-4xl px-4 lg:px-8">
            <div class="rounded-2xl bg-gradient-to-r from-[#071f3a] to-[#0f2847] p-12 text-center text-white mb-12">
                <h2 class="text-3xl font-black animate-fade-in-up">Tanya Jawab Seputar Kesiswaan</h2>
                <p class="mt-4 text-white/80 animate-fade-in-up" style="animation-delay: 0.1s;">Informasi lengkap tentang kegiatan, pendaftaran ekstrakurikuler, dan program pengembangan karakter.</p>
            </div>
            <div class="space-y-5">
                @foreach (['Bagaimana cara mendaftar ekstrakurikuler?', 'Apakah ada batasan dalam memilih ekstrakurikuler?', 'Kapan jadwal kegiatan ekstrakurikuler dilaksanakan?'] as $question)
                    <details class="faq-item group">
                        <summary class="cursor-pointer group-open:text-[#19a99a]">{{ $question }}</summary>
                        <p class="mt-3 text-[#6b7f91]">Informasi lengkap tersedia di bagian kesiswaan atau melalui wali kelas masing-masing.</p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-white px-4 py-20 lg:px-8">
        <div class="cta-panel">
            <h2>Jadilah Bagian Dari Komunitas Kesiswaan SMAN 2 Balige</h2>
            <p>Bergabunglah dengan ribuan siswa yang aktif mengembangkan potensi diri melalui kegiatan organisasi dan ekstrakurikuler.</p>
            <div class="mt-10 flex flex-col justify-center gap-4 sm:flex-row">
                <a href="{{ route('home') }}#kontak" class="gold-button hover:shadow-xl">Hubungi Bagian Kesiswaan</a>
                <a href="{{ route('home') }}#berita" class="ghost-button hover:bg-white/10">Lihat Berita Kegiatan</a>
            </div>
        </div>
    </section>
@endsection
