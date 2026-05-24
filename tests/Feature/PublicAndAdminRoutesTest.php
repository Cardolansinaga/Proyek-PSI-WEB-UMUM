<?php

namespace Tests\Feature;

use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PublicAndAdminRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    /**
     * @return array<string, array{string}>
     */
    public static function publicRoutes(): array
    {
        return [
            'home' => ['/'],
            'akademik' => ['/akademik'],
            'kesiswaan' => ['/kesiswaan-ekstrakurikuler'],
            'ppdb' => ['/ppdb'],
            'berita index' => ['/berita'],
            'berita detail' => ['/berita/pembinaan-sains-sman-2-balige-2026'],
        ];
    }

    public function test_public_pages_render_successfully(): void
    {
        foreach (self::publicRoutes() as $route) {
            $this->get($route[0])->assertOk();
        }
    }

    public function test_guru_and_alumni_pages_are_removed(): void
    {
        $this->get('/guru-tenaga-kependidikan')->assertNotFound();
        $this->get('/alumni-kemitraan')->assertNotFound();
        $this->withSession(['is_admin' => true])->get('/admin/guru')->assertNotFound();
    }

    public function test_admin_can_upload_home_hero_image(): void
    {
        Storage::fake('public');

        $this->withSession(['is_admin' => true])
            ->post(route('admin.beranda.update'), [
                'hero_title' => 'Judul Hero Test',
                'hero_subtitle' => 'Subjudul hero untuk pengujian upload gambar.',
                'hero_badge' => 'Badge Test',
                'profile_summary' => 'Ringkasan profil sekolah untuk test.',
                'profile_detail' => 'Detail profil sekolah untuk test.',
                'cta_label' => 'Informasi PPDB',
                'principal_name' => 'Kepala Sekolah Test',
                'principal_message' => 'Sambutan kepala sekolah untuk test.',
                'hero_image' => UploadedFile::fake()->image('hero.jpg', 1200, 800),
            ])
            ->assertRedirect(route('admin.beranda'));

        $path = SiteSetting::getValue('hero_image');

        $this->assertNotEmpty($path);
        Storage::disk('public')->assertExists($path);
    }

    public function test_admin_area_requires_session_authentication(): void
    {
        $this->get('/admin')
            ->assertRedirect(route('login'));
    }

    public function test_admin_area_rejects_forged_cookie_access(): void
    {
        $this->withCookie('is_admin', '1')
            ->get('/admin')
            ->assertRedirect(route('login'));
    }

    public function test_admin_login_starts_session_and_opens_dashboard(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin@sman2balige.sch.id',
            'password' => 'password',
        ]);

        $response
            ->assertRedirect('/admin')
            ->assertSessionHas('is_admin', true);

        $this->withSession(['is_admin' => true])
            ->get('/admin')
            ->assertOk();
    }

    public function test_admin_login_rejects_invalid_credentials(): void
    {
        $this->from('/login')
            ->post('/login', [
                'email' => 'admin@sman2balige.sch.id',
                'password' => 'wrong-password',
            ])
            ->assertRedirect('/login')
            ->assertSessionHasErrors('email');
    }
}
