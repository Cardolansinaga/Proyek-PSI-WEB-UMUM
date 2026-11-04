@extends('layouts.admin')

@section('title', 'Kelola PPDB')

@push('styles')
    @vite('resources/css/admin-pages/ppdb.css')
@endpush

@section('content')
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'ppdb'])
    <div class="main-content">
        <main class="content-padding">
            @php
                $decodeAdminJson = function (string $key) use ($settings): array {
                    $decoded = json_decode($settings[$key] ?? '', true);

                    return is_array($decoded) ? $decoded : [];
                };
                $stageSchedules = $decodeAdminJson('ppdb_stage_schedule_json');
                $schoolPhone = $settings['school_phone'] ?? '0812-7492-3186';
            @endphp
            <div class="page-head">
                <div>
                    <h1>Kelola PPDB</h1>
                    <p style="margin-top:8px; color:#64748b; font-size:14px;">Kelola informasi SPMB sekolah yang ditampilkan pada halaman publik.</p>
                    @if (session('status'))
                        <p style="margin-top:12px; color:#166534; font-weight:900; padding:10px 12px; background:#dcfce7; border-radius:8px; display:inline-block; font-size:13px;"><i class="bi bi-check-circle-fill" aria-hidden="true"></i> {{ session('status') }}</p>
                    @endif
                </div>
                <div class="page-actions" style="display:flex; gap:10px; flex-wrap:wrap;">
                    <a href="{{ route('ppdb') }}" class="btn-outline"><i class="bi bi-box-arrow-up-right" aria-hidden="true"></i> Lihat Publik</a>
                    <a href="{{ route('admin.pengaturan') }}" class="btn-primary"><i class="bi bi-sliders" aria-hidden="true"></i> Edit Info SPMB</a>
                </div>
            </div>

            @include('pages.admin.partials.page-guide', [
                'title' => 'Cara mengelola PPDB',
                'description' => 'Halaman ini merangkum informasi SPMB yang dikelola sekolah. Pendaftaran dan status calon murid dikelola melalui sistem resmi pemerintah.',
                'items' => [
                    'Klik Edit Info SPMB untuk mengubah jadwal, daya tampung, kontak, dan syarat PPDB.',
                    'Gunakan Lihat Publik untuk memastikan informasi PPDB sudah mudah dibaca.',
                ],
            ])

            <section class="ppdb-admin-overview">
                <article class="ppdb-admin-panel">
                    <h2><i class="bi bi-info-circle" aria-hidden="true"></i> Informasi SPMB Aktif</h2>
                    <p>Satu sumber data untuk halaman PPDB publik. Nomor sekolah mengikuti poster resmi SPMB.</p>
                    <div class="ppdb-summary-list">
                        <div><span>Tahun Pelajaran</span><strong>{{ $settings['ppdb_year'] ?? '2026/2027' }}</strong></div>
                        <div><span>Status</span><strong>{{ $settings['ppdb_status'] ?? 'SPMB Sumut 2026' }}</strong></div>
                        <div><span>Daya Tampung</span><strong>6 rombel x 36 = 216 orang</strong></div>
                        <div><span>Nomor Sekolah</span><strong>{{ $schoolPhone }}</strong></div>
                        <div><span>Aplikasi</span><strong>{{ $settings['ppdb_app_url'] ?? 'https://spmbsumutberkah.disdik.sumutprov.go.id' }}</strong></div>
                    </div>
                </article>
                <article class="ppdb-admin-panel">
                    <h2><i class="bi bi-calendar-event" aria-hidden="true"></i> Jadwal Resmi</h2>
                    <p>Jadwal ini tampil di PPDB umum dan diedit melalui Pengaturan Admin.</p>
                    <div class="ppdb-stage-summary">
                        @foreach ($stageSchedules as $stage)
                            <article>
                                <h3>{{ $stage['stage'] ?? '' }} - {{ $stage['track'] ?? '' }}</h3>
                                <ul>
                                    @foreach (($stage['items'] ?? []) as $item)
                                        <li><span>{{ $item['label'] ?? '' }}</span><strong>{{ $item['date'] ?? '' }}</strong></li>
                                    @endforeach
                                </ul>
                            </article>
                        @endforeach
                    </div>
                </article>
            </section>

            <aside class="ppdb-admin-note" role="note">
                <i class="bi bi-info-circle" aria-hidden="true"></i>
                <p><strong>Pendaftaran dan verifikasi calon murid</strong><br>Data pendaftar tidak dikelola di panel ini. Arahkan calon murid ke aplikasi SPMB resmi pemerintah untuk mendaftar dan memeriksa status.</p>
                <a href="{{ $settings['ppdb_app_url'] ?? 'https://spmbsumutberkah.disdik.sumutprov.go.id' }}" target="_blank" rel="noopener">Buka aplikasi resmi <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i></a>
            </aside>
        </main>
    </div>
</div>
@endsection
