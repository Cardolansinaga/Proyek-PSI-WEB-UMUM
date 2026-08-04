<?php

namespace Tests\Feature;

use App\Models\SiteSetting;
use App\Models\Gallery;
use App\Models\User;
use Database\Seeders\AdminSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
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
        $admin = $this->admin();
        $admin->update(['must_change_password' => false]);

        $this->actingAs($admin)
            ->withSession(['is_admin' => true])
            ->post(route('admin.beranda.update'), [
                'hero_title' => 'Judul Hero Test',
                'hero_subtitle' => 'Subjudul hero untuk pengujian upload gambar.',
                'hero_badge' => 'Badge Test',
                'profile_summary' => 'Ringkasan profil sekolah untuk test.',
                'profile_detail' => 'Detail profil sekolah untuk test.',
                'cta_label' => 'Informasi PPDB',
                'principal_name' => 'Kepala Sekolah Test',
                'principal_message' => 'Sambutan kepala sekolah untuk test.',
                'publish_mode' => 'published',
                'hero_image' => UploadedFile::fake()->image('hero.jpg', 1200, 800),
            ])
            ->assertRedirect(route('admin.beranda'));

        $path = SiteSetting::getValue('hero_image');

        $this->assertNotEmpty($path);
        Storage::disk('public')->assertExists($path);
    }

    public function test_admin_can_create_a_custom_gallery_type_with_a_real_image(): void
    {
        Storage::fake('public');
        $admin = $this->admin();
        $admin->update(['must_change_password' => false]);

        $this->actingAs($admin)
            ->withSession(['is_admin' => true])
            ->post(route('admin.galeri.store'), [
                'title' => 'Lapangan Basket Baru',
                'description' => 'Dokumentasi lapangan basket sekolah.',
                'image_class' => 'Lapangan Basket Outdoor',
                'status' => 'published',
                'image' => UploadedFile::fake()->image('lapangan-basket.jpg', 1200, 800),
            ])
            ->assertRedirect(route('admin.galeri'));

        $gallery = Gallery::query()->where('title', 'Lapangan Basket Baru')->firstOrFail();

        $this->assertSame('Lapangan Basket Outdoor', $gallery->image_class);
        $this->assertNotNull($gallery->image_path);
        Storage::disk('public')->assertExists($gallery->image_path);

        $this->get('/')
            ->assertOk()
            ->assertSee('Lapangan Basket Baru');
    }

    public function test_published_gallery_requires_an_uploaded_image(): void
    {
        $admin = $this->admin();
        $admin->update(['must_change_password' => false]);

        $this->actingAs($admin)
            ->withSession(['is_admin' => true])
            ->from(route('admin.galeri'))
            ->post(route('admin.galeri.store'), [
                'title' => 'Galeri Tanpa Foto',
                'description' => 'Tidak boleh langsung diterbitkan.',
                'image_class' => 'Ruang Baru',
                'status' => 'published',
            ])
            ->assertRedirect(route('admin.galeri'))
            ->assertSessionHasErrors('image');

        $this->assertDatabaseMissing('galleries', ['title' => 'Galeri Tanpa Foto']);
    }

    public function test_gallery_admin_uses_free_visual_type_and_modern_image_dropzone(): void
    {
        $admin = $this->admin();
        $admin->update(['must_change_password' => false]);

        $this->actingAs($admin)
            ->withSession(['is_admin' => true])
            ->get(route('admin.galeri'))
            ->assertOk()
            ->assertSee('list="gallery-visual-types"', false)
            ->assertSee('data-image-dropzone', false)
            ->assertSee('bisa ditempel dengan Ctrl+V')
            ->assertDontSee('<select name="image_class"', false);
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
            'password' => 'Test-only-Admin!2026',
        ]);

        $response
            ->assertRedirect(route('dashboard'))
            ->assertSessionHas('is_admin', true);

        $this->actingAs($this->admin())
            ->withSession(['is_admin' => true])
            ->get('/admin')
            ->assertOk()
            ->assertSee('Segera ganti password awal')
            ->assertSee(route('admin.password.edit'), false);
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

    public function test_admin_can_replace_initial_password_from_the_dashboard_reminder(): void
    {
        $admin = $this->admin();
        $newPassword = 'Password-Baru!2026';

        $this->actingAs($admin)
            ->withSession(['is_admin' => true])
            ->put(route('admin.password.update'), [
                'current_password' => 'Test-only-Admin!2026',
                'password' => $newPassword,
                'password_confirmation' => $newPassword,
            ])
            ->assertRedirect(route('dashboard'));

        $admin->refresh();

        $this->assertFalse($admin->must_change_password);
        $this->assertNotNull($admin->password_changed_at);
        $this->assertTrue(Hash::check($newPassword, $admin->password));

        $this->actingAs($admin)
            ->withSession(['is_admin' => true])
            ->get('/admin')
            ->assertOk();
    }

    public function test_admin_with_initial_password_can_use_other_admin_pages_before_changing_it(): void
    {
        $admin = $this->admin();

        $this->actingAs($admin)
            ->withSession(['is_admin' => true])
            ->get(route('admin.beranda'))
            ->assertOk();

        $this->assertTrue($admin->fresh()->must_change_password);
    }

    public function test_admin_seeder_never_overwrites_an_existing_password(): void
    {
        $admin = $this->admin();
        $admin->update([
            'password' => 'Password-Pribadi!2026',
            'must_change_password' => false,
        ]);
        $passwordHash = $admin->password;

        $this->seed(AdminSeeder::class);

        $admin->refresh();

        $this->assertSame($passwordHash, $admin->password);
        $this->assertFalse($admin->must_change_password);
    }

    public function test_admin_cannot_save_a_facebook_search_result_as_the_official_link(): void
    {
        $admin = $this->admin();
        $admin->update(['must_change_password' => false]);

        $this->actingAs($admin)
            ->withSession(['is_admin' => true])
            ->from(route('admin.pengaturan'))
            ->post(route('admin.pengaturan.update'), [
                'school_name' => 'SMAN 2 Balige',
                'school_npsn' => '10208520',
                'site_status' => 'Aktif',
                'ppdb_year' => '2026/2027',
                'ppdb_status' => 'SPMB Sumut 2026',
                'admin_name' => $admin->name,
                'admin_email' => $admin->email,
                'facebook_url' => 'https://www.facebook.com/search/top?q=SMAN%202%20Balige',
            ])
            ->assertRedirect(route('admin.pengaturan'))
            ->assertSessionHasErrors('facebook_url');

        $this->assertSame(
            SiteSetting::OFFICIAL_FACEBOOK_URL,
            SiteSetting::getValue('facebook_url')
        );
    }

    private function admin(): User
    {
        return User::query()->where('email', 'admin@sman2balige.sch.id')->firstOrFail();
    }
}
