@extends('layouts.site', ['active' => 'berita'])

@section('title', 'Berita & Pengumuman - SMAN 2 Balige')
@section('description', 'Informasi dan update terbaru SMAN 2 Balige.')

@section('content')
    @php($beritaHeroImage = ! empty($settings['berita_hero_image']) ? asset('storage/'.$settings['berita_hero_image']) : asset('images/heroes/ppdb-hero-1280.webp'))
    <section class="school-hero hero-news text-center relative overflow-hidden" style="background-image: linear-gradient(90deg, rgb(7 31 58 / 0.86), rgb(7 31 58 / 0.38)), url('{{ $beritaHeroImage }}') !important;">
        <div class="hero-shade"></div>
        <div class="mx-auto grid min-h-[430px] max-w-7xl place-items-center px-4 py-20 lg:px-8 relative z-10">
            <div class="relative max-w-4xl animate-fade-in-up">
                <span class="section-pill animate-fade-in" style="animation-delay: 0.1s;">Warta Sekolah</span>
                <h1 class="mt-7 text-5xl font-black leading-[1] text-white sm:text-6xl animate-fade-in-up" style="animation-delay: 0.2s;">Informasi & Update Terbaru Sekolah</h1>
                <p class="mx-auto mt-6 max-w-2xl text-base font-semibold leading-8 text-white/72 animate-fade-in-up" style="animation-delay: 0.3s;">Ikuti perkembangan prestasi, pengumuman akademik, dan agenda kesiswaan dalam satu portal terpadu.</p>
            </div>
        </div>
    </section>

    <section class="bg-gradient-to-b from-white to-[#f8fafc] py-8">
        <div class="mx-auto flex max-w-7xl flex-col gap-5 px-4 md:flex-row md:items-center md:justify-between lg:px-8">
            <div class="flex flex-wrap gap-3 animate-fade-in-up">
                @php($filterIcons = ['Semua' => 'bi-grid', 'Berita' => 'bi-newspaper', 'Pengumuman' => 'bi-megaphone', 'Prestasi' => 'bi-trophy', 'PPDB' => 'bi-journal-check'])
                @foreach (['Semua', 'Berita', 'Pengumuman', 'Prestasi', 'PPDB'] as $filter)
                    <a href="#daftar-berita" class="filter-pill group {{ $loop->first ? 'active' : '' }} hover:scale-105 transition-transform hover:shadow-lg">
                        <i class="bi {{ $filterIcons[$filter] }}" aria-hidden="true"></i>
                        <span class="group-hover:text-[#d6a63a] transition-colors">{{ $filter }}</span>
                    </a>
                @endforeach
            </div>
            <a href="{{ route('home') }}#kontak" class="outline-button hover:bg-[#071f3a]/5 hover:scale-105 transition-all animate-fade-in-up"><i class="bi bi-send" aria-hidden="true"></i>Kirim Informasi ke Humas</a>
        </div>
    </section>

    <section id="daftar-berita" class="bg-gradient-to-b from-[#f8fafc] to-white py-16 sm:py-20">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            @if ($featured)
                <article class="featured-news hover-lift group animate-fade-in-up bg-gradient-to-br from-white to-[#f0f7ff] overflow-hidden rounded-2xl shadow-xl hover:shadow-2xl transition-all">
                    <div class="grid md:grid-cols-2 gap-0 relative overflow-hidden">
                        @php($featuredImage = ! empty($featured->image_path) ? asset('storage/'.$featured->image_path) : null)
                        <div class="illustration {{ $featured->image_class ?? 'trophy' }} relative group-hover:scale-105 transition-transform duration-300" @if($featuredImage) style="background-image: linear-gradient(180deg, rgb(7 31 58 / .08), rgb(7 31 58 / .28)), url('{{ $featuredImage }}') !important;" @endif></div>
                        <div class="absolute top-0 right-0 w-40 h-40 bg-[#d6a63a]/10 rounded-full blur-3xl"></div>
                        <div class="p-8 lg:p-12 flex flex-col justify-between">
                            <div>
                                <p class="meta-line group-hover:text-[#d6a63a] transition-colors">{{ optional($featured->published_at)->format('d M Y') }} / <span class="inline-block px-3 py-1 bg-[#d6a63a]/10 rounded-full text-[#d6a63a] text-xs font-bold">{{ $featured->category }}</span></p>
                                <h2 class="group-hover:text-[#d6a63a] transition-colors">{{ $featured->title }}</h2>
                                <p class="text-[#6b7f91]">{{ $featured->excerpt }}</p>
                            </div>
                            <a href="{{ route('berita.show', $featured->slug) }}" class="inline-flex items-center gap-2 text-[#d6a63a] font-bold group/link">
                                Baca Selengkapnya <i class="bi bi-arrow-right group-hover/link:translate-x-2 transition-transform" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @endif
            <div class="mt-14 grid gap-8 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($posts as $post)
                    <article class="news-card hover-lift group animate-fade-in-up stagger-{{ ($loop->index % 6) + 1 }} bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all hover:border-[#d6a63a]/50 border border-transparent">
                        <div class="relative overflow-hidden">
                            @php($postImage = ! empty($post->image_path) ? asset('storage/'.$post->image_path) : null)
                            <div class="illustration {{ $post->image_class ?? 'library' }} group-hover:scale-110 transition-transform duration-300" @if($postImage) style="background-image: linear-gradient(180deg, rgb(7 31 58 / .08), rgb(7 31 58 / .28)), url('{{ $postImage }}') !important;" @endif><span class="visual-label">{{ $post->category }}</span></div>
                            <div class="absolute top-0 right-0 w-32 h-32 bg-[#d6a63a]/5 rounded-full blur-3xl"></div>
                        </div>
                        <div class="p-7">
                            <h3 class="group-hover:text-[#d6a63a] transition-colors">{{ $post->title }}</h3>
                            <p class="text-[#6b7f91]">{{ $post->excerpt }}</p>
                            <div class="mt-6 flex items-center justify-between text-[11px] font-black uppercase tracking-[0.12em]">
                                <span class="text-[#9aaaba]">{{ optional($post->published_at)->format('d M Y') }}</span>
                                <a class="!mt-0 text-[#c59632] transition-all group-hover:translate-x-2 group-hover:text-[#d6a63a] flex items-center gap-1" href="{{ route('berita.show', $post->slug) }}">Detail <i class="bi bi-arrow-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="mt-16 animate-fade-in-up" style="animation-delay: 0.5s;">
                {{ $posts->links() }}
            </div>
        </div>
    </section>

    <section class="bg-gradient-to-b from-white to-[#f6f9fc] px-4 py-20 lg:px-8">
        <div class="cta-panel">
            <h2 class="animate-fade-in-up">Siap Menjadi Bagian Dari Kami?</h2>
            <p class="mt-3 animate-fade-in-up" style="animation-delay: 0.1s;">Informasi Penerimaan Peserta Didik Baru tahun ajaran {{ $settings['ppdb_year'] ?? '2026/2027' }} tersedia untuk calon siswa dan orang tua.</p>
            <a href="{{ route('ppdb') }}" class="gold-button mt-10 hover:shadow-2xl hover:shadow-[#d6a63a]/50 hover:scale-105 transition-all"><i class="bi bi-journal-check" aria-hidden="true"></i>Informasi PPDB</a>
        </div>
    </section>
@endsection
