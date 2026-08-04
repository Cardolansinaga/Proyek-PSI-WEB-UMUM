@extends('layouts.admin')

@section('title', 'Detail PPDB')

@push('styles')
    @vite('resources/css/admin-pages/detail-ppdb.css')
@endpush

@section('content')
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'ppdb'])
    <div class="main-content">
        <main class="content-padding">
            <div class="page-head">
                <div>
                    <h1>Detail Pendaftar PPDB</h1>
                    <p>Periksa data calon siswa, kelengkapan berkas, dan status verifikasi pendaftaran.</p>
                </div>
                <a href="{{ route('admin.ppdb') }}" class="btn-outline"><i class="bi bi-arrow-left" aria-hidden="true"></i> Kembali ke PPDB</a>
            </div>

            @include('pages.admin.partials.page-guide', [
                'title' => 'Panduan verifikasi pendaftar',
                'description' => 'Gunakan halaman ini untuk mengecek satu pendaftar sebelum menentukan statusnya.',
                'items' => [
                    'Periksa nama, nomor kontak, jalur pendaftaran, asal sekolah, dan alamat.',
                    'Cek kelengkapan berkas sebelum menekan tombol verifikasi.',
                    'Pilih Minta Revisi Berkas jika data masih perlu diperbaiki oleh pendaftar.',
                ],
            ])

            <div class="grid">
                <section class="card">
                    <h2><i class="bi bi-person-vcard" aria-hidden="true"></i> Data Calon Siswa</h2>
                    <div class="info-grid">
                        <div class="info"><span>No. Registrasi</span><strong>{{ $application->registration_number }}</strong></div>
                        <div class="info"><span>Status</span><strong>{{ ucfirst($application->status) }}</strong></div>
                        <div class="info"><span>Nama Lengkap</span><strong>{{ $application->full_name }}</strong></div>
                        <div class="info"><span>Jalur Pendaftaran</span><strong>{{ $application->pathway }}</strong></div>
                        <div class="info"><span>Asal Sekolah</span><strong>{{ $application->origin_school }}</strong></div>
                        <div class="info"><span>Nomor Kontak</span><strong>{{ $application->phone }}</strong></div>
                        <div class="info"><span>Nama Orang Tua</span><strong>{{ $application->parent_name }}</strong></div>
                        <div class="info"><span>Alamat</span><strong>{{ $application->address }}</strong></div>
                    </div>
                </section>

                <aside class="card">
                    <h2><i class="bi bi-shield-check" aria-hidden="true"></i> Aksi Verifikasi</h2>
                    <form method="POST" action="{{ route('admin.ppdb.verify', $application) }}" style="display: grid; gap: 12px;">
                        @csrf
                        <button type="submit" name="status" value="verified" class="btn-primary"><i class="bi bi-check-circle" aria-hidden="true"></i> Terverifikasi</button>
                        <button type="submit" name="status" value="revision" class="btn-outline"><i class="bi bi-arrow-repeat" aria-hidden="true"></i> Minta Revisi Berkas</button>
                        <button type="submit" name="status" value="rejected" class="btn-danger"><i class="bi bi-x-circle" aria-hidden="true"></i> Tolak Pendaftaran</button>
                    </form>
                </aside>

                <section class="card" style="grid-column: 1 / -1;">
                    <h2><i class="bi bi-folder-check" aria-hidden="true"></i> Kelengkapan Berkas</h2>
                    @foreach (($application->documents ?? []) as $document => $isComplete)
                        <div class="doc-row"><strong>{{ $document }}</strong><span class="badge" style="{{ $isComplete ? '' : 'background:#fee2e2;color:#991b1b;' }}">{{ $isComplete ? 'Lengkap' : 'Belum Lengkap' }}</span></div>
                    @endforeach
                </section>
            </div>
        </main>
    </div>
</div>
@endsection
