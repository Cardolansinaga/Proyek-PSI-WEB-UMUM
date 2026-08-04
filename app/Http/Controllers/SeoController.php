<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function robots(): Response
    {
        $content = implode("\n", [
            'User-agent: *',
            'Allow: /',
            'Disallow: /admin',
            'Disallow: /login',
            'Disallow: /forgot-password',
            'Disallow: /reset-password',
            '',
            'Sitemap: '.route('sitemap'),
            '',
        ]);

        return response($content)
            ->header('Content-Type', 'text/plain; charset=UTF-8')
            ->header('Cache-Control', 'public, max-age=3600');
    }

    public function sitemap(): Response
    {
        $staticPages = collect([
            ['url' => route('home'), 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['url' => route('akademik'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => route('kesiswaan'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => route('ppdb'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => route('berita.index'), 'priority' => '0.9', 'changefreq' => 'daily'],
        ]);

        $posts = Post::query()
            ->published()
            ->latest('updated_at')
            ->get(['slug', 'updated_at']);

        return response()
            ->view('seo.sitemap', compact('staticPages', 'posts'))
            ->header('Content-Type', 'application/xml; charset=UTF-8')
            ->header('Cache-Control', 'public, max-age=3600');
    }
}
