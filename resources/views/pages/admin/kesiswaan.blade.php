@extends('layouts.admin')

@section('title', 'Kelola Kesiswaan & Ekstrakurikuler')

@push('styles')
    @vite('resources/css/admin-pages/kesiswaan.css')
@endpush

@section('content')
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'kesiswaan'])
    <div class="main-content">
        <main class="content-padding">
            <div class="page-head">
                <div>
                    <h1>Kelola Kesiswaan & Ekstrakurikuler</h1>
                    <p>Kelola organisasi siswa, kegiatan pembinaan, dan ekstrakurikuler yang tampil di halaman publik.</p>
                    @if (session('status'))
                        <p class="status-message"><i class="bi bi-check-circle-fill" aria-hidden="true"></i> {{ session('status') }}</p>
                    @endif
                </div>
                <div class="actions">
                    <a href="{{ route('kesiswaan') }}" class="btn-light"><i class="bi bi-box-arrow-up-right" aria-hidden="true"></i> Lihat Publik</a>
                    <a href="{{ route('admin.kesiswaan.create') }}" class="btn-primary"><i class="bi bi-plus-circle" aria-hidden="true"></i> Tambah Data</a>
                </div>
            </div>

            @include('pages.admin.partials.page-guide', [
                'title' => 'Cara mengelola kegiatan siswa',
                'description' => 'Halaman ini dipakai untuk memperbarui daftar organisasi, ekstrakurikuler, pembina, dan jadwal kegiatan.',
                'items' => [
                    'Klik Tambah Data jika ada organisasi atau ekstrakurikuler baru.',
                    'Klik Edit untuk mengganti pembina, jadwal, lokasi, foto, atau deskripsi.',
                    'Pastikan statusnya Tampil jika ingin muncul di website publik.',
                ],
            ])

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label"><i class="bi bi-bar-chart" aria-hidden="true"></i> Total Data</div>
                    <div class="stat-value">{{ $activities->count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label"><i class="bi bi-people" aria-hidden="true"></i> Organisasi</div>
                    <div class="stat-value">{{ $activities->where('type', 'Organisasi Siswa')->count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label"><i class="bi bi-stars" aria-hidden="true"></i> Ekstrakurikuler</div>
                    <div class="stat-value">{{ $activities->where('type', '!=', 'Organisasi Siswa')->count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label"><i class="bi bi-eye" aria-hidden="true"></i> Tampil Publik</div>
                    <div class="stat-value">{{ $activities->where('is_published', true)->count() }}</div>
                </div>
            </div>

            <section class="card">
                <h2 style="color:#071f3a; font-size:20px; font-weight:900;">Daftar Kegiatan</h2>
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tipe</th>
                                <th>Pembina</th>
                                <th>Jadwal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($activities as $activity)
                            <tr>
                                <td>
                                    <strong>{{ $activity->name }}</strong>
                                    <div style="margin-top:4px; color:#64748b; font-size:12px;">{{ \Illuminate\Support\Str::limit($activity->description, 90) }}</div>
                                </td>
                                <td>{{ $activity->type }}</td>
                                <td>{{ $activity->mentor ?: $activity->coordinator ?: '-' }}</td>
                                <td>
                                    {{ $activity->schedule ?: '-' }}
                                    <div style="margin-top:4px; color:#94a3b8; font-size:12px;">{{ $activity->location ?: '' }}</div>
                                </td>
                                <td>
                                    <span class="badge {{ $activity->is_published ? '' : 'badge-muted' }}">
                                        {{ $activity->is_published ? 'Tampil di Website' : 'Belum Tampil' }}
                                    </span>
                                </td>
                                <td>
                                    <a class="btn-light" href="{{ route('admin.kesiswaan.edit', $activity) }}"><i class="bi bi-pencil-square" aria-hidden="true"></i> Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Belum ada data kesiswaan.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</div>
@endsection
