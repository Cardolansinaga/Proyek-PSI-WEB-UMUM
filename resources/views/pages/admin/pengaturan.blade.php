@extends('layouts.admin')

@section('title', 'Pengaturan Admin')

@push('styles')
    @vite('resources/css/admin-pages/pengaturan.css')
@endpush

@section('content')
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'pengaturan'])
    <div class="main-content">
        <main class="content-padding">
            <div class="page-head">
                <div>
                    <h1>Pengaturan Admin</h1>
                    <p>Atur identitas sekolah, kontak resmi, teks halaman publik, jadwal PPDB, dan gambar utama website.</p>
                    @if (session('status'))
                        <p class="status-message" style="margin-top: 12px;"><i class="bi bi-check-circle-fill" aria-hidden="true"></i> {{ session('status') }}</p>
                    @endif
                    @if ($errors->any())
                        <div class="error-list" style="margin-top: 12px;">
                            <strong>Periksa kembali data pengaturan:</strong>
                            <ul style="margin: 8px 0 0 18px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <button type="submit" form="settings-form" class="btn-primary"><i class="bi bi-save" aria-hidden="true"></i> Simpan Pengaturan</button>
            </div>

            @include('pages.admin.partials.page-guide', [
                'title' => 'Panduan aman mengubah pengaturan',
                'description' => 'Bagian ini mengatur banyak halaman sekaligus. Ubah hanya bagian yang memang perlu diperbarui.',
                'items' => [
                    'Untuk teks biasa, langsung ganti kalimat di kotak isian.',
                    'Untuk bagian Format Daftar Khusus, cukup ubah kata di dalam tanda kutip jika belum terbiasa.',
                    'Setelah klik Simpan Pengaturan, cek halaman publik yang terkait agar tidak ada teks salah.',
                ],
            ])

            <form id="settings-form" method="POST" action="{{ route('admin.pengaturan.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="settings-grid">
                    <div class="stack">
                        <section class="card">
                            <h2><i class="bi bi-building" aria-hidden="true"></i> Profil Sekolah</h2>
                            <div class="field-grid">
                                <div class="input-group">
                                    <label>Nama Sekolah</label>
                                    <input class="custom-input" name="school_name" value="{{ old('school_name', $settings['school_name'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Tagline Sekolah</label>
                                    <input class="custom-input" name="school_tagline" value="{{ old('school_tagline', $settings['school_tagline'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Email Resmi</label>
                                    <input type="email" class="custom-input" name="school_email" value="{{ old('school_email', $settings['school_email'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Telepon Sekolah</label>
                                    <input class="custom-input" name="school_phone" value="{{ old('school_phone', $settings['school_phone'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Status Situs</label>
                                    <select class="custom-select" name="site_status">
                                        @foreach (['Aktif', 'Mode Perawatan'] as $status)
                                            <option value="{{ $status }}" @selected(old('site_status', $settings['site_status'] ?? '') === $status)>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label>NPSN</label>
                                    <input class="custom-input" name="school_npsn" inputmode="numeric" maxlength="8" value="{{ old('school_npsn', $settings['school_npsn'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Kode Pos</label>
                                    <input class="custom-input" name="school_postal_code" value="{{ old('school_postal_code', $settings['school_postal_code'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Akreditasi</label>
                                    <input class="custom-input" name="school_accreditation" value="{{ old('school_accreditation', $settings['school_accreditation'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Latitude</label>
                                    <input class="custom-input" name="school_latitude" inputmode="decimal" value="{{ old('school_latitude', $settings['school_latitude'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Longitude</label>
                                    <input class="custom-input" name="school_longitude" inputmode="decimal" value="{{ old('school_longitude', $settings['school_longitude'] ?? '') }}">
                                </div>
                            </div>
                            <div class="input-group">
                                <label>Alamat Sekolah</label>
                                <textarea class="custom-textarea" name="school_address">{{ old('school_address', $settings['school_address'] ?? '') }}</textarea>
                            </div>
                        </section>

                        <section class="card">
                            <h2><i class="bi bi-globe2" aria-hidden="true"></i> Footer & Tautan Publik</h2>
                            <div class="input-group">
                                <label>Deskripsi Footer</label>
                                <textarea class="custom-textarea" name="footer_description">{{ old('footer_description', $settings['footer_description'] ?? '') }}</textarea>
                            </div>
                            <div class="field-grid">
                                <div class="input-group">
                                    <label>Instagram Resmi</label>
                                    <input type="url" class="custom-input" name="instagram_url" value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Facebook Resmi</label>
                                    <input class="custom-input" type="url" name="facebook_url" value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}" placeholder="https://www.facebook.com/nama-halaman">
                                    <small>Gunakan URL halaman/profil langsung, bukan URL hasil pencarian Facebook.</small>
                                </div>
                                <div class="input-group">
                                    <label>Google Maps</label>
                                    <input type="url" class="custom-input" name="maps_url" value="{{ old('maps_url', $settings['maps_url'] ?? '') }}">
                                </div>
                            </div>
                        </section>

                        <section class="card">
                            <h2><i class="bi bi-journal-check" aria-hidden="true"></i> Pengaturan PPDB</h2>
                            <div class="field-grid">
                                <div class="input-group">
                                    <label>Tahun Ajaran</label>
                                    <input class="custom-input" name="ppdb_year" value="{{ old('ppdb_year', $settings['ppdb_year'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Status PPDB</label>
                                    <input class="custom-input" name="ppdb_status" value="{{ old('ppdb_status', $settings['ppdb_status'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Tanggal Buka</label>
                                    <input type="date" class="custom-input" name="ppdb_open_date" value="{{ old('ppdb_open_date', $settings['ppdb_open_date'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Tanggal Tutup</label>
                                    <input type="date" class="custom-input" name="ppdb_close_date" value="{{ old('ppdb_close_date', $settings['ppdb_close_date'] ?? '') }}">
                                </div>
                            </div>
                        </section>

                        <section class="card">
                            <h2><i class="bi bi-mortarboard" aria-hidden="true"></i> Konten Akademik & Prestasi</h2>
                            <div class="field-grid">
                                <div class="input-group">
                                    <label>Badge Hero</label>
                                    <input class="custom-input" name="academic_hero_badge" value="{{ old('academic_hero_badge', $settings['academic_hero_badge'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Judul Hero</label>
                                    <input class="custom-input" name="academic_hero_title" value="{{ old('academic_hero_title', $settings['academic_hero_title'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Aksen Judul Hero</label>
                                    <input class="custom-input" name="academic_hero_highlight" value="{{ old('academic_hero_highlight', $settings['academic_hero_highlight'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Tahun Kalender Akademik</label>
                                    <input class="custom-input" name="academic_calendar_year" value="{{ old('academic_calendar_year', $settings['academic_calendar_year'] ?? '') }}">
                                </div>
                            </div>
                            <div class="input-group">
                                <label>Subjudul Hero</label>
                                <textarea class="custom-textarea" name="academic_hero_subtitle">{{ old('academic_hero_subtitle', $settings['academic_hero_subtitle'] ?? '') }}</textarea>
                            </div>
                            <div class="field-grid">
                                <div class="input-group">
                                    <label>Judul Komitmen</label>
                                    <input class="custom-input" name="academic_intro_title" value="{{ old('academic_intro_title', $settings['academic_intro_title'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Kutipan Visual</label>
                                    <input class="custom-input" name="academic_intro_quote" value="{{ old('academic_intro_quote', $settings['academic_intro_quote'] ?? '') }}">
                                </div>
                            </div>
                            <div class="input-group">
                                <label>Deskripsi Komitmen</label>
                                <textarea class="custom-textarea" name="academic_intro_body">{{ old('academic_intro_body', $settings['academic_intro_body'] ?? '') }}</textarea>
                            </div>
                            <div class="field-grid">
                                <div class="input-group">
                                    <label>Statistik 1 - Angka</label>
                                    <input class="custom-input" name="academic_stat_one_value" value="{{ old('academic_stat_one_value', $settings['academic_stat_one_value'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Statistik 1 - Label</label>
                                    <input class="custom-input" name="academic_stat_one_label" value="{{ old('academic_stat_one_label', $settings['academic_stat_one_label'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Statistik 2 - Angka</label>
                                    <input class="custom-input" name="academic_stat_two_value" value="{{ old('academic_stat_two_value', $settings['academic_stat_two_value'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Statistik 2 - Label</label>
                                    <input class="custom-input" name="academic_stat_two_label" value="{{ old('academic_stat_two_label', $settings['academic_stat_two_label'] ?? '') }}">
                                </div>
                            </div>
                            <div class="field-grid">
                                <div class="input-group">
                                    <label>Judul Kurikulum</label>
                                    <input class="custom-input" name="academic_curriculum_title" value="{{ old('academic_curriculum_title', $settings['academic_curriculum_title'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Deskripsi Kurikulum</label>
                                    <textarea class="custom-textarea" name="academic_curriculum_description">{{ old('academic_curriculum_description', $settings['academic_curriculum_description'] ?? '') }}</textarea>
                                </div>
                            </div>
                            <div class="field-grid">
                                @foreach ([
                                    'academic_programs_json' => 'Daftar Program Akademik',
                                    'academic_calendar_json' => 'Daftar Kalender Akademik',
                                    'academic_services_json' => 'Daftar Layanan Akademik',
                                    'academic_facilities_json' => 'Daftar Fasilitas Akademik',
                                    'academic_faq_json' => 'Daftar Tanya Jawab Akademik',
                                ] as $field => $label)
                                    <div class="input-group">
                                        <label>{{ $label }}</label>
                                        <textarea class="custom-textarea" name="{{ $field }}" data-structured-json style="min-height: 180px;">{{ old($field, $settings[$field] ?? '') }}</textarea>
                                        <p class="field-help">Kelola daftar melalui editor visual. Gunakan tombol tambah atau hapus untuk mengubah susunan.</p>
                                        @if ($field === 'academic_facilities_json')
                                            <p class="field-help">Isi kolom gambar hanya dengan URL/path foto fasilitas yang telah diverifikasi atau diunggah oleh sekolah.</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </section>

                        <section class="card">
                            <h2><i class="bi bi-people" aria-hidden="true"></i> Konten Kesiswaan & Ekstrakurikuler</h2>
                            <div class="field-grid">
                                <div class="input-group">
                                    <label>Badge Hero</label>
                                    <input class="custom-input" name="student_hero_badge" value="{{ old('student_hero_badge', $settings['student_hero_badge'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Judul Hero</label>
                                    <input class="custom-input" name="student_hero_title" value="{{ old('student_hero_title', $settings['student_hero_title'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Aksen Judul Hero</label>
                                    <input class="custom-input" name="student_hero_highlight" value="{{ old('student_hero_highlight', $settings['student_hero_highlight'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Judul Organisasi</label>
                                    <input class="custom-input" name="student_org_title" value="{{ old('student_org_title', $settings['student_org_title'] ?? '') }}">
                                </div>
                            </div>
                            <div class="input-group">
                                <label>Subjudul Hero</label>
                                <textarea class="custom-textarea" name="student_hero_subtitle">{{ old('student_hero_subtitle', $settings['student_hero_subtitle'] ?? '') }}</textarea>
                            </div>
                            <div class="input-group">
                                <label>Deskripsi Organisasi</label>
                                <textarea class="custom-textarea" name="student_org_description">{{ old('student_org_description', $settings['student_org_description'] ?? '') }}</textarea>
                            </div>
                            <div class="field-grid">
                                <div class="input-group">
                                    <label>Judul Pembinaan Karakter</label>
                                    <input class="custom-input" name="student_character_title" value="{{ old('student_character_title', $settings['student_character_title'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Judul Ekstrakurikuler</label>
                                    <input class="custom-input" name="student_clubs_title" value="{{ old('student_clubs_title', $settings['student_clubs_title'] ?? '') }}">
                                </div>
                            </div>
                            <div class="field-grid">
                                <div class="input-group">
                                    <label>Deskripsi Pembinaan Karakter</label>
                                    <textarea class="custom-textarea" name="student_character_description">{{ old('student_character_description', $settings['student_character_description'] ?? '') }}</textarea>
                                </div>
                                <div class="input-group">
                                    <label>Deskripsi Ekstrakurikuler</label>
                                    <textarea class="custom-textarea" name="student_clubs_description">{{ old('student_clubs_description', $settings['student_clubs_description'] ?? '') }}</textarea>
                                </div>
                            </div>
                            <div class="field-grid">
                                <div class="input-group">
                                    <label>Judul Tombol Ajakan</label>
                                    <input class="custom-input" name="student_cta_title" value="{{ old('student_cta_title', $settings['student_cta_title'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Deskripsi Tombol Ajakan</label>
                                    <textarea class="custom-textarea" name="student_cta_description">{{ old('student_cta_description', $settings['student_cta_description'] ?? '') }}</textarea>
                                </div>
                            </div>
                            <div class="field-grid">
                                @foreach ([
                                    'student_character_json' => 'Daftar Program Pembinaan',
                                    'student_faq_json' => 'Daftar Tanya Jawab Kesiswaan',
                                ] as $field => $label)
                                    <div class="input-group">
                                        <label>{{ $label }}</label>
                                        <textarea class="custom-textarea" name="{{ $field }}" data-structured-json style="min-height: 180px;">{{ old($field, $settings[$field] ?? '') }}</textarea>
                                        <p class="field-help">Kelola daftar melalui editor visual. Gunakan tombol tambah atau hapus untuk mengubah susunan.</p>
                                    </div>
                                @endforeach
                            </div>
                        </section>

                        <section class="card">
                            <h2><i class="bi bi-journal-check" aria-hidden="true"></i> Konten Halaman PPDB</h2>
                            <div class="field-grid">
                                <div class="input-group">
                                    <label>Judul Hero PPDB</label>
                                    <input class="custom-input" name="ppdb_hero_title" value="{{ old('ppdb_hero_title', $settings['ppdb_hero_title'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Judul Kontak PPDB</label>
                                    <input class="custom-input" name="ppdb_contact_title" value="{{ old('ppdb_contact_title', $settings['ppdb_contact_title'] ?? '') }}">
                                </div>
                                <div class="input-group">
                                    <label>Link Aplikasi SPMB</label>
                                    <input type="url" class="custom-input" name="ppdb_app_url" value="{{ old('ppdb_app_url', $settings['ppdb_app_url'] ?? '') }}">
                                </div>
                            </div>
                            <div class="field-grid">
                                <div class="input-group">
                                    <label>Subjudul Hero PPDB</label>
                                    <textarea class="custom-textarea" name="ppdb_hero_subtitle">{{ old('ppdb_hero_subtitle', $settings['ppdb_hero_subtitle'] ?? '') }}</textarea>
                                </div>
                                <div class="input-group">
                                    <label>Deskripsi Kontak PPDB</label>
                                    <textarea class="custom-textarea" name="ppdb_contact_description">{{ old('ppdb_contact_description', $settings['ppdb_contact_description'] ?? '') }}</textarea>
                                </div>
                                <div class="input-group">
                                    <label>Catatan Tracking SPMB</label>
                                    <textarea class="custom-textarea" name="ppdb_tracking_note">{{ old('ppdb_tracking_note', $settings['ppdb_tracking_note'] ?? '') }}</textarea>
                                </div>
                            </div>
                            <div class="field-grid">
                                @foreach ([
                                    'ppdb_pathways_json' => 'Daftar Jalur PPDB',
                                    'ppdb_steps_json' => 'Daftar Alur PPDB',
                                    'ppdb_documents_json' => 'Daftar Dokumen PPDB',
                                    'ppdb_faq_json' => 'Daftar Tanya Jawab PPDB',
                                    'ppdb_capacity_json' => 'Daftar Daya Tampung SPMB',
                                    'ppdb_stage_schedule_json' => 'Daftar Jadwal Tahap SPMB',
                                    'ppdb_special_requirements_json' => 'Daftar Persyaratan Khusus SPMB',
                                    'ppdb_weighting_json' => 'Daftar Pembobotan Prestasi SPMB',
                                    'ppdb_contacts_json' => 'Daftar Kontak Panitia SPMB',
                                ] as $field => $label)
                                    <div class="input-group">
                                        <label>{{ $label }}</label>
                                        <textarea class="custom-textarea" name="{{ $field }}" data-structured-json style="min-height: 180px;">{{ old($field, $settings[$field] ?? '') }}</textarea>
                                        <p class="field-help">Kelola daftar melalui editor visual. Gunakan tombol tambah atau hapus untuk mengubah susunan.</p>
                                    </div>
                                @endforeach
                            </div>
                        </section>

                        <section class="card">
                            <h2><i class="bi bi-image" aria-hidden="true"></i> Gambar Hero Halaman Publik</h2>
                            <div class="image-grid">
                                @foreach ([
                                    'akademik_hero_image' => 'Akademik & Prestasi',
                                    'kesiswaan_hero_image' => 'Kesiswaan & Ekstrakurikuler',
                                    'ppdb_hero_image' => 'PPDB',
                                    'berita_hero_image' => 'Berita & Pengumuman',
                                ] as $field => $label)
                                    <div class="input-group">
                                        <label>{{ $label }}</label>
                                        @if (! empty($settings[$field]))
                                            <div class="image-preview" style="background-image: url('{{ asset('storage/'.$settings[$field]) }}');"></div>
                                            <label class="check-row">
                                                <input type="checkbox" name="remove_{{ $field }}" value="1">
                                                Hapus gambar custom
                                            </label>
                                        @else
                                            <div class="image-preview">Gambar bawaan aktif</div>
                                        @endif
                                        <input class="custom-input" type="file" name="{{ $field }}" accept="image/png,image/jpeg,image/webp">
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    </div>

                    <aside class="stack">
                        <section class="card">
                            <h2><i class="bi bi-person-gear" aria-hidden="true"></i> Akun Admin</h2>
                            <div class="input-group">
                                <label>Nama Admin</label>
                                <input class="custom-input" name="admin_name" value="{{ old('admin_name', auth()->user()->name) }}" required>
                            </div>
                            <div class="input-group">
                                <label>Email Login</label>
                                <input type="email" class="custom-input" name="admin_email" value="{{ old('admin_email', auth()->user()->email) }}" required>
                            </div>
                            <div class="input-group">
                                <label>Logo Situs</label>
                                @if (! empty($settings['logo']))
                                    <div class="image-preview" style="background-image: url('{{ asset('storage/'.$settings['logo']) }}'); background-size: contain; background-color: #ffffff;"></div>
                                    <label class="check-row">
                                        <input type="checkbox" name="remove_logo" value="1">
                                        Hapus logo custom
                                    </label>
                                @else
                                    <div class="image-preview" style="background-image: url('{{ asset('images/logo-sman2-balige.jpg') }}'); background-size: contain; background-color: #ffffff;">Logo resmi aktif</div>
                                @endif
                                <input class="custom-input" type="file" name="logo" accept="image/png,image/jpeg,image/webp">
                            </div>
                            <div class="input-group">
                                <label>Durasi Sesi</label>
                                <p class="field-help">Durasi sesi login mengikuti konfigurasi keamanan server dan tidak diubah dari formulir ini.</p>
                            </div>
                        </section>

                        <section class="card">
                            <h2><i class="bi bi-broadcast" aria-hidden="true"></i> Publikasi</h2>
                            <div class="setting-note">Semua konten publik ditarik dari data yang Anda simpan di formulir ini dan modul konten lain (Berita, Galeri, Kesiswaan, Akademik).</div>
                            <p class="field-help"><strong>Catatan:</strong> Hindari mengisi data contoh. Simpan hanya data resmi agar halaman publik selalu valid.</p>
                        </section>

                        <div style="display: flex; gap: 10px;">
                            <a href="{{ route('dashboard') }}" class="btn-outline"><i class="bi bi-x-circle" aria-hidden="true"></i> Batal</a>
                            <button type="submit" class="btn-primary"><i class="bi bi-save" aria-hidden="true"></i> Simpan</button>
                        </div>
                    </aside>
                </div>
            </form>
        </main>
    </div>
</div>
@endsection
