<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LinkIntegrityTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_every_internal_public_link_and_fragment_is_reachable(): void
    {
        $pages = [
            '/',
            '/akademik',
            '/kesiswaan-ekstrakurikuler',
            '/ppdb',
            '/berita',
            '/berita/pembinaan-sains-sman-2-balige-2026',
            '/login',
            '/forgot-password',
        ];

        foreach ($pages as $page) {
            $response = $this->get($page);
            $response->assertOk();
            $this->assertInternalLinksAreReachable($response->getContent(), $page);
        }
    }

    public function test_public_redirect_routes_land_on_existing_sections(): void
    {
        $redirects = [
            '/profil-sekolah' => ['/', 'profil'],
            '/asrama-kehidupan-sekolah' => ['/kesiswaan-ekstrakurikuler', 'ekskul'],
            '/galeri' => ['/', 'galeri'],
            '/prestasi' => ['/akademik', 'prestasi'],
            '/kontak' => ['/', 'kontak'],
        ];

        foreach ($redirects as $source => [$target, $fragment]) {
            $this->get($source)->assertRedirect($target.'#'.$fragment);
            $targetResponse = $this->get($target)->assertOk();
            $this->assertHtmlHasId($targetResponse->getContent(), $fragment, $source);
        }
    }

    public function test_admin_navigation_links_are_reachable_for_an_authenticated_admin(): void
    {
        $admin = User::query()->where('email', 'admin@sman2balige.sch.id')->firstOrFail();
        $admin->update(['must_change_password' => false]);

        $this->actingAs($admin)->withSession(['is_admin' => true]);

        foreach (['/admin', '/admin/beranda', '/admin/berita', '/admin/prestasi', '/admin/kesiswaan', '/admin/ppdb', '/admin/galeri', '/admin/pengaturan'] as $page) {
            $response = $this->get($page);
            $response->assertOk();
            $this->assertInternalLinksAreReachable($response->getContent(), $page);
        }
    }

    private function assertInternalLinksAreReachable(string $html, string $currentPath): void
    {
        preg_match_all('/<a\b[^>]*\bhref=(?:"([^"]*)"|\'([^\']*)\')/i', $html, $matches, PREG_SET_ORDER);
        $checked = [];

        foreach ($matches as $match) {
            $href = html_entity_decode($match[1] !== '' ? $match[1] : $match[2], ENT_QUOTES | ENT_HTML5);

            if ($href === '' || preg_match('/^(?:mailto:|tel:|javascript:)/i', $href)) {
                continue;
            }

            $parts = parse_url($href);
            if ($parts === false || (isset($parts['host']) && $parts['host'] !== 'localhost')) {
                continue;
            }

            $path = $parts['path'] ?? (isset($parts['host']) ? '/' : (parse_url($currentPath, PHP_URL_PATH) ?: '/'));
            $query = isset($parts['query']) ? '?'.$parts['query'] : '';
            $fragment = $parts['fragment'] ?? null;
            $key = $path.$query.'#'.($fragment ?? '');

            if (isset($checked[$key])) {
                continue;
            }
            $checked[$key] = true;

            $response = $this->get($path.$query);
            $this->assertLessThan(400, $response->getStatusCode(), "Tautan {$href} dari {$currentPath} tidak dapat dibuka.");

            if ($fragment !== null && $fragment !== '') {
                $this->assertHtmlHasId($response->getContent(), $fragment, $href);
            }
        }
    }

    private function assertHtmlHasId(string $html, string $id, string $source): void
    {
        $quotedId = preg_quote($id, '/');
        $this->assertMatchesRegularExpression(
            '/\bid=(?:"'.$quotedId.'"|\''.$quotedId.'\')/i',
            $html,
            "Tautan {$source} mengarah ke bagian #{$id} yang tidak tersedia."
        );
    }
}
