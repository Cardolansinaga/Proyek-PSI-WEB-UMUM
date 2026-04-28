@extends('layouts.site', ['active' => 'alumni'])

@section('title', 'Alumni & Kemitraan - SMAN 2 Balige')
@section('description', 'Jejaring alumni, profil inspiratif, statistik lulusan, dan kemitraan strategis SMAN 2 Balige.')

@section('content')
    <section class="alumni-hero page-hero">
        <div class="page-hero-overlay"></div>
        <div class="mx-auto max-w-7xl px-4 py-24 sm:py-32 lg:px-8">
            <div class="relative max-w-4xl">
                <span class="section-pill">Komunitas Alumni</span>
                <h1 class="mt-7 max-w-4xl text-5xl font-black leading-[1.02] text-white sm:text-6xl lg:text-7xl">
                    Membangun Warisan, Menginspirasi <span class="text-[#d6a63a]">Masa Depan.</span>
                </h1>
                <p class="mt-7 max-w-2xl text-base font-semibold leading-8 text-white/72">
                    Menghubungkan generasi pemimpin, inovator, dan pemikir yang lahir dari rahim SMAN 2 Balige untuk kontribusi nyata bagi bangsa dan dunia.
                </p>
                <div class="mt-9 flex flex-col gap-4 sm:flex-row">
                    <a class="gold-button" href="#kontribusi">Gabung Jejaring Alumni -></a>
                    <a class="ghost-button" href="#kemitraan">Hubungi Kerja Sama</a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-20 sm:py-24">
        <div class="mx-auto grid max-w-7xl gap-14 px-4 lg:grid-cols-2 lg:items-center lg:px-8">
            <div>
                <h2 class="section-title max-w-xl">Peran Strategis Alumni & Mitra</h2>
                <p class="mt-7 max-w-xl text-sm font-semibold leading-7 text-[#6b7f91]">
                    SMAN 2 Balige percaya bahwa pendidikan tidak berhenti di gerbang sekolah. Alumni kami adalah duta nilai, sementara mitra strategis kami adalah jembatan menuju dunia profesional yang nyata.
                </p>
                <div class="mt-10 grid max-w-md grid-cols-2 gap-8">
                    <div class="big-stat"><strong>5000+</strong><span>Alumni Tersebar</span></div>
                    <div class="big-stat"><strong>50+</strong><span>Mitra Institusi</span></div>
                </div>
            </div>
            <div class="partnership-visual">
                <div class="collab-badge">Kolaborasi<br>Berkelanjutan</div>
            </div>
        </div>
    </section>

    <section class="bg-[#f6f9fc] py-20 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="text-4xl font-black text-[#071f3a] sm:text-5xl">Profil Alumni Inspiratif</h2>
                <p class="mt-5 text-sm font-semibold leading-7 text-[#6b7f91]">Kisah sukses mereka yang mengawali langkah di Balige dan kini mewarnai dunia dengan prestasi luar biasa.</p>
            </div>
            <div class="mt-14 grid gap-8 lg:grid-cols-[1.7fr_0.85fr]">
                <article class="alumni-feature alumni-photo-one">
                    <div>
                        <span>Angkatan 1998</span>
                        <h3>Dr. Johannes Simbolon</h3>
                        <p>Kepala Peneliti Bioteknologi di institusi internasional, pelopor riset ketahanan pangan global.</p>
                    </div>
                </article>
                <div class="grid gap-8">
                    <article class="alumni-small alumni-photo-two">
                        <div><h3>Maria Pangaribuan, MBA</h3><p>CEO Tech Start-up Global</p></div>
                    </article>
                    <article class="alumni-small alumni-photo-three">
                        <div><h3>Ir. Tumpal Siahaan</h3><p>Arsitek Nasional</p></div>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section id="lulusan" class="bg-white py-20">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h2 class="text-3xl font-black text-[#071f3a]">Jejak Lulusan</h2>
                    <p class="mt-3 max-w-2xl text-sm font-semibold text-[#6b7f91]">Lulusan SMAN 2 Balige tersebar di berbagai universitas terbaik di dalam dan luar negeri setiap tahunnya.</p>
                </div>
                <a class="inline-flex w-fit text-sm font-black text-[#071f3a]" href="#lulusan">Lihat Statistik Lengkap -></a>
            </div>
            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="track-card"><span>edu</span><strong>UI & ITB</strong><small>35% lulusan 2023</small></div>
                <div class="track-card"><span>glb</span><strong>Luar Negeri</strong><small>12 mahasiswa aktif</small></div>
                <div class="track-card"><span>gov</span><strong>Kedinasan</strong><small>25 lulusan / tahun</small></div>
                <div class="track-card"><span>tn</span><strong>TNI & Polri</strong><small>Akademi terbaik</small></div>
            </div>
        </div>
    </section>

    <section id="kemitraan" class="bg-[#071f3a] py-20 text-white">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 lg:grid-cols-[1fr_1.1fr] lg:items-center lg:px-8">
            <div>
                <h2 class="text-3xl font-black">Kemitraan Strategis</h2>
                <div class="mt-4 h-1 w-14 rounded-full bg-[#d6a63a]"></div>
                <div class="mt-10 space-y-8">
                    <div class="partner-line"><span>i</span><div><strong>Sinergi Industri</strong><p>Program magang dan kunjungan industri untuk membekali siswa dengan wawasan dunia kerja profesional sejak dini.</p></div></div>
                    <div class="partner-line"><span>g</span><div><strong>Beasiswa Kemitraan</strong><p>Dukungan finansial dari berbagai yayasan dan perusahaan mitra bagi siswa berprestasi dan kurang mampu.</p></div></div>
                </div>
            </div>
            <div class="partner-grid">
                <div></div><div></div><div></div><div></div>
            </div>
        </div>
    </section>

    <section class="bg-white py-20 text-center">
        <div class="mx-auto max-w-4xl px-4 lg:px-8">
            <div class="mx-auto grid h-12 w-12 place-items-center rounded-full bg-[#f2eee4] text-2xl font-black text-[#d6a63a]">"</div>
            <blockquote class="mt-9 text-3xl font-black leading-tight text-[#071f3a] sm:text-4xl">
                "SMAN 2 Balige bukan sekadar sekolah, tapi laboratorium karakter. Disiplin dan daya juang yang saya pelajari di sana menjadi pondasi terkuat saat saya menempuh karir di kancah internasional."
            </blockquote>
            <div class="mx-auto mt-10 h-14 w-14 rounded-full bg-[linear-gradient(135deg,#0b2a4a,#d6a63a)]"></div>
            <p class="mt-4 text-sm font-black text-[#071f3a]">Dr. Andreas Napitupulu</p>
            <p class="mt-1 text-[10px] font-black uppercase tracking-[0.18em] text-[#8ca0b0]">Senior Engineer di Google HQ, San Francisco</p>
        </div>
    </section>

    <section id="kontribusi" class="bg-white px-4 pb-24 lg:px-8">
        <div class="mx-auto grid max-w-7xl gap-8 rounded-[2rem] bg-[#c39a43] px-8 py-14 text-[#071f3a] lg:grid-cols-[1fr_auto] lg:items-center lg:px-20">
            <div>
                <h2 class="max-w-2xl text-4xl font-black leading-none sm:text-5xl">Mari Berkontribusi Kembali.</h2>
                <p class="mt-6 max-w-2xl text-sm font-bold leading-7 text-[#173047]/75">Jadilah bagian dari ekosistem yang terus bertumbuh untuk masa depan pendidikan Indonesia yang lebih gemilang.</p>
            </div>
            <div class="flex flex-col gap-4 sm:flex-row">
                <a class="rounded-2xl bg-[#071f3a] px-7 py-4 text-sm font-black text-white" href="#">Gabung Jejaring</a>
                <a class="rounded-2xl bg-white px-7 py-4 text-sm font-black text-[#071f3a]" href="{{ route('kontak') }}">Hubungi Mitra</a>
            </div>
        </div>
    </section>
@endsection
