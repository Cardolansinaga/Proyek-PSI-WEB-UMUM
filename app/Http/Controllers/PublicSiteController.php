<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Activity;
use App\Models\Gallery;
use App\Models\Post;
use App\Models\SiteSetting;

class PublicSiteController extends Controller
{
    public function home()
    {
        return view('welcome', [
            'settings' => $this->settings(),
            'posts' => Post::published()->latest('published_at')->take(3)->get(),
            'galleries' => Gallery::published()->orderBy('sort_order')->take(4)->get(),
            'achievements' => Achievement::published()->orderByDesc('is_featured')->orderBy('sort_order')->take(5)->get(),
        ]);
    }

    public function akademik()
    {
        return view('pages.umum.akademik', [
            'settings' => $this->settings(),
            'achievements' => Achievement::published()->orderByDesc('is_featured')->orderBy('sort_order')->get(),
        ]);
    }

    public function kesiswaan()
    {
        return view('pages.umum.kesiswaan', [
            'settings' => $this->settings(),
            'organizations' => Activity::published()->where('type', 'like', '%Organisasi%')->orderBy('sort_order')->get(),
            'clubs' => Activity::published()->where('type', 'like', '%Ekstrakurikuler%')->orderBy('sort_order')->get(),
        ]);
    }

    public function ppdb()
    {
        return view('pages.umum.ppdb', [
            'settings' => $this->settings(),
        ]);
    }

    public function berita()
    {
        $posts = Post::published()->latest('published_at')->paginate(9);

        return view('pages.umum.berita', [
            'settings' => $this->settings(),
            'featured' => Post::published()->where('is_featured', true)->latest('published_at')->first() ?? $posts->first(),
            'posts' => $posts,
        ]);
    }

    public function beritaDetail(string $slug)
    {
        return view('pages.umum.berita-detail', [
            'settings' => $this->settings(),
            'post' => Post::published()->where('slug', $slug)->firstOrFail(),
            'relatedPosts' => Post::published()->where('slug', '!=', $slug)->latest('published_at')->take(3)->get(),
        ]);
    }

    /**
     * @return array<string, string|null>
     */
    private function settings(): array
    {
        return cache()->remember('site_settings', 3600, fn () => SiteSetting::map([
            'school_name' => 'SMAN 2 Balige',
            'school_email' => 'info@sman2balige.sch.id',
            'school_phone' => '(0632) 213456',
            'school_address' => 'Jl. Kartini Soposurung, Balige, Toba, Sumatera Utara',
            'hero_title' => 'Membangun Generasi Unggul & Berkarakter',
            'hero_subtitle' => 'Membentuk pemimpin masa depan melalui standar akademik internasional, kedisiplinan tinggi, dan pengembangan bakat komprehensif di jantung kota Balige.',
            'profile_summary' => 'SMAN 2 Balige memadukan keteguhan tradisi, disiplin, literasi digital, dan pendampingan prestasi.',
            'profile_detail' => 'Profil sekolah, nilai inti, sejarah, sambutan kepala sekolah, fasilitas, galeri, dan pembaruan terkini tersedia langsung di Beranda.',
            'vision' => 'Terwujudnya insan pendidikan yang bertaqwa, cerdas, terampil, kompetitif, dan berwawasan lingkungan.',
            'principal_name' => 'Drs. Horas Balige, M.Pd.',
            'principal_message' => 'Di SMAN 2 Balige, kami membangun budaya belajar yang disiplin, hangat, dan menantang.',
            'cta_label' => 'Informasi PPDB',
            'hero_image' => null,
            'logo' => null,
            'akademik_hero_image' => null,
            'kesiswaan_hero_image' => null,
            'ppdb_hero_image' => null,
            'berita_hero_image' => null,
            'ppdb_year' => '2026/2027',
            'ppdb_status' => 'Dibuka',
            'ppdb_open_date' => '2026-06-01',
            'ppdb_close_date' => '2026-07-15',
        ]));
    }
}
