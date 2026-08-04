<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PostCrudTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_admin_can_create_a_published_post_with_automatic_slug_and_image(): void
    {
        Storage::fake('public');

        $this->actingAsAdmin()
            ->post(route('admin.posts.store'), $this->postPayload([
                'title' => 'Kabar Resmi Sekolah Hari Ini',
                'slug' => '',
                'status' => 'published',
                'published_at' => now()->subMinute()->format('Y-m-d H:i:s'),
                'image' => UploadedFile::fake()->image('berita.webp', 1200, 675),
            ]))
            ->assertRedirect();

        $post = Post::query()->where('title', 'Kabar Resmi Sekolah Hari Ini')->firstOrFail();

        $this->assertSame('kabar-resmi-sekolah-hari-ini', $post->slug);
        $this->assertNotNull($post->published_at);
        Storage::disk('public')->assertExists($post->image_path);

        $this->get(route('berita.show', $post->slug))
            ->assertOk()
            ->assertSee('Kabar Resmi Sekolah Hari Ini');
    }

    public function test_automatic_slug_stays_unique(): void
    {
        $this->actingAsAdmin()
            ->post(route('admin.posts.store'), $this->postPayload([
                'title' => 'Judul Berita Sama',
                'slug' => '',
            ]))
            ->assertRedirect();

        $this->actingAsAdmin()
            ->post(route('admin.posts.store'), $this->postPayload([
                'title' => 'Judul Berita Sama',
                'slug' => '',
            ]))
            ->assertRedirect();

        $this->assertDatabaseHas('posts', ['slug' => 'judul-berita-sama']);
        $this->assertDatabaseHas('posts', ['slug' => 'judul-berita-sama-2']);
    }

    public function test_draft_can_be_previewed_by_admin_but_not_opened_publicly(): void
    {
        $post = Post::query()->create($this->modelPayload([
            'title' => 'Draft Untuk Preview',
            'slug' => 'draft-untuk-preview',
            'status' => 'draft',
        ]));

        $this->get(route('berita.show', $post->slug))->assertNotFound();

        $this->actingAsAdmin()
            ->get(route('admin.posts.preview', $post))
            ->assertOk()
            ->assertSee('Mode preview admin')
            ->assertSee('Draft Untuk Preview');
    }

    public function test_admin_can_update_and_feature_a_post(): void
    {
        $oldFeatured = Post::query()->create($this->modelPayload([
            'title' => 'Featured Lama',
            'slug' => 'featured-lama',
            'is_featured' => true,
        ]));
        $post = Post::query()->create($this->modelPayload([
            'title' => 'Berita Akan Diedit',
            'slug' => 'berita-akan-diedit',
        ]));

        $this->actingAsAdmin()
            ->put(route('admin.posts.update', $post), $this->postPayload([
                'title' => 'Berita Sudah Diedit',
                'slug' => 'berita-sudah-diedit',
                'status' => 'published',
                'published_at' => now()->subMinute()->format('Y-m-d H:i:s'),
                'is_featured' => '1',
            ]))
            ->assertRedirect(route('admin.posts.edit', $post));

        $post->refresh();
        $oldFeatured->refresh();

        $this->assertSame('Berita Sudah Diedit', $post->title);
        $this->assertTrue($post->is_featured);
        $this->assertFalse($oldFeatured->is_featured);
    }

    public function test_delete_is_soft_and_admin_can_restore_the_post(): void
    {
        $post = Post::query()->create($this->modelPayload([
            'title' => 'Berita Dihapus Sementara',
            'slug' => 'berita-dihapus-sementara',
        ]));

        $this->actingAsAdmin()
            ->delete(route('admin.posts.destroy', $post))
            ->assertRedirect(route('admin.posts.index'));

        $this->assertSoftDeleted('posts', ['id' => $post->id]);
        $this->get(route('berita.show', $post->slug))->assertNotFound();

        $this->actingAsAdmin()
            ->patch(route('admin.posts.restore', $post->id))
            ->assertRedirect();

        $this->assertNotSoftDeleted('posts', ['id' => $post->id]);
    }

    public function test_public_category_filter_and_admin_search_work(): void
    {
        Post::query()->create($this->modelPayload([
            'title' => 'Berita Akademik Khusus Filter',
            'slug' => 'berita-akademik-khusus-filter',
            'category' => 'Akademik',
        ]));
        Post::query()->create($this->modelPayload([
            'title' => 'Berita Kesiswaan Khusus Filter',
            'slug' => 'berita-kesiswaan-khusus-filter',
            'category' => 'Kesiswaan',
        ]));

        $this->get(route('berita.index', ['category' => 'Akademik']))
            ->assertOk()
            ->assertSee('Berita Akademik Khusus Filter')
            ->assertDontSee('Berita Kesiswaan Khusus Filter');

        $this->actingAsAdmin()
            ->get(route('admin.posts.index', ['search' => 'Kesiswaan Khusus']))
            ->assertOk()
            ->assertSee('Berita Kesiswaan Khusus Filter')
            ->assertDontSee('Berita Akademik Khusus Filter');
    }

    public function test_post_validation_rejects_invalid_status_and_oversized_image(): void
    {
        Storage::fake('public');

        $this->actingAsAdmin()
            ->from(route('admin.posts.create'))
            ->post(route('admin.posts.store'), $this->postPayload([
                'status' => 'sembarang',
                'image' => UploadedFile::fake()->image('terlalu-besar.jpg')->size(5000),
            ]))
            ->assertRedirect(route('admin.posts.create'))
            ->assertSessionHasErrors(['status', 'image']);
    }

    public function test_admin_index_is_paginated(): void
    {
        for ($index = 1; $index <= 17; $index++) {
            Post::query()->create($this->modelPayload([
                'title' => 'Berita Pagination '.$index,
                'slug' => 'berita-pagination-'.$index,
            ]));
        }

        $this->actingAsAdmin()
            ->get(route('admin.posts.index'))
            ->assertOk()
            ->assertViewHas('posts', fn ($posts) => $posts->count() === 15 && $posts->hasMorePages());
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
    private function postPayload(array $overrides = []): array
    {
        return array_replace([
            'title' => 'Berita Pengujian',
            'slug' => 'berita-pengujian-'.uniqid(),
            'category' => 'Berita',
            'excerpt' => 'Ringkasan berita pengujian yang informatif.',
            'body' => "Paragraf pertama berita.\n\nParagraf kedua berita.",
            'meta_title' => 'Meta Berita Pengujian',
            'meta_description' => 'Deskripsi SEO berita pengujian untuk halaman resmi sekolah.',
            'status' => 'draft',
            'published_at' => '',
            'is_featured' => '0',
            'sort_order' => 0,
            'image_class' => 'library',
        ], $overrides);
    }

    /**
     * @param  array<string, mixed>  $overrides
     * @return array<string, mixed>
     */
    private function modelPayload(array $overrides = []): array
    {
        return array_replace([
            'title' => 'Berita Model',
            'slug' => 'berita-model-'.uniqid(),
            'category' => 'Berita',
            'excerpt' => 'Ringkasan berita model.',
            'body' => 'Isi berita model.',
            'status' => 'published',
            'published_at' => now()->subMinute(),
            'is_featured' => false,
            'sort_order' => 0,
            'image_class' => 'library',
        ], $overrides);
    }
}
