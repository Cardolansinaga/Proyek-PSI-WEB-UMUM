@extends('layouts.admin')

@section('title', 'Ringkasan Admin')

@push('styles')
    @vite('resources/css/admin-pages/dashboard.css')
@endpush

@section('content')
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'dashboard'])
    <div class="main-content">
        <main class="content-padding">
            <div class="page-head">
                <div>
                    <h1>Ringkasan Admin</h1>
                    <p>Ringkasan menu untuk mengelola isi website sekolah. Pilih kartu sesuai bagian website yang ingin diperbarui.</p>
                </div>
                <a href="{{ route('home') }}" class="card" style="padding: 12px 18px; font-weight: 900;"><i class="bi bi-box-arrow-up-right" aria-hidden="true"></i> Lihat Situs Publik</a>
            </div>

            @if (session('status'))
                <div class="dashboard-status" role="status">
                    <i class="bi bi-check-circle" aria-hidden="true"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            @if (auth()->user()->must_change_password)
                <section class="password-reminder" role="alert" aria-labelledby="password-reminder-title">
                    <span class="password-reminder-icon"><i class="bi bi-shield-lock" aria-hidden="true"></i></span>
                    <div>
                        <h2 id="password-reminder-title">Segera ganti password awal</h2>
                        <p>Anda sudah dapat menggunakan seluruh menu admin. Demi keamanan akun, ganti password bawaan dengan password pribadi.</p>
                    </div>
                    <a href="{{ route('admin.password.edit') }}">Ganti Password Sekarang <i class="bi bi-arrow-right" aria-hidden="true"></i></a>
                </section>
            @endif

            @include('pages.admin.partials.page-guide', [
                'title' => 'Mulai dari sini',
                'description' => 'Dashboard ini hanya pintu masuk. Data website diubah dari menu-menu di bawah.',
                'items' => [
                    'Klik menu atau kartu yang sesuai dengan bagian website yang ingin diedit.',
                    'Setelah selesai mengubah isi, tekan tombol Simpan pada halaman tersebut.',
                    'Gunakan tombol Lihat Website untuk memastikan hasilnya sudah benar.',
                ],
            ])

            <div class="status-row">
                <div class="status-card"><strong>{{ $stats['posts'] }}</strong><small>Berita tersimpan</small></div>
                <div class="status-card"><strong>{{ $stats['achievements'] }}</strong><small>Prestasi tercatat</small></div>
                <div class="status-card"><strong>{{ $stats['students'] }}</strong><small>Data siswa</small></div>
                <div class="status-card"><strong>{{ $stats['ppdb'] }}</strong><small>Data pendaftar</small></div>
            </div>

            <div class="module-grid">
                <a href="{{ route('admin.beranda') }}" class="card"><span><i class="bi bi-house-door" aria-hidden="true"></i></span><h2>Beranda</h2><p>Profil sekolah, sambutan, galeri, dan tombol PPDB.</p></a>
                <a href="{{ route('admin.posts.index') }}" class="card"><span><i class="bi bi-newspaper" aria-hidden="true"></i></span><h2>Berita</h2><p>Tulis, jadwalkan, terbitkan, dan arsipkan berita resmi sekolah.</p></a>
                <a href="{{ route('prestasi.index') }}" class="card"><span><i class="bi bi-mortarboard" aria-hidden="true"></i></span><h2>Akademik & Prestasi</h2><p>Kurikulum, fasilitas akademik, layanan belajar, dan prestasi siswa.</p></a>
                <a href="{{ route('admin.kesiswaan.index') }}" class="card"><span><i class="bi bi-people" aria-hidden="true"></i></span><h2>Kesiswaan & Ekstrakurikuler</h2><p>OSIS, MPK, agenda kesiswaan, pembinaan karakter, dan ekstrakurikuler.</p></a>
                <a href="{{ route('admin.ppdb') }}" class="card"><span><i class="bi bi-journal-check" aria-hidden="true"></i></span><h2>PPDB</h2><p>Informasi penerimaan, jadwal, dokumen, dan verifikasi pendaftar.</p></a>
                <a href="{{ route('admin.galeri') }}" class="card"><span><i class="bi bi-images" aria-hidden="true"></i></span><h2>Galeri</h2><p>Foto sekolah, media publik, dan visual yang tampil di Beranda.</p></a>
                <a href="{{ route('admin.pengaturan') }}" class="card"><span><i class="bi bi-gear" aria-hidden="true"></i></span><h2>Pengaturan Situs</h2><p>Identitas sekolah, kontak resmi, status situs, dan akun admin.</p></a>
            </div>
        </main>
    </div>
</div>
@endsection
