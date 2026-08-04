const schemas = {
    leadership_focus_json: { title: '', summary: '', description: '', icon: 'bi-check-circle', href: '/', link_label: '' },
    academic_programs_json: { title: '', description: '', icon: 'bi-journal-bookmark', variant: '' },
    academic_calendar_json: { date: '', title: '', description: '' },
    academic_services_json: { title: '', icon: 'bi-file-earmark-check', description: '' },
    academic_facilities_json: { title: '', image: '', class: '' },
    academic_faq_json: { question: '', answer: '' },
    student_character_json: { title: '', description: '', icon: 'bi-person-check', accent: '' },
    student_faq_json: { question: '', answer: '' },
    ppdb_pathways_json: { title: '', description: '', icon: 'bi-check-circle' },
    ppdb_steps_json: { title: '', description: '' },
    ppdb_documents_json: '',
    ppdb_faq_json: { question: '', answer: '' },
    ppdb_capacity_json: { group: '', items: [{ label: '', value: '' }] },
    ppdb_stage_schedule_json: { stage: '', track: '', tone: '', items: [{ label: '', date: '' }] },
    ppdb_special_requirements_json: { title: '', items: [''] },
    ppdb_weighting_json: { title: '', items: [{ label: '', value: '' }] },
    ppdb_contacts_json: { name: '', phone: '' },
};

const labels = {
    title: 'Judul', summary: 'Ringkasan', description: 'Deskripsi', icon: 'Ikon', href: 'Tautan',
    link_label: 'Label tautan', date: 'Tanggal', image: 'URL/path gambar', class: 'Gaya visual',
    question: 'Pertanyaan', answer: 'Jawaban', accent: 'Aksen', variant: 'Varian', group: 'Kelompok',
    items: 'Rincian', label: 'Label', value: 'Nilai', stage: 'Tahap', track: 'Jalur', tone: 'Warna',
    name: 'Nama', phone: 'Nomor telepon',
};

const clone = (value) => JSON.parse(JSON.stringify(value));

function inputFor(value, key, onChange) {
    const wrapper = document.createElement('label');
    wrapper.className = 'structured-field';
    const caption = document.createElement('span');
    caption.textContent = labels[key] || key.replaceAll('_', ' ');
    wrapper.appendChild(caption);

    const control = ['description', 'summary', 'answer'].includes(key)
        ? document.createElement('textarea')
        : document.createElement('input');
    control.className = 'custom-input';
    control.value = value ?? '';
    if (control instanceof HTMLTextAreaElement) control.rows = 3;
    control.addEventListener('input', () => onChange(control.value));
    wrapper.appendChild(control);
    return wrapper;
}

function renderArray(array, template, onChange, title = 'Item') {
    const container = document.createElement('div');
    container.className = 'structured-list';

    const redraw = () => {
        container.replaceChildren();
        array.forEach((item, index) => {
            const card = document.createElement('div');
            card.className = 'structured-item';
            const head = document.createElement('div');
            head.className = 'structured-item-head';
            head.innerHTML = `<strong>${title} ${index + 1}</strong>`;
            const remove = document.createElement('button');
            remove.type = 'button';
            remove.className = 'structured-remove';
            remove.textContent = 'Hapus';
            remove.addEventListener('click', () => {
                array.splice(index, 1);
                onChange();
                redraw();
            });
            head.appendChild(remove);
            card.appendChild(head);

            if (item !== null && typeof item === 'object' && !Array.isArray(item)) {
                const grid = document.createElement('div');
                grid.className = 'structured-grid';
                Object.keys(template || item).forEach((key) => {
                    const fieldValue = item[key] ?? clone(template[key]);
                    if (Array.isArray(fieldValue)) {
                        const nested = document.createElement('div');
                        nested.className = 'structured-nested';
                        const nestedTitle = document.createElement('strong');
                        nestedTitle.textContent = labels[key] || key;
                        nested.append(nestedTitle, renderArray(fieldValue, template[key]?.[0] ?? '', onChange, 'Rincian'));
                        grid.appendChild(nested);
                    } else {
                        grid.appendChild(inputFor(fieldValue, key, (next) => {
                            item[key] = next;
                            onChange();
                        }));
                    }
                });
                card.appendChild(grid);
            } else {
                card.appendChild(inputFor(item, 'value', (next) => {
                    array[index] = next;
                    onChange();
                }));
            }
            container.appendChild(card);
        });

        const add = document.createElement('button');
        add.type = 'button';
        add.className = 'structured-add';
        add.textContent = '+ Tambah item';
        add.addEventListener('click', () => {
            array.push(clone(template));
            onChange();
            redraw();
        });
        container.appendChild(add);
    };

    redraw();
    return container;
}

