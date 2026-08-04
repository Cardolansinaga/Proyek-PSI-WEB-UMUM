<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Activity;
use App\Models\Gallery;
use App\Models\Post;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PublicSiteController extends Controller
{
    public function home()
    {
        return view('welcome', [
            'settings' => $this->settings(),
            'posts' => Post::query()->published()->latest('published_at')->take(3)->get(),
            'galleries' => Gallery::query()->published()->orderBy('sort_order')->take(4)->get(),
            'achievements' => Achievement::query()->published()->orderByDesc('is_featured')->orderBy('sort_order')->take(5)->get(),
        ]);
    }

    public function akademik()
    {
        return view('pages.umum.akademik', [
            'settings' => $this->settings(),
            'achievements' => Achievement::query()->published()->orderByDesc('is_featured')->orderBy('sort_order')->get(),
        ]);
    }

    public function kesiswaan()
    {
        return view('pages.umum.kesiswaan', [
            'settings' => $this->settings(),
            'organizations' => Activity::query()->published()->where('type', 'like', '%Organisasi%')->orderBy('sort_order')->get(),
            'clubs' => Activity::query()->published()->where('type', 'like', '%Ekstrakurikuler%')->orderBy('sort_order')->get(),
        ]);
    }

    public function ppdb()
    {
        return view('pages.umum.ppdb', [
            'settings' => $this->settings(),
        ]);
    }

    public function berita(Request $request)
    {
        $filters = $request->validate([
            'category' => ['nullable', 'string', 'max:80'],
        ]);
        $activeCategory = trim((string) ($filters['category'] ?? ''));
        $postsQuery = Post::query()
            ->published()
            ->when($activeCategory !== '', fn ($query) => $query->where('category', $activeCategory));
        $posts = $postsQuery->latest('published_at')->paginate(9)->withQueryString();
        $featured = Post::query()
            ->published()
            ->where('is_featured', true)
            ->when($activeCategory !== '', fn ($query) => $query->where('category', $activeCategory))
            ->latest('published_at')
            ->first() ?? $posts->first();

        return view('pages.umum.berita', [
            'settings' => $this->settings(),
            'featured' => $featured,
            'posts' => $posts,
            'categories' => Post::query()
                ->published()
                ->distinct()
                ->orderBy('category')
                ->pluck('category'),
            'activeCategory' => $activeCategory,
        ]);
    }

    public function beritaDetail(string $slug)
    {
        return view('pages.umum.berita-detail', [
            'settings' => $this->settings(),
            'post' => Post::query()->published()->where('slug', $slug)->firstOrFail(),
            'relatedPosts' => Post::query()->published()->where('slug', '!=', $slug)->latest('published_at')->take(3)->get(),
        ]);
    }

    /**
     * @return array<string, string|null>
     */
    private function settings(): array
    {
        return cache()->remember('site_settings', 3600, fn () => SiteSetting::map(SiteSetting::defaults()));
    }
}
