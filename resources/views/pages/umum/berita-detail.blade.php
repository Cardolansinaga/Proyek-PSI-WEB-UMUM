@extends('layouts.site', ['active' => 'berita'])

@section('title', $post->title . ' - SMAN 2 Balige')
@section('description', $post->excerpt)

@section('content')
    <article class="bg-gradient-to-b from-white to-[#f6f9fc] py-16 sm:py-20">
        <div class="mx-auto max-w-4xl px-4 lg:px-8">
            <nav class="text-[11px] font-black uppercase tracking-[0.2em] text-[#9aaaba] animate-fade-in-up">Beranda / Berita / Detail Berita</nav>
            <div class="mt-8 flex flex-wrap items-center gap-4 animate-fade-in-up" style="animation-delay: 0.1s;">
                <span class="rounded-full bg-gradient-to-r from-[#f4ecd9] to-[#f9f4e5] px-4 py-2 text-[10px] font-black uppercase tracking-[0.14em] text-[#c59632] hover:shadow-lg transition-shadow">{{ $post->category }}</span>
                <span class="text-sm font-bold text-[#8396a8]">{{ optional($post->published_at)->format('d M Y') }}</span>
            </div>
            <h1 class="mt-6 text-4xl font-black leading-[1.02] text-[#071f3a] sm:text-5xl lg:text-6xl animate-fade-in-up" style="animation-delay: 0.2s;">
                {{ $post->title }}
            </h1>
            <div class="mt-10 flex flex-col sm:flex-row items-center justify-between border-y border-[#e7edf2] py-6 gap-4 animate-fade-in-up" style="animation-delay: 0.3s;">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 rounded-full bg-gradient-to-br from-[#071f3a] to-[#d6a63a] shadow-lg shadow-[#071f3a]/20"></div>
                    <div><strong class="block text-[#071f3a]">Admin Sekolah</strong><span class="text-sm font-semibold text-[#8396a8]">Humas SMAN 2 Balige</span></div>
                </div>
                <div class="flex gap-3">
                    <a class="icon-button group hover:bg-[#d6a63a] hover:text-white transition-all hover:scale-110" href="{{ route('akademik') }}#prestasi" aria-label="Lihat prestasi"><i class="bi bi-trophy"></i></a>
                    <a class="icon-button group hover:bg-[#071f3a] hover:text-white transition-all hover:scale-110" href="{{ route('berita.index') }}" aria-label="Kembali ke berita"><i class="bi bi-newspaper"></i></a>
                </div>
            </div>
            <figure class="mt-12 animate-fade-in-up" style="animation-delay: 0.4s;">
                @php($postImage = ! empty($post->image_path) ? asset('storage/'.$post->image_path) : null)
                <div class="illustration {{ $post->image_class ?? 'medalists' }} min-h-[360px] rounded-[1.5rem] shadow-2xl shadow-[#071f3a]/20 group-hover:shadow-3xl transition-shadow hover:scale-[1.02] transition-transform" @if($postImage) style="background-image: linear-gradient(180deg, rgb(7 31 58 / .08), rgb(7 31 58 / .28)), url('{{ $postImage }}') !important;" @endif></div>
                <figcaption class="mt-5 text-center text-sm font-semibold text-[#8da0b1]">{{ $post->excerpt }}</figcaption>
            </figure>
            <div class="prose-copy mt-14 animate-fade-in-up" style="animation-delay: 0.5s;">
                @foreach (preg_split('/\R+/', trim($post->body ?? $post->excerpt)) as $paragraph)
                    <p class="text-[#6b7f91] leading-relaxed">{{ $paragraph }}</p>
                @endforeach
            </div>
        </div>
    </article>

    <section class="bg-gradient-to-b from-white to-[#f8fafc] pb-20">
        <div class="mx-auto max-w-4xl px-4 lg:px-8">
            <h2 class="text-2xl font-black text-[#071f3a] animate-fade-in-up">Galeri Kegiatan</h2>
            <div class="mt-8 grid gap-6 sm:grid-cols-2 animate-fade-in-up" style="animation-delay: 0.1s;">
                <div class="illustration study min-h-[220px] rounded-2xl group hover:shadow-xl transition-shadow hover:scale-[1.02]"></div>
                <div class="grid gap-6"><div class="illustration class min-h-[220px] rounded-2xl group hover:shadow-xl transition-shadow hover:scale-[1.02]"></div><div class="illustration labroom min-h-[220px] rounded-2xl group hover:shadow-xl transition-shadow hover:scale-[1.02]"></div></div>
            </div>
            <div class="mt-14 flex flex-col gap-6 border-y border-[#e7edf2] py-8 sm:flex-row sm:items-center sm:justify-between animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="flex flex-wrap gap-3"><span class="tag hover:bg-[#d6a63a] hover:text-white transition-all">#Sains2026</span><span class="tag hover:bg-[#071f3a] hover:text-white transition-all">#Sains</span><span class="tag hover:bg-[#d6a63a] hover:text-white transition-all">#Prestasi</span></div>
                <div class="flex items-center gap-3">
                    <span class="text-[11px] font-black uppercase tracking-[0.18em] text-[#9aaaba]">Bagikan:</span>
                    <a class="share fb hover:scale-125 hover:bg-[#3B5998] transition-all" href="mailto:?subject={{ urlencode($post->title) }}&body={{ route('berita.show', $post->slug) }}" aria-label="Bagikan lewat email"><i class="bi bi-envelope"></i></a>
                    <a class="share tw hover:scale-125 hover:bg-[#1DA1F2] transition-all" href="https://twitter.com/intent/tweet?url={{ urlencode(route('berita.show', $post->slug)) }}" target="_blank" rel="noopener" aria-label="Bagikan ke X"><i class="bi bi-twitter-x"></i></a>
                    <a class="share wa hover:scale-125 hover:bg-[#25D366] transition-all" href="https://wa.me/?text={{ urlencode(route('berita.show', $post->slug)) }}" target="_blank" rel="noopener" aria-label="Bagikan ke WhatsApp"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gradient-to-br from-[#f8fafc] via-white to-[#f0f7ff] py-20">
        <div class="mx-auto max-w-5xl px-4 lg:px-8">
            <h2 class="text-3xl font-black text-[#071f3a] animate-fade-in-up">Berita Terkait</h2>
            <p class="mt-3 text-sm font-semibold text-[#8396a8] animate-fade-in-up" style="animation-delay: 0.1s;">Simak informasi menarik lainnya dari sekolah kami.</p>
            <div class="mt-10 grid gap-8 md:grid-cols-2">
                @foreach ($relatedPosts as $related)
                    <article class="news-card hover-lift group animate-fade-in-up stagger-{{ $loop->index + 1 }} bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all border border-transparent hover:border-[#d6a63a]/50"><div class="relative overflow-hidden"><div class="illustration {{ $related->image_class ?? 'graduates' }} group-hover:scale-110 transition-transform duration-300"></div></div><div class="p-7"><p class="meta-line group-hover:text-[#d6a63a] transition-colors">{{ $related->category }}</p><h3 class="group-hover:text-[#d6a63a] transition-colors">{{ $related->title }}</h3><p class="text-[#6b7f91]">{{ $related->excerpt }}</p><a href="{{ route('berita.show', $related->slug) }}" class="inline-flex items-center gap-2 mt-4 text-[#d6a63a] font-bold group-hover:translate-x-2 transition-transform">Detail <i class="bi bi-arrow-right" aria-hidden="true"></i></a></div></article>
                @endforeach
            </div>
            <div class="mt-12 text-center animate-fade-in-up" style="animation-delay: 0.3s;"><a href="{{ route('berita.index') }}" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-[#071f3a] to-[#0f2847] px-8 py-4 text-sm font-black uppercase tracking-[0.08em] text-white hover:shadow-2xl hover:shadow-[#071f3a]/30 hover:scale-105 transition-all">Lihat Berita Lainnya <i class="bi bi-arrow-right" aria-hidden="true"></i></a></div>
        </div>
    </section>
@endsection
