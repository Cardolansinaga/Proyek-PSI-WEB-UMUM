<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Post;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AdminContentController extends Controller
{
    private const HOME_FIELDS = [
        'hero_title',
        'hero_subtitle',
        'hero_badge',
        'profile_summary',
        'profile_detail',
        'cta_label',
        'principal_name',
        'principal_message',
        'leadership_focus_json',
    ];

    public function beranda()
    {
        return view('pages.admin.beranda', [
            'settings' => $this->homeEditorSettings(),
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
            'leadership_focus_json' => ['nullable', 'json'],
            'hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'remove_hero_image' => ['nullable'],
            'publish_mode' => ['required', Rule::in(['published', 'draft'])],
        ], [
            'leadership_focus_json.json' => 'Format Daftar Fokus Kerja Beranda belum benar. Jika ragu, ubah hanya teks di dalam tanda kutip dan jangan hapus tanda kurung, koma, atau titik dua.',
            'hero_image.image' => 'Gambar Beranda harus berupa file gambar.',
            'hero_image.mimes' => 'Gambar Beranda harus berformat JPG, PNG, atau WEBP.',
        ], [
            'hero_title' => 'Judul Hero',
            'profile_summary' => 'Ringkasan Profil',
            'cta_label' => 'Teks Tombol PPDB',
            'leadership_focus_json' => 'Daftar Fokus Kerja Beranda',
        ]);

        $publishMode = $data['publish_mode'];
        $this->assertLeadershipFocusStructure($data['leadership_focus_json'] ?? null);
        $content = collect($data)->only(self::HOME_FIELDS)->all();
        $publishedImage = $this->settings()['hero_image'] ?? null;
        $draftImage = SiteSetting::getValue('draft_home_hero_image');
        $hasImageChange = $request->hasFile('hero_image') || $request->boolean('remove_hero_image');

        if ($publishMode === 'draft') {
            $draftContent = collect($content)
                ->mapWithKeys(fn ($value, $key) => ['draft_home_'.$key => $value])
                ->all();

            SiteSetting::setMany($draftContent + ['home_publish_mode' => 'draft']);

            if ($hasImageChange) {
                $newDraftImage = $this->storeImage($request, 'hero_image', $draftImage);
                SiteSetting::setMany(['draft_home_hero_image' => $newDraftImage]);
            } elseif ($draftImage === null) {
                SiteSetting::setMany(['draft_home_hero_image' => $publishedImage]);
            }
        } else {
            $selectedImage = $hasImageChange
                ? $this->storeImage($request, 'hero_image', $draftImage ?? $publishedImage)
                : ($draftImage ?? $publishedImage);

            if ($publishedImage && $publishedImage !== $selectedImage && $publishedImage !== $draftImage) {
                $this->deleteImage($publishedImage);
            }

            SiteSetting::setMany($content + [
                'hero_image' => $selectedImage,
                'home_publish_mode' => 'published',
            ]);
        }

        $this->clearSettingsCache();

        $message = $publishMode === 'published'
            ? 'Konten Beranda berhasil diterbitkan ke halaman publik.'
            : 'Draft Beranda berhasil disimpan tanpa mengubah halaman publik.';

        return redirect()->route('admin.beranda')->with('status', $message);
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

        $this->clearPublicPageCache();

        return redirect()->route('admin.beranda')->with('status', 'Gambar berita berhasil diperbarui.');
    }

    public function pengaturan()
    {
        return view('pages.admin.pengaturan', [
            'settings' => $this->settings(),
        ]);
    }

    public function updatePengaturan(Request $request)
    {
        $contentFields = [
            'school_tagline',
            'footer_description',
            'instagram_url',
            'facebook_url',
            'maps_url',
            'academic_hero_badge',
            'academic_hero_title',
            'academic_hero_highlight',
            'academic_hero_subtitle',
            'academic_intro_title',
            'academic_intro_body',
            'academic_intro_quote',
            'academic_stat_one_value',
            'academic_stat_one_label',
            'academic_stat_two_value',
            'academic_stat_two_label',
            'academic_curriculum_title',
            'academic_curriculum_description',
            'academic_calendar_year',
            'student_hero_badge',
            'student_hero_title',
            'student_hero_highlight',
            'student_hero_subtitle',
            'student_org_title',
            'student_org_description',
            'student_character_title',
            'student_character_description',
            'student_clubs_title',
            'student_clubs_description',
            'student_cta_title',
            'student_cta_description',
            'ppdb_hero_title',
            'ppdb_hero_subtitle',
            'ppdb_app_url',
            'ppdb_tracking_note',
            'ppdb_contact_title',
            'ppdb_contact_description',
        ];

        $jsonFieldLabels = [
            'academic_programs_json' => 'Daftar Program Akademik',
            'academic_calendar_json' => 'Daftar Kalender Akademik',
            'academic_services_json' => 'Daftar Layanan Akademik',
            'academic_facilities_json' => 'Daftar Fasilitas Akademik',
            'academic_faq_json' => 'Daftar Tanya Jawab Akademik',
            'student_character_json' => 'Daftar Program Pembinaan',
            'student_faq_json' => 'Daftar Tanya Jawab Kesiswaan',
            'ppdb_pathways_json' => 'Daftar Jalur PPDB',
            'ppdb_steps_json' => 'Daftar Alur PPDB',
            'ppdb_documents_json' => 'Daftar Dokumen PPDB',
            'ppdb_faq_json' => 'Daftar Tanya Jawab PPDB',
            'ppdb_capacity_json' => 'Daftar Daya Tampung SPMB',
            'ppdb_stage_schedule_json' => 'Daftar Jadwal Tahap SPMB',
            'ppdb_special_requirements_json' => 'Daftar Persyaratan Khusus SPMB',
            'ppdb_weighting_json' => 'Daftar Pembobotan Prestasi SPMB',
            'ppdb_contacts_json' => 'Daftar Kontak Panitia SPMB',
        ];
        $jsonFields = array_keys($jsonFieldLabels);
        $jsonMessages = collect($jsonFields)
            ->mapWithKeys(fn ($field) => [
                $field.'.json' => 'Format '.$jsonFieldLabels[$field].' belum benar. Jika ragu, ubah hanya teks di dalam tanda kutip dan jangan hapus tanda kurung, koma, atau titik dua.',
            ])
            ->all();
        $contentRules = array_fill_keys($contentFields, ['nullable', 'string']);
        $contentRules['instagram_url'] = ['nullable', 'url:http,https', 'max:2048'];
        $contentRules['maps_url'] = ['nullable', 'url:http,https', 'max:2048'];
        $contentRules['ppdb_app_url'] = ['nullable', 'url:http,https', 'max:2048'];
        $contentRules['facebook_url'] = [
            'nullable',
            'url:http,https',
            'max:2048',
            function (string $attribute, mixed $value, $fail): void {
                if ($value === null || $value === '') {
                    return;
                }

                $host = strtolower((string) parse_url($value, PHP_URL_HOST));
                $path = strtolower((string) parse_url($value, PHP_URL_PATH));

                if (! in_array($host, ['facebook.com', 'www.facebook.com', 'm.facebook.com'], true)) {
                    $fail('Facebook Resmi harus menggunakan alamat facebook.com.');

                    return;
                }

                if ($path === '' || $path === '/' || str_starts_with($path, '/search')) {
                    $fail('Gunakan tautan langsung halaman Facebook, bukan halaman pencarian Facebook.');
                }
            },
        ];

        $data = $request->validate(array_merge([
            'school_name' => ['required', 'string', 'max:120'],
            'school_email' => ['nullable', 'email', 'max:120'],
            'school_phone' => ['nullable', 'string', 'max:80'],
            'school_npsn' => ['required', 'digits:8'],
            'school_postal_code' => ['nullable', 'string', 'max:10'],
            'school_accreditation' => ['nullable', 'string', 'max:20'],
            'school_latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'school_longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'site_status' => ['required', 'string', 'max:80'],
            'school_address' => ['nullable', 'string'],
            'ppdb_year' => ['required', 'string', 'max:40'],
            'ppdb_status' => ['required', 'string', 'max:40'],
            'ppdb_open_date' => ['nullable', 'date'],
            'ppdb_close_date' => ['nullable', 'date', 'after_or_equal:ppdb_open_date'],
            'admin_name' => ['required', 'string', 'max:120'],
            'admin_email' => [
                'required',
                'email',
                'max:120',
                Rule::unique('users', 'email')->ignore($request->user()->id),
            ],
            'akademik_hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'kesiswaan_hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'ppdb_hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'berita_hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'remove_akademik_hero_image' => ['nullable'],
            'remove_kesiswaan_hero_image' => ['nullable'],
            'remove_ppdb_hero_image' => ['nullable'],
            'remove_berita_hero_image' => ['nullable'],
            'remove_logo' => ['nullable'],
        ], $contentRules, array_fill_keys($jsonFields, ['nullable', 'json'])), $jsonMessages, array_merge([
            'school_name' => 'Nama Sekolah',
            'school_email' => 'Email Resmi',
            'school_phone' => 'Telepon Sekolah',
            'school_npsn' => 'NPSN',
            'school_address' => 'Alamat Sekolah',
            'ppdb_year' => 'Tahun Ajaran PPDB',
            'ppdb_status' => 'Status PPDB',
            'ppdb_open_date' => 'Tanggal Buka PPDB',
            'ppdb_close_date' => 'Tanggal Tutup PPDB',
        ], $jsonFieldLabels));

        $imageFields = ['akademik_hero_image', 'kesiswaan_hero_image', 'ppdb_hero_image', 'berita_hero_image'];
        $this->assertStructuredJsonFields($data);

        SiteSetting::setMany(collect($data)->except(array_merge(
            ['admin_name', 'admin_email', 'logo', 'remove_logo'],
            $imageFields,
            array_map(fn ($field) => 'remove_'.$field, $imageFields),
        ))->all());

        foreach ($imageFields as $field) {
            $path = $this->storeImage($request, $field, $this->settings()[$field] ?? null);
            if ($request->hasFile($field) || $request->boolean('remove_'.$field)) {
                SiteSetting::setMany([$field => $path]);
            }
        }

        // handle logo upload separately
        $logoPath = $this->storeImage($request, 'logo', $this->settings()['logo'] ?? null);
        if ($request->hasFile('logo') || $request->boolean('remove_logo')) {
            SiteSetting::setMany(['logo' => $logoPath]);
        }

        $this->clearSettingsCache();

        $request->user()->update([
            'name' => $data['admin_name'],
            'email' => Str::lower($data['admin_email']),
        ]);
        $request->session()->put('admin_name', $data['admin_name']);

        return redirect()->route('admin.pengaturan')->with('status', 'Pengaturan berhasil disimpan.');
    }

    private function assertLeadershipFocusStructure(?string $json): void
    {
        if ($json === null || trim($json) === '') {
            return;
        }

        $decoded = json_decode($json, true);
        if (! is_array($decoded)) {
            throw ValidationException::withMessages([
                'leadership_focus_json' => ['Daftar Fokus Kerja Beranda harus berupa daftar JSON yang valid.'],
            ]);
        }

        if ($decoded === []) {
            return;
        }

        foreach ($decoded as $index => $item) {
            if (! is_array($item)) {
                throw ValidationException::withMessages([
                    'leadership_focus_json' => ['Item #'.($index + 1).' pada Daftar Fokus Kerja Beranda harus berupa objek JSON.'],
                ]);
            }

            foreach (['title', 'summary', 'description'] as $requiredKey) {
                $value = trim((string) ($item[$requiredKey] ?? ''));
                if ($value === '') {
                    throw ValidationException::withMessages([
                        'leadership_focus_json' => ['Item #'.($index + 1).' pada Daftar Fokus Kerja Beranda wajib mengisi kolom '.$requiredKey.'.'],
                    ]);
                }
            }
        }
    }

    /**
     * @param  array<string, mixed>  $data
     */
    private function assertStructuredJsonFields(array $data): void
    {
        $errors = [];
        $objectListRules = [
            'academic_programs_json' => ['title', 'description', 'icon'],
            'academic_calendar_json' => ['date', 'title', 'description'],
            'academic_services_json' => ['title', 'icon', 'description'],
            'academic_facilities_json' => ['title'],
            'academic_faq_json' => ['question', 'answer'],
            'student_character_json' => ['title', 'description', 'icon'],
            'student_faq_json' => ['question', 'answer'],
            'ppdb_pathways_json' => ['title', 'description', 'icon'],
            'ppdb_steps_json' => ['title', 'description'],
            'ppdb_faq_json' => ['question', 'answer'],
            'ppdb_contacts_json' => ['name', 'phone'],
        ];
        $stringListRules = [
            'ppdb_documents_json',
        ];

        foreach ($objectListRules as $field => $requiredKeys) {
            $rawValue = $data[$field] ?? null;
            if (! is_string($rawValue) || trim($rawValue) === '') {
                continue;
            }

            $decoded = json_decode($rawValue, true);
            if (! is_array($decoded) || $decoded === []) {
                $errors[$field][] = 'Kolom ini wajib berisi daftar JSON dengan minimal satu item.';
                continue;
            }

            foreach ($decoded as $index => $item) {
                if (! is_array($item)) {
                    $errors[$field][] = 'Item #'.($index + 1).' harus berupa objek JSON.';
                    continue;
                }

                foreach ($requiredKeys as $requiredKey) {
                    if (trim((string) ($item[$requiredKey] ?? '')) === '') {
                        $errors[$field][] = 'Item #'.($index + 1).' wajib mengisi kolom "'.$requiredKey.'".';
                    }
                }

                if ($field === 'academic_facilities_json') {
                    $hasClass = trim((string) ($item['class'] ?? '')) !== '';
                    $hasImage = trim((string) ($item['image'] ?? '')) !== '';
                    if (! $hasClass && ! $hasImage) {
                        $errors[$field][] = 'Item #'.($index + 1).' wajib memiliki "class" atau "image".';
                    }
                }
            }
        }

        foreach ($stringListRules as $field) {
            $rawValue = $data[$field] ?? null;
            if (! is_string($rawValue) || trim($rawValue) === '') {
                continue;
            }

            $decoded = json_decode($rawValue, true);
            if (! is_array($decoded) || $decoded === []) {
                $errors[$field][] = 'Kolom ini wajib berisi daftar JSON teks dengan minimal satu item.';
                continue;
            }

            foreach ($decoded as $index => $item) {
                if (trim((string) $item) === '') {
                    $errors[$field][] = 'Item #'.($index + 1).' tidak boleh kosong.';
                }
            }
        }

        if ($errors !== []) {
            throw ValidationException::withMessages($errors);
        }
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
        $this->clearPublicPageCache();
    }

    private function clearPublicPageCache(): void
    {
        $cacheFiles = glob(public_path('page-cache/*.html')) ?: [];

        foreach ($cacheFiles as $cacheFile) {
            if (is_file($cacheFile)) {
                @unlink($cacheFile);
            }
        }
    }

    /**
     * @return array<string, string|null>
     */
    private function settings(): array
    {
        return cache()->remember('admin_site_settings', 3600, fn () => SiteSetting::map(SiteSetting::defaults()));
    }

    /**
     * @return array<string, string|null>
     */
    private function homeEditorSettings(): array
    {
        $settings = $this->settings();
        $mode = $settings['home_publish_mode'] ?? 'published';

        if ($mode === 'draft') {
            $stored = SiteSetting::map();

            foreach ([...self::HOME_FIELDS, 'hero_image'] as $field) {
                $draftKey = 'draft_home_'.$field;

                if (array_key_exists($draftKey, $stored)) {
                    $settings[$field] = $stored[$draftKey];
                }
            }
        }

        $settings['publish_mode'] = $mode;

        return $settings;
    }
}
