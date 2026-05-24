<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Activity;
use App\Models\Gallery;
use App\Models\Post;
use App\Models\PpdbApplication;
use App\Models\SiteSetting;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminContentController extends Controller
{
    public function dashboard()
    {
        return view('pages.admin.dashboard', [
            'stats' => [
                'posts' => Post::count(),
                'achievements' => Achievement::count(),
                'students' => Student::count(),
                'ppdb' => PpdbApplication::count(),
            ],
        ]);
    }

    public function beranda()
    {
        return view('pages.admin.beranda', [
            'settings' => $this->settings(),
            'posts' => Post::query()->latest('published_at')->take(3)->get(),
            'galleries' => Gallery::query()->orderBy('sort_order')->take(4)->get(),
        ]);
    }

    public function updateBeranda(Request $request)
    {
        $data = $request->validate([
            'hero_title' => ['required', 'string', 'max:180'],
            'hero_subtitle' => ['nullable', 'string', 'max:500'],
            'hero_badge' => ['nullable', 'string', 'max:120'],
            'profile_summary' => ['required', 'string'],
            'profile_detail' => ['nullable', 'string'],
            'cta_label' => ['required', 'string', 'max:80'],
            'principal_name' => ['nullable', 'string', 'max:120'],
            'principal_message' => ['nullable', 'string'],
            'hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'remove_hero_image' => ['nullable'],
        ]);

        SiteSetting::setMany(collect($data)->except(['hero_image', 'remove_hero_image'])->all());

        $heroImage = $this->storeImage($request, 'hero_image', $this->settings()['hero_image'] ?? null);
        if ($request->hasFile('hero_image') || $request->boolean('remove_hero_image')) {
            SiteSetting::setMany(['hero_image' => $heroImage]);
        }

        $this->clearSettingsCache();

        return redirect()->route('admin.beranda')->with('status', 'Konten Beranda berhasil disimpan dan tampil di halaman publik.');
    }

    public function updateBeritaImage(Request $request, Post $post)
    {
        $data = $request->validate([
            'image_class' => ['nullable', 'string', 'max:80'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'remove_image' => ['nullable'],
        ]);

        $post->update([
            'image_class' => $data['image_class'] ?? $post->image_class,
            'image_path' => $this->storeImage($request, 'image', $post->image_path),
        ]);

        return redirect()->route('admin.beranda')->with('status', 'Gambar berita berhasil diperbarui.');
    }

    public function prestasi()
    {
        $achievements = Achievement::query()
            ->orderByDesc('year')
            ->orderBy('sort_order')
            ->paginate(15);

        return view('pages.admin.prestasi', compact('achievements'));
    }

    public function createPrestasi()
    {
        return view('pages.admin.tambah-prestasi', [
            'achievement' => new Achievement(['year' => now()->year, 'level' => 'Nasional', 'status' => 'published']),
            'mode' => 'create',
        ]);
    }

    public function editPrestasi(Achievement $achievement)
    {
        return view('pages.admin.tambah-prestasi', [
            'achievement' => $achievement,
            'mode' => 'edit',
        ]);
    }

    public function storePrestasi(Request $request)
    {
        Achievement::create($this->achievementData($request));

        return redirect()->route('prestasi.index')->with('status', 'Prestasi berhasil disimpan ke database dan halaman publik.');
    }

    public function updatePrestasi(Request $request, Achievement $achievement)
    {
        $achievement->update($this->achievementData($request, $achievement->image_path));

        return redirect()->route('prestasi.index')->with('status', 'Prestasi berhasil diperbarui.');
    }

    public function destroyPrestasi(Achievement $achievement)
    {
        $this->deleteImage($achievement->image_path);
        $achievement->delete();

        return redirect()->route('prestasi.index')->with('status', 'Prestasi berhasil dihapus.');
    }

    public function kesiswaan()
    {
        $activities = Activity::query()
            ->orderBy('sort_order')
            ->paginate(15);

        return view('pages.admin.kesiswaan', compact('activities'));
    }

    public function createKesiswaan()
    {
        return view('pages.admin.form-kesiswaan', [
            'activity' => new Activity(['status' => 'Aktif', 'is_published' => true]),
            'mode' => 'create',
        ]);
    }

    public function editKesiswaan(Activity $activity)
    {
        return view('pages.admin.form-kesiswaan', [
            'activity' => $activity,
            'mode' => 'edit',
        ]);
    }

    public function storeKesiswaan(Request $request)
    {
        Activity::create($this->activityData($request));

        return redirect()->route('admin.kesiswaan.index')->with('status', 'Data kesiswaan berhasil disimpan ke database.');
    }

    public function updateKesiswaan(Request $request, Activity $activity)
    {
        $activity->update($this->activityData($request, $activity->image_path));

        return redirect()->route('admin.kesiswaan.index')->with('status', 'Data kesiswaan berhasil diperbarui.');
    }

    public function ppdb()
    {
        $applications = PpdbApplication::query()
            ->latest()
            ->paginate(20);

        return view('pages.admin.ppdb', [
            'applications' => $applications,
            'settings' => $this->settings(),
        ]);
    }

    public function ppdbDetail(PpdbApplication $application)
    {
        return view('pages.admin.detail-ppdb', [
            'application' => $application,
        ]);
    }

    public function verifyPpdb(Request $request, PpdbApplication $application)
    {
        $request->validate(['status' => ['required', 'in:waiting,verified,revision,rejected']]);
        $application->update(['status' => $request->status]);

        return redirect()->route('admin.ppdb')->with('status', 'Status pendaftar PPDB berhasil diperbarui.');
    }

    public function galeri()
    {
        $galleries = Gallery::query()
            ->orderBy('sort_order')
            ->paginate(12);

        return view('pages.admin.galeri', compact('galleries'));
    }

    public function storeGaleri(Request $request)
    {
        Gallery::create($this->galleryData($request));

        return redirect()->route('admin.galeri')->with('status', 'Galeri berhasil disimpan.');
    }

    public function updateGaleri(Request $request, Gallery $gallery)
    {
        $gallery->update($this->galleryData($request, $gallery->image_path));

        return redirect()->route('admin.galeri')->with('status', 'Galeri berhasil diperbarui.');
    }

    public function destroyGaleri(Gallery $gallery)
    {
        $this->deleteImage($gallery->image_path);
        $gallery->delete();

        return redirect()->route('admin.galeri')->with('status', 'Galeri berhasil dihapus.');
    }

    public function pengaturan()
    {
        return view('pages.admin.pengaturan', [
            'settings' => $this->settings(),
        ]);
    }

    public function updatePengaturan(Request $request)
    {
        $data = $request->validate([
            'school_name' => ['required', 'string', 'max:120'],
            'school_email' => ['nullable', 'email', 'max:120'],
            'school_phone' => ['nullable', 'string', 'max:80'],
            'site_status' => ['required', 'string', 'max:80'],
            'school_address' => ['nullable', 'string'],
            'ppdb_year' => ['required', 'string', 'max:40'],
            'ppdb_status' => ['required', 'string', 'max:40'],
            'ppdb_open_date' => ['nullable', 'date'],
            'ppdb_close_date' => ['nullable', 'date'],
            'admin_name' => ['nullable', 'string', 'max:120'],
            'admin_email' => ['nullable', 'email', 'max:120'],
            'akademik_hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'kesiswaan_hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'ppdb_hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'berita_hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'remove_akademik_hero_image' => ['nullable'],
            'remove_kesiswaan_hero_image' => ['nullable'],
            'remove_ppdb_hero_image' => ['nullable'],
            'remove_berita_hero_image' => ['nullable'],
        ]);

        $imageFields = ['akademik_hero_image', 'kesiswaan_hero_image', 'ppdb_hero_image', 'berita_hero_image'];

        SiteSetting::setMany(collect($data)->except(array_merge(
            ['admin_name', 'admin_email'],
            $imageFields,
            array_map(fn ($field) => 'remove_'.$field, $imageFields),
        ))->all());

        foreach ($imageFields as $field) {
            $path = $this->storeImage($request, $field, $this->settings()[$field] ?? null);
            if ($request->hasFile($field) || $request->boolean('remove_'.$field)) {
                SiteSetting::setMany([$field => $path]);
            }
        }

        $this->clearSettingsCache();

        if (! empty($data['admin_email'])) {
            User::updateOrCreate(
                ['email' => $data['admin_email']],
                ['name' => $data['admin_name'] ?: 'Admin Utama', 'password' => Hash::make('password')]
            );
            $request->session()->put('admin_name', $data['admin_name'] ?: 'Admin Utama');
        }

        return redirect()->route('admin.pengaturan')->with('status', 'Pengaturan berhasil disimpan.');
    }

    /**
     * @return array<string, mixed>
     */
    private function achievementData(Request $request, ?string $oldImage = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'student_name' => ['nullable', 'string', 'max:160'],
            'class_name' => ['nullable', 'string', 'max:120'],
            'competition' => ['nullable', 'string', 'max:160'],
            'level' => ['required', 'string', 'max:80'],
            'rank' => ['nullable', 'string', 'max:120'],
            'year' => ['required', 'integer', 'min:1990', 'max:2100'],
            'description' => ['nullable', 'string'],
            'image_class' => ['nullable', 'string', 'max:80'],
            'status' => ['required', 'string', 'max:40'],
            'is_featured' => ['nullable'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'remove_image' => ['nullable'],
        ]);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['image_path'] = $this->storeImage($request, 'image', $oldImage);
        unset($data['image'], $data['remove_image']);

        return $data;
    }

    /**
     * @return array<string, mixed>
     */
    private function activityData(Request $request, ?string $oldImage = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:160'],
            'type' => ['required', 'string', 'max:120'],
            'coordinator' => ['nullable', 'string', 'max:120'],
            'mentor' => ['nullable', 'string', 'max:120'],
            'schedule' => ['nullable', 'string', 'max:120'],
            'location' => ['nullable', 'string', 'max:120'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'string', 'max:40'],
            'publish' => ['nullable', 'string', 'max:40'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'remove_image' => ['nullable'],
        ]);

        $data['is_published'] = ($data['publish'] ?? 'Ya, tampilkan') === 'Ya, tampilkan';
        $data['image_class'] = Str::contains($data['type'], 'Organisasi') ? 'bi-people-fill' : 'bi-stars';
        $data['image_path'] = $this->storeImage($request, 'image', $oldImage);
        unset($data['publish'], $data['image'], $data['remove_image']);

        return $data;
    }

    /**
     * @return array<string, mixed>
     */
    private function galleryData(Request $request, ?string $oldImage = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:160'],
            'description' => ['nullable', 'string'],
            'image_class' => ['required', 'string', 'max:80'],
            'status' => ['required', 'string', 'max:40'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'remove_image' => ['nullable'],
        ]);

        $data['image_path'] = $this->storeImage($request, 'image', $oldImage);
        unset($data['image'], $data['remove_image']);

        return $data;
    }

    private function storeImage(Request $request, string $field, ?string $oldPath = null): ?string
    {
        if ($request->boolean('remove_'.$field)) {
            $this->deleteImage($oldPath);

            return null;
        }

        if (! $request->hasFile($field)) {
            return $oldPath;
        }

        $path = $request->file($field)->store('site-images', 'public');
        $this->deleteImage($oldPath);

        return $path;
    }

    private function deleteImage(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }

    private function clearSettingsCache(): void
    {
        cache()->forget('site_settings');
        cache()->forget('admin_site_settings');
    }

    /**
     * @return array<string, string|null>
     */
    private function settings(): array
    {
        return cache()->remember('admin_site_settings', 3600, fn () => SiteSetting::map([
            'school_name' => 'SMAN 2 Balige',
            'school_email' => 'info@sman2balige.sch.id',
            'school_phone' => '(0632) 213456',
            'school_address' => 'Jl. Kartini Soposurung, Balige, Toba, Sumatera Utara',
            'site_status' => 'Aktif',
            'hero_title' => 'Membangun Generasi Unggul & Berkarakter',
            'hero_subtitle' => 'Membentuk pemimpin masa depan melalui standar akademik internasional, kedisiplinan tinggi, dan pengembangan bakat komprehensif.',
            'hero_badge' => 'Institusi Pendidikan Prestisius',
            'profile_summary' => 'SMAN 2 Balige memadukan keteguhan tradisi, disiplin, literasi digital, dan pendampingan prestasi.',
            'profile_detail' => 'Profil sekolah, nilai inti, sejarah, sambutan kepala sekolah, fasilitas, galeri, dan pembaruan terkini tersedia langsung di Beranda.',
            'principal_name' => 'Drs. Horas Balige, M.Pd.',
            'principal_message' => 'Di SMAN 2 Balige, kami membangun budaya belajar yang disiplin, hangat, dan menantang.',
            'cta_label' => 'Informasi PPDB',
            'hero_image' => null,
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
