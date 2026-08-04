@extends('layouts.admin')

@section('title', '{{ ($mode ?? \'create\') === \'edit\' ? \'Edit Prestasi\' : \'Tambah Prestasi\' }}')

@push('styles')
    @vite('resources/css/admin-pages/tambah-prestasi.css')
@endpush

@section('content')
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'prestasi'])
    <div class="main-content">
        <main class="content-padding">
            @php($isEdit = ($mode ?? 'create') === 'edit')
            <form id="achievement-form" method="POST" action="{{ $isEdit ? route('admin.prestasi.update', $achievement) : route('admin.prestasi.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="page-head" style="display:flex; justify-content:space-between; gap:20px; align-items:flex-start; margin-bottom:32px;">
                    <div>
                        <h1 style="font-size:36px; font-weight:900; color:#071f3a;">{{ $isEdit ? 'Edit Prestasi' : 'Tambah Prestasi' }}</h1>
                        <p style="color:#64748b; margin-top:8px;">Isi data prestasi siswa atau tim. Data akan tampil di website jika statusnya dipilih tampil.</p>
                    </div>
                    <div class="page-actions" style="display:flex; gap:12px;">
                        <a href="{{ route('prestasi.index') }}" class="btn-cancel"><i class="bi bi-x-circle" aria-hidden="true"></i> Batal</a>
                        <button class="btn-save" type="submit"><i class="bi bi-save" aria-hidden="true"></i> Simpan Data</button>
                    </div>
                </div>

                @include('pages.admin.partials.page-guide', [
                    'title' => $isEdit ? 'Panduan edit prestasi' : 'Panduan tambah prestasi',
                    'description' => 'Gunakan kalimat singkat agar prestasi mudah dipahami pengunjung website.',
                    'items' => [
                        'Nama prestasi atau lomba wajib diisi.',
                        'Pilih status Tampil di Website jika data sudah siap dilihat publik.',
                        'Centang prestasi unggulan hanya untuk prestasi yang ingin ditonjolkan.',
                    ],
                ])

                <div class="form-grid">
                    <section class="card">
                        <h2 style="font-size:18px; font-weight:900; color:#071f3a; margin-bottom:24px;"><i class="bi bi-trophy" aria-hidden="true"></i> Informasi Utama</h2>
                        <div class="input-group">
                            <label>Nama Prestasi / Nama Lomba</label>
                            <input name="title" class="custom-input" value="{{ old('title', $achievement->title) }}" required>
                        </div>
                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                            <div class="input-group">
                                <label>Tingkat Prestasi</label>
                                <select name="level" class="custom-input">
                                    @foreach (['Sekolah', 'Kabupaten', 'Provinsi', 'Nasional', 'Internasional'] as $level)
                                        <option value="{{ $level }}" @selected(old('level', $achievement->level) === $level)>{{ $level }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group">
                                <label>Tahun Perolehan</label>
                                <input type="number" name="year" class="custom-input" value="{{ old('year', $achievement->year ?? now()->year) }}" required>
                            </div>
                        </div>
                        <div class="input-group">
                            <label>Nama Siswa atau Tim</label>
                            <input name="student_name" class="custom-input" value="{{ old('student_name', $achievement->student_name) }}">
                        </div>
                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                            <div class="input-group">
                                <label>Kelas</label>
                                <input name="class_name" class="custom-input" value="{{ old('class_name', $achievement->class_name) }}">
                            </div>
                            <div class="input-group">
                                <label>Peringkat</label>
                                <input name="rank" class="custom-input" value="{{ old('rank', $achievement->rank) }}">
                            </div>
                        </div>
                        <div class="input-group">
                            <label>Kompetisi</label>
                            <input name="competition" class="custom-input" value="{{ old('competition', $achievement->competition) }}">
                        </div>
                        <div class="input-group">
                            <label>Deskripsi & Narasi</label>
                            <textarea name="description" class="custom-textarea">{{ old('description', $achievement->description) }}</textarea>
                        </div>
                    </section>

                    <aside class="card">
                        <h2 style="font-size:18px; font-weight:900; color:#071f3a; margin-bottom:24px;"><i class="bi bi-broadcast" aria-hidden="true"></i> Publikasi</h2>
                        <div class="input-group">
                            <label>Status</label>
                            <select name="status" class="custom-input">
                                <option value="published" @selected(old('status', $achievement->status) === 'published')>Tampil di Website</option>
                                <option value="draft" @selected(old('status', $achievement->status) === 'draft')>Simpan Dulu, Belum Tampil</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Pilihan Ilustrasi Bawaan</label>
                            <select name="image_class" class="custom-input">
                                @foreach (['victory', 'speech', 'runner', 'dance'] as $visual)
                                    <option value="{{ $visual }}" @selected(old('image_class', $achievement->image_class) === $visual)>{{ ucfirst($visual) }}</option>
                                @endforeach
                            </select>
                            <p class="field-help">Dipakai jika belum ada gambar prestasi yang diunggah.</p>
                        </div>
                        <div class="input-group">
                            <label>Gambar Prestasi</label>
                            @if (! empty($achievement->image_path))
                                <div class="image-preview" style="background-image: url('{{ asset('storage/'.$achievement->image_path) }}');"></div>
                                <label class="check-row">
                                    <input type="checkbox" name="remove_image" value="1">
                                    Hapus gambar custom
                                </label>
                            @else
                                <div class="image-preview">Belum ada gambar custom</div>
                            @endif
                            <input type="file" name="image" class="custom-input" accept="image/png,image/jpeg,image/webp">
                        </div>
                        <label style="display:flex; gap:10px; align-items:center; font-weight:900; color:#071f3a;">
                            <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $achievement->is_featured))>
                            Tampilkan sebagai prestasi unggulan
                        </label>
                    </aside>
                </div>
            </form>
        </main>
    </div>
</div>
@endsection
