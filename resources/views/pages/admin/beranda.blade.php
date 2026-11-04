@extends('layouts.admin')

@section('title', 'Kelola Beranda')

@push('styles')
    @vite('resources/css/admin-pages/beranda.css')
@endpush

@section('content')
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'beranda'])
    <div class="main-content">
        <main class="content-padding">
            <div class="page-head">
                <div>
                    <h1>Kelola Beranda</h1>
                    <p>Ubah isi halaman depan website: judul utama, profil sekolah, sambutan, berita, galeri, dan tombol ajakan PPDB.</p>
                    @if (session('status'))
                        <p style="margin-top: 12px; color: #166534; font-weight: 900; padding: 10px 12px; background: #dcfce7; border-radius: 8px; display: inline-block; font-size: 13px;"><i class="bi bi-check-circle-fill" aria-hidden="true"></i> {{ session('status') }}</p>
                    @endif
                    @if ($errors->any())
                        <div class="home-form-errors" role="alert"><strong>Beranda belum disimpan.</strong><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
                    @endif
                </div>
                <div class="page-head-actions">
                    <a href="{{ route('home') }}" class="btn-outline"><i class="bi bi-box-arrow-up-right" aria-hidden="true"></i> Lihat Beranda Publik</a>
                    <button type="submit" form="home-form" name="publish_mode" value="published" class="btn-primary"><i class="bi bi-save" aria-hidden="true"></i> Terbitkan Perubahan</button>
                </div>
            </div>

            @include('pages.admin.partials.page-guide', [
                'title' => 'Cara mengubah Beranda',
                'description' => 'Beranda adalah halaman pertama yang dilihat pengunjung, jadi ubah teks dengan singkat dan jelas.',
                'items' => [
                    'Isi bagian Konten Utama Beranda untuk judul, profil, dan sambutan kepala sekolah.',
                    'Untuk gambar, pilih file JPG, PNG, atau WEBP yang jelas dan tidak terlalu gelap.',
                    'Pilih Terbitkan Perubahan untuk langsung menayangkan konten, atau Simpan Draft untuk melanjutkan nanti.',
                    'Buka Lihat Beranda Publik setelah menerbitkan untuk mengecek hasilnya.',
                ],
            ])

            <div class="overview-grid">
                <article class="card overview-card"><span class="status-pill">Beranda</span><h2><i class="bi bi-building" aria-hidden="true"></i> Profil Sekolah</h2><p>Hero, profil, dan sambutan kepala sekolah.</p></article>
                <article class="card overview-card"><span class="status-pill">3 item</span><h2><i class="bi bi-newspaper" aria-hidden="true"></i> Berita Terbaru</h2><p>Berita terbit terbaru pada halaman publik.</p></article>
                <article class="card overview-card"><span class="status-pill">4 item</span><h2><i class="bi bi-images" aria-hidden="true"></i> Galeri Sekolah</h2><p>Foto terpilih dari pengelolaan galeri.</p></article>
                <article class="card overview-card"><span class="status-pill">Tautan</span><h2><i class="bi bi-journal-check" aria-hidden="true"></i> Informasi SPMB</h2><p>Tombol utama menuju halaman informasi pendaftaran.</p></article>
            </div>

            <form id="home-form" method="POST" action="{{ route('admin.beranda.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="management-grid">
                    <div class="stack">
                        <section class="card" id="home-editor">
                            <h2>Konten Utama Beranda</h2>
                            <div class="field-grid">
                                <div class="input-group">
                                    <label>Judul Hero</label>
                                <input class="custom-input" name="hero_title" maxlength="180" value="{{ old('hero_title', $settings['hero_title'] ?? '') }}" required>
                                </div>
                                <div class="input-group">
                                    <label>Teks Tombol PPDB</label>
                                <input class="custom-input" name="cta_label" maxlength="80" value="{{ old('cta_label', $settings['cta_label'] ?? '') }}" required>
                                </div>
                            </div>
                            <div class="input-group">
                                <label>Subjudul Hero</label>
                                <textarea class="custom-textarea" name="hero_subtitle">{{ old('hero_subtitle', $settings['hero_subtitle'] ?? '') }}</textarea>
                            </div>
                            <div class="input-group">
                                <label>Ringkasan Profil</label>
                                <textarea class="custom-textarea" name="profile_summary" required>{{ old('profile_summary', $settings['profile_summary'] ?? '') }}</textarea>
                            </div>
                            <div class="input-group">
                                <label>Detail Profil</label>
                                <textarea class="custom-textarea" name="profile_detail">{{ old('profile_detail', $settings['profile_detail'] ?? '') }}</textarea>
                            </div>
                            <div class="field-grid">
                                <div class="input-group">
                                    <label>Nama Kepala Sekolah</label>
                                    <input class="custom-input" name="principal_name" value="{{ old('principal_name', $settings['principal_name'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Label Hero</label>
                                    <input class="custom-input" name="hero_badge" value="{{ old('hero_badge', $settings['hero_badge'] ?? '') }}">
                                </div>
                            </div>
                            <div class="input-group">
                                <label>Sambutan Kepala Sekolah</label>
                                <textarea class="custom-textarea" name="principal_message">{{ old('principal_message', $settings['principal_message'] ?? '') }}</textarea>
                            </div>
                            <div class="input-group">
                                <label>Daftar Fokus Kerja Beranda</label>
                                <textarea class="custom-textarea" name="leadership_focus_json" data-structured-json rows="12">{{ old('leadership_focus_json', $settings['leadership_focus_json'] ?? '') }}</textarea>
                                <p class="field-help">Gunakan editor visual untuk menambah, mengubah, atau menghapus fokus kerja.</p>
                                @error('leadership_focus_json')<small class="field-error">{{ $message }}</small>@enderror
                            </div>
                            <div class="input-group">
                                <label>Gambar Hero Beranda</label>
                                <div class="hero-image-editor">
                                    <div class="image-preview hero-image-preview" style="{{ ! empty($settings['hero_image']) ? "background-image: url('".media_url($settings['hero_image'])."');" : '' }}">{{ empty($settings['hero_image']) ? 'Belum ada gambar custom' : '' }}</div>
                                    <div class="hero-image-controls">
                                        <input class="custom-input" type="file" name="hero_image" accept="image/png,image/jpeg,image/webp">
                                        <small>JPG, PNG, WebP · maks. 4 MB. Gunakan Terbitkan Perubahan agar gambar langsung tampil.</small>
                                        @error('hero_image')<small class="field-error">{{ $message }}</small>@enderror
                                        @if (! empty($settings['hero_image']))
                                            <label class="check-row"><input type="checkbox" name="remove_hero_image" value="1"> Hapus gambar dan gunakan latar bawaan</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="card">
                            <h2>Berita & Pengumuman di Beranda</h2>
                            <div class="content-list">
                                @foreach ($posts as $post)
                                    @php($postImage = ! empty($post->image_path) ? media_url($post->image_path) : null)
                                    <div class="content-row media-row">
                                        <form class="content-row-form" method="POST" action="{{ route('admin.beranda.post-image.update', $post) }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="content-row-head">
                                                <div class="image-preview" style="{{ $postImage ? "background-image: url('".$postImage."');" : '' }}">{{ $postImage ? '' : 'Gambar bawaan' }}</div>
                                                <div class="content-row-meta">
                                                    <strong>{{ $post->title }}</strong>
                                                    <span>{{ $post->category }} / {{ optional($post->published_at)->format('d M Y') }}</span>
                                                    <label class="image-clear-option"><input type="checkbox" name="remove_image" value="1" @disabled(! $postImage)> Hapus gambar khusus dan gunakan visual bawaan</label>
                                                </div>
                                            </div>
                                            <div class="field-grid image-controls" style="margin-top: 12px;">
                                                <div class="input-group" style="margin-bottom: 0;">
                                                    <label>Visual Bawaan</label>
                                                    <select class="custom-select" name="image_class">
                                                        @foreach (['graduates', 'olympiad', 'workshop', 'trophy', 'library'] as $visual)
                                                            <option value="{{ $visual }}" @selected($post->image_class === $visual)>{{ ucfirst($visual) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="input-group" style="margin-bottom: 0;">
                                                    <label>Upload / Ganti Gambar</label>
                                                    <input class="custom-input" type="file" name="image" accept="image/png,image/jpeg,image/webp">
                                                </div>
                                            </div>
                                            <div class="image-actions">
                                                <button type="submit" class="btn-primary"><i class="bi bi-image" aria-hidden="true"></i> Simpan Gambar</button>
                                                <a class="btn-outline" href="{{ route('admin.posts.edit', $post) }}"><i class="bi bi-pencil-square" aria-hidden="true"></i> Edit Lengkap</a>
                                                <a class="btn-outline" href="{{ route('admin.posts.preview', $post) }}" target="_blank" rel="noopener"><i class="bi bi-eye" aria-hidden="true"></i> Preview</a>
                                            </div>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    </div>

                    <aside class="stack">
                        <section class="card">
                            <h2>Galeri Beranda</h2>
                            <div class="content-list">
                                @forelse ($galleries as $gallery)
                                    <div class="content-row"><div><strong>{{ $gallery->title }}</strong><span>{{ $gallery->status === 'published' ? 'Tampil di website' : 'Belum tampil' }}</span></div><a class="btn-outline" href="{{ route('admin.galeri') }}"><i class="bi bi-pencil-square" aria-hidden="true"></i> Edit</a></div>
                                @empty
                                    <p class="empty-note">Belum ada item galeri. Tambahkan foto dari menu Foto Galeri.</p>
                                @endforelse
                            </div>
                        </section>

                        <section class="card">
                            <h2>Status Publikasi</h2>
                            <div class="input-group">
                                <label>Mode Publikasi</label>
                                <button type="submit" class="btn-outline save-draft-button" name="publish_mode" value="draft"><i class="bi bi-file-earmark" aria-hidden="true"></i> Simpan Draft</button>
                            </div>
                            <div class="note">Mode Draft menyimpan perubahan untuk dilanjutkan nanti. Pengunjung tetap melihat versi Published terakhir.</div>
                        </section>
                    </aside>
                </div>
            </form>
        </main>
    </div>
</div>
@endsection
