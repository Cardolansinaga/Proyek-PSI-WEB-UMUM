import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/public-natural.css',
                'resources/js/app.js',
                'resources/js/admin.js',
                'resources/css/admin.css',
                'resources/css/admin-pages/beranda.css',
                'resources/css/admin-pages/dashboard.css',
                'resources/css/admin-pages/detail-ppdb.css',
                'resources/css/admin-pages/edit-student.css',
                'resources/css/admin-pages/form-kesiswaan.css',
                'resources/css/admin-pages/galeri.css',
                'resources/css/admin-pages/kesiswaan.css',
                'resources/css/admin-pages/pengaturan.css',
                'resources/css/admin-pages/ppdb.css',
                'resources/css/admin-pages/prestasi.css',
                'resources/css/admin-pages/tambah-prestasi.css',
                'resources/css/admin-pages/posts-form.css',
                'resources/css/admin-pages/posts-index.css',
                'resources/css/auth.css',
                'resources/css/auth-login.css',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
