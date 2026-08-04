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
                    <p style="margin-top:8px; color:#64748b; font-size:14px;">Pantau pendaftar, verifikasi berkas, serta informasi SPMB yang tampil di halaman publik.</p>
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
                'description' => 'Halaman ini menampilkan ringkasan SPMB dan daftar pendaftar yang masuk ke admin.',
                'items' => [
                    'Klik Edit Info SPMB untuk mengubah jadwal, daya tampung, kontak, dan syarat PPDB.',
                    'Klik Detail pada pendaftar untuk melihat data dan menentukan status verifikasi.',
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

            <div class="card">
                <h2>Pendaftar Terbaru</h2>
                <table class="data-table">
                    <thead><tr><th>No. Registrasi</th><th>Nama</th><th>Jalur</th><th>Asal Sekolah</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                    @forelse ($applications as $application)
                        @php
                            $statusMap = [
                                'waiting' => ['Menunggu', '#fef3c7', '#92400e'],
                                'verified' => ['Terverifikasi', '#dcfce7', '#166534'],
                                'revision' => ['Revisi', '#ffedd5', '#9a3412'],
                                'rejected' => ['Ditolak', '#fee2e2', '#991b1b'],
                            ];
                            $status = $statusMap[$application->status] ?? $statusMap['waiting'];
                        @endphp
                        <tr>
                            <td style="font-weight:900;">{{ $application->registration_number }}</td>
                            <td>{{ $application->full_name }}</td>
                            <td>{{ $application->pathway }}</td>
                            <td>{{ $application->origin_school }}</td>
                            <td><span class="badge" style="background:{{ $status[1] }}; color:{{ $status[2] }};">{{ $status[0] }}</span></td>
                            <td><a href="{{ route('admin.ppdb.show', $application) }}" style="color:#071f3a; font-weight:900; text-decoration:none;"><i class="bi bi-eye" aria-hidden="true"></i> Detail</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="6">Belum ada pendaftar PPDB.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
@endsection
