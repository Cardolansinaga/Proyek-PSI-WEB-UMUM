<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductionReadinessTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_sitemap_contains_public_pages_and_only_published_posts(): void
    {
        Post::query()->create([
            'title' => 'Berita Published Audit',
            'slug' => 'berita-published-audit',
            'status' => 'published',
            'published_at' => now()->subMinute(),
        ]);

        Post::query()->create([
            'title' => 'Berita Draft Audit',
            'slug' => 'berita-draft-audit',
            'status' => 'draft',
            'published_at' => now(),
        ]);

        $response = $this->get(route('sitemap'));

        $response
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml; charset=UTF-8')
            ->assertSee(route('home'), false)
            ->assertSee(route('berita.show', 'berita-published-audit'), false)
            ->assertDontSee('berita-draft-audit');

        $this->assertNotFalse(simplexml_load_string($response->getContent()));
    }

    public function test_robots_file_protects_internal_routes_and_references_sitemap(): void
    {
        $this->get(route('robots'))
            ->assertOk()
            ->assertHeader('Content-Type', 'text/plain; charset=UTF-8')
            ->assertSee('Disallow: /admin')
            ->assertSee('Disallow: /login')
            ->assertSee('Sitemap: '.route('sitemap'));
    }

    public function test_custom_404_page_is_safe_and_branded(): void
    {
        $this->get('/halaman-yang-tidak-tersedia')
            ->assertNotFound()
            ->assertSee('SMAN 2 Balige')
            ->assertSee('Halaman yang Anda cari tidak ditemukan')
            ->assertSee('noindex,nofollow', false)
            ->assertDontSee('Stack trace');
    }

    public function test_all_required_error_templates_render_without_external_state(): void
    {
        foreach ([403, 404, 419, 429, 500, 503] as $status) {
            $html = view('errors.'.$status)->render();

            $this->assertStringContainsString((string) $status, $html);
            $this->assertStringContainsString('SMAN 2 Balige', $html);
            $this->assertStringContainsString('noindex,nofollow', $html);
        }
    }

    public function test_public_home_has_no_unverified_principal_placeholder(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Ani Sefriana Nadapdap, S.Pd., M.Si.')
            ->assertDontSee('menunggu verifikasi');
    }

    public function test_facebook_links_open_the_direct_school_page(): void
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('href="'.SiteSetting::OFFICIAL_FACEBOOK_URL.'"', false)
            ->assertSee('target="_blank"', false)
            ->assertSee('rel="noopener"', false)
            ->assertDontSee('facebook.com/search', false);

        $cards = json_decode(SiteSetting::defaults()['ppdb_research_cards_json'], true);
        $facebookCard = collect($cards)->firstWhere('link_label', 'Buka Facebook');

        $this->assertSame(SiteSetting::OFFICIAL_FACEBOOK_URL, $facebookCard['url'] ?? null);
    }

    public function test_public_pages_use_plain_school_copy_without_the_synthetic_default_hero(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Selamat Datang di SMAN 2 Balige')
            ->assertDontSee('Institusi Pendidikan Prestisius')
            ->assertDontSee('standar akademik internasional')
            ->assertDontSee('images/heroes/ppdb-hero', false);

        $this->get('/akademik')
            ->assertOk()
            ->assertSee('Akademik &amp; Prestasi', false)
            ->assertDontSee('Membentuk Intelek')
            ->assertDontSee('images/heroes/ppdb-hero', false);

        $this->get('/kesiswaan-ekstrakurikuler')
            ->assertOk()
            ->assertSee('Kesiswaan &amp; Ekstrakurikuler', false)
            ->assertDontSee('Ekosistem Kesiswaan')
            ->assertDontSee('images/heroes/ppdb-hero', false);

        $this->get('/ppdb')
            ->assertOk()
            ->assertSee('Informasi SPMB SMAN 2 Balige')
            ->assertDontSee('images/heroes/ppdb-hero', false);

        $this->get('/berita')
            ->assertOk()
            ->assertSeeText('Berita & Pengumuman')
            ->assertDontSee('Informasi &amp; Update Terbaru Sekolah', false)
            ->assertDontSee('images/heroes/ppdb-hero', false);
    }

    public function test_ppdb_uses_direct_application_page_without_redundant_location_bar(): void
    {
        $response = $this->get('/ppdb');

        $response
            ->assertOk()
            ->assertSee('https://spmbsumutberkah.disdik.sumutprov.go.id/information/download-aplikasi-spmb-2026', false)
            ->assertDontSee('ppdb-contact-address', false)
            ->assertDontSee('Lihat Lokasi Sekolah');
    }

    public function test_admin_login_uses_only_the_school_logo_and_keeps_animated_background(): void
    {
        $response = $this->get('/login');

        $response
            ->assertOk()
            ->assertSee('class="school-emblem"', false)
            ->assertSee('Logo SMAN 2 Balige')
            ->assertDontSee('campus-sketch', false)
            ->assertDontSee('<style>', false);

        $this->assertSame(1, substr_count($response->getContent(), '<img '));
    }

    public function test_home_uses_compact_news_metadata_and_direct_school_maps_search(): void
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('home-news-category', false)
            ->assertSee('<time datetime=', false)
            ->assertSee('https://www.google.com/maps/search/?api=1&amp;query=SMAN%202%20Balige', false)
            ->assertSee('id="kontak"', false)
            ->assertSee('id="galeri"', false);
    }
}
