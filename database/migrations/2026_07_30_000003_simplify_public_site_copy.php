<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('site_settings')) {
            return;
        }

        $replacements = [
            'hero_title' => [
                ['Membangun Generasi Unggul & Berkarakter'],
                'Selamat Datang di SMAN 2 Balige',
            ],
            'hero_subtitle' => [
                ['Membentuk pemimpin masa depan melalui standar akademik internasional, kedisiplinan tinggi, dan pengembangan bakat komprehensif di jantung kota Balige.'],
                'Informasi resmi mengenai profil sekolah, kegiatan akademik, kesiswaan, berita, dan penerimaan murid baru.',
            ],
            'hero_badge' => [
                ['Institusi Pendidikan Prestisius'],
                'Situs Resmi Sekolah',
            ],
            'profile_summary' => [
                [
                    'SMAN 2 Balige memadukan keteguhan tradisi, disiplin, literasi digital, dan pendampingan prestasi.',
                    'SMAN 2 Balige memadukan keteguhan tradisi, disiplin, literasi digital, dan pendampingan prestasi agar setiap siswa berkembang sebagai pribadi yang cerdas, santun, dan siap bersaing.',
                ],
                'SMAN 2 Balige merupakan sekolah menengah atas negeri di Balige yang menyelenggarakan pembelajaran, pembinaan karakter, dan kegiatan pengembangan diri bagi siswa.',
            ],
            'profile_detail' => [
                [
                    'Profil sekolah, nilai inti, sejarah, sambutan kepala sekolah, fasilitas, galeri, dan pembaruan terkini tersedia langsung di Beranda.',
                    'Profil sekolah, nilai inti, sejarah, sambutan kepala sekolah, fasilitas, galeri, dan pembaruan terkini tersedia langsung di Beranda sehingga pengunjung mendapat gambaran lengkap tanpa berpindah halaman.',
                ],
                'Situs ini menyediakan informasi sekolah yang dibutuhkan siswa, orang tua, alumni, dan masyarakat.',
            ],
            'principal_message' => [
                [
                    'Di SMAN 2 Balige, kami membangun budaya belajar yang disiplin, hangat, dan menantang.',
                    'Di SMAN 2 Balige, kami membangun budaya belajar yang disiplin, hangat, dan menantang agar siswa berani tumbuh sebagai pembelajar yang siap menghadapi masa depan.',
                ],
                'Kami berupaya menyediakan lingkungan belajar yang tertib, aman, dan mendukung perkembangan setiap siswa.',
            ],
            'academic_hero_badge' => [
                ['Keunggulan Akademik & Prestasi'],
                'Informasi Akademik',
            ],
            'academic_hero_title' => [
                ['Membentuk Intelek'],
                'Akademik',
            ],
            'academic_hero_highlight' => [
                ['Berprestasi Unggul'],
                '& Prestasi',
            ],
            'academic_hero_subtitle' => [
                ['Ekosistem belajar yang kompetitif, suportif, dan terukur untuk menumbuhkan karakter, disiplin, serta budaya juara.'],
                'Informasi mengenai kurikulum, layanan akademik, kalender pendidikan, fasilitas belajar, dan prestasi siswa.',
            ],
            'academic_intro_title' => [
                ['Komitmen Terhadap Integritas Akademik'],
                'Pembelajaran di SMAN 2 Balige',
            ],
            'academic_intro_body' => [
                ['Di SMAN 2 Balige, pendidikan bukan sekadar transfer pengetahuan, melainkan pembentukan pola pikir kritis dan etos kerja yang tinggi.'],
                'Kegiatan akademik dilaksanakan melalui pembelajaran di kelas, penugasan, evaluasi berkala, dan pendampingan sesuai kebutuhan siswa.',
            ],
            'academic_curriculum_title' => [
                ['Kurikulum Adaptif dan Terukur'],
                'Program Akademik',
            ],
            'academic_curriculum_description' => [
                ['Kurikulum Merdeka dipadukan dengan program pengayaan khusus olimpiade dan riset ilmiah.'],
                'Program pembelajaran dan pendampingan akademik yang tersedia bagi siswa SMAN 2 Balige.',
            ],
            'student_hero_badge' => [
                ['Ekosistem Kesiswaan'],
                'Kegiatan Siswa',
            ],
            'student_hero_title' => [
                ['Kesiswaan &'],
                'Kesiswaan',
            ],
            'student_hero_highlight' => [
                ['Ekstrakurikuler'],
                '& Ekstrakurikuler',
            ],
            'student_hero_subtitle' => [
                ['Informasi kegiatan OSIS, MPK, ekstrakurikuler, pembinaan karakter, dan program partisipasi siswa dalam mengembangkan potensi diri.'],
                'Informasi organisasi siswa, kegiatan sekolah, pembinaan karakter, dan pilihan ekstrakurikuler.',
            ],
            'student_org_title' => [
                ['Organisasi Siswa & Agenda'],
                'Organisasi dan Kegiatan Siswa',
            ],
            'student_org_description' => [
                ['OSIS dan MPK memfasilitasi kegiatan kepemimpinan, agenda tahunan, dan pembinaan karakter siswa melalui partisipasi aktif.'],
                'Informasi OSIS, MPK, dan kegiatan siswa yang berlangsung di lingkungan sekolah.',
            ],
            'student_character_title' => [
                ['Karakter & Kepemimpinan'],
                'Pembinaan Karakter',
            ],
            'student_character_description' => [
                ['Setiap siswa adalah pemimpin masa depan yang perlu dibina dengan penuh perhatian dan dedikasi.'],
                'Kegiatan pembinaan membantu siswa membangun disiplin, tanggung jawab, dan kemampuan bekerja sama.',
            ],
            'student_clubs_title' => [
                ['Ekstrakurikuler Unggulan'],
                'Pilihan Ekstrakurikuler',
            ],
            'student_clubs_description' => [
                ['Pilihan kegiatan yang membantu siswa menemukan bakat, membangun relasi, dan mengasah karakter melalui pengalaman praktis.'],
                'Kegiatan ekstrakurikuler dapat diikuti siswa sesuai minat dan jadwal yang tersedia.',
            ],
            'student_cta_title' => [
                ['Jadilah Bagian Dari Komunitas Kesiswaan SMAN 2 Balige'],
                'Informasi Kegiatan Siswa',
            ],
            'student_cta_description' => [
                ['Bergabunglah dengan ribuan siswa yang aktif mengembangkan potensi diri melalui kegiatan organisasi dan ekstrakurikuler.'],
                'Hubungi bagian kesiswaan untuk menanyakan jadwal, pendaftaran, atau ketentuan kegiatan.',
            ],
            'ppdb_hero_title' => [
                ['SPMB SMAN 2 Balige Tahun Pelajaran 2026/2027'],
                'Informasi SPMB SMAN 2 Balige',
            ],
            'ppdb_hero_subtitle' => [
                ['Informasi resmi Sistem Penerimaan Murid Baru SMAN 2 Balige berdasarkan poster SPMB Tahun Pelajaran 2026/2027: jalur, jadwal, syarat, pembobotan prestasi, aplikasi, dan kontak panitia.'],
                'Jadwal, jalur pendaftaran, persyaratan, aplikasi, dan kontak panitia penerimaan murid baru.',
            ],
        ];

        foreach ($replacements as $key => [$oldValues, $newValue]) {
            DB::table('site_settings')
                ->where('key', $key)
                ->whereIn('value', $oldValues)
                ->update([
                    'value' => $newValue,
                    'updated_at' => now(),
                ]);
        }
    }

    public function down(): void
    {
        // Simplified copy must not be reverted to promotional placeholder text.
    }
};
