<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ($mode ?? 'upload') === 'edit' ? 'Edit Media Galeri' : 'Upload Galeri' }} - SMAN 2 Balige</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { overflow: hidden; font-family: 'Inter', sans-serif; background: #f8fafc; }
        .admin-container { display: flex; height: 100vh; width: 100vw; }
        .sidebar { width: 260px; background: #071f3a; flex-shrink: 0; display: flex; flex-direction: column; color: white; }
        .main-content { flex: 1; overflow-y: auto; }
        .content-padding { padding: 34px 30px; max-width: 1120px; margin: 0 auto; width: 100%; }
        .page-head { display: flex; justify-content: space-between; gap: 20px; margin-bottom: 24px; }
        .page-head h1 { font-size: 34px; color: #071f3a; font-weight: 900; }
        .page-head p { color: #64748b; margin-top: 8px; }
        .grid { display: grid; grid-template-columns: minmax(0, 1fr) 330px; gap: 22px; }
        .card { background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; box-shadow: 0 8px 20px rgba(15,23,42,.06); }
        .upload-zone { border: 1px solid #d9e1ec; border-radius: 22px; background: linear-gradient(180deg, #ffffff 0%, #eef4fb 100%); padding: 36px; text-align: center; margin-bottom: 22px; position: relative; overflow: hidden; transition: border-color .18s ease, background .18s ease, transform .18s ease, box-shadow .18s ease; }
        .upload-zone::after { content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top, rgba(59,130,246,.08), transparent 38%);
            pointer-events: none;
        }
        .upload-zone:hover, .upload-zone.dragover { border-color: #1e40af; background: linear-gradient(180deg, #f8fbff 0%, #e6f0fb 100%); box-shadow: 0 16px 45px rgba(15,23,42,.08); transform: translateY(-1px); }
        .upload-zone .zone-content { position: relative; z-index: 1; display: grid; gap: 14px; align-items: center; justify-items: center; }
        .upload-zone input[type='file'] { position: absolute; inset: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; }
        .upload-zone .zone-icon { font-size: 42px; color: #0f172a; margin-bottom: 6px; }
        .upload-zone strong { display: block; font-size: 20px; line-height: 1.1; margin-bottom: 6px; color: #071f3a; }
        .upload-zone .zone-hint { font-size: 13px; color: #475569; max-width: 340px; }
        .upload-zone .upload-actions { display: flex; gap: 10px; align-items: center; justify-content: center; flex-wrap: wrap; }
        .upload-zone .upload-button { display: inline-flex; align-items: center; gap: 8px; padding: 11px 18px; border-radius: 999px; background: #0f172a; color: white; font-weight: 800; text-transform: uppercase; font-size: 12px; border: none; cursor: pointer; }
        .upload-zone .upload-note { font-size: 12px; color: #64748b; }
        .media-preview { margin-top: 22px; border: 1px solid #e2e8f0; border-radius: 18px; overflow: hidden; background: white; box-shadow: 0 10px 28px rgba(15,23,42,.05); }
        .preview-header { padding: 18px 22px; display: flex; align-items: center; justify-content: space-between; gap: 16px; background: #f8fafc; }
        .preview-header strong { font-size: 15px; color: #0f172a; }
        .preview-placeholder { padding: 30px 20px; display: grid; gap: 12px; place-items: center; color: #475569; background: #f8fafc; }
        .preview-placeholder .bi { font-size: 36px; color: #0f172a; }
        .preview-preview { width: 100%; max-height: 320px; object-fit: cover; display: block; }
        .preview-meta { padding: 18px 20px 22px; display: grid; gap: 14px; border-top: 1px solid #e2e8f0; }
        .preview-meta .meta-row { display: grid; grid-template-columns: auto minmax(0, max-content); gap: 10px; font-size: 13px; color: #475569; }
        .preview-meta .meta-row span:first-child { font-weight: 700; color: #071f3a; }
        .preview-badges { display: flex; flex-wrap: wrap; gap: 10px; }
        .preview-badge { padding: 8px 14px; border-radius: 999px; font-size: 12px; font-weight: 700; color: #0f172a; background: #dbeafe; border: 1px solid #bfdbfe; }
        .field-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
        .input-group { display: grid; gap: 8px; margin-bottom: 16px; }
        .input-group label { font-size: 11px; font-weight: 900; color: #64748b; text-transform: uppercase; }
        .input-group small { color: #64748b; font-size: 12px; }
        .custom-input, .custom-textarea, .custom-select { width: 100%; border: 1px solid #d9e1ec; border-radius: 12px; padding: 14px 16px; font: inherit; color: #071f3a; background: white; transition: border-color .18s ease, box-shadow .18s ease; }
        .custom-input:focus, .custom-textarea:focus, .custom-select:focus { outline: none; border-color: #2563eb; box-shadow: 0 0 0 4px rgba(59,130,246,.12); }
        .custom-textarea { min-height: 140px; resize: vertical; }
        .btn-primary, .btn-outline { border-radius: 14px; padding: 14px 18px; font-weight: 900; text-decoration: none; cursor: pointer; transition: transform .16s ease, box-shadow .16s ease; }
        .btn-primary { background: #071f3a; color: white; border: 1px solid #071f3a; }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 16px 30px rgba(7,23,47,.12); }
        .btn-outline { background: white; color: #071f3a; border: 1px solid #d9e1ec; }
        .btn-outline:hover { transform: translateY(-1px); box-shadow: 0 14px 24px rgba(15,23,42,.08); }
        @media (max-width: 900px) { .grid, .field-grid { grid-template-columns: 1fr; } .page-head { flex-direction: column; } }
    </style>        .custom-textarea { min-height: 120px; resize: vertical; }
        .btn-primary, .btn-outline { border-radius: 10px; padding: 12px 18px; font-weight: 900; text-decoration: none; cursor: pointer; transition: transform .16s ease, box-shadow .16s ease; }
        .btn-primary { background: #071f3a; color: white; border: 1px solid #071f3a; }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 16px 30px rgba(7,23,47,.12); }
        .btn-outline { background: white; color: #071f3a; border: 1px solid #d9e1ec; }
        .btn-outline:hover { transform: translateY(-1px); box-shadow: 0 14px 24px rgba(15,23,42,.08); }
        @media (max-width: 900px) { .grid, .field-grid { grid-template-columns: 1fr; } .page-head { flex-direction: column; } }
    </style>
    @include('pages.admin.partials.responsive')
</head>
<body>
<div class="admin-container">
    @include('pages.admin.partials.sidebar', ['activeAdmin' => 'galeri'])
    <div class="main-content">
        <main class="content-padding">
            @php($isEdit = ($mode ?? 'upload') === 'edit')
            <div class="page-head">
                <div>
                    <h1>{{ $isEdit ? 'Edit Media Galeri' : 'Upload Media Galeri' }}</h1>
                    <p>Tambahkan dokumentasi kegiatan sekolah dengan judul, kategori, deskripsi, dan status publikasi yang jelas.</p>
                </div>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <a href="{{ route('admin.galeri') }}" class="btn-outline">Kembali</a>
                    <button type="submit" form="galeri-form" class="btn-primary">Simpan Media</button>
                </div>
            </div>

            <form id="galeri-form" method="POST" action="{{ $isEdit ? route('admin.galeri.update', $id ?? 1) : route('admin.galeri.store') }}">
                @csrf
                <div class="grid">
                    <section class="card">
                        <div class="upload-zone" id="uploadZone">
                            <div class="zone-content">
                                <div class="zone-icon"><i class="bi bi-cloud-arrow-up"></i></div>
                                <strong>Pilih Foto atau Video</strong>
                                <p class="zone-hint">Format JPG, PNG, MP4. Seret file ke area ini atau klik untuk memilih dari perangkat.</p>
                                <div class="upload-actions">
                                    <span class="upload-button">Pilih Media</span>
                                    <span class="upload-note">Ukuran maksimal 20MB</span>
                                </div>
                            </div>
                            <input type="file" name="media" accept="image/*,video/*">
                            <div class="media-preview" id="previewCard">
                                <div class="preview-header">
                                    <strong>Pratinjau Media</strong>
                                    <span class="preview-badge" id="previewType">Media: -</span>
                                </div>
                                <div class="preview-placeholder" id="previewPlaceholder">
                                    <i class="bi bi-camera"></i>
                                    <div>Pilih file untuk melihat preview langsung.</div>
                                </div>
                                <div class="preview-meta" id="previewMeta" hidden>
                                    <div class="preview-badges" id="previewBadges">
                                        <span class="preview-badge" id="previewCategory">Kategori: Kegiatan Akademik</span>
                                        <span class="preview-badge" id="previewStatus">Status: Publik</span>
                                    </div>
                                    <div class="meta-row"><span>Nama File</span><span id="previewName">-</span></div>
                                    <div class="meta-row"><span>Ukuran</span><span id="previewSize">-</span></div>
                                    <div class="meta-row"><span>Tanggal Kegiatan</span><span id="previewDate">-</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="field-grid">
                            <div class="input-group">
                                <label>Judul Media</label>
                                <input class="custom-input" name="judul" placeholder="Contoh: Upacara Hari Pendidikan Nasional" required>
                            </div>
                            <div class="input-group">
                                <label>Kategori</label>
                                <select class="custom-select" name="kategori">
                                    <option>Kegiatan Akademik</option>
                                    <option>Ekstrakurikuler</option>
                                    <option>Prestasi</option>
                                    <option>Fasilitas</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-group">
                            <label>Deskripsi</label>
                            <textarea class="custom-textarea" name="deskripsi" placeholder="Tuliskan deskripsi singkat dokumentasi."></textarea>
                        </div>
                    </section>

                    <aside class="card">
                        <h2 style="font-size: 18px; color: #071f3a; margin-bottom: 18px;">Pengaturan Publikasi</h2>
                        <div class="input-group">
                            <label>Status</label>
                            <select class="custom-select" name="status">
                                <option>Publik</option>
                                <option>Draft</option>
                                <option>Arsip</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Tanggal Kegiatan</label>
                            <input type="date" class="custom-input" name="tanggal">
                        </div>
                        <div class="input-group">
                            <label>Alt Text Gambar</label>
                            <input class="custom-input" name="alt" placeholder="Deskripsi singkat untuk aksesibilitas">
                        </div>
                        <div style="display: flex; gap: 10px; margin-top: 22px;">
                            <a href="{{ route('admin.galeri') }}" class="btn-outline">Batal</a>
                            <button type="submit" class="btn-primary">Simpan</button>
                        </div>
                    </aside>
                </div>
            </form>
        </main>
    </div>
</div>
<script>
    (() => {
        const uploadZone = document.getElementById('uploadZone');
        const fileInput = uploadZone.querySelector('input[name="media"]');
        const previewCard = document.getElementById('previewCard');
        const previewMeta = document.getElementById('previewMeta');
        const previewPlaceholder = document.getElementById('previewPlaceholder');
        const previewType = document.getElementById('previewType');
        const previewCategory = document.getElementById('previewCategory');
        const previewStatus = document.getElementById('previewStatus');
        const previewName = document.getElementById('previewName');
        const previewSize = document.getElementById('previewSize');
        const previewDate = document.getElementById('previewDate');
        const categorySelect = document.querySelector('select[name="kategori"]');
        const statusSelect = document.querySelector('select[name="status"]');
        const dateInput = document.querySelector('input[name="tanggal"]');

        const formatSize = (bytes) => {
            if (!bytes) return '-';
            const units = ['B', 'KB', 'MB'];
            let size = bytes;
            let index = 0;
            while (size >= 1024 && index < units.length - 1) {
                size /= 1024;
                index += 1;
            }
            return `${size.toFixed(1)} ${units[index]}`;
        };

        const updatePreviewChips = () => {
            previewCategory.textContent = `Kategori: ${categorySelect.value}`;
            previewStatus.textContent = `Status: ${statusSelect.value}`;
        };

        const updateDateMeta = () => {
            previewDate.textContent = dateInput.value || '-';
        };

        const clearPreview = () => {
            previewPlaceholder.hidden = false;
            previewMeta.hidden = true;
            const existingMedia = document.querySelector('#previewCard img, #previewCard video');
            if (existingMedia) existingMedia.remove();
            previewName.textContent = '-';
            previewSize.textContent = '-';
            previewType.textContent = 'Media: -';
            previewDate.textContent = dateInput.value || '-';
        };

        const renderPreview = (file) => {
            if (!file) {
                clearPreview();
                return;
            }
            previewPlaceholder.hidden = true;
            previewMeta.hidden = false;
            previewName.textContent = file.name;
            previewSize.textContent = formatSize(file.size);
            const typeLabel = file.type.startsWith('video/') ? 'Video' : file.type.startsWith('image/') ? 'Foto' : 'Media';
            previewType.textContent = `Media: ${typeLabel}`;
            updatePreviewChips();
            updateDateMeta();
            const existingMedia = document.querySelector('#previewCard img, #previewCard video');
            if (existingMedia) existingMedia.remove();

            const reader = new FileReader();
            reader.onload = (event) => {
                const src = event.target.result;
                let mediaElement;
                if (file.type.startsWith('image/')) {
                    mediaElement = document.createElement('img');
                    mediaElement.src = src;
                    mediaElement.alt = file.name;
                    mediaElement.className = 'preview-preview';
                } else if (file.type.startsWith('video/')) {
                    mediaElement = document.createElement('video');
                    mediaElement.src = src;
                    mediaElement.className = 'preview-preview';
                    mediaElement.controls = true;
                    mediaElement.muted = true;
                    mediaElement.playsInline = true;
                }
                if (mediaElement) {
                    previewCard.insertBefore(mediaElement, previewMeta);
                }
            };
            reader.readAsDataURL(file);
        };

        fileInput.addEventListener('change', () => renderPreview(fileInput.files[0]));
        categorySelect.addEventListener('change', updatePreviewChips);
        statusSelect.addEventListener('change', updatePreviewChips);
        dateInput.addEventListener('change', updateDateMeta);

        ['dragenter', 'dragover'].forEach((eventName) => {
            uploadZone.addEventListener(eventName, (event) => {
                event.preventDefault();
                event.stopPropagation();
                uploadZone.classList.add('dragover');
            });
        });

        ['dragleave', 'drop'].forEach((eventName) => {
            uploadZone.addEventListener(eventName, (event) => {
                event.preventDefault();
                event.stopPropagation();
                uploadZone.classList.remove('dragover');
            });
        });

        uploadZone.addEventListener('drop', (event) => {
            const files = event.dataTransfer?.files;
            if (files?.length) {
                fileInput.files = files;
                renderPreview(files[0]);
            }
        });

        updatePreviewChips();
        updateDateMeta();
    })();
</script>
</body>
</html>
