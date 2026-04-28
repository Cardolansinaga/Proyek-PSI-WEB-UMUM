@extends('layouts.site', ['active' => 'kontak'])

@section('title', 'Kontak & FAQ - SMAN 2 Balige')
@section('description', 'Kontak, layanan informasi, pesan elektronik, peta, media sosial, dan FAQ SMAN 2 Balige.')

@section('content')
    <section class="contact-hero page-hero">
        <div class="page-hero-overlay"></div>
        <div class="mx-auto max-w-7xl px-4 py-24 sm:py-32 lg:px-8">
            <div class="relative max-w-4xl">
                <span class="section-pill">Hubungi Kami</span>
                <h1 class="mt-7 text-5xl font-black leading-[0.98] text-white sm:text-6xl lg:text-7xl">
                    Terhubung dengan <span class="text-[#d6a63a]">Ekselerasi Pendidikan</span>
                </h1>
                <p class="mt-7 max-w-2xl text-base font-semibold leading-8 text-white/72 sm:text-lg">
                    Kami berdedikasi untuk memberikan layanan informasi terbaik bagi calon siswa, orang tua, dan alumni SMAN 2 Balige.
                </p>
            </div>
        </div>
    </section>

    <section class="bg-[#f6f9fc] py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="grid gap-8 md:grid-cols-3">
                <article class="info-card">
                    <span class="round-icon">pin</span>
                    <h2>Lokasi Kampus</h2>
                    <p>Jl. Sopo Surung, Kec. Balige, Kab. Toba, Sumatera Utara, 22312</p>
                    <a href="#peta">Petunjuk Arah -></a>
                </article>
                <article class="info-card">
                    <span class="round-icon">?</span>
                    <h2>Layanan Kontak</h2>
                    <dl>
                        <div><dt>Telp:</dt><dd>(0632) 21xxx</dd></div>
                        <div><dt>Email:</dt><dd>info@sman2balige.sch.id</dd></div>
                    </dl>
                </article>
                <article class="info-card">
                    <span class="round-icon">clk</span>
                    <h2>Jam Operasional</h2>
                    <dl>
                        <div><dt>Senin - Kamis</dt><dd>07:30 - 15:30</dd></div>
                        <div><dt>Jumat</dt><dd>07:30 - 16:00</dd></div>
                        <div><dt>Sabtu - Minggu</dt><dd class="text-red-500">Tutup</dd></div>
                    </dl>
                </article>
            </div>

            <div class="mt-24 grid gap-12 lg:grid-cols-[1.1fr_0.8fr] lg:items-start">
                <section class="message-panel">
                    <h2>Kirim Pesan Elektronik</h2>
                    <p>Sampaikan pertanyaan atau masukan Anda. Kami akan merespons melalui alamat email yang Anda lampirkan.</p>
                    <form class="mt-10 grid gap-6">
                        <div class="grid gap-6 sm:grid-cols-2">
                            <label class="form-field">
                                <span>Nama Lengkap</span>
                                <input type="text" placeholder="Contoh: Budi Santoso">
                            </label>
                            <label class="form-field">
                                <span>Email Aktif</span>
                                <input type="email" placeholder="budi@example.com">
                            </label>
                        </div>
                        <label class="form-field">
                            <span>Kategori Pesan</span>
                            <select>
                                <option>Informasi PPDB</option>
                                <option>Akademik</option>
                                <option>Kerja Sama</option>
                                <option>Alumni</option>
                            </select>
                        </label>
                        <label class="form-field">
                            <span>Isi Pesan</span>
                            <textarea rows="7" placeholder="Tuliskan pesan Anda secara detail di sini..."></textarea>
                        </label>
                        <button class="primary-wide" type="button">Kirim Pesan -></button>
                    </form>
                </section>

                <aside class="space-y-12">
                    <div id="peta" class="map-card">
                        <div class="map-pin">
                            <span>S2</span>
                            <strong>SMAN 2 Balige</strong>
                            <small>Jl. Sopo Surung, Balige</small>
                            <a href="#">Buka Google Maps</a>
                        </div>
                    </div>
                    <div>
                        <h2 class="mini-heading">Media Sosial Resmi</h2>
                        <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2">
                            <a class="social-card" href="#"><span>f</span>Facebook</a>
                            <a class="social-card" href="#"><span>ig</span>Instagram</a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <section class="bg-[#f6f9fc] py-20">
        <div class="mx-auto max-w-4xl px-4 text-center lg:px-8">
            <p class="eyebrow">Pusat Bantuan</p>
            <h2 class="mt-3 text-4xl font-black text-[#071f3a] sm:text-5xl">Informasi Umum</h2>
            <div class="mt-14 space-y-5 text-left">
                <details class="faq-item" open>
                    <summary>Kapan jadwal pendaftaran PPDB resmi dibuka?</summary>
                    <p>Pendaftaran PPDB di SMAN 2 Balige biasanya mengikuti kalender pendidikan Provinsi Sumatera Utara, sekitar bulan Mei hingga Juni. Informasi terkini akan diumumkan melalui website dan media sosial kami.</p>
                </details>
                <details class="faq-item">
                    <summary>Bagaimana fasilitas asrama bagi siswa luar kota?</summary>
                    <p>Sekolah menyediakan pendampingan informasi hunian sekitar kampus dan koordinasi dengan orang tua untuk memastikan siswa luar kota memiliki lingkungan tinggal yang aman.</p>
                </details>
            </div>
        </div>
    </section>

    <section class="bg-[#f6f9fc] px-4 pb-24 lg:px-8">
        <div class="mx-auto max-w-7xl rounded-[2rem] bg-[#071f3a] px-8 py-16 text-center shadow-2xl shadow-[#071f3a]/15">
            <h2 class="text-4xl font-black text-white sm:text-5xl">Mulai Perjalanan Akademik Anda</h2>
            <div class="mt-9 flex flex-col justify-center gap-4 sm:flex-row">
                <a class="gold-button" href="{{ route('home') }}#ppdb">Daftar PPDB Sekarang -></a>
                <a class="ghost-button" href="{{ route('guru') }}">Eksplorasi Program</a>
            </div>
        </div>
    </section>
@endsection
