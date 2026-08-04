<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class SiteSetting extends Model
{
    public const OFFICIAL_FACEBOOK_URL = 'https://www.facebook.com/sman2baligesoposurung';

    protected $fillable = ['key', 'value'];

    /**
     * @return array<string, string|null>
     */
    public static function defaults(): array
    {
        return [
            'school_name' => 'SMAN 2 Balige',
            'school_tagline' => 'Unggul & Berkarakter',
            'school_email' => 'smanegeri2balige01@gmail.com',
            'school_phone' => '0632 4320052',
            'school_address' => 'Jl. Kartini Soposurung, Sangkar Nihuta, Balige, Kabupaten Toba, Sumatera Utara 22312',
            'school_npsn' => '10208520',
            'school_postal_code' => '22312',
            'school_accreditation' => 'A',
            'school_latitude' => '2.324300000000',
            'school_longitude' => '99.048800000000',
            'site_status' => 'Aktif',
            'home_publish_mode' => 'published',
            'footer_description' => 'Portal resmi informasi sekolah untuk profil, akademik, kesiswaan dan ekstrakurikuler, PPDB, dan kontak SMAN 2 Balige.',
            'instagram_url' => 'https://www.instagram.com/sman2_balige?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==',
            'facebook_url' => self::OFFICIAL_FACEBOOK_URL,
            'maps_url' => 'https://www.google.com/maps/search/?api=1&query=SMAN%202%20Balige',
            'hero_title' => 'Selamat Datang di SMAN 2 Balige',
            'hero_subtitle' => 'Informasi resmi mengenai profil sekolah, kegiatan akademik, kesiswaan, berita, dan penerimaan murid baru.',
            'hero_badge' => 'Situs Resmi Sekolah',
            'profile_summary' => 'SMAN 2 Balige merupakan sekolah menengah atas negeri di Balige yang menyelenggarakan pembelajaran, pembinaan karakter, dan kegiatan pengembangan diri bagi siswa.',
            'profile_detail' => 'Situs ini menyediakan informasi sekolah yang dibutuhkan siswa, orang tua, alumni, dan masyarakat.',
            'vision' => 'Terwujudnya insan pendidikan yang bertaqwa, cerdas, terampil, kompetitif, dan berwawasan lingkungan.',
            'principal_name' => 'Ani Sefriana Nadapdap, S.Pd., M.Si.',
            'principal_message' => 'Kami berupaya menyediakan lingkungan belajar yang tertib, aman, dan mendukung perkembangan setiap siswa.',
            'leadership_focus_json' => '[]',
            'cta_label' => 'Informasi PPDB',
            'hero_image' => null,
            'logo' => null,
            'akademik_hero_image' => null,
            'kesiswaan_hero_image' => null,
            'ppdb_hero_image' => null,
            'berita_hero_image' => null,
            'academic_hero_badge' => 'Informasi Akademik',
            'academic_hero_title' => 'Akademik',
            'academic_hero_highlight' => '& Prestasi',
            'academic_hero_subtitle' => 'Informasi mengenai kurikulum, layanan akademik, kalender pendidikan, fasilitas belajar, dan prestasi siswa.',
            'academic_intro_title' => 'Pembelajaran di SMAN 2 Balige',
            'academic_intro_body' => 'Kegiatan akademik dilaksanakan melalui pembelajaran di kelas, penugasan, evaluasi berkala, dan pendampingan sesuai kebutuhan siswa.',
            'academic_intro_quote' => 'Kalender dan layanan akademik tersedia bagi siswa dan orang tua.',
            'academic_stat_one_value' => null,
            'academic_stat_one_label' => null,
            'academic_stat_two_value' => null,
            'academic_stat_two_label' => null,
            'academic_curriculum_title' => 'Program Akademik',
            'academic_curriculum_description' => 'Program pembelajaran dan pendampingan akademik yang tersedia bagi siswa SMAN 2 Balige.',
            'academic_programs_json' => '[]',
            'academic_calendar_year' => null,
            'academic_calendar_json' => '[]',
            'academic_services_json' => '[]',
            'academic_facilities_json' => '[]',
            'academic_faq_json' => '[]',
            'student_hero_badge' => 'Kegiatan Siswa',
            'student_hero_title' => 'Kesiswaan',
            'student_hero_highlight' => '& Ekstrakurikuler',
            'student_hero_subtitle' => 'Informasi organisasi siswa, kegiatan sekolah, pembinaan karakter, dan pilihan ekstrakurikuler.',
            'student_org_title' => 'Organisasi dan Kegiatan Siswa',
            'student_org_description' => 'Informasi OSIS, MPK, dan kegiatan siswa yang berlangsung di lingkungan sekolah.',
            'student_character_title' => 'Pembinaan Karakter',
            'student_character_description' => 'Kegiatan pembinaan membantu siswa membangun disiplin, tanggung jawab, dan kemampuan bekerja sama.',
            'student_character_json' => '[]',
            'student_clubs_title' => 'Pilihan Ekstrakurikuler',
            'student_clubs_description' => 'Kegiatan ekstrakurikuler dapat diikuti siswa sesuai minat dan jadwal yang tersedia.',
            'student_faq_json' => '[]',
            'student_cta_title' => 'Informasi Kegiatan Siswa',
            'student_cta_description' => 'Hubungi bagian kesiswaan untuk menanyakan jadwal, pendaftaran, atau ketentuan kegiatan.',
            'ppdb_year' => '2026/2027',
            'ppdb_status' => 'SPMB Sumut 2026',
            'ppdb_open_date' => '2026-05-18',
            'ppdb_close_date' => '2026-06-30',
            'ppdb_app_url' => 'https://spmbsumutberkah.disdik.sumutprov.go.id/information/download-aplikasi-spmb-2026',
            'ppdb_tracking_note' => 'Calon Murid Baru yang sudah mendaftar wajib mengecek status/proses pendaftarannya di aplikasi SPMB pada menu Tracking.',
            'ppdb_hero_title' => 'Informasi SPMB SMAN 2 Balige',
            'ppdb_hero_subtitle' => 'Jadwal, jalur pendaftaran, persyaratan, aplikasi, dan kontak panitia penerimaan murid baru.',
            'ppdb_features_json' => self::jsonDefault([
                ['title' => 'Kanal Resmi SPMB Sumut', 'description' => 'Pendaftaran dan tracking dilakukan melalui aplikasi/website SPMB Sumut 2026.', 'icon' => 'bi-cloud-arrow-up'],
                ['title' => 'Kontak Sekolah Resmi', 'description' => 'Nomor sekolah pada poster resmi: 0812-7492-3186.', 'icon' => 'bi-headset'],
                ['title' => 'Lokasi SMAN 2 Balige', 'description' => 'SMA N 2 Balige Soposurung, Jalan Kartini, Soposurung, Balige.', 'icon' => 'bi-geo-alt'],
            ]),
            'ppdb_pathways_json' => self::jsonDefault([
                ['title' => 'Afirmasi', 'description' => 'Untuk keluarga tidak mampu, penyandang disabilitas, dan kondisi khusus sesuai ketentuan resmi.', 'icon' => 'bi-person-heart'],
                ['title' => 'Mutasi', 'description' => 'Untuk calon murid yang mengikuti perpindahan tugas orang tua atau anak guru.', 'icon' => 'bi-folder-check'],
                ['title' => 'Domisili', 'description' => 'Berdasarkan alamat pada KK minimal 1 tahun sebelum pendaftaran.', 'icon' => 'bi-geo-alt'],
                ['title' => 'Prestasi', 'description' => 'Berdasarkan prestasi akademik dan non akademik sesuai pembobotan resmi.', 'icon' => 'bi-trophy'],
            ]),
            'ppdb_steps_json' => self::jsonDefault([
                ['title' => 'Unduh / Buka Aplikasi', 'description' => 'Gunakan website SPMB Sumut 2026 untuk memulai pendaftaran.'],
                ['title' => 'Pilih 1 Sekolah Tujuan', 'description' => 'Pilih SMAN 2 Balige sesuai jalur dan ketentuan yang berlaku.'],
                ['title' => 'Validasi & Masa Sanggah', 'description' => 'Pantau status berkas dan proses verifikasi sesuai jadwal tahap.'],
                ['title' => 'Daftar Ulang', 'description' => 'Ikuti jadwal daftar ulang sesuai hasil pengumuman resmi.'],
            ]),
            'ppdb_documents_json' => self::jsonDefault([
                'Usia maksimal 21 tahun saat pendaftaran',
                'Lulusan SMP/MTs sederajat dibuktikan dengan ijazah atau Surat Keterangan Lulus',
                'Memiliki Kartu Keluarga (KK) minimal 1 tahun atau Surat Keterangan Domisili jika keadaan tertentu',
                'Memilih 1 sekolah tujuan',
                'Daftar online di aplikasi SPMB Sumut 2026',
            ]),
            'ppdb_faq_json' => self::jsonDefault([
                ['question' => 'Di mana pendaftaran SPMB SMAN 2 Balige dilakukan?', 'answer' => 'Pendaftaran dilakukan online melalui aplikasi/website SPMB Sumut 2026: https://spmbsumutberkah.disdik.sumutprov.go.id.'],
                ['question' => 'Apa yang harus dicek setelah mendaftar?', 'answer' => 'Calon Murid Baru wajib mengecek status/proses pendaftaran pada aplikasi SPMB di menu Tracking.'],
                ['question' => 'Berapa kapasitas penerimaan SMAN 2 Balige?', 'answer' => 'Kapasitas pada poster resmi adalah 6 rombel x 36 orang, total 216 orang.'],
            ]),
            'ppdb_research_cards_json' => self::jsonDefault([
                ['label' => 'Poster Resmi', 'title' => 'SPMB SMAN 2 Balige 2026/2027', 'description' => 'Data halaman ini disesuaikan dengan poster resmi SPMB SMAN 2 Balige Tahun Pelajaran 2026/2027.'],
                ['label' => 'Aplikasi SPMB', 'title' => 'SPMB Sumut Berkah', 'description' => 'Gunakan kanal pendaftaran online resmi dari Dinas Pendidikan Sumatera Utara.', 'url' => 'https://spmbsumutberkah.disdik.sumutprov.go.id', 'link_label' => 'Buka aplikasi SPMB'],
                ['label' => 'Info Sekolah', 'title' => 'Ikuti Facebook Sekolah', 'description' => 'Poster mencantumkan info SPMB SMAN 2 Balige di Facebook: SMAN 2 Balige Soposurung.', 'url' => self::OFFICIAL_FACEBOOK_URL, 'link_label' => 'Buka Facebook'],
            ]),
            'ppdb_capacity_json' => self::jsonDefault([
                ['group' => 'Daya Tampung', 'items' => [['label' => '6 rombel x 36 orang', 'value' => '216 orang']]],
                ['group' => 'Afirmasi', 'items' => [['label' => 'Total afirmasi', 'value' => 'Min 30%'], ['label' => 'Keluarga Tidak Mampu', 'value' => 'Min 20%'], ['label' => 'Disabilitas', 'value' => 'Max 5%'], ['label' => 'Terdampak Bencana', 'value' => 'Max 5%']]],
                ['group' => 'Mutasi', 'items' => [['label' => 'Total mutasi', 'value' => 'Max 5%'], ['label' => 'Pindah Orangtua', 'value' => '3%'], ['label' => 'Anak Guru', 'value' => '2%']]],
                ['group' => 'Domisili', 'items' => [['label' => 'Kuota domisili', 'value' => 'Min 30%']]],
                ['group' => 'Prestasi', 'items' => [['label' => 'Total prestasi', 'value' => 'Min 35%'], ['label' => 'Prestasi Akademik', 'value' => '30%'], ['label' => 'Prestasi Non Akademik', 'value' => '5%']]],
            ]),
            'ppdb_stage_schedule_json' => self::jsonDefault([
                ['stage' => 'Tahap 1', 'track' => 'Afirmasi, Mutasi, Domisili', 'tone' => 'gold', 'items' => [['label' => 'Pendaftaran', 'date' => '18 - 23 Mei 2026'], ['label' => 'Validasi & Masa Sanggah', 'date' => '18 - 24 Mei 2026'], ['label' => 'Pengumuman', 'date' => '4 Juni 2026'], ['label' => 'Daftar Ulang', 'date' => '5 - 8 Juni 2026']]],
                ['stage' => 'Tahap 2', 'track' => 'Prestasi', 'tone' => 'green', 'items' => [['label' => 'Pendaftaran', 'date' => '10 - 16 Juni 2026'], ['label' => 'Validasi & Masa Sanggah', 'date' => '10 - 17 Juni 2026'], ['label' => 'Pengumuman', 'date' => '26 Juni 2026'], ['label' => 'Daftar Ulang', 'date' => '27, 29 - 30 Juni 2026']]],
            ]),
            'ppdb_special_requirements_json' => self::jsonDefault([
                ['title' => 'Afirmasi', 'items' => ['Untuk keluarga tidak mampu dan penyandang disabilitas', 'Memiliki KIP, PKH, DTSEN, atau surat keterangan panti asuhan/sosial pemerintah']],
                ['title' => 'Mutasi', 'items' => ['Untuk calon murid yang mengikuti perpindahan tugas orangtua (ASN/TNI/POLRI/BUMN/BUMD)', 'Bukti: surat penugasan dan KK terbaru']],
                ['title' => 'Domisili', 'items' => ['Berdasarkan alamat pada KK minimal 1 tahun sebelum pendaftaran', 'Jika pendaftar melebihi kuota, urutan berdasarkan kemampuan akademik, jarak terdekat, dan usia']],
            ]),
            'ppdb_weighting_json' => self::jsonDefault([
                ['title' => 'Prestasi Akademik', 'items' => [['label' => 'Nilai rata-rata rapor semester 1-5', 'value' => '50%'], ['label' => 'Nilai tes kemampuan akademik', 'value' => '20%'], ['label' => 'Sertifikat lomba akademik', 'value' => '30%']]],
                ['title' => 'Prestasi Non Akademik', 'items' => [['label' => 'Sertifikat lomba non akademik (olahraga dan seni)', 'value' => '70%'], ['label' => 'Ketua OSIS, MPK, BES, atau ketua kepanduan', 'value' => '30%']]],
            ]),
            'ppdb_contacts_json' => self::jsonDefault([
                ['name' => 'Rohani Siburian', 'phone' => '0813-7081-4217'],
                ['name' => 'Giovanni Nainggolan', 'phone' => '0813-9679-2399'],
                ['name' => 'Veronika Nadapdap', 'phone' => '0852-0717-8875'],
                ['name' => 'SMA N 2 Balige', 'phone' => '0812-7492-3186'],
            ]),
            'ppdb_contact_title' => 'Butuh bantuan SPMB? Hubungi panitia resmi sekolah.',
            'ppdb_contact_description' => 'Gunakan kontak pada poster resmi SPMB SMAN 2 Balige untuk memastikan jalur, jadwal, validasi, masa sanggah, daftar ulang, dan kendala aplikasi.',
        ];
    }

    /**
     * @param  array<int|string, mixed>  $value
     */
    private static function jsonDefault(array $value): string
    {
        return json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public static function getValue(string $key, ?string $default = null): ?string
    {
        if (! Schema::hasTable('site_settings')) {
            return $default;
        }

        return static::query()->where('key', $key)->value('value') ?? $default;
    }

    /**
     * @param  array<string, mixed>  $settings
     */
    public static function setMany(array $settings): void
    {
        if (! Schema::hasTable('site_settings')) {
            return;
        }

        foreach ($settings as $key => $value) {
            static::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }

    /**
     * @param  array<string, string>  $defaults
     * @return array<string, string|null>
     */
    public static function map(array $defaults = []): array
    {
        if (! Schema::hasTable('site_settings')) {
            return $defaults;
        }

        $values = static::query()->pluck('value', 'key')->all();

        return array_replace($defaults, $values);
    }
}
