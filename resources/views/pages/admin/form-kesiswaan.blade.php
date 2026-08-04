@extends('layouts.admin')

@section('title', '{{ ($mode ?? \'create\') === \'edit\' ? \'Edit Kesiswaan\' : \'Tambah Kesiswaan\' }}')

@push('styles')
    @vite('resources/css/admin-pages/form-kesiswaan.css')
@endpush

@section('content')
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'kesiswaan'])
    <div class="main-content">
        <main class="content-padding">
            @php($isEdit = ($mode ?? 'create') === 'edit')
            <div class="page-head">
                <div>
                    <h1>{{ $isEdit ? 'Edit Data Kesiswaan' : 'Tambah Data Kesiswaan' }}</h1>
                    <p>Kelola organisasi siswa, ekstrakurikuler, pembina, jadwal latihan, dan status publikasi.</p>
                </div>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <a href="{{ route('admin.kesiswaan.index') }}" class="btn-outline"><i class="bi bi-arrow-left" aria-hidden="true"></i> Kembali</a>
                    <button type="submit" form="kesiswaan-form" class="btn-primary"><i class="bi bi-save" aria-hidden="true"></i> Simpan Data</button>
                </div>
            </div>

            @include('pages.admin.partials.page-guide', [
                'title' => $isEdit ? 'Panduan edit kegiatan' : 'Panduan tambah kegiatan',
                'description' => 'Isi data yang benar-benar dibutuhkan pengunjung: nama kegiatan, pembina, jadwal, lokasi, dan deskripsi singkat.',
                'items' => [
                    'Gunakan nama kegiatan yang mudah dikenali, misalnya OSIS, Basket, atau Paduan Suara.',
                    'Pilih Ya, tampilkan jika kegiatan sudah siap muncul di website.',
                    'Upload foto kegiatan jika ada; jika tidak, website tetap memakai visual bawaan.',
                ],
            ])

            <form id="kesiswaan-form" method="POST" action="{{ $isEdit ? route('admin.kesiswaan.update', $activity) : route('admin.kesiswaan.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-grid">
                    <section class="card">
                        <h2 style="font-size: 18px; color: #071f3a; margin-bottom: 18px;"><i class="bi bi-clipboard-data" aria-hidden="true"></i> Informasi Kegiatan</h2>
                        <div class="field-grid">
                            <div class="input-group">
                                <label>Nama Organisasi / Ekstrakurikuler</label>
                                <input class="custom-input" name="name" value="{{ old('name', $activity->name) }}" placeholder="Contoh: OSIS, MPK, Basket, Paduan Suara" required>
                            </div>
                            <div class="input-group">
                                <label>Jenis Kegiatan</label>
                                <select class="custom-select" name="type">
                                    @foreach (['Organisasi Siswa', 'Ekstrakurikuler Akademik', 'Ekstrakurikuler Olahraga', 'Ekstrakurikuler Seni'] as $type)
                                        <option value="{{ $type }}" @selected(old('type', $activity->type) === $type)>{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group">
                                <label>Ketua / Koordinator</label>
                                <input class="custom-input" name="coordinator" value="{{ old('coordinator', $activity->coordinator) }}" placeholder="Nama ketua atau koordinator siswa">
                            </div>
                            <div class="input-group">
                                <label>Pembina</label>
                                <input class="custom-input" name="mentor" value="{{ old('mentor', $activity->mentor) }}" placeholder="Nama guru pembina">
                            </div>
                            <div class="input-group">
                                <label>Jadwal Rutin</label>
                                <input class="custom-input" name="schedule" value="{{ old('schedule', $activity->schedule) }}" placeholder="Contoh: Jumat, 15.30 WIB">
                            </div>
                            <div class="input-group">
                                <label>Lokasi</label>
                                <input class="custom-input" name="location" value="{{ old('location', $activity->location) }}" placeholder="Contoh: Aula, Lapangan, Lab Bahasa">
                            </div>
                        </div>
                        <div class="input-group">
                            <label>Deskripsi Singkat</label>
                            <textarea class="custom-textarea" name="description" placeholder="Jelaskan tujuan, aktivitas utama, dan manfaat kegiatan bagi siswa.">{{ old('description', $activity->description) }}</textarea>
                        </div>
                    </section>
                    <aside class="card">
                        <h2 style="font-size: 18px; color: #071f3a; margin-bottom: 18px;"><i class="bi bi-broadcast" aria-hidden="true"></i> Publikasi</h2>
                        <div class="input-group">
                            <label>Status</label>
                            <select class="custom-select" name="status">
                                <option value="Aktif" @selected(old('status', $activity->status) === 'Aktif')>Aktif</option>
                                <option value="Draft" @selected(old('status', $activity->status) === 'Draft')>Simpan Dulu, Belum Tampil</option>
                                <option value="Arsip" @selected(old('status', $activity->status) === 'Arsip')>Arsip</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Tampilkan di Website</label>
                            <select class="custom-select" name="publish">
                                <option @selected(old('publish', $activity->is_published ? 'Ya, tampilkan' : 'Tidak, simpan internal') === 'Ya, tampilkan')>Ya, tampilkan</option>
                                <option @selected(old('publish', $activity->is_published ? 'Ya, tampilkan' : 'Tidak, simpan internal') === 'Tidak, simpan internal')>Tidak, simpan internal</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Foto Kegiatan</label>
                            @if (! empty($activity->image_path))
                                <div class="image-preview" style="background-image: url('{{ asset('storage/'.$activity->image_path) }}');"></div>
                                <label class="check-row">
                                    <input type="checkbox" name="remove_image" value="1">
                                    Hapus gambar custom
                                </label>
                            @else
                                <div class="image-preview">Belum ada gambar custom</div>
                            @endif
                            <input type="file" class="custom-input" name="image" accept="image/png,image/jpeg,image/webp">
                        </div>
                        <div style="display: flex; gap: 10px; margin-top: 22px;">
                            <a href="{{ route('admin.kesiswaan.index') }}" class="btn-outline"><i class="bi bi-x-circle" aria-hidden="true"></i> Batal</a>
                            <button type="submit" class="btn-primary"><i class="bi bi-save" aria-hidden="true"></i> Simpan</button>
                        </div>
                    </aside>
                </div>
            </form>
        </main>
    </div>
</div>
@endsection
