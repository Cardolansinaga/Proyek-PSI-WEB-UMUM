@extends('layouts.site', ['active' => 'asrama'])

@section('title', 'Asrama & Kehidupan Sekolah - SMAN 2 Balige')
@section('description', 'Jelajahi kehidupan asrama dan pengalaman sekolah unggul di SMAN 2 Balige.')

@section('content')
    <section class="school-hero hero-ppdb" style="background-image: url('{{ asset('images/asrama-gerbang.jpg') }}'); background-size: cover; background-position: center;">
        <div class="hero-shade"></div>
        <div class="mx-auto grid min-h-[640px] max-w-7xl items-center px-4 py-24 lg:px-8">
            <div class="relative max-w-3xl text-white">
                <span class="section-pill">Kehidupan Sekolah</span>
                <h1 class="mt-7 text-5xl font-black leading-[0.98] text-white sm:text-6xl lg:text-7xl">
                    Rumah Kedua Bagi Para <span class="text-[#d6a63a]">Pemimpin Masa Depan</span>
                </h1>
                <p class="mt-7 max-w-2xl text-base font-semibold leading-8 text-white/80">
                    SMAN 2 Balige adalah ekosistem pembinaan karakter unggul melalui tradisi asrama yang disiplin, religius, dan penuh kekeluargaan.
                </p>
                <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                    <a href="#fasilitas" class="gold-button">Jelajahi Asrama</a>
                    <a href="{{ route('ppdb') }}" class="ghost-button">Lihat PPDB</a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="grid gap-16 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
                <div class="max-w-2xl">
                    <p class="eyebrow">Pembinaan Karakter & Suasana Belajar Kondusif</p>
                    <h2 class="mt-4 text-4xl font-black text-[#071f3a] sm:text-5xl">
                        Di SMAN 2 Balige, lingkungan asrama dirancang untuk meminimalkan distraksi dan memaksimalkan potensi siswa.
                    </h2>
                    <div class="mt-4 h-1 w-16 rounded-full bg-[#d6a63a]"></div>
                    <p class="mt-6 max-w-2xl text-sm font-semibold leading-7 text-[#6b7f91] sm:text-base">
                        Kami percaya kecerdasan intelektual harus berjalan beriringan dengan ketangguhan mental dan integritas moral. Suasana belajar kondusif siap mendukung setiap langkah siswa.
                    </p>

                    <div class="mt-10 grid gap-5 sm:grid-cols-2">
                        <article class="rounded-[2rem] border border-[#e2eaf1] bg-[#fbfdff] p-8 shadow-[0_18px_40px_rgb(7,31,58,0.04)]">
                            <p class="text-5xl font-black text-[#d6a63a]">24/7</p>
                            <h3 class="mt-3 text-lg uppercase font-black tracking-[0.18em] text-[#071f3a]">Pendampingan Pengasuh</h3>
                            <p class="mt-4 text-sm font-semibold leading-7 text-[#6b7f91]">Pendampingan pengasuh yang siap mendukung siswa setiap saat.</p>
                        </article>
                        <article class="rounded-[2rem] border border-[#e2eaf1] bg-[#fbfdff] p-8 shadow-[0_18px_40px_rgb(7,31,58,0.04)]">
                            <p class="text-5xl font-black text-[#d6a63a]">Elite</p>
                            <h3 class="mt-3 text-lg uppercase font-black tracking-[0.18em] text-[#071f3a]">Fasilitas Akademik</h3>
                            <p class="mt-4 text-sm font-semibold leading-7 text-[#6b7f91]">Fasilitas akademik terintegrasi untuk mendukung pembelajaran unggulan.</p>
                        </article>
                    </div>
                </div>

                <div class="relative">
                    <div class="overflow-hidden rounded-[2rem] border border-[#e2eaf1] bg-[#f8fbff] shadow-[0_28px_70px_rgb(7,31,58,0.08)]">
                        <div class="h-[32rem] w-full bg-[url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=1400&q=80')] bg-cover bg-center"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="fasilitas" class="bg-[#f6f9fc] py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <p class="eyebrow">Eksplorasi Fasilitas</p>
                <h2 class="text-4xl font-black text-[#071f3a] sm:text-5xl">Kehidupan Asrama yang Dinamis</h2>
                <p class="mt-4 text-sm font-semibold leading-7 text-[#6b7f91] sm:text-base">
                    Lebih dari sekadar tempat tinggal, asrama adalah laboratorium sosial tempat persaudaraan abadi terbentuk melalui kebersamaan.
                </p>
            </div>

            <div class="mt-14 grid gap-5 lg:grid-cols-[1.55fr_1fr]">
                <article class="rounded-[2rem] bg-white p-8 shadow-[0_28px_70px_rgb(7,31,58,0.08)]">
                    <div class="h-96 overflow-hidden rounded-[2rem] bg-[#eff6ff]">
                        <div class="h-full w-full bg-[url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=1400&q=80')] bg-cover bg-center"></div>
                    </div>
                    <div class="mt-8">
                        <p class="eyebrow">Gerbang Asrama</p>
                        <h3 class="mt-3 text-3xl font-black text-[#071f3a]">Asrama Yayasan Sopo Surung SMAN 2 Balige yang menyambut siswa dengan semangat disiplin dan kebersamaan.</h3>
                    </div>
                </article>

                <div class="grid gap-5">
                    <article class="rounded-[2rem] bg-white p-7 shadow-[0_18px_45px_rgb(7,31,58,0.08)]">
                        <h4 class="text-lg font-black text-[#071f3a]">Kegiatan Sore</h4>
                        <p class="mt-3 text-sm font-semibold leading-7 text-[#6b7f91]">Program olahraga dan ekstrakurikuler untuk menjaga kebugaran dan kreativitas.</p>
                    </article>
                    <article class="rounded-[2rem] bg-white p-7 shadow-[0_18px_45px_rgb(7,31,58,0.08)]">
                        <h4 class="text-lg font-black text-[#071f3a]">Gizi Seimbang</h4>
                        <p class="mt-3 text-sm font-semibold leading-7 text-[#6b7f91]">Menu sehat yang menunjang daya tahan tubuh dan fokus belajar siswa.</p>
                    </article>
                    <article class="rounded-[2rem] bg-white p-7 shadow-[0_18px_45px_rgb(7,31,58,0.08)]">
                        <h4 class="text-lg font-black text-[#071f3a]">Sesi Belajar Mandiri</h4>
                        <p class="mt-3 text-sm font-semibold leading-7 text-[#6b7f91]">Waktu khusus untuk fokus belajar individu dan evaluasi bersama mentor.</p>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <p class="eyebrow">Pilar Keunggulan</p>
                <h2 class="mt-3 text-4xl font-black text-[#071f3a] sm:text-5xl">Nilai & Budaya Sekolah</h2>
                <p class="mt-6 text-sm font-semibold leading-7 text-[#6b7f91] sm:text-base">
                    Kami membentuk pemimpin berkarakter tinggi, solidaritas korsa, dan sikap etika yang kuat dalam setiap aspek kehidupan sekolah.
                </p>
            </div>
            <div class="mt-14 grid gap-5 lg:grid-cols-3">
                <article class="feature-card">
                    <span class="feature-icon">DS</span>
                    <h3>Disiplin Semi-Militer</h3>
                    <p>Membangun ketangguhan fisik, mental, serta rasa tanggung jawab tinggi terhadap setiap tugas dan kewajiban.</p>
                </article>
                <article class="feature-card">
                    <span class="feature-icon">SK</span>
                    <h3>Solidaritas Korsa</h3>
                    <p>Rasa kekeluargaan antar angkatan yang kuat, menciptakan jaringan alumni yang solid dan suportif sepanjang hayat.</p>
                </article>
                <article class="feature-card">
                    <span class="feature-icon">KE</span>
                    <h3>Keunggulan Etika</h3>
                    <p>Mengedepankan sopan santun, tata krama, dan kecerdasan emosional dalam setiap interaksi di lingkungan sekolah.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="bg-[#071f3a] py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="rounded-[2rem] bg-[#0e324c] p-10 text-white sm:p-14">
                <div class="grid gap-8 lg:grid-cols-[1.25fr_0.75fr] lg:items-center">
                    <div>
                        <p class="text-sm font-black uppercase tracking-[0.28em] text-[#d6a63a]">Pendaftaran 2024/2025</p>
                        <h2 class="mt-5 text-4xl font-black leading-tight sm:text-5xl">Mulai Perjalanan Anda Menjadi Pemimpin Dunia</h2>
                        <p class="mt-6 max-w-2xl text-sm font-semibold leading-7 text-[#dbe4ed] sm:text-base">Amankan tempat Anda di salah satu institusi pendidikan terbaik. Bergabunglah dengan komunitas pembelajar yang berdedikasi.</p>
                    </div>
                    <div class="flex flex-col gap-4 sm:flex-row sm:justify-end">
                        <a href="{{ route('ppdb') }}" class="gold-button">Daftar PPDB Sekarang</a>
                        <a href="{{ route('kontak') }}" class="outline-button">Konsultasi Pendidikan</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
