@extends('layouts.site', ['active' => 'asrama'])

@section('title', 'Asrama & Kehidupan Sekolah - SMAN 2 Balige')
@section('description', 'Kehidupan asrama, rutinitas harian, nilai budaya sekolah, dan pembinaan karakter SMAN 2 Balige.')

@section('content')
    <section class="school-hero hero-dorm">
        <div class="hero-shade"></div>
        <div class="mx-auto grid min-h-[560px] max-w-7xl items-center px-4 py-20 lg:px-8">
            <div class="relative max-w-3xl">
                <span class="section-pill">Kehidupan Sekolah</span>
                <h1 class="mt-7 text-5xl font-black leading-[0.98] text-white sm:text-6xl lg:text-7xl">
                    Rumah Kedua Bagi Para <span class="text-[#d6a63a]">Pemimpin Masa Depan</span>
                </h1>
                <p class="mt-7 max-w-2xl text-base font-semibold leading-8 text-white/78">Ekosistem pembinaan karakter yang disiplin, religius, dan penuh kekeluargaan.</p>
                <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                    <a href="#asrama" class="gold-button">Jelajahi Asrama</a>
                    <a href="{{ route('ppdb') }}" class="ghost-button">Lihat PPDB</a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto grid max-w-7xl gap-14 px-4 lg:grid-cols-[1fr_0.95fr] lg:items-center lg:px-8">
            <div>
                <h2 class="text-4xl font-black leading-tight text-[#071f3a]">Pembinaan Karakter & Suasana Belajar Kondusif</h2>
                <p class="mt-7 max-w-2xl text-sm font-semibold leading-7 text-[#6b7f91]">Lingkungan asrama kami dirancang untuk meminimalkan distraksi dan memaksimalkan potensi siswa melalui ritme harian yang sehat.</p>
                <div class="mt-9 grid max-w-md grid-cols-2 gap-5">
                    <div class="profile-stat"><strong>24/7</strong><span>Pendampingan Pengasuh</span></div>
                    <div class="profile-stat"><strong>Elite</strong><span>Fasilitas Akademik</span></div>
                </div>
            </div>
            <div class="dorm-study-card"><div class="floating-quote dark">Disiplin adalah jembatan antara tujuan dan pencapaian.</div></div>
        </div>
    </section>

    <section id="asrama" class="bg-[#f6f9fc] py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <p class="eyebrow">Eksplorasi Fasilitas</p>
                <h2 class="mt-3 text-4xl font-black text-[#071f3a]">Kehidupan Asrama yang Dinamis</h2>
                <p class="mt-5 text-sm font-semibold leading-7 text-[#6b7f91]">Lebih dari sekadar tempat tinggal, asrama adalah laboratorium sosial untuk persaudaraan dan kebersamaan.</p>
            </div>
            <div class="dorm-gallery mt-12">
                <div class="facility-tile dorm-room"><span>Kamar Harian Nyaman</span></div>
                <div class="facility-tile court-real"><span>Kegiatan Sore</span></div>
                <div class="facility-tile canteen-real"><span>Gizi Seimbang</span></div>
                <div class="facility-tile night-study"><span>Sesi Belajar Mandiri</span></div>
            </div>
        </div>
    </section>

    <section class="bg-[#071f3a] py-20 text-white">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <p class="eyebrow">Pilar Keunggulan</p>
            <h2 class="mt-3 text-4xl font-black">Nilai & Budaya Sekolah</h2>
            <div class="mt-12 grid gap-8 md:grid-cols-3">
                @foreach ([['Disiplin Semi-Militer', 'Membangun ketangguhan fisik, mental, serta tanggung jawab.'], ['Solidaritas Korsa', 'Rasa kekeluargaan antar angkatan yang kuat.'], ['Keunggulan Etika', 'Mengedepankan sopan santun, tata krama, dan kecerdasan emosional.']] as $value)
                    <article class="dark-value"><span></span><h3>{{ $value[0] }}</h3><p>{{ $value[1] }}</p></article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto max-w-5xl px-4 lg:px-8">
            <div class="text-center"><h2 class="text-4xl font-black text-[#071f3a]">Rutinitas Harian</h2><p class="mt-4 text-sm font-semibold text-[#6b7f91]">Setiap detik di asrama adalah langkah terukur menuju kesuksesan masa depan.</p></div>
            <div class="daily-timeline mt-14">
                @foreach ([['05:00', 'Bangun & Olahraga Pagi'], ['07:30', 'Kegiatan Belajar Mengajar'], ['13:30', 'Eksplorasi Ilmu'], ['16:00', 'Ekstrakurikuler & Bakat']] as $routine)
                    <article class="calendar-card"><span>{{ $routine[0] }}</span><div><h3>{{ $routine[1] }}</h3><p>Pembiasaan yang menjaga disiplin, fokus, dan keseimbangan siswa.</p></div></article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-[#f6f9fc] py-20">
        <div class="mx-auto max-w-6xl px-4 text-center lg:px-8">
            <h2 class="text-4xl font-black text-[#071f3a]">Inspirasi & Kesaksian</h2>
            <div class="mt-10 grid gap-7 md:grid-cols-2">
                <blockquote class="testimonial">Perubahan putra kami sangat signifikan sejak masuk asrama. Ia jauh lebih mandiri, disiplin waktu, dan memiliki sopan santun yang luar biasa.<span>Br. Bambang Wijaya</span></blockquote>
                <blockquote class="testimonial">Asrama SMAN 2 Balige mengajarkan saya arti persahabatan sejati dan perjuangan.<span>Anisa Putri, S.T.</span></blockquote>
            </div>
        </div>
    </section>

    <section class="bg-white px-4 py-20 lg:px-8">
        <div class="cta-panel">
            <p class="eyebrow text-[#d6a63a]">Pendaftaran 2024/2025</p>
            <h2>Mulai Perjalanan Anda Menjadi Pemimpin Dunia</h2>
            <p>Amankan tempat Anda di salah satu institusi pendidikan terbaik dengan komunitas pembelajar berdedikasi.</p>
            <div class="mt-10 flex flex-col justify-center gap-4 sm:flex-row">
                <a href="{{ route('ppdb') }}" class="gold-button">Daftar PPDB Sekarang</a>
                <a href="{{ route('kontak') }}" class="ghost-button">Konsultasi Pendidikan</a>
            </div>
        </div>
    </section>
@endsection
