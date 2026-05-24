@extends('layouts.site', ['active' => 'ppdb'])

@section('title', 'Informasi PPDB - SMAN 2 Balige')
@section('description', 'Informasi penerimaan peserta didik baru SMAN 2 Balige.')

@section('content')
    @php($ppdbHeroImage = ! empty($settings['ppdb_hero_image']) ? asset('storage/'.$settings['ppdb_hero_image']) : null)
    <section class="school-hero hero-ppdb text-center relative overflow-hidden" @if($ppdbHeroImage) style="background-image: linear-gradient(90deg, rgb(7 31 58 / 0.86), rgb(7 31 58 / 0.38)), url('{{ $ppdbHeroImage }}') !important;" @endif>
        <div class="hero-shade"></div>
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-20 left-10 w-72 h-72 bg-[#d6a63a] rounded-full mix-blend-multiply filter blur-3xl animate-pulse-glow"></div>
            <div class="absolute bottom-20 right-10 w-72 h-72 bg-emerald-400 rounded-full mix-blend-multiply filter blur-3xl animate-pulse-glow animation-delay-2"></div>
        </div>
        <div class="mx-auto grid min-h-[520px] max-w-7xl place-items-center px-4 py-20 lg:px-8 relative z-10">
            <div class="relative max-w-4xl animate-fade-in-up">
                <span class="section-pill animate-fade-in" style="animation-delay: 0.1s;">Tahun Ajaran {{ $settings['ppdb_year'] ?? '2026/2027' }} - {{ $settings['ppdb_status'] ?? 'Dibuka' }}</span>
                <h1 class="mt-7 text-5xl font-black leading-[0.98] text-white sm:text-6xl lg:text-7xl animate-fade-in-up drop-shadow-lg" style="animation-delay: 0.2s;">
                    Penerimaan Peserta <span class="text-[#d6a63a]">Didik Baru</span>
                </h1>
                <p class="mx-auto mt-7 max-w-2xl text-base font-semibold leading-8 text-white/76 animate-fade-in-up" style="animation-delay: 0.3s;">
                    Bergabunglah dengan institusi pendidikan unggulan yang berfokus pada karakter, prestasi, dan masa depan gemilang.
                </p>
                <div class="mt-9 flex flex-col justify-center gap-4 sm:flex-row">
                    <a href="#formulir" class="gold-button transition-smooth hover:shadow-2xl hover:shadow-[#d6a63a]/50 hover:scale-105" style="animation-delay: 0.4s;">{{ ($settings['ppdb_status'] ?? 'Dibuka') === 'Dibuka' ? 'Hubungi Panitia' : 'Lihat Informasi' }}</a>
                    <a href="#syarat" class="ghost-button transition-smooth hover:bg-white/20 hover:scale-105" style="animation-delay: 0.5s;">Lihat Panduan</a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="mx-auto max-w-3xl text-center animate-fade-in-up">
                <h2 class="text-3xl font-black text-[#071f3a] sm:text-4xl">Mengapa Memilih SMAN 2 Balige?</h2>
                <div class="mx-auto mt-5 h-1 w-16 rounded-full bg-gradient-to-r from-[#d6a63a] to-[#f0d97d] animate-pulse-glow"></div>
            </div>
            <div class="mt-14 grid gap-8 md:grid-cols-3">
                <article class="info-card hover-lift animate-fade-in-up stagger-1 group"><span class="round-icon group-hover:scale-125 transition-transform"><i class="bi bi-award"></i></span><h2 class="group-hover:text-[#d6a63a] transition-colors">Akreditasi A</h2><p>Kualitas pendidikan terstandarisasi nasional dengan kurikulum relevan dan adaptif.</p></article>
                <article class="info-card hover-lift animate-fade-in-up stagger-2 group"><span class="round-icon group-hover:scale-125 transition-transform"><i class="bi bi-trophy"></i></span><h2 class="group-hover:text-[#d6a63a] transition-colors">Prestasi Internasional</h2><p>Siswa kami konsisten meraih medali di ajang olimpiade sains dan kompetisi global.</p></article>
                <article class="info-card hover-lift animate-fade-in-up stagger-3 group"><span class="round-icon group-hover:scale-125 transition-transform"><i class="bi bi-people"></i></span><h2 class="group-hover:text-[#d6a63a] transition-colors">Lingkungan Inklusif</h2><p>Pembentukan karakter melalui lingkungan aman, disiplin, dan penuh rasa persaudaraan.</p></article>
            </div>
        </div>
    </section>

    <section class="bg-gradient-to-b from-[#071f3a] to-[#0f2847] py-20 text-center text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-[#d6a63a] rounded-full filter blur-3xl animate-pulse"></div>
        </div>
        <div class="mx-auto max-w-7xl px-4 lg:px-8 relative z-10">
            <h2 class="text-3xl font-black sm:text-4xl animate-fade-in-up">Alur Pendaftaran</h2>
            <p class="mx-auto mt-4 max-w-2xl text-sm font-semibold leading-7 text-white/78 animate-fade-in-up" style="animation-delay: 0.1s;">Ikuti langkah-langkah mudah untuk menjadi bagian dari civitas akademika SMAN 2 Balige.</p>
            <div class="mt-12 grid gap-6 md:grid-cols-4">
                @foreach ([['Konsultasi Informasi', 'Hubungi panitia untuk memastikan jadwal dan jalur pendaftaran.'], ['Persiapan Dokumen', 'Lengkapi biodata calon siswa dan berkas yang diperlukan.'], ['Verifikasi Berkas', 'Tim panitia memeriksa kelengkapan dokumen.'], ['Pengumuman', 'Ikuti informasi resmi sekolah terkait hasil seleksi.']] as $index => $step)
                    <article class="step-card transition-smooth hover:translate-y-[-8px] hover:shadow-2xl animate-fade-in-up group" style="animation-delay: {{ (0.2 + $index * 0.1) }}s;">
                        <span class="text-2xl font-black group-hover:text-[#d6a63a] transition-colors">{{ $index + 1 }}</span>
                        <h3 class="group-hover:text-[#d6a63a] transition-colors">{{ $step[0] }}</h3>
                        <p class="text-xs text-white/70">{{ $step[1] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section id="syarat" class="bg-gradient-to-b from-white to-[#f6f9fc] py-20 sm:py-24">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 lg:grid-cols-[1.35fr_0.8fr] lg:px-8">
            <div>
                <h2 class="mini-heading animate-fade-in-up">Persyaratan & Dokumen</h2>
                <p class="mt-2 text-sm text-[#6b7f91] animate-fade-in-up" style="animation-delay: 0.1s;">Lengkapi semua berkas dengan baik dan benar untuk mempercepat proses verifikasi.</p>
                <div class="mt-8 grid gap-5">
                    @foreach (['Scan Ijazah / SKL', 'Akta Kelahiran & Kartu Keluarga', 'Pas Foto Terbaru', 'Rapor Semester 1-5'] as $doc)
                        <div class="document-row group hover:bg-[#d6a63a]/5 transition-colors rounded-lg">
                            <span class="text-[#d6a63a] group-hover:scale-110 transition-transform">✓</span>
                            <div>
                                <strong class="group-hover:text-[#d6a63a] transition-colors">{{ $doc }}</strong>
                                <p class="text-xs text-[#8ca0b0]">Dokumen dipindai dengan jelas dan diunggah melalui portal pendaftaran.</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <aside class="rounded-[1.6rem] bg-gradient-to-br from-[#071f3a] to-[#0f2847] p-8 text-white shadow-2xl shadow-[#071f3a]/30 hover-lift">
                <h3 class="text-2xl font-black">Jadwal Penting</h3>
                <p class="mt-2 text-xs text-white/70">Catat dan ikuti semua jadwal yang telah ditentukan.</p>
                <div class="mt-8 grid gap-5">
                    @foreach ([['15 Mei', 'Sosialisasi PPDB'], [\Carbon\Carbon::parse($settings['ppdb_open_date'] ?? '2026-06-01')->format('d M'), 'Pembukaan Pendaftaran'], ['10 Jul', 'Seleksi Akademik'], [\Carbon\Carbon::parse($settings['ppdb_close_date'] ?? '2026-07-15')->format('d M'), 'Penutupan Pendaftaran']] as $date)
                        <div class="schedule-row group hover:bg-white/10 transition-colors rounded-lg px-3 py-2">
                            <span class="text-[#d6a63a] font-bold group-hover:text-white transition-colors">{{ $date[0] }}</span>
                            <strong class="group-hover:text-[#d6a63a] transition-colors">{{ $date[1] }}</strong>
                        </div>
                    @endforeach
                </div>
            </aside>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-4xl px-4 lg:px-8">
            <div class="rounded-2xl bg-gradient-to-r from-[#071f3a] to-[#0f2847] p-12 text-center text-white mb-12">
                <h2 class="text-3xl font-black animate-fade-in-up">Pertanyaan Umum (FAQ)</h2>
                <p class="mt-4 text-white/80 animate-fade-in-up" style="animation-delay: 0.1s;">Temukan jawaban atas pertanyaan seputar PPDB SMAN 2 Balige.</p>
            </div>
            <div class="space-y-5 text-left">
                <details class="faq-item group" open>
                    <summary class="cursor-pointer group-open:text-[#d6a63a]">Apakah ada biaya pendaftaran PPDB?</summary>
                    <p class="mt-3 text-[#6b7f91] text-sm">Pendaftaran PPDB di SMAN 2 Balige tidak dipungut biaya apa pun. Mohon waspada terhadap segala bentuk penipuan yang mengatasnamakan panitia sekolah.</p>
                </details>
                <details class="faq-item group">
                    <summary class="cursor-pointer group-open:text-[#d6a63a]">Jalur apa saja yang tersedia tahun ini?</summary>
                    <p class="mt-3 text-[#6b7f91] text-sm">Tersedia jalur prestasi akademik, prestasi non-akademik, zonasi, afirmasi, dan perpindahan tugas orang tua sesuai aturan dinas pendidikan.</p>
                </details>
                <details class="faq-item group">
                    <summary class="cursor-pointer group-open:text-[#d6a63a]">Bagaimana jika mengalami kendala teknis?</summary>
                    <p class="mt-3 text-[#6b7f91] text-sm">Calon siswa dapat menghubungi sekretariat PPDB melalui email atau datang langsung ke sekolah pada jam kerja.</p>
                </details>
            </div>
        </div>
    </section>

    <section id="formulir" class="bg-gradient-to-b from-[#f6f9fc] to-white px-4 py-20 lg:px-8">
        <div class="cta-panel">
            <h2 class="animate-fade-in-up">Siap Menjadi Bagian Dari Generasi Unggul?</h2>
            <p class="mt-3 animate-fade-in-up" style="animation-delay: 0.1s;">Jangan lewatkan kesempatan berharga untuk menempuh pendidikan di salah satu SMA terbaik di Sumatera Utara.</p>
            <div class="mt-10 flex flex-col justify-center gap-4 sm:flex-row">
                <a href="{{ route('home') }}#kontak" class="gold-button hover:shadow-2xl hover:shadow-[#d6a63a]/50 hover:scale-105 transition-all">Hubungi Panitia PPDB</a>
                <a href="{{ route('home') }}#kontak" class="ghost-button hover:bg-white/20 hover:scale-105 transition-all">Lihat Lokasi Sekolah</a>
            </div>
        </div>
    </section>
@endsection
