@extends('layouts.admin')

@section('title', 'Kelola Berita')

@push('styles')
    @vite('resources/css/admin-pages/posts-index.css')
@endpush

@section('content')
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'berita'])

    <div class="main-content">
        <main class="content-padding">
            <header class="page-head">
                <div>
                    <h1>Kelola Berita</h1>
                    <p>Tulis, jadwalkan, terbitkan, dan arsipkan berita resmi sekolah. Draft tidak akan terlihat oleh pengunjung.</p>
                </div>
                <a class="btn-primary" href="{{ route('admin.posts.create') }}">
                    <i class="bi bi-plus-circle" aria-hidden="true"></i>
                    Tambah Berita
                </a>
            </header>

            @if(session('status'))
                <div class="notice" role="status">
                    <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                    {{ session('status') }}
                </div>
            @endif

            <form class="filters" method="GET" action="{{ route('admin.posts.index') }}">
                <div class="field">
                    <label for="search">Cari berita</label>
                    <input id="search" name="search" type="search" value="{{ $filters['search'] }}" placeholder="Judul atau isi berita">
                </div>
                <div class="field">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        @foreach([
                            'all' => 'Semua status',
                            'draft' => 'Draft',
                            'published' => 'Published',
                            'scheduled' => 'Terjadwal',
                            'archived' => 'Diarsipkan',
                            'trashed' => 'Sampah',
                        ] as $value => $label)
                            <option value="{{ $value }}" @selected($filters['status'] === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label for="category">Kategori</label>
                    <select id="category" name="category">
                        <option value="">Semua kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" @selected($filters['category'] === $category)>{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label for="sort">Urutan</label>
                    <select id="sort" name="sort">
                        <option value="newest" @selected($filters['sort'] === 'newest')>Terbaru</option>
                        <option value="oldest" @selected($filters['sort'] === 'oldest')>Terlama</option>
                        <option value="updated" @selected($filters['sort'] === 'updated')>Terakhir diubah</option>
                        <option value="title" @selected($filters['sort'] === 'title')>Judul A–Z</option>
                    </select>
                </div>
                <button class="btn-secondary filter-action" type="submit">
                    <i class="bi bi-sliders" aria-hidden="true"></i>
                    Terapkan
                </button>
            </form>

            <div class="result-summary">
                <span>{{ $posts->total() }} berita ditemukan</span>
                @if(collect($filters)->filter()->isNotEmpty())
                    <a href="{{ route('admin.posts.index') }}">Reset filter</a>
                @endif
            </div>

            @if($posts->isEmpty())
                <section class="empty-state">
                    <i class="bi bi-newspaper" aria-hidden="true"></i>
                    <h2>Belum ada berita pada daftar ini</h2>
                    <p>Ubah filter pencarian atau tambahkan berita baru. Berita yang disimpan sebagai Draft tetap aman dan tidak tampil di website publik.</p>
                    <a class="btn-primary" href="{{ route('admin.posts.create') }}">Tambah Berita Pertama</a>
                </section>
            @else
                <section class="post-list" aria-label="Daftar berita admin">
                    @foreach($posts as $post)
                        @php
                            $isScheduled = $post->status === 'published' && $post->published_at?->isFuture();
                            $displayStatus = $post->trashed()
                                ? 'trashed'
                                : ($isScheduled ? 'scheduled' : $post->status);
                            $statusLabel = [
                                'published' => 'Published',
                                'draft' => 'Draft',
                                'scheduled' => 'Terjadwal',
                                'archived' => 'Diarsipkan',
                                'trashed' => 'Sampah',
                            ][$displayStatus] ?? ucfirst($displayStatus);
                            $imageUrl = $post->image_path ? asset('storage/'.$post->image_path) : null;
                        @endphp

                        <article class="post-card">
                            <div class="post-image" @if($imageUrl) style="background-image: linear-gradient(180deg, rgba(7,31,58,.04), rgba(7,31,58,.18)), url('{{ $imageUrl }}');" @endif>
                                @unless($imageUrl)
                                    <span><i class="bi bi-image" aria-hidden="true"></i> Belum ada gambar</span>
                                @endunless
                            </div>

                            <div class="post-body">
                                <div class="post-meta">
                                    <span class="badge {{ $displayStatus }}">{{ $statusLabel }}</span>
                                    <span class="badge">{{ $post->category }}</span>
                                    @if($post->is_featured)
                                        <span class="featured"><i class="bi bi-star-fill" aria-hidden="true"></i> Featured</span>
                                    @endif
                                </div>
                                <h2>{{ $post->title }}</h2>
                                <p>{{ $post->excerpt }}</p>
                                <div class="post-date">
                                    @if($post->published_at)
                                        {{ $isScheduled ? 'Akan terbit' : 'Tanggal publikasi' }}:
                                        {{ $post->published_at->format('d M Y, H:i') }} WIB
                                    @else
                                        Belum memiliki tanggal publikasi
                                    @endif
                                </div>
                            </div>

                            <div class="post-actions">
                                @if($post->trashed())
                                    <form method="POST" action="{{ route('admin.posts.restore', $post->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn-success" type="submit">
                                            <i class="bi bi-arrow-repeat" aria-hidden="true"></i>
                                            Pulihkan
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.posts.force-delete', $post->id) }}" onsubmit="return confirm('Hapus berita ini secara permanen? Tindakan ini tidak dapat dibatalkan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-danger" type="submit">
                                            <i class="bi bi-trash" aria-hidden="true"></i>
                                            Permanen
                                        </button>
                                    </form>
                                @else
                                    <a class="btn-secondary" href="{{ route('admin.posts.edit', $post) }}">
                                        <i class="bi bi-pencil-square" aria-hidden="true"></i>
                                        Edit
                                    </a>
                                    <a class="btn-secondary" href="{{ route('admin.posts.preview', $post) }}" target="_blank" rel="noopener">
                                        <i class="bi bi-eye" aria-hidden="true"></i>
                                        Preview
                                    </a>
                                    <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('Pindahkan berita ini ke sampah? Berita masih dapat dipulihkan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-danger" type="submit">
                                            <i class="bi bi-archive" aria-hidden="true"></i>
                                            Sampah
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </section>

                <div class="pagination-wrap">
                    {{ $posts->links() }}
                </div>
            @endif
        </main>
    </div>
</div>
@endsection
