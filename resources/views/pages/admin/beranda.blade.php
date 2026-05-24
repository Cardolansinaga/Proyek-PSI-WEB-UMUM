<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Beranda - SMAN 2 Balige</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('pages.admin.partials.admin-polish')
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { overflow: hidden; font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); }
        .admin-container { display: flex; height: 100vh; width: 100vw; }
        .sidebar { width: 260px; background: #071f3a; flex-shrink: 0; display: flex; flex-direction: column; color: white; }
        .main-content { flex: 1; overflow-y: auto; }
        .content-padding { padding: 34px 30px; max-width: 1320px; margin: 0 auto; width: 100%; }
        .page-head { display: flex; justify-content: space-between; align-items: flex-start; gap: 20px; margin-bottom: 32px; }
        .page-head h1 { font-size: 36px; color: #071f3a; font-weight: 900; }
        .page-head p { color: #64748b; margin-top: 8px; max-width: 720px; font-size: 14px; }
        .btn-primary, .btn-outline { border-radius: 10px; padding: 12px 18px; font-weight: 900; text-decoration: none; cursor: pointer; transition: all 0.3s ease; }
        .btn-primary { background: linear-gradient(135deg, #071f3a 0%, #0f2847 100%); color: white; border: none; box-shadow: 0 4px 12px rgba(7, 31, 58, 0.2); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(7, 31, 58, 0.3); }
        .btn-outline { background: white; color: #071f3a; border: 1px solid #d9e1ec; box-shadow: 0 2px 8px rgba(0,0,0,0.04); }
        .btn-outline:hover { border-color: #d6a63a; box-shadow: 0 4px 12px rgba(214, 166, 58, 0.15); }
        .overview-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 16px; margin-bottom: 28px; }
        .management-grid { display: grid; grid-template-columns: minmax(0, 1.35fr) minmax(320px, .75fr); gap: 20px; }
        .card { background: white; border-radius: 14px; padding: 28px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
        .card h2 { font-size: 22px; color: #071f3a; font-weight: 900; margin-bottom: 20px; }
        .field-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
        .input-group { display: grid; gap: 10px; margin-bottom: 16px; }
        .input-group label { font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; }
        .custom-input, .custom-select, .custom-textarea { width: 100%; border: 1px solid #d9e1ec; border-radius: 10px; padding: 12px 14px; font: inherit; color: #071f3a; background: white; transition: all 0.3s ease; }
        .custom-input:hover, .custom-select:hover, .custom-textarea:hover { border-color: #d6a63a; box-shadow: 0 2px 8px rgba(214, 166, 58, 0.1); }
        .custom-input:focus, .custom-select:focus, .custom-textarea:focus { outline: none; border-color: #071f3a; box-shadow: 0 4px 12px rgba(7, 31, 58, 0.15); }
        .custom-textarea { min-height: 118px; resize: vertical; }
        .stack { display: grid; gap: 18px; }
        .content-list { display: grid; gap: 12px; }
        .content-row { display: grid; grid-template-columns: 1fr auto; gap: 14px; align-items: center; border: 1px solid #f1f5f9; border-radius: 10px; padding: 16px; background: #fbfdff; transition: all 0.2s ease; }
        .content-row.media-row { grid-template-columns: 132px 1fr; align-items: start; }
        .content-row:hover { background: #f8fafc; box-shadow: 0 2px 8px rgba(0,0,0,0.04); }
        .content-row strong { color: #071f3a; display: block; font-size: 14px; }
        .content-row span { color: #94a3b8; font-size: 12px; margin-top: 4px; }
        .status-pill { display: inline-flex; border-radius: 999px; padding: 8px 14px; background: #dcfce7; color: #166534; font-size: 11px; font-weight: 900; letter-spacing: 0.5px; }
        .note { border-left: 4px solid #c9962c; background: #fff8e7; padding: 16px; border-radius: 10px; color: #7c5a10; font-size: 13px; line-height: 1.6; }
        .image-preview { min-height: 150px; border-radius: 12px; border: 1px solid #d9e1ec; background: #f4f7fb center/cover no-repeat; display: grid; place-items: center; color: #64748b; font-size: 12px; font-weight: 800; overflow: hidden; }
        .check-row { display: flex; gap: 10px; align-items: flex-start; color: #071f3a; font-size: 13px; font-weight: 800; line-height: 1.5; }
        .check-row input { width: auto; margin-top: 3px; }
        @media (max-width: 1080px) { .overview-grid, .management-grid, .field-grid { grid-template-columns: 1fr; } .page-head { flex-direction: column; } }
        @media (max-width: 640px) { .content-row.media-row { grid-template-columns: 1fr; } }
    </style>
    @include('pages.admin.partials.responsive')
</head>
<body>
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'beranda'])
    <div class="main-content">
        <main class="content-padding">
            <div class="page-head">
                <div>
                    <h1>Manajemen Beranda</h1>
                    <p>Kelola semua bagian yang sekarang tampil di Beranda publik: profil sekolah, sambutan, berita & pengumuman, galeri, dan CTA PPDB.</p>
                    @if (session('status'))
                        <p style="margin-top: 12px; color: #166534; font-weight: 900; padding: 10px 12px; background: #dcfce7; border-radius: 8px; display: inline-block; font-size: 13px;">✓ {{ session('status') }}</p>
                    @endif
                </div>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <a href="{{ route('home') }}" class="btn-outline">Lihat Beranda Publik</a>
                    <button type="submit" form="home-form" class="btn-primary">Simpan Beranda</button>
                </div>
            </div>

            <div class="overview-grid">
                <article class="card" style="border-left: 4px solid #d6a63a;">
                    <span class="status-pill">Aktif</span>
                    <h2 style="margin-top: 12px; font-size: 20px;">📋 Profil Sekolah</h2>
                    <p style="color: #64748b; font-size: 14px; line-height: 1.5;">Hero, profil, sejarah, visi, misi, dan sambutan kepala sekolah.</p>
                </article>
                <article class="card" style="border-left: 4px solid #3b82f6;">
                    <span class="status-pill">Aktif</span>
                    <h2 style="margin-top: 12px; font-size: 20px;">📰 Berita Terbaru</h2>
                    <p style="color: #64748b; font-size: 14px; line-height: 1.5;">3 pembaruan tampil langsung di section Beranda publik.</p>
                </article>
                <article class="card" style="border-left: 4px solid #19a99a;">
                    <span class="status-pill">Aktif</span>
                    <h2 style="margin-top: 12px; font-size: 20px;">🖼️ Galeri Sekolah</h2>
                    <p style="color: #64748b; font-size: 14px; line-height: 1.5;">4 item galeri ringkas untuk kesan visual sekolah.</p>
                </article>
                <article class="card" style="border-left: 4px solid #8b5cf6;">
                    <span class="status-pill">Aktif</span>
                    <h2 style="margin-top: 12px; font-size: 20px;">🎯 CTA PPDB</h2>
                    <p style="color: #64748b; font-size: 14px; line-height: 1.5;">Tombol diarahkan ke halaman Informasi PPDB.</p>
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
                                    <label>Label CTA</label>
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
                                                <button type="submit" class="btn-primary">Simpan Gambar</button>
                                                <a class="btn-outline" href="{{ route('berita.show', $post->slug) }}">Lihat</a>
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
                                    <div class="content-row"><div><strong>{{ $gallery->title }}</strong><span>{{ $gallery->status === 'published' ? 'Tampil publik' : 'Draft' }}</span></div><a class="btn-outline" href="{{ route('admin.galeri') }}">Edit</a></div>
                                @endforeach
                            </div>
                        </section>

                        <section class="card">
                            <h2>Status Publikasi</h2>
                            <div class="input-group">
                                <label>Mode Publikasi</label>
                                <select class="custom-select" name="publish_mode">
                                    <option>Publik</option>
                                    <option>Draft</option>
                                </select>
                            </div>
                            <div class="note">Modul Pengumuman dan Galeri tidak dipisah lagi karena keduanya sekarang menjadi bagian dari Beranda publik.</div>
                        </section>
                    </aside>
                </div>
            </form>
        </main>
    </div>
</div>
</body>
</html>
