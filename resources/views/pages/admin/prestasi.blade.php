@extends('layouts.admin')

@section('title', 'Kelola Akademik & Prestasi')

@push('styles')
    @vite('resources/css/admin-pages/prestasi.css')
@endpush

@section('content')
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'prestasi'])
    <div class="main-content">
        <main class="content-padding">
            <div class="page-head">
                <div>
                    <h1>Kelola Akademik & Prestasi</h1>
                    <p>Tambah, ubah, atau hapus prestasi siswa yang tampil pada halaman Akademik & Prestasi publik.</p>
                    @if (session('status'))
                        <p style="color:#166534; font-weight:900;">{{ session('status') }}</p>
                    @endif
                </div>
                <div style="display:flex; gap:12px; flex-wrap:wrap;">
                    <a href="{{ route('akademik') }}#prestasi" class="btn-light"><i class="bi bi-box-arrow-up-right" aria-hidden="true"></i> Lihat Publik</a>
                    <a href="{{ route('prestasi.create') }}" class="btn-add"><i class="bi bi-plus-circle" aria-hidden="true"></i> Tambah Prestasi</a>
                </div>
            </div>

            @include('pages.admin.partials.page-guide', [
                'title' => 'Cara mengelola prestasi',
                'description' => 'Data yang berstatus tampil akan muncul di halaman publik dan dapat dilihat oleh siswa, orang tua, serta mitra.',
                'items' => [
                    'Klik Tambah Prestasi untuk memasukkan prestasi baru.',
                    'Klik Edit untuk memperbaiki data prestasi yang sudah ada.',
                    'Gunakan Hapus hanya jika data memang tidak perlu tampil lagi.',
                ],
            ])

            <div class="stats-grid">
                <div class="stat-card total"><div class="stat-label"><i class="bi bi-bar-chart" aria-hidden="true"></i> Total Prestasi</div><div class="stat-value">{{ $achievements->count() }}</div></div>
                <div class="stat-card international"><div class="stat-label"><i class="bi bi-globe2" aria-hidden="true"></i> Internasional</div><div class="stat-value">{{ $achievements->where('level', 'Internasional')->count() }}</div></div>
                <div class="stat-card featured"><div class="stat-label"><i class="bi bi-star-fill" aria-hidden="true"></i> Unggulan</div><div class="stat-value">{{ $achievements->where('is_featured', true)->count() }}</div></div>
                <div class="stat-card draft"><div class="stat-label"><i class="bi bi-file-earmark-text" aria-hidden="true"></i> Belum Tampil</div><div class="stat-value">{{ $achievements->where('status', '!=', 'published')->count() }}</div></div>
            </div>

            <section class="card">
                <h2>Riwayat Prestasi</h2>
                <table class="data-table">
                    <thead><tr><th>Nama Siswa / Tim</th><th>Kompetisi</th><th>Level</th><th>Peringkat</th><th>Aksi</th></tr></thead>
                    <tbody>
                    @forelse ($achievements as $achievement)
                        <tr>
                            <td style="font-weight:900;">{{ $achievement->student_name ?? 'Tim Sekolah' }}<br><span style="font-weight:500; color:#94a3b8; font-size:11px;">{{ $achievement->class_name ?? $achievement->year }}</span></td>
                            <td>{{ $achievement->title }}<br><span style="font-size:11px; color:#94a3b8;">{{ $achievement->competition }}</span></td>
                            <td><span class="badge">{{ $achievement->level }}</span></td>
                            <td style="font-weight:900; color:#c59632;">{{ $achievement->rank }}</td>
                            <td>
                                <div style="display:flex; gap:8px; flex-wrap:wrap;">
                                    <a class="btn-light" href="{{ route('prestasi.edit', $achievement) }}"><i class="bi bi-pencil-square" aria-hidden="true"></i> Edit</a>
                                    <form method="POST" action="{{ route('admin.prestasi.destroy', $achievement) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-danger" type="submit" onclick="return confirm('Hapus prestasi ini?')"><i class="bi bi-trash" aria-hidden="true"></i> Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5">Belum ada data prestasi.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</div>
@endsection