document.querySelectorAll('textarea[data-structured-json]').forEach((textarea) => {
    const schema = schemas[textarea.name];
    if (schema === undefined) return;

    let value;
    try {
        value = JSON.parse(textarea.value || '[]');
    } catch {
        textarea.insertAdjacentHTML('beforebegin', '<p class="structured-error">Format lama belum valid. Perbaiki JSON terlebih dahulu agar editor visual dapat digunakan.</p>');
        return;
    }
    if (!Array.isArray(value)) value = [];

    const editor = document.createElement('div');
    editor.className = 'structured-editor';
    const sync = () => {
        textarea.value = JSON.stringify(value, null, 2);
    };
    editor.appendChild(renderArray(value, schema, sync));
    textarea.classList.add('structured-source');
    textarea.before(editor);
    sync();
});

document.querySelectorAll('[data-image-dropzone]').forEach((dropzone) => {
    const input = dropzone.querySelector('[data-image-input]');
    const browse = dropzone.querySelector('[data-image-browse]');
    const preview = dropzone.querySelector('[data-image-preview]');
    const filename = dropzone.querySelector('[data-image-filename]');
    let previewUrl = null;

    if (!input || !preview || !filename) return;

    const showFile = (file) => {
        dropzone.classList.remove('has-error');

        if (!file.type.startsWith('image/')) {
            dropzone.classList.add('has-error');
            filename.textContent = 'File harus berupa gambar JPG, PNG, atau WebP.';
            return false;
        }

        if (file.size > 4 * 1024 * 1024) {
            dropzone.classList.add('has-error');
            filename.textContent = 'Ukuran gambar melebihi batas 4 MB.';
            return false;
        }

        if (previewUrl) URL.revokeObjectURL(previewUrl);
        previewUrl = URL.createObjectURL(file);
        preview.replaceChildren();
        const image = document.createElement('img');
        image.src = previewUrl;
        image.alt = `Preview ${file.name}`;
        preview.appendChild(image);
        preview.classList.add('has-image');
        filename.textContent = file.name;
        return true;
    };

    const assignFile = (file) => {
        if (!showFile(file)) return;
        const transfer = new DataTransfer();
        transfer.items.add(file);
        input.files = transfer.files;
    };

    browse?.addEventListener('click', (event) => {
        event.stopPropagation();
        input.click();
    });

    dropzone.addEventListener('click', (event) => {
        if (event.target !== browse) input.click();
    });

    dropzone.addEventListener('keydown', (event) => {
        if (event.key === 'Enter' || event.key === ' ') {
            event.preventDefault();
            input.click();
        }
    });

    input.addEventListener('change', () => {
        const file = input.files?.[0];
        if (file) showFile(file);
    });

    ['dragenter', 'dragover'].forEach((eventName) => {
        dropzone.addEventListener(eventName, (event) => {
            event.preventDefault();
            dropzone.classList.add('is-dragging');
        });
    });

    ['dragleave', 'drop'].forEach((eventName) => {
        dropzone.addEventListener(eventName, (event) => {
            event.preventDefault();
            dropzone.classList.remove('is-dragging');
        });
    });

    dropzone.addEventListener('drop', (event) => {
        const file = event.dataTransfer?.files?.[0];
        if (file) assignFile(file);
    });

    dropzone.addEventListener('paste', (event) => {
        const file = [...(event.clipboardData?.files || [])].find((item) => item.type.startsWith('image/'));
        if (file) {
            event.preventDefault();
            assignFile(file);
        }
    });
});

