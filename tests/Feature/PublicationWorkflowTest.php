<?php

namespace Tests\Feature;

use App\Models\Achievement;
use App\Models\Activity;
use App\Models\Gallery;
use App\Models\Post;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicationWorkflowTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_public_pages_only_show_published_content(): void
    {
        Post::query()->create([
            'title' => 'Berita Draft Rahasia',
            'slug' => 'berita-draft-rahasia',
            'status' => 'draft',
            'published_at' => now(),
        ]);
        Gallery::query()->create([
            'title' => 'Galeri Draft Rahasia',
            'image_class' => 'library',
            'status' => 'draft',
        ]);
        Achievement::query()->create([
            'title' => 'Prestasi Draft Rahasia',
            'year' => now()->year,
            'status' => 'draft',
        ]);
        Activity::query()->create([
            'name' => 'Kegiatan Draft Rahasia',
            'type' => 'Ekstrakurikuler',
            'status' => 'Draft',
            'is_published' => false,
        ]);

        $this->get('/')
            ->assertOk()
            ->assertDontSee('Berita Draft Rahasia')
            ->assertDontSee('Galeri Draft Rahasia')
            ->assertDontSee('Prestasi Draft Rahasia');

        $this->get('/akademik')
            ->assertOk()
            ->assertDontSee('Prestasi Draft Rahasia');

        $this->get('/kesiswaan-ekstrakurikuler')
            ->assertOk()
            ->assertDontSee('Kegiatan Draft Rahasia');

        $this->get('/berita')
            ->assertOk()
            ->assertDontSee('Berita Draft Rahasia');

        $this->get('/berita/berita-draft-rahasia')->assertNotFound();
    }

    public function test_future_post_is_not_public_before_its_publish_date(): void
    {
        Post::query()->create([
            'title' => 'Berita Terjadwal',
            'slug' => 'berita-terjadwal',
            'status' => 'published',
            'published_at' => now()->addDay(),
        ]);

        $this->get('/berita')
            ->assertOk()
            ->assertDontSee('Berita Terjadwal');

        $this->get('/berita/berita-terjadwal')->assertNotFound();
    }

    public function test_home_draft_does_not_replace_last_published_version(): void
    {
        SiteSetting::setMany([
            'hero_title' => 'Judul Beranda Terbit',
            'home_publish_mode' => 'published',
        ]);

        $this->actingAsAdmin()
            ->post(route('admin.beranda.update'), $this->homePayload([
                'hero_title' => 'Judul Beranda Draft',
                'publish_mode' => 'draft',
            ]))
            ->assertRedirect(route('admin.beranda'));

        $this->assertSame('Judul Beranda Terbit', SiteSetting::getValue('hero_title'));
        $this->assertSame('Judul Beranda Draft', SiteSetting::getValue('draft_home_hero_title'));
        $this->assertSame('draft', SiteSetting::getValue('home_publish_mode'));

        $this->get('/')
            ->assertOk()
            ->assertSee('Judul Beranda Terbit')
            ->assertDontSee('Judul Beranda Draft');
    }

    public function test_admin_can_publish_a_saved_home_version(): void
    {
        SiteSetting::setMany(['hero_title' => 'Versi Lama']);

        $this->actingAsAdmin()
            ->post(route('admin.beranda.update'), $this->homePayload([
                'hero_title' => 'Versi Baru Terbit',
                'publish_mode' => 'published',
            ]))
            ->assertRedirect(route('admin.beranda'));

        $this->assertSame('Versi Baru Terbit', SiteSetting::getValue('hero_title'));
        $this->assertSame('published', SiteSetting::getValue('home_publish_mode'));

        $this->get('/')
            ->assertOk()
            ->assertSee('Versi Baru Terbit');
    }

    private function actingAsAdmin(): static
    {
        $admin = User::query()->where('is_admin', true)->firstOrFail();
        $admin->update(['must_change_password' => false]);

        return $this->actingAs($admin)->withSession(['is_admin' => true]);
    }

    /**
     * @param  array<string, mixed>  $overrides
     * @return array<string, mixed>
     */
    private function homePayload(array $overrides = []): array
    {
        return array_replace([
            'hero_title' => 'Judul Beranda',
            'hero_subtitle' => 'Subjudul beranda resmi sekolah.',
            'hero_badge' => 'Sekolah Unggul',
            'profile_summary' => 'Ringkasan profil sekolah.',
            'profile_detail' => 'Detail profil sekolah.',
            'cta_label' => 'Informasi PPDB',
            'principal_name' => 'Kepala Sekolah',
            'principal_message' => 'Sambutan kepala sekolah.',
            'leadership_focus_json' => '[]',
            'publish_mode' => 'published',
        ], $overrides);
    }
}
