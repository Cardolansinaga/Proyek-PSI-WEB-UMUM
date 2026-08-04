@extends('layouts.site', ['active' => 'berita'])

@section('title', 'Berita & Pengumuman - SMAN 2 Balige')
@section('description', 'Informasi dan update terbaru SMAN 2 Balige.')
@section('canonical', $activeCategory !== '' ? route('berita.index', ['category' => $activeCategory]) : route('berita.index'))
@section('image', ! empty($settings['berita_hero_image']) ? asset('storage/'.$settings['berita_hero_image']) : asset('images/logo-sman2-balige.jpg'))

@section('content')
    @php
        $hasCustomBeritaHero = ! empty($settings['berita_hero_image']);
        $beritaHeroImage = $hasCustomBeritaHero ? asset('storage/'.$settings['berita_hero_image']) : null;
    @endphp
    <section
        class="school-hero hero-news text-center relative overflow-hidden {{ $hasCustomBeritaHero ? 'has-custom-photo' : 'default-school-hero' }}"
        @if($hasCustomBeritaHero)
            style="background-image: linear-gradient(90deg, rgb(11 42 68 / 0.92), rgb(11 42 68 / 0.62)), url('{{ $beritaHeroImage }}') !important;"
        @else
            style="background-color: #12324d !important; background-image: none !important;"
        @endif
    >
        <div class="hero-shade"></div>
        <div class="mx-auto grid min-h-[430px] max-w-7xl place-items-center px-4 py-20 lg:px-8 relative z-10">
            <div class="relative max-w-4xl">
                <span class="section-pill">Informasi Sekolah</span>
                <h1 class="mt-7 text-5xl font-black leading-[1] text-white sm:text-6xl">Berita & Pengumuman</h1>
                <p class="mx-auto mt-6 max-w-2xl text-base font-semibold leading-8 text-white/72">Pembaruan kegiatan dan pengumuman resmi SMAN 2 Balige.</p>
            </div>
        </div>
    </section>

    <section class="bg-gradient-to-b from-white to-[#f8fafc] py-8">
        <div class="mx-auto flex max-w-7xl flex-col gap-5 px-4 md:flex-row md:items-center md:justify-between lg:px-8">
            <div class="flex flex-wrap gap-3">
                @php($filterIcons = ['Berita' => 'bi-newspaper', 'Pengumuman' => 'bi-megaphone', 'Prestasi' => 'bi-trophy', 'PPDB' => 'bi-journal-check', 'Akademik' => 'bi-mortarboard', 'Kesiswaan' => 'bi-people'])
                <a href="{{ route('berita.index') }}#daftar-berita" class="filter-pill group {{ $activeCategory === '' ? 'active' : '' }}" @if($activeCategory === '') aria-current="page" @endif>
                    <i class="bi bi-grid" aria-hidden="true"></i>
                    <span class="group-hover:text-[#d6a63a] transition-colors">Semua</span>
                </a>
                @foreach ($categories as $filter)
                    <a href="{{ route('berita.index', ['category' => $filter]) }}#daftar-berita" class="filter-pill group {{ $activeCategory === $filter ? 'active' : '' }}" @if($activeCategory === $filter) aria-current="page" @endif>
                        <i class="bi {{ $filterIcons[$filter] ?? 'bi-folder-check' }}" aria-hidden="true"></i>
                        <span class="group-hover:text-[#d6a63a] transition-colors">{{ $filter }}</span>
                    </a>
                @endforeach
            </div>
            <a href="{{ route('home') }}#kontak" class="outline-button hover:bg-[#071f3a]/5 transition-all"><i class="bi bi-send" aria-hidden="true"></i>Kirim Informasi ke Humas</a>
        </div>
    </section>

    <section id="daftar-berita" class="bg-gradient-to-b from-[#f8fafc] to-white py-16 sm:py-20">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            @if ($featured)
                @php($featuredImage = ! empty($featured->image_path) ? asset('storage/'.$featured->image_path) : null)
                <article class="featured-news hover-lift group bg-gradient-to-br from-white to-[#f0f7ff] overflow-hidden rounded-2xl shadow-xl hover:shadow-2xl transition-all">
                    <div class="featured-news-layout {{ $featuredImage ? 'has-media' : 'is-text-only' }}">
                        @if($featuredImage)
                            <div class="illustration relative group-hover:scale-105 transition-transform duration-300" style="background-image: linear-gradient(180deg, rgb(7 31 58 / .08), rgb(7 31 58 / .28)), url('{{ $featuredImage }}') !important;"></div>
                        @endif
                        <div class="absolute top-0 right-0 w-40 h-40 bg-[#d6a63a]/10 rounded-full blur-3xl"></div>
                        <div class="featured-news-content p-8 lg:p-12 flex flex-col justify-between">
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
            @if($posts->isEmpty())
                <div class="mt-14 rounded-2xl border border-dashed border-[#ccd9e4] bg-white px-6 py-16 text-center">
                    <i class="bi bi-newspaper text-4xl text-[#d6a63a]" aria-hidden="true"></i>
                    <h2 class="mt-4 text-2xl font-black text-[#071f3a]">Belum ada berita pada kategori ini</h2>
                    <p class="mx-auto mt-3 max-w-xl text-sm font-semibold leading-7 text-[#6b7f91]">Silakan pilih kategori lain atau lihat semua berita sekolah.</p>
                    <a href="{{ route('berita.index') }}#daftar-berita" class="outline-button mt-6">Lihat Semua Berita</a>
                </div>
            @else
                <div class="mt-14 grid gap-8 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($posts as $post)
                    @php($postImage = ! empty($post->image_path) ? asset('storage/'.$post->image_path) : null)
                    <article class="news-card {{ $postImage ? 'has-media' : 'is-text-only' }} hover-lift group bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all hover:border-[#d6a63a]/50 border border-transparent">
                        @if($postImage)
                            <div class="relative overflow-hidden">
                                <div class="illustration group-hover:scale-110 transition-transform duration-300" style="background-image: linear-gradient(180deg, rgb(7 31 58 / .08), rgb(7 31 58 / .28)), url('{{ $postImage }}') !important;">
                                <span class="visual-label">{{ $post->category }}</span>
                                </div>
                                <div class="absolute top-0 right-0 w-32 h-32 bg-[#d6a63a]/5 rounded-full blur-3xl"></div>
                            </div>
                        @endif
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
                <div class="mt-16">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </section>

    <section class="bg-gradient-to-b from-white to-[#f6f9fc] px-4 py-20 lg:px-8">
        <div class="cta-panel">
            <h2>Informasi Penerimaan Murid Baru</h2>
            <p class="mt-3">Jadwal dan persyaratan tahun ajaran {{ $settings['ppdb_year'] ?? '2026/2027' }} tersedia pada halaman PPDB.</p>
            <a href="{{ route('ppdb') }}" class="gold-button mt-10">Buka Informasi PPDB</a>
        </div>
    </section>
@endsection
