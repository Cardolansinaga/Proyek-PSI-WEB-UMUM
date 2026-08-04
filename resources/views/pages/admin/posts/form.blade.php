@extends('layouts.admin')

@section('title', '{{ $mode === \'edit\' ? \'Edit\' : \'Tambah\' }} Berita')

@push('styles')
    @vite('resources/css/admin-pages/posts-form.css')
@endpush

@section('content')
@php
    $isEdit = $mode === 'edit';
    $formAction = $isEdit ? route('admin.posts.update', $post) : route('admin.posts.store');
    $publishedValue = old('published_at', $post->published_at?->format('Y-m-d\TH:i'));
    $imageUrl = $post->image_path ? asset('storage/'.$post->image_path) : null;
@endphp

<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'berita'])

    <div class="main-content">
        <main class="content-padding">
            <header class="page-head">
                <div>
                    <h1>{{ $isEdit ? 'Edit Berita' : 'Tambah Berita' }}</h1>
                    <p>Gunakan bahasa resmi, jelas, dan mudah dipahami. Simpan sebagai Draft jika isi belum siap dilihat publik.</p>
                </div>
                <div class="head-actions">
                    <a class="btn-secondary" href="{{ route('admin.posts.index') }}">
                        <i class="bi bi-arrow-left" aria-hidden="true"></i>
                        Kembali
                    </a>
                    @if($isEdit)
                        <a class="btn-secondary" href="{{ route('admin.posts.preview', $post) }}" target="_blank" rel="noopener">
                            <i class="bi bi-eye" aria-hidden="true"></i>
                            Preview
                        </a>
                    @endif
                    <button class="btn-primary" type="submit" form="post-form">
                        <i class="bi bi-save" aria-hidden="true"></i>
                        Simpan Berita
                    </button>
                </div>
            </header>

            @if(session('status'))
                <div class="notice" role="status">{{ session('status') }}</div>
            @endif

            @if($errors->any())
                <div class="notice error" role="alert">
                    <strong>Berita belum dapat disimpan. Periksa bagian berikut:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="post-form" method="POST" action="{{ $formAction }}" enctype="multipart/form-data">
                @csrf
                @if($isEdit)
                    @method('PUT')
                @endif

                <div class="editor-grid">
                    <div class="stack">
                        <section class="card">
                            <h2><i class="bi bi-newspaper" aria-hidden="true"></i> Isi Berita</h2>

                            <div class="field">
                                <label for="title">Judul berita</label>
                                <input id="title" name="title" type="text" maxlength="180" value="{{ old('title', $post->title) }}" required autofocus>
                                <small>Maksimal 180 karakter. Gunakan judul yang informatif, bukan seluruhnya huruf kapital.</small>
                            </div>

                            <div class="field-grid">
                                <div class="field">
                                    <label for="slug">Slug URL</label>
                                    <input id="slug" name="slug" type="text" maxlength="200" value="{{ old('slug', $post->slug) }}" placeholder="Otomatis dari judul">
                                    <small>Kosongkan saat membuat berita agar dibuat otomatis.</small>
                                </div>
                                <div class="field">
                                    <label for="category">Kategori</label>
                                    <select id="category" name="category" required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category }}" @selected(old('category', $post->category) === $category)>{{ $category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="field">
                                <label for="excerpt">Ringkasan</label>
                                <textarea id="excerpt" name="excerpt" maxlength="500" required>{{ old('excerpt', $post->excerpt) }}</textarea>
                                <small>Ringkasan tampil pada kartu berita dan dapat dipakai sebagai deskripsi pencarian.</small>
                            </div>

                            <div class="field">
                                <label for="body">Isi lengkap</label>
                                <textarea id="body" class="body-editor" name="body" maxlength="50000" required>{{ old('body', $post->body) }}</textarea>
                                <small>Pisahkan paragraf dengan baris kosong. Konten ditampilkan sebagai teks aman tanpa menjalankan HTML.</small>
                            </div>
                        </section>

                        <section class="card">
                            <h2><i class="bi bi-compass" aria-hidden="true"></i> SEO Berita</h2>

                            <div class="field">
                                <label for="meta_title">Meta title</label>
                                <input id="meta_title" name="meta_title" type="text" maxlength="70" value="{{ old('meta_title', $post->meta_title) }}" placeholder="Opsional — gunakan judul berita bila kosong">
                                <small>Disarankan 50–60 karakter untuk hasil pencarian.</small>
                            </div>

                            <div class="field">
                                <label for="meta_description">Meta description</label>
                                <textarea id="meta_description" name="meta_description" maxlength="180" placeholder="Opsional — gunakan ringkasan bila kosong">{{ old('meta_description', $post->meta_description) }}</textarea>
                                <small>Disarankan 120–160 karakter dan menjelaskan isi berita secara spesifik.</small>
                            </div>
                        </section>
                    </div>

                    <aside class="stack">
                        <section class="card">
                            <h2><i class="bi bi-broadcast" aria-hidden="true"></i> Publikasi</h2>

                            <div class="field">
                                <label for="status">Status berita</label>
                                <select id="status" name="status" required>
                                    <option value="draft" @selected(old('status', $post->status) === 'draft')>Draft — belum tampil</option>
                                    <option value="published" @selected(old('status', $post->status) === 'published')>Published — tampil sesuai tanggal</option>
                                    <option value="archived" @selected(old('status', $post->status) === 'archived')>Diarsipkan — disembunyikan</option>
                                </select>
                            </div>

                            <div class="field">
                                <label for="published_at">Tanggal dan waktu publikasi</label>
                                <input id="published_at" name="published_at" type="datetime-local" value="{{ $publishedValue }}">
                                <small>Jika Published dan waktunya masih di masa depan, berita otomatis menjadi terjadwal.</small>
                            </div>

                            <div class="field">
                                <label for="sort_order">Urutan manual</label>
                                <input id="sort_order" name="sort_order" type="number" min="0" max="999999" value="{{ old('sort_order', $post->sort_order ?? 0) }}">
                            </div>

                            <label class="check-field">
                                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $post->is_featured))>
                                <span>Jadikan Featured News. Berita featured sebelumnya akan dinonaktifkan.</span>
                            </label>

                            <div class="publish-note">Draft dan berita terjadwal dapat dipreview oleh admin, tetapi tidak dapat dibuka pengunjung sebelum waktunya.</div>
                        </section>

                        <section class="card">
                            <h2><i class="bi bi-image" aria-hidden="true"></i> Gambar Utama</h2>

                            <div class="image-preview" @if($imageUrl) style="background-image: linear-gradient(180deg, rgba(7,31,58,.04), rgba(7,31,58,.18)), url('{{ $imageUrl }}');" @endif>
                                @unless($imageUrl)
                                    Belum ada gambar
                                @endunless
                            </div>

                            <div class="field">
                                <label for="image">Upload gambar baru</label>
                                <input id="image" name="image" type="file" accept="image/jpeg,image/png,image/webp">
                                <small>JPG, PNG, atau WEBP; maksimal 4 MB. Rasio landscape disarankan.</small>
                            </div>

                            <div class="field">
                                <label for="image_class">Visual cadangan</label>
                                <select id="image_class" name="image_class">
                                    @foreach([
                                        'library' => 'Perpustakaan',
                                        'trophy' => 'Prestasi',
                                        'study' => 'Kegiatan Belajar',
                                        'graduates' => 'Kelulusan',
                                        'labroom' => 'Laboratorium',
                                        'court' => 'Olahraga',
                                    ] as $value => $label)
                                        <option value="{{ $value }}" @selected(old('image_class', $post->image_class ?? 'library') === $value)>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @if($imageUrl)
                                <label class="check-field">
                                    <input type="checkbox" name="remove_image" value="1">
                                    <span>Hapus gambar saat ini dan gunakan visual cadangan.</span>
                                </label>
                            @endif
                        </section>
                    </aside>
                </div>
            </form>

            @if($isEdit)
                <section class="card danger-zone">
                    <h2><i class="bi bi-exclamation-triangle" aria-hidden="true"></i> Pindahkan ke Sampah</h2>
                    <p style="margin-bottom: 14px; color: #64748b; font-size: 13px; line-height: 1.6;">Berita akan hilang dari website, tetapi masih dapat dipulihkan dari filter Sampah.</p>
                    <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('Pindahkan berita ini ke sampah?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn-danger" type="submit">
                            <i class="bi bi-archive" aria-hidden="true"></i>
                            Pindahkan ke Sampah
                        </button>
                    </form>
                </section>
            @endif
        </main>
    </div>
</div>
@endsection
