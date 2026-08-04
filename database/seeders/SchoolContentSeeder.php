<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Activity;
use App\Models\Gallery;
use App\Models\Post;
use App\Models\PpdbApplication;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SchoolContentSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::setMany([
            'school_name' => 'SMAN 2 Balige',
            'school_email' => 'smanegeri2balige01@gmail.com',
            'school_phone' => '0632 4320052',
            'school_address' => 'Jl. Kartini Soposurung, Sangkar Nihuta, Balige, Kabupaten Toba, Sumatera Utara 22312',
            'school_npsn' => '10208520',
            'school_postal_code' => '22312',
            'school_accreditation' => 'A',
            'school_latitude' => '2.324300000000',
            'school_longitude' => '99.048800000000',
            'maps_url' => 'https://www.google.com/maps/search/?api=1&query=SMAN%202%20Balige',
            'facebook_url' => SiteSetting::OFFICIAL_FACEBOOK_URL,
            'site_status' => 'Aktif',
            'hero_title' => 'Selamat Datang di SMAN 2 Balige',
            'hero_subtitle' => 'Informasi resmi mengenai profil sekolah, kegiatan akademik, kesiswaan, berita, dan penerimaan murid baru.',
            'hero_badge' => 'Situs Resmi Sekolah',
            'profile_summary' => 'SMAN 2 Balige merupakan sekolah menengah atas negeri di Balige yang menyelenggarakan pembelajaran, pembinaan karakter, dan kegiatan pengembangan diri bagi siswa.',
            'profile_detail' => 'Situs ini menyediakan informasi sekolah yang dibutuhkan siswa, orang tua, alumni, dan masyarakat.',
            'vision' => 'Terwujudnya insan pendidikan yang bertaqwa, cerdas, terampil, kompetitif, dan berwawasan lingkungan dalam kancah global yang dinamis.',
            'principal_name' => 'Ani Sefriana Nadapdap, S.Pd., M.Si.',
            'principal_message' => 'Kami berupaya menyediakan lingkungan belajar yang tertib, aman, dan mendukung perkembangan setiap siswa.',
            'cta_label' => 'Informasi PPDB',
            'ppdb_year' => '2026/2027',
            'ppdb_status' => 'SPMB Sumut 2026',
            'ppdb_open_date' => '2026-05-18',
            'ppdb_close_date' => '2026-06-30',
        ]);

        foreach ($this->posts() as $index => $post) {
            Post::query()->updateOrCreate(
                ['slug' => $post['slug']],
                array_merge($post, ['sort_order' => $index + 1])
            );
        }

        foreach ($this->achievements() as $index => $achievement) {
            Achievement::query()->updateOrCreate(
                ['title' => $achievement['title']],
                array_merge($achievement, ['sort_order' => $index + 1])
            );
        }

        foreach ($this->activities() as $index => $activity) {
            Activity::query()->updateOrCreate(
                ['name' => $activity['name']],
                array_merge($activity, ['sort_order' => $index + 1])
            );
        }

        foreach ($this->galleries() as $index => $gallery) {
            Gallery::query()->updateOrCreate(
                ['title' => $gallery['title']],
                array_merge($gallery, ['sort_order' => $index + 1])
            );
        }

        foreach ($this->applications() as $application) {
            PpdbApplication::query()->updateOrCreate(
                ['registration_number' => $application['registration_number']],
                $application
            );
        }
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function posts(): array
    {
        return [
            [
                'title' => 'Penerimaan Siswa Baru Tahun Ajaran 2026/2027',
                'slug' => Str::slug('Penerimaan Siswa Baru Tahun Ajaran 2026/2027'),
                'category' => 'PPDB',
                'excerpt' => 'Informasi jalur pendaftaran, dokumen, dan jadwal layanan PPDB kini tersedia untuk calon siswa dan orang tua.',
                'body' => 'Panitia PPDB SMAN 2 Balige membuka layanan informasi untuk calon peserta didik baru tahun ajaran 2026/2027. Orang tua dan calon siswa dapat menyiapkan berkas utama sejak dini.',
                'image_class' => 'graduates',
                'is_featured' => true,
                'published_at' => '2026-05-12 08:00:00',
            ],
            [
                'title' => 'Tim Sains Sekolah Siap Mengikuti Seleksi Olimpiade',
                'slug' => Str::slug('Tim Sains Sekolah Siap Mengikuti Seleksi Olimpiade'),
                'category' => 'Prestasi',
                'excerpt' => 'Program pembinaan akademik terus diperkuat melalui mentoring rutin, simulasi soal, dan evaluasi berkala.',
                'body' => 'Pembinaan olimpiade berjalan melalui kelas intensif, pendampingan guru, dan simulasi berkala agar siswa siap berkompetisi di tingkat provinsi dan nasional.',
                'image_class' => 'olympiad',
                'is_featured' => true,
                'published_at' => '2026-05-08 08:00:00',
            ],
            [
                'title' => 'LDKS Menumbuhkan Kepemimpinan yang Berkarakter',
                'slug' => Str::slug('LDKS Menumbuhkan Kepemimpinan yang Berkarakter'),
                'category' => 'Kesiswaan',
                'excerpt' => 'OSIS dan MPK menyiapkan agenda pembinaan agar siswa berani memimpin, bekerja sama, dan bertanggung jawab.',
                'body' => 'Latihan dasar kepemimpinan siswa menjadi ruang pembentukan karakter, komunikasi, dan tanggung jawab organisasi.',
                'image_class' => 'workshop',
                'is_featured' => true,
                'published_at' => '2026-05-01 08:00:00',
            ],
            [
                'title' => 'SMAN 2 Balige Perkuat Pembinaan Olimpiade dan Riset Siswa',
                'slug' => 'pembinaan-sains-sman-2-balige-2026',
                'category' => 'Akademik',
                'excerpt' => 'Program pembinaan akademik tahun ini difokuskan pada pendampingan intensif, riset ilmiah, dan penguatan karakter kompetitif siswa.',
                'body' => 'Prestasi dan budaya riset terus menjadi perhatian utama SMAN 2 Balige. Melalui pembinaan terjadwal, siswa didampingi untuk menguatkan kemampuan analisis, keberanian berkompetisi, dan kedisiplinan belajar.',
                'image_class' => 'trophy',
                'is_featured' => true,
                'published_at' => '2026-05-15 08:00:00',
            ],
        ];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function achievements(): array
    {
        return [
            ['title' => 'OSN Astronomi: Juara 1 Nasional', 'student_name' => 'Andini Putri', 'class_name' => 'XII MIPA 1', 'competition' => 'OSN Astronomi', 'level' => 'Nasional', 'rank' => 'Juara 1', 'year' => 2026, 'description' => 'Capaian akademik melalui pembinaan intensif dan simulasi kompetisi.', 'image_class' => 'victory', 'is_featured' => true],
            ['title' => 'Juara 1 Debat Bahasa Inggris Nasional', 'student_name' => 'Arisandi P. Hutabarat', 'class_name' => 'XI Bahasa', 'competition' => 'Debat Bahasa Inggris', 'level' => 'Nasional', 'rank' => 'Medali Emas', 'year' => 2026, 'description' => 'Prestasi komunikasi dan berpikir kritis di tingkat nasional.', 'image_class' => 'speech'],
            ['title' => 'Medali Perak Lari 100m O2SN', 'student_name' => 'Samuel Siahaan', 'class_name' => 'XI IPS 2', 'competition' => 'O2SN Atletik', 'level' => 'Provinsi', 'rank' => 'Medali Perak', 'year' => 2026, 'description' => 'Prestasi olahraga yang membanggakan sekolah di tingkat provinsi.', 'image_class' => 'runner'],
            ['title' => 'Penampil Terbaik Festival Budaya', 'student_name' => 'Sanggar Tari SMAN 2', 'class_name' => null, 'competition' => 'Festival Budaya', 'level' => 'Nasional', 'rank' => 'Penghargaan Utama', 'year' => 2026, 'description' => 'Karya seni dan budaya Toba tampil sebagai penampil terbaik.', 'image_class' => 'dance'],
        ];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function activities(): array
    {
        return [
            ['name' => 'OSIS', 'type' => 'Organisasi Siswa', 'coordinator' => 'Ketua OSIS', 'mentor' => 'Waka Kesiswaan', 'schedule' => 'Jumat, 14.00 WIB', 'location' => 'Ruang OSIS', 'description' => 'Penggerak program kepemimpinan, kreativitas, bakti sosial, dan budaya sekolah.', 'image_class' => 'bi-people-fill'],
            ['name' => 'MPK', 'type' => 'Organisasi Siswa', 'coordinator' => 'Ketua MPK', 'mentor' => 'Pembina MPK', 'schedule' => 'Rabu, 14.00 WIB', 'location' => 'Aula', 'description' => 'Forum aspirasi siswa yang membantu menjaga komunikasi antara siswa dan sekolah.', 'image_class' => 'bi-chat-square-heart-fill'],
            ['name' => 'Basket', 'type' => 'Ekstrakurikuler Olahraga', 'coordinator' => 'Kapten Tim Basket', 'mentor' => 'Guru PJOK', 'schedule' => 'Selasa dan Kamis, 15.30 WIB', 'location' => 'Lapangan Olahraga', 'description' => 'Latihan fisik terarah untuk membangun sportivitas, kerja sama, dan daya juang.', 'image_class' => 'bi-stars'],
            ['name' => 'Sains & Riset', 'type' => 'Ekstrakurikuler Akademik', 'coordinator' => 'Koordinator Riset', 'mentor' => 'Tim Guru Sains', 'schedule' => 'Sabtu, 09.00 WIB', 'location' => 'Laboratorium', 'description' => 'Klub sains, robotik, karya ilmiah, dan pendampingan lomba akademik.', 'image_class' => 'bi-stars'],
            ['name' => 'Seni & Budaya', 'type' => 'Ekstrakurikuler Seni', 'coordinator' => 'Koordinator Sanggar', 'mentor' => 'Guru Seni Budaya', 'schedule' => 'Jumat, 15.30 WIB', 'location' => 'Aula Seni', 'description' => 'Musik, tari, teater, dan eksplorasi budaya Toba dalam kegiatan sekolah.', 'image_class' => 'bi-stars'],
        ];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function galleries(): array
    {
        return [
            ['title' => 'Perpustakaan', 'description' => 'Ruang baca dan referensi akademik siswa.', 'image_class' => 'library'],
            ['title' => 'Lab Digital', 'description' => 'Fasilitas pembelajaran digital dan multimedia.', 'image_class' => 'lab'],
            ['title' => 'Ruang Belajar', 'description' => 'Kelas aktif untuk pembelajaran kolaboratif.', 'image_class' => 'hall'],
            ['title' => 'Lapangan Olahraga', 'description' => 'Ruang kegiatan olahraga dan upacara.', 'image_class' => 'court'],
        ];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function applications(): array
    {
        return [
            ['registration_number' => 'REG-2026-001', 'full_name' => 'Andi Wijaya', 'pathway' => 'Zonasi', 'origin_school' => 'SMPN 1 Balige', 'phone' => '+62 812-1234-5678', 'parent_name' => 'Parningotan Wijaya', 'address' => 'Jl. Sisingamangaraja, Balige', 'status' => 'waiting', 'documents' => ['Akta Kelahiran' => true, 'Kartu Keluarga' => true, 'Rapor Semester Terakhir' => true, 'Pas Foto' => true]],
            ['registration_number' => 'REG-2026-002', 'full_name' => 'Budi Ramadhan', 'pathway' => 'Prestasi', 'origin_school' => 'SMP Swasta Bintang', 'phone' => '+62 813-2345-6789', 'parent_name' => 'M. Ramadhan', 'address' => 'Jl. Merdeka, Balige', 'status' => 'verified', 'documents' => ['Akta Kelahiran' => true, 'Kartu Keluarga' => true, 'Rapor Semester Terakhir' => true, 'Pas Foto' => true]],
            ['registration_number' => 'REG-2026-003', 'full_name' => 'Citra Dewi', 'pathway' => 'Afirmasi', 'origin_school' => 'SMPN 2 Laguboti', 'phone' => '+62 821-3456-7890', 'parent_name' => 'L. Dewi', 'address' => 'Laguboti, Toba', 'status' => 'revision', 'documents' => ['Akta Kelahiran' => true, 'Kartu Keluarga' => false, 'Rapor Semester Terakhir' => true, 'Pas Foto' => true]],
        ];
    }
}
