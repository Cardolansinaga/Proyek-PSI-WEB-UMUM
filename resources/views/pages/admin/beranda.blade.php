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
                </div>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <a href="{{ route('home') }}" class="btn-outline"><i class="bi bi-box-arrow-up-right" aria-hidden="true"></i> Lihat Beranda Publik</a>
                    <button type="submit" form="home-form" class="btn-primary"><i class="bi bi-save" aria-hidden="true"></i> Simpan Beranda</button>
                </div>
            </div>

            @include('pages.admin.partials.page-guide', [
                'title' => 'Cara mengubah Beranda',
                'description' => 'Beranda adalah halaman pertama yang dilihat pengunjung, jadi ubah teks dengan singkat dan jelas.',
                'items' => [
                    'Isi bagian Konten Utama Beranda untuk judul, profil, dan sambutan kepala sekolah.',
                    'Untuk gambar, pilih file JPG, PNG, atau WEBP yang jelas dan tidak terlalu gelap.',
                    'Klik Simpan Beranda, lalu buka Lihat Beranda Publik untuk mengecek hasilnya.',
                ],
            ])

            <div class="overview-grid">
                <article class="card" style="border-left: 4px solid #d6a63a;">
                    <span class="status-pill">Aktif</span>
                    <h2 style="margin-top: 12px; font-size: 20px;"><i class="bi bi-building" aria-hidden="true"></i> Profil Sekolah</h2>
                    <p style="color: #64748b; font-size: 14px; line-height: 1.5;">Hero, profil, sejarah, visi, misi, dan sambutan kepala sekolah.</p>
                </article>
                <article class="card" style="border-left: 4px solid #3b82f6;">
                    <span class="status-pill">Aktif</span>
                    <h2 style="margin-top: 12px; font-size: 20px;"><i class="bi bi-newspaper" aria-hidden="true"></i> Berita Terbaru</h2>
                    <p style="color: #64748b; font-size: 14px; line-height: 1.5;">3 pembaruan tampil langsung di section Beranda publik.</p>
                </article>
                <article class="card" style="border-left: 4px solid #19a99a;">
                    <span class="status-pill">Aktif</span>
                    <h2 style="margin-top: 12px; font-size: 20px;"><i class="bi bi-images" aria-hidden="true"></i> Galeri Sekolah</h2>
                    <p style="color: #64748b; font-size: 14px; line-height: 1.5;">4 item galeri ringkas untuk kesan visual sekolah.</p>
                </article>
                <article class="card" style="border-left: 4px solid #8b5cf6;">
                    <span class="status-pill">Aktif</span>
                    <h2 style="margin-top: 12px; font-size: 20px;"><i class="bi bi-journal-check" aria-hidden="true"></i> Tombol PPDB</h2>
                    <p style="color: #64748b; font-size: 14px; line-height: 1.5;">Tombol ajakan diarahkan ke halaman Informasi PPDB.</p>
                </article>
            </div>

            <form id="home-form" method="POST" action="{{ route('admin.beranda.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="management-grid">
                    <div class="stack">
                        <section class="card">
                            <h2>Konten Utama Beranda</h2>
                            <div class="field-grid">
                                <div class="input-group">
                                    <label>Judul Hero</label>
                                    <input class="custom-input" name="hero_title" value="{{ old('hero_title', $settings['hero_title'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Teks Tombol PPDB</label>
                                    <input class="custom-input" name="cta_label" value="{{ old('cta_label', $settings['cta_label'] ?? '') }}">
                                </div>
                            </div>
                            <div class="input-group">
                                <label>Subjudul Hero</label>
                                <textarea class="custom-textarea" name="hero_subtitle">{{ old('hero_subtitle', $settings['hero_subtitle'] ?? '') }}</textarea>
                            </div>
                            <div class="input-group">
                                <label>Ringkasan Profil</label>
                                <textarea class="custom-textarea" name="profile_summary">{{ old('profile_summary', $settings['profile_summary'] ?? '') }}</textarea>
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
                                <p class="field-help">Kelola daftar melalui editor visual. Gunakan tombol tambah atau hapus untuk mengubah susunan.</p>
                            </div>
                            <div class="input-group">
                                <label>Gambar Hero Beranda</label>
                                @if (! empty($settings['hero_image']))
                                    <div class="image-preview" style="background-image: url('{{ asset('storage/'.$settings['hero_image']) }}');"></div>
                                    <label class="check-row">
                                        <input type="checkbox" name="remove_hero_image" value="1">
                                        Hapus gambar beranda dan kembali ke gambar bawaan
                                    </label>
                                @else
                                    <div class="image-preview">Belum ada gambar custom</div>
                                @endif
                                <input class="custom-input" type="file" name="hero_image" accept="image/png,image/jpeg,image/webp">
                            </div>
                        </section>

                        <section class="card">
                            <h2>Berita & Pengumuman di Beranda</h2>
                            <div class="content-list">
                                @foreach ($posts as $post)
                                    @php($postImage = ! empty($post->image_path) ? asset('storage/'.$post->image_path) : null)
                                    <div class="content-row media-row">
                                        <div class="image-preview" style="{{ $postImage ? "background-image: url('".$postImage."'); min-height: 96px;" : 'min-height: 96px;' }}">{{ $postImage ? '' : 'Gambar bawaan' }}</div>
                                        <form method="POST" action="{{ route('admin.beranda.post-image.update', $post) }}" enctype="multipart/form-data">
                                            @csrf
                                            <strong>{{ $post->title }}</strong>
                                            <span>{{ $post->category }} / {{ optional($post->published_at)->format('d M Y') }}</span>
                                            <div class="field-grid" style="margin-top: 12px;">
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
                                            @if ($postImage)
                                                <label class="check-row">
                                                    <input type="checkbox" name="remove_image" value="1">
                                                    Hapus gambar custom
                                                </label>
                                            @endif
                                            <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-top: 12px;">
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
                                @foreach ($galleries as $gallery)
                                    <div class="content-row"><div><strong>{{ $gallery->title }}</strong><span>{{ $gallery->status === 'published' ? 'Tampil di website' : 'Belum tampil' }}</span></div><a class="btn-outline" href="{{ route('admin.galeri') }}"><i class="bi bi-pencil-square" aria-hidden="true"></i> Edit</a></div>
                                @endforeach
                            </div>
                        </section>

                        <section class="card">
                            <h2>Status Publikasi</h2>
                            <div class="input-group">
                                <label>Mode Publikasi</label>
                                <select class="custom-select" name="publish_mode">
                                    <option value="published" @selected(old('publish_mode', $settings['publish_mode'] ?? 'published') === 'published')>Published — tampil di website</option>
                                    <option value="draft" @selected(old('publish_mode', $settings['publish_mode'] ?? 'published') === 'draft')>Draft — simpan tanpa mengubah website</option>
                                </select>
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
