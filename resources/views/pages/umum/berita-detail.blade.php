@extends('layouts.site', ['active' => 'berita'])

@section('title', ($post->meta_title ?: $post->title) . ' - SMAN 2 Balige')
@section('description', $post->meta_description ?: $post->excerpt)
@section('canonical', route('berita.show', $post->slug))
@section('og_type', 'article')
@section('image', $post->image_path ? asset('storage/'.$post->image_path) : asset('images/logo-sman2-balige.jpg'))
@if(! empty($isPreview))
    @section('robots', 'noindex,nofollow')
@endif

@push('structured-data')
    @php
        $articleSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'NewsArticle',
            'headline' => $post->title,
            'description' => $post->meta_description ?: $post->excerpt,
            'image' => [$post->image_path ? asset('storage/'.$post->image_path) : asset('images/logo-sman2-balige.jpg')],
            'datePublished' => $post->published_at?->toIso8601String(),
            'dateModified' => $post->updated_at?->toIso8601String(),
            'mainEntityOfPage' => route('berita.show', $post->slug),
            'author' => [
                '@type' => 'Organization',
                'name' => 'Humas SMAN 2 Balige',
            ],
            'publisher' => [
                '@type' => 'EducationalOrganization',
                'name' => $settings['school_name'] ?? 'SMAN 2 Balige',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => ! empty($settings['logo']) ? asset('storage/'.$settings['logo']) : asset('images/logo-sman2-balige-96.webp'),
                ],
            ],
        ];
        $breadcrumbSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Berita', 'item' => route('berita.index')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $post->title, 'item' => route('berita.show', $post->slug)],
            ],
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($articleSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) !!}</script>
    <script type="application/ld+json">{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) !!}</script>
@endpush

@section('content')
    @if(! empty($isPreview))
        <div class="article-preview-notice" role="status">
            <i class="bi bi-eye" aria-hidden="true"></i>
            Mode preview admin — halaman ini belum tentu tersedia untuk pengunjung.
        </div>
    @endif

    <article class="article-page">
        <div class="article-container">
            <nav class="article-breadcrumb" aria-label="Breadcrumb">
                <ol>
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li aria-hidden="true">/</li>
                    <li><a href="{{ route('berita.index') }}">Berita</a></li>
                    <li aria-hidden="true">/</li>
                    <li aria-current="page">Detail</li>
                </ol>
            </nav>

            <div class="article-meta">
                <span>{{ $post->category }}</span>
                <time datetime="{{ optional($post->published_at)->toDateString() }}">{{ optional($post->published_at)->format('d M Y') }}</time>
            </div>

            <h1 class="article-title">{{ $post->title }}</h1>

            <div class="article-author">
                <div>
                    <strong>Humas SMAN 2 Balige</strong>
                    <span>Informasi resmi sekolah</span>
                </div>
                <a href="{{ route('berita.index') }}">Kembali ke daftar berita</a>
            </div>

            @php($postImage = ! empty($post->image_path) ? asset('storage/'.$post->image_path) : null)
            @if($postImage)
                <figure class="article-figure">
                    <img src="{{ $postImage }}" alt="{{ $post->title }}" loading="eager" decoding="async">
                    @if($post->excerpt)
                        <figcaption>{{ $post->excerpt }}</figcaption>
                    @endif
                </figure>
            @endif

            <div class="prose-copy article-body">
                @foreach (preg_split('/\R+/', trim($post->body ?? $post->excerpt)) as $paragraph)
                    @if(trim($paragraph) !== '')
                        <p>{{ $paragraph }}</p>
                    @endif
                @endforeach
            </div>

            <div class="article-share">
                <span>Bagikan informasi:</span>
                <div>
                    <a class="share" href="mailto:?subject={{ urlencode($post->title) }}&body={{ route('berita.show', $post->slug) }}" aria-label="Bagikan lewat email"><i class="bi bi-envelope"></i></a>
                    <a class="share" href="https://twitter.com/intent/tweet?url={{ urlencode(route('berita.show', $post->slug)) }}" target="_blank" rel="noopener" aria-label="Bagikan ke X"><i class="bi bi-twitter-x"></i></a>
                    <a class="share" href="https://wa.me/?text={{ urlencode(route('berita.show', $post->slug)) }}" target="_blank" rel="noopener" aria-label="Bagikan ke WhatsApp"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>
        </div>
    </article>

    @if($relatedPosts->isNotEmpty())
        <section class="related-news-section">
            <div class="mx-auto max-w-5xl px-4 lg:px-8">
                <h2>Berita Terkait</h2>
                <p>Informasi sekolah lainnya yang dapat Anda baca.</p>
                <div class="natural-news-grid">
                    @foreach ($relatedPosts as $related)
                        @php($relatedImage = ! empty($related->image_path) ? asset('storage/'.$related->image_path) : null)
                        <article class="news-card">
                            <div
                                class="illustration {{ $related->image_class ?? 'graduates' }}"
                                @if($relatedImage)
                                    style="background-image: linear-gradient(180deg, rgb(7 31 58 / .03), rgb(7 31 58 / .2)), url('{{ $relatedImage }}') !important;"
                                @endif
                            ></div>
                            <div class="p-7">
                                <p class="meta-line">{{ $related->category }}</p>
                                <h3>{{ $related->title }}</h3>
                                <p>{{ $related->excerpt }}</p>
                                <a href="{{ route('berita.show', $related->slug) }}">Baca selengkapnya <i class="bi bi-arrow-right" aria-hidden="true"></i></a>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div class="related-news-link">
                    <a href="{{ route('berita.index') }}" class="outline-button">Lihat Semua Berita</a>
                </div>
            </div>
        </section>
    @endif
@endsection
