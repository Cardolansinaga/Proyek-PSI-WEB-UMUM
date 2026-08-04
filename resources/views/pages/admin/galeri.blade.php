@extends('layouts.admin')

@section('title', 'Kelola Galeri')

@push('styles')
    @vite('resources/css/admin-pages/galeri.css')
@endpush

@section('content')
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'galeri'])
    <main>
        <div class="page-header">
            <h1>Kelola Galeri</h1>
            <p>Tambah dan atur foto yang tampil pada bagian Galeri di Beranda publik.</p>
            @if (session('status'))
                <p class="status-message"><i class="bi bi-check-circle-fill" aria-hidden="true"></i> {{ session('status') }}</p>
            @endif
        </div>

        @if ($errors->any())
            <div class="form-errors" role="alert">
                <strong>Galeri belum dapat disimpan.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @include('pages.admin.partials.page-guide', [
            'title' => 'Cara mengelola galeri',
            'description' => 'Foto galeri membantu pengunjung melihat suasana sekolah. Pilih foto yang terang, jelas, dan mewakili kegiatan sekolah.',
            'items' => [
                'Tulis tipe visual sendiri, misalnya Lapangan Basket, Ruang Musik, atau kegiatan baru lainnya.',
                'Klik area gambar, tarik dan lepas file, atau tempel gambar dengan Ctrl+V untuk melihat preview.',
                'Galeri yang dipublikasikan wajib memiliki gambar. Pilih Simpan Dulu jika konten belum lengkap.',
            ],
        ])

        <datalist id="gallery-visual-types">
            <option value="Perpustakaan">
            <option value="Laboratorium">
            <option value="Aula">
            <option value="Lapangan">
            <option value="Lapangan Basket">
            <option value="Ruang Kelas">
            <option value="Ruang Musik">
            <option value="Kegiatan Siswa">
        </datalist>

        <div class="gallery-admin-grid">
            <form class="gallery-card gallery-create-form" method="POST" action="{{ route('admin.galeri.store') }}" enctype="multipart/form-data">
                @csrf
                <h2><i class="bi bi-plus-circle" aria-hidden="true"></i> Tambah Galeri Baru</h2>

                <label for="gallery-title-new">Judul Galeri</label>
                <input id="gallery-title-new" name="title" value="{{ old('title') }}" required placeholder="Masukkan judul galeri">

                <label for="gallery-description-new">Deskripsi</label>
                <textarea id="gallery-description-new" name="description" placeholder="Masukkan deskripsi singkat galeri">{{ old('description') }}</textarea>

                <label for="gallery-type-new">Tipe Visual</label>
                <input id="gallery-type-new" name="image_class" value="{{ old('image_class') }}" list="gallery-visual-types" required maxlength="80" placeholder="Contoh: Lapangan Basket">
                <p class="field-help">Boleh memilih saran atau mengetik tipe baru sendiri.</p>

                <label>Gambar Galeri</label>
                <div class="image-dropzone" data-image-dropzone tabindex="0" role="button" aria-label="Unggah gambar galeri baru">
                    <input class="image-file-input" data-image-input type="file" name="image" accept="image/png,image/jpeg,image/webp">
                    <div class="dropzone-preview" data-image-preview>
                        <i class="bi bi-cloud-arrow-up" aria-hidden="true"></i>
                    </div>
                    <strong>Tarik dan lepas gambar ke sini</strong>
                    <span>atau <button type="button" data-image-browse>pilih gambar</button> dari perangkat</span>
                    <small>JPG, PNG, atau WebP · maksimal 4 MB · bisa ditempel dengan Ctrl+V</small>
                    <p class="selected-file" data-image-filename>Belum ada gambar dipilih.</p>
                </div>

                <label for="gallery-status-new">Status Tampilan</label>
                <select id="gallery-status-new" name="status">
                    <option value="published" @selected(old('status') === 'published')>Tampil di Website</option>
                    <option value="draft" @selected(old('status', 'draft') === 'draft')>Simpan Dulu, Belum Tampil</option>
                </select>

                <button class="btn" type="submit"><i class="bi bi-save" aria-hidden="true"></i> Simpan Galeri Baru</button>
            </form>

            <section class="gallery-card gallery-list-card">
                <h2><i class="bi bi-images" aria-hidden="true"></i> Daftar Galeri ({{ $galleries->total() }})</h2>

                @forelse ($galleries as $gallery)
                    @php
                        $legacyVisualLabels = ['library' => 'Perpustakaan', 'lab' => 'Laboratorium', 'hall' => 'Aula', 'court' => 'Lapangan'];
                        $visualLabel = $legacyVisualLabels[$gallery->image_class] ?? $gallery->image_class;
                    @endphp
                    <article class="gallery-row">
                        <form id="gallery-update-{{ $gallery->id }}" class="gallery-edit-form" method="POST" action="{{ route('admin.galeri.update', $gallery) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="gallery-edit-fields">
                                <label for="gallery-title-{{ $gallery->id }}">Judul</label>
                                <input id="gallery-title-{{ $gallery->id }}" name="title" value="{{ $gallery->title }}" required placeholder="Judul galeri">

                                <label for="gallery-description-{{ $gallery->id }}">Deskripsi</label>
                                <textarea id="gallery-description-{{ $gallery->id }}" name="description" placeholder="Deskripsi">{{ $gallery->description }}</textarea>

                                <div class="gallery-two-columns">
                                    <div>
                                        <label for="gallery-type-{{ $gallery->id }}">Tipe Visual</label>
                                        <input id="gallery-type-{{ $gallery->id }}" name="image_class" value="{{ $visualLabel }}" list="gallery-visual-types" required maxlength="80" placeholder="Contoh: Lapangan Basket">
                                    </div>
                                    <div>
                                        <label for="gallery-status-{{ $gallery->id }}">Status</label>
                                        <select id="gallery-status-{{ $gallery->id }}" name="status">
                                            <option value="published" @selected($gallery->status === 'published')>Tampil di Website</option>
                                            <option value="draft" @selected($gallery->status === 'draft')>Simpan Dulu</option>
                                        </select>
                                    </div>
                                </div>

                                <label>Gambar Galeri</label>
                                <div class="image-dropzone compact" data-image-dropzone tabindex="0" role="button" aria-label="Ganti gambar {{ $gallery->title }}">
                                    <input class="image-file-input" data-image-input type="file" name="image" accept="image/png,image/jpeg,image/webp">
                                    <div class="dropzone-preview {{ $gallery->image_path ? 'has-image' : '' }}" data-image-preview>
                                        @if ($gallery->image_path)
                                            <img src="{{ asset('storage/'.$gallery->image_path) }}" alt="Gambar {{ $gallery->title }}">
                                        @else
                                            <i class="bi bi-cloud-arrow-up" aria-hidden="true"></i>
                                        @endif
                                    </div>
                                    <strong>{{ $gallery->image_path ? 'Ganti gambar' : 'Tambahkan gambar' }}</strong>
                                    <span>Tarik file, <button type="button" data-image-browse>pilih gambar</button>, atau tempel Ctrl+V</span>
                                    <small>JPG, PNG, atau WebP · maksimal 4 MB</small>
                                    <p class="selected-file" data-image-filename>{{ $gallery->image_path ? 'Gambar saat ini tetap digunakan.' : 'Belum ada gambar. Galeri ini tidak tampil di publik.' }}</p>
                                </div>

                                @if ($gallery->image_path)
                                    <label class="check-row">
                                        <input type="checkbox" name="remove_image" value="1">
                                        Hapus gambar saat ini
                                    </label>
                                @endif
                            </div>
                        </form>

                        <div class="gallery-row-actions">
                            <button class="btn" type="submit" form="gallery-update-{{ $gallery->id }}"><i class="bi bi-save" aria-hidden="true"></i> Simpan Perubahan</button>
                            <form method="POST" action="{{ route('admin.galeri.destroy', $gallery) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus galeri ini?')"><i class="bi bi-trash" aria-hidden="true"></i> Hapus</button>
                            </form>
                        </div>
                    </article>
                @empty
                    <p class="gallery-empty">Belum ada galeri yang ditambahkan.</p>
                @endforelse

                {{ $galleries->links() }}
            </section>
        </div>
    </main>
</div>
@endsection
