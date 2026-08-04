@extends('layouts.site', ['active' => 'ppdb'])

@section('title', 'Informasi SPMB 2026/2027 - SMAN 2 Balige')
@section('canonical', route('ppdb'))
@section('image', ! empty($settings['ppdb_hero_image']) ? asset('storage/'.$settings['ppdb_hero_image']) : asset('images/logo-sman2-balige.jpg'))
@section('description', 'Informasi resmi SPMB SMAN 2 Balige Tahun Pelajaran 2026/2027.')

@push('head')
    @if(! empty($settings['ppdb_hero_image']))
        <link rel="preload" as="image" href="{{ asset('storage/'.$settings['ppdb_hero_image']) }}" fetchpriority="high">
    @endif
@endpush

@section('content')
    @php
        $hasCustomPpdbHero = ! empty($settings['ppdb_hero_image']);
        $ppdbHeroImage = $hasCustomPpdbHero ? asset('storage/'.$settings['ppdb_hero_image']) : null;
        $ppdbYear = $settings['ppdb_year'] ?? '2026/2027';
        $ppdbStatus = $settings['ppdb_status'] ?? 'Dibuka';
        $schoolEmail = trim((string) ($settings['school_email'] ?? ''));
        $schoolPhone = $settings['school_phone'] ?? '0812-7492-3186';
        $mapsUrl = $settings['maps_url'] ?? 'https://www.google.com/maps/search/?api=1&query=SMAN%202%20Balige';
        $ppdbAppUrl = trim((string) ($settings['ppdb_app_url'] ?? ''));
        if ($ppdbAppUrl === '') {
            $ppdbAppUrl = 'https://spmbsumutberkah.disdik.sumutprov.go.id/information/download-aplikasi-spmb-2026';
        } elseif (! str_starts_with($ppdbAppUrl, 'http://') && ! str_starts_with($ppdbAppUrl, 'https://')) {
            $ppdbAppUrl = 'https://'.ltrim($ppdbAppUrl, '/');
        }
        $trackingNote = $settings['ppdb_tracking_note'] ?? 'Calon Murid Baru yang sudah mendaftar wajib mengecek status/proses pendaftarannya di aplikasi SPMB pada menu Tracking.';
        $mailSubject = rawurlencode('Informasi PPDB SMAN 2 Balige '.$ppdbYear);
        $mailUrl = $schoolEmail !== '' ? 'mailto:'.$schoolEmail.'?subject='.$mailSubject : '#kontak-panitia';
        $decodeList = function (string $key, array $fallback = []) use ($settings): array {
            $decoded = json_decode($settings[$key] ?? '', true);

            return is_array($decoded) ? $decoded : $fallback;
        };
        $telFromPhone = function (?string $phone) use ($mailUrl): string {
            $digits = preg_replace('/\D+/', '', $phone ?? '');
            if ($digits === '') {
                return $mailUrl;
            }

            $dial = str_starts_with($digits, '0')
                ? '+62'.substr($digits, 1)
                : (str_starts_with($digits, '62') ? '+'.$digits : '+'.$digits);

            return 'tel:'.$dial;
        };
        $monthNames = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $formatShortDate = function (?string $date, string $fallback) use ($monthNames): string {
            try {
                $parsed = \Carbon\Carbon::parse($date ?: $fallback);

                return $parsed->format('d').' '.$monthNames[(int) $parsed->format('n')];
            } catch (\Throwable $e) {
                return '-';
            }
        };
        $openLabel = $formatShortDate($settings['ppdb_open_date'] ?? null, '2026-06-01');
        $closeLabel = $formatShortDate($settings['ppdb_close_date'] ?? null, '2026-07-15');
        $pathways = $decodeList('ppdb_pathways_json');
        $steps = $decodeList('ppdb_steps_json');
        $documents = $decodeList('ppdb_documents_json');
        $faqs = $decodeList('ppdb_faq_json');
        $capacityGroups = $decodeList('ppdb_capacity_json');
        $stageSchedules = $decodeList('ppdb_stage_schedule_json');
        $specialRequirements = $decodeList('ppdb_special_requirements_json');
        $weightings = $decodeList('ppdb_weighting_json');
        $ppdbContacts = $decodeList('ppdb_contacts_json');
        $quotaGroups = collect($capacityGroups)
            ->reject(fn ($group) => str_contains(strtolower($group['group'] ?? ''), 'daya tampung'))
            ->values()
            ->all();
        $schoolContact = collect($ppdbContacts)->first(fn ($contact) => str_contains(strtolower($contact['name'] ?? ''), 'sma'));
        $primaryContact = $schoolContact ?: ($ppdbContacts[0] ?? ['name' => 'SMA N 2 Balige', 'phone' => $schoolPhone]);
        $primaryTelUrl = $telFromPhone($primaryContact['phone'] ?? $schoolPhone);
        $primaryContactText = trim(($primaryContact['phone'] ?? $schoolPhone).' '.(! empty($primaryContact['name']) ? '('.$primaryContact['name'].')' : ''));
        $contactCards = [
            ['title' => 'Aplikasi SPMB Sumut', 'desc' => 'Buka kanal pendaftaran online SPMB Sumut 2026.', 'value' => 'spmbsumutberkah.disdik.sumutprov.go.id', 'href' => $ppdbAppUrl, 'icon' => 'bi-cloud-arrow-up', 'label' => 'Buka aplikasi', 'external' => true],
            ['title' => 'Nomor SMAN 2 Balige', 'desc' => 'Nomor sekolah resmi sesuai poster SPMB.', 'value' => $primaryContactText, 'href' => $primaryTelUrl, 'icon' => 'bi-headset', 'label' => 'Telepon sekolah', 'external' => false],
            ['title' => 'Lokasi Sekolah', 'desc' => 'Buka Google Maps untuk melihat rute menuju SMAN 2 Balige.', 'value' => 'SMAN 2 Balige', 'href' => $mapsUrl, 'icon' => 'bi-geo-alt', 'label' => 'Buka maps', 'external' => true],
        ];
    @endphp

    <section
        class="school-hero hero-ppdb ppdb-hero relative overflow-hidden {{ $hasCustomPpdbHero ? 'has-custom-photo' : 'default-school-hero' }}"
        @unless($hasCustomPpdbHero)
            style="background-color: #12324d !important; background-image: none !important;"
        @endunless
    >
        @if($hasCustomPpdbHero)
            <picture class="hero-picture" aria-hidden="true">
                <img
                    class="hero-media"
                    src="{{ $ppdbHeroImage }}"
                    alt=""
                    width="1600"
                    height="900"
                    fetchpriority="high"
                    decoding="async"
                >
            </picture>
            <div class="hero-overlay" aria-hidden="true"></div>
        @endif
        <div class="ppdb-hero-grid mx-auto grid max-w-7xl gap-10 px-4 py-20 lg:grid-cols-[1fr_0.72fr] lg:items-center lg:px-8">
            <div class="relative z-10">
                <span class="ppdb-kicker">SPMB/PPDB {{ $ppdbYear }}</span>
                <h1>{{ $settings['ppdb_hero_title'] ?? 'Informasi SPMB SMAN 2 Balige' }}</h1>
                <p>
                    {{ $settings['ppdb_hero_subtitle'] ?? 'Jadwal, jalur pendaftaran, persyaratan, aplikasi, dan kontak panitia penerimaan murid baru.' }}
                </p>
                <div class="ppdb-hero-actions">
                    <a href="{{ $ppdbAppUrl }}" class="gold-button" target="_blank" rel="noopener">Buka Aplikasi SPMB</a>
                    <a href="#jadwal" class="ghost-button">Lihat Jadwal</a>
                </div>
            </div>
            <aside class="ppdb-hero-card" aria-label="Ringkasan PPDB">
                <span class="ppdb-status-badge">{{ $ppdbStatus }}</span>
                <h2>Tahun Ajaran {{ $ppdbYear }}</h2>
                <dl>
                    <div>
                        <dt>Rentang Jadwal</dt>
                        <dd>{{ $openLabel }} - {{ $closeLabel }}</dd>
                    </div>
                    <div>
                        <dt>Tahap</dt>
                        <dd>1 & 2</dd>
                    </div>
                    <div>
                        <dt>Aplikasi</dt>
                        <dd>SPMB Sumut 2026</dd>
                    </div>
                </dl>
                <a href="#jadwal" class="ppdb-card-link">Lihat jadwal terbaru <i class="bi bi-arrow-right" aria-hidden="true"></i></a>
            </aside>
        </div>
    </section>

    <section id="jadwal" class="ppdb-section ppdb-official-section">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="ppdb-section-heading">
                <p class="eyebrow">Data Resmi SPMB</p>
                <h2>Kuota jalur dan jadwal pelaksanaan</h2>
                <p>Ringkasan daya tampung, kuota setiap jalur, dan tanggal pelaksanaan penerimaan murid baru.</p>
            </div>
            <div class="ppdb-official-grid">
                <article class="ppdb-capacity-panel">
                    <div class="ppdb-panel-title">
                        <span><i class="bi bi-people-fill" aria-hidden="true"></i></span>
                        <div>
                            <p>Daya Tampung Resmi</p>
                            <h3>216 Orang</h3>
                            <small>6 rombel x 36 siswa</small>
                        </div>
                    </div>
                    <div class="ppdb-capacity-list">
                        @foreach ($quotaGroups as $group)
                            <div>
                                <strong>{{ $group['group'] ?? '' }}</strong>
                                @foreach (($group['items'] ?? []) as $item)
                                    <p><span>{{ $item['label'] ?? '' }}</span><b>{{ $item['value'] ?? '' }}</b></p>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </article>
                <div class="ppdb-stage-grid">
                    @foreach ($stageSchedules as $stage)
                        <article class="ppdb-stage-card {{ ($stage['tone'] ?? '') === 'green' ? 'green' : 'gold' }}">
                            <div class="ppdb-stage-head">
                                <span>{{ $stage['stage'] ?? '' }}</span>
                                <h3>{{ $stage['track'] ?? '' }}</h3>
                            </div>
                            <div class="ppdb-stage-list">
                                @foreach (($stage['items'] ?? []) as $item)
                                    <div>
                                        <i class="bi {{ ($item['label'] ?? '') === 'Pengumuman' ? 'bi-megaphone' : (($item['label'] ?? '') === 'Daftar Ulang' ? 'bi-clipboard-check' : 'bi-calendar-event') }}" aria-hidden="true"></i>
                                        <span>{{ $item['label'] ?? '' }}</span>
                                        <strong>{{ $item['date'] ?? '' }}</strong>
                                    </div>
                                @endforeach
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
            <div class="ppdb-tracking-note">
                <i class="bi bi-info-circle" aria-hidden="true"></i>
                <span>{{ $trackingNote }}</span>
            </div>
        </div>
    </section>

    <section class="ppdb-section ppdb-flow-section">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 lg:grid-cols-[0.8fr_1.2fr] lg:items-start lg:px-8">
            <div class="ppdb-section-heading compact">
                <p class="eyebrow">Jalur & Alur</p>
                <h2>Mulai dari jalur yang tepat</h2>
                <p>Jalur penerimaan mengikuti ketentuan SPMB/PPDB yang berlaku. Pilih jalur sesuai kondisi dan dokumen pendukung.</p>
            </div>
            <div class="ppdb-pathway-grid">
                @foreach ($pathways as $pathway)
                    <article class="ppdb-pathway-card">
                        <span><i class="bi {{ $pathway['icon'] }}" aria-hidden="true"></i></span>
                        <div>
                            <h3>{{ $pathway['title'] }}</h3>
                            <p>{{ $pathway['description'] ?? $pathway['desc'] ?? '' }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
        <div class="mx-auto mt-12 max-w-7xl px-4 lg:px-8">
            <div class="ppdb-step-strip">
                @foreach ($steps as $index => $step)
                    <article>
                        <span>{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                        <h3>{{ $step['title'] ?? $step[0] ?? '' }}</h3>
                        <p>{{ $step['description'] ?? $step[1] ?? '' }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section id="syarat" class="ppdb-section bg-white">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 lg:grid-cols-[1.04fr_0.96fr] lg:px-8">
            <div class="ppdb-document-panel">
                <div class="ppdb-section-heading compact">
                    <p class="eyebrow">Syarat Umum</p>
                    <h2>Persyaratan dasar calon murid baru</h2>
                    <p>Pastikan data usia, kelulusan, KK/domisili, pilihan sekolah, dan pendaftaran online sudah sesuai.</p>
                </div>
                <div class="ppdb-document-grid">
                    @foreach ($documents as $doc)
                        <div class="ppdb-document-item">
                            <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                            <span>{{ $doc }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            <aside class="ppdb-special-panel">
                <div class="ppdb-section-heading compact">
                    <p class="eyebrow">Persyaratan Khusus</p>
                    <h2>Ketentuan per jalur</h2>
                    <p>Pilih jalur sesuai kondisi dan bukti pendukung yang dapat diverifikasi.</p>
                </div>
                <div class="ppdb-special-list">
                    @foreach ($specialRequirements as $group)
                        <article>
                            <h3>{{ $group['title'] ?? '' }}</h3>
                            @foreach (($group['items'] ?? []) as $item)
                                <p><i class="bi bi-check-circle-fill" aria-hidden="true"></i>{{ $item }}</p>
                            @endforeach
                        </article>
                    @endforeach
                </div>
                <div class="ppdb-weighting-grid">
                    @foreach ($weightings as $weight)
                        <article>
                            <h3>{{ $weight['title'] ?? '' }}</h3>
                            @foreach (($weight['items'] ?? []) as $item)
                                <p><span>{{ $item['label'] ?? '' }}</span><b>{{ $item['value'] ?? '' }}</b></p>
                            @endforeach
                        </article>
                    @endforeach
                </div>
            </aside>
        </div>
    </section>

    <section class="ppdb-section ppdb-faq-section">
        <div class="mx-auto max-w-4xl px-4 lg:px-8">
            <div class="ppdb-section-heading text-center">
                <p class="eyebrow">FAQ</p>
                <h2>Pertanyaan umum PPDB</h2>
                <p>Jawaban singkat untuk membantu calon siswa dan orang tua sebelum menghubungi panitia.</p>
            </div>
            <div class="ppdb-faq-list">
                @foreach ($faqs as $index => $faq)
                    <details class="faq-item" @if($index === 0) open @endif>
                        <summary>{{ $faq['question'] ?? $faq[0] ?? '' }}</summary>
                        <p>{{ $faq['answer'] ?? $faq[1] ?? '' }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    <section id="kontak-panitia" class="ppdb-section ppdb-contact-section">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 lg:grid-cols-[0.82fr_1.18fr] lg:items-start lg:px-8">
            <div class="ppdb-contact-copy">
                <span class="ppdb-kicker">Kontak Panitia PPDB</span>
                <h2>{{ $settings['ppdb_contact_title'] ?? 'Butuh bantuan? Hubungi kanal resmi sekolah.' }}</h2>
                <p>{{ $settings['ppdb_contact_description'] ?? 'Gunakan kontak resmi ini untuk memastikan jadwal, jalur pendaftaran, kelengkapan dokumen, dan lokasi sekolah.' }}</p>
                <div class="ppdb-contact-actions">
                    <a href="{{ $primaryTelUrl }}" class="gold-button"><i class="bi bi-headset" aria-hidden="true"></i>Hubungi Panitia PPDB</a>
                    <a href="{{ $ppdbAppUrl }}" class="ghost-button" target="_blank" rel="noopener"><i class="bi bi-cloud-arrow-up" aria-hidden="true"></i>Buka Aplikasi SPMB</a>
                </div>
                <div class="ppdb-hotline-list">
                    @foreach ($ppdbContacts as $contact)
                        <a href="{{ $telFromPhone($contact['phone'] ?? '') }}">
                            <strong>{{ $contact['phone'] ?? '' }}</strong>
                            <span>{{ $contact['name'] ?? 'Panitia SPMB' }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="ppdb-contact-grid">
                @foreach ($contactCards as $card)
                    <a
                        class="ppdb-contact-card"
                        href="{{ $card['href'] }}"
                        @if($card['external']) target="_blank" rel="noopener" @endif
                    >
                        <span><i class="bi {{ $card['icon'] }}" aria-hidden="true"></i></span>
                        <div>
                            <h3>{{ $card['title'] }}</h3>
                            <p>{{ $card['desc'] }}</p>
                            <strong>{{ $card['value'] }}</strong>
                            <em>{{ $card['label'] }} <i class="bi bi-arrow-right" aria-hidden="true"></i></em>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