/* Shared admin navigation and table enhancements */
document.addEventListener('DOMContentLoaded', function () {
        const escapeHtml = function (value) {
            return value.replace(/[&<>"']/g, function (char) {
                return {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#039;'
                }[char];
            });
        };

        const iconFor = function (label) {
            const text = label.toLowerCase();
            if (text.includes('ringkasan')) return 'bi-speedometer2';
            if (text.includes('isi beranda')) return 'bi-house-door';
            if (text.includes('kegiatan siswa')) return 'bi-people';
            if (text.includes('info ppdb')) return 'bi-journal-check';
            if (text.includes('foto galeri')) return 'bi-images';
            if (text.includes('dashboard')) return 'bi-speedometer2';
            if (text.includes('beranda')) return 'bi-house-door';
            if (text.includes('akademik')) return 'bi-journal-richtext';
            if (text.includes('prestasi')) return 'bi-trophy';
            if (text.includes('pengumuman')) return 'bi-megaphone';
            if (text.includes('kesiswaan')) return 'bi-mortarboard';
            if (text.includes('ppdb')) return 'bi-clipboard-check';
            if (text.includes('galeri')) return 'bi-images';
            if (text.includes('pengaturan')) return 'bi-gear';
            if (text.includes('upload') || text.includes('unggah')) return 'bi-cloud-arrow-up';
            if (text.includes('atur')) return 'bi-sliders';
            if (text.includes('tambah') || text.includes('buat')) return 'bi-plus-circle';
            return 'bi-circle';
        };

        document.querySelectorAll('.admin-container .header').forEach(function (header) {
            header.remove();
        });

        document.querySelectorAll('.admin-container .admin-sidebar-toggle').forEach(function (toggle) {
            const sidebar = toggle.closest('.sidebar');
            const icon = toggle.querySelector('i');

            if (!sidebar) return;

            toggle.addEventListener('click', function () {
                const isOpen = sidebar.classList.toggle('admin-nav-open');
                toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');

                if (icon) {
                    icon.classList.toggle('bi-list', !isOpen);
                    icon.classList.toggle('bi-x-lg', isOpen);
                }
            });

            sidebar.querySelectorAll('nav a').forEach(function (link) {
                link.addEventListener('click', function () {
                    sidebar.classList.remove('admin-nav-open');
                    toggle.setAttribute('aria-expanded', 'false');

                    if (icon) {
                        icon.classList.add('bi-list');
                        icon.classList.remove('bi-x-lg');
                    }
                });
            });
        });

        document.querySelectorAll('.admin-container .nav-item').forEach(function (item) {
            const href = item.getAttribute('href') || '';
            let label = item.textContent.replace(/\s+/g, ' ').trim();
            if (href.match(/\/admin$/)) label = 'Ringkasan';
            if (href.includes('/admin/beranda')) label = 'Isi Beranda';
            if (href.includes('/admin/prestasi')) label = 'Prestasi';
            if (href.includes('/admin/kesiswaan')) label = 'Kegiatan Siswa';
            if (href.includes('/admin/ppdb')) label = 'Info PPDB';
            if (href.includes('/admin/galeri')) label = 'Foto Galeri';
            if (href.includes('/admin/pengaturan')) label = 'Pengaturan';
            item.innerHTML = '<i class="bi ' + iconFor(label) + ' admin-nav-icon" aria-hidden="true"></i><span>' + escapeHtml(label) + '</span>';
        });

        document.querySelectorAll('.admin-container .sidebar nav').forEach(function (nav) {
            if (!nav.querySelector('a[href*="/admin/beranda"]')) {
                const dashboard = nav.querySelector('a[href$="/admin"], a[href*="/admin"]:not([href*="/admin/"])');
                const link = document.createElement('a');
                link.href = "/admin/beranda";
                link.className = 'nav-item';
                link.innerHTML = '<i class="bi bi-house-door admin-nav-icon" aria-hidden="true"></i><span>Beranda</span>';
                if (dashboard && dashboard.nextSibling) {
                    nav.insertBefore(link, dashboard.nextSibling);
                } else {
                    nav.insertBefore(link, nav.firstChild);
                }
            }
        });

        document.querySelectorAll('.admin-container table').forEach(function (table) {
            const labels = Array.from(table.querySelectorAll('thead th')).map(function (header) {
                return header.textContent.replace(/\s+/g, ' ').trim();
            });

            if (!labels.length) return;

            table.classList.add('responsive-table');
            table.querySelectorAll('tbody tr').forEach(function (row) {
                row.querySelectorAll('td').forEach(function (cell, index) {
                    if (!cell.hasAttribute('data-label')) {
                        cell.setAttribute('data-label', labels[index] || 'Data');
                    }
                });
            });
        });

        document.querySelectorAll('.admin-container .quick-access-grid .card').forEach(function (card) {
            const label = card.textContent.replace(/\s+/g, ' ').trim();
            card.querySelectorAll('div').forEach(function (node) {
                if (!node.textContent.trim() && node.children.length === 0) {
                    node.remove();
                }
            });
            if (!card.querySelector('.admin-quick-icon')) {
                card.insertAdjacentHTML('afterbegin', '<span class="admin-quick-icon" aria-hidden="true"><i class="bi ' + iconFor(label) + '"></i></span>');
            }
        });

        document.querySelectorAll('.admin-container .btn-action').forEach(function (button, index) {
            if (!button.textContent.trim()) {
                button.innerHTML = index % 2 === 0
                    ? '<i class="bi bi-pencil-square" aria-hidden="true"></i><span>Edit</span>'
                    : '<i class="bi bi-archive" aria-hidden="true"></i><span>Arsip</span>';
            }
            button.classList.add('admin-small-action');
            if (!button.getAttribute('type')) {
                button.setAttribute('type', 'button');
            }
        });

        document.querySelectorAll('.admin-container .arrow-btn').forEach(function (button, index) {
            if (!button.textContent.trim()) {
                button.innerHTML = index % 2 === 0
                    ? '<i class="bi bi-chevron-left" aria-hidden="true"></i><span>Prev</span>'
                    : '<i class="bi bi-chevron-right" aria-hidden="true"></i><span>Next</span>';
            }
            button.setAttribute('type', 'button');
        });
    });
