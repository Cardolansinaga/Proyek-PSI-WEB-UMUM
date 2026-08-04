<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminContentController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\Admin\AchievementController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\PpdbController;
use App\Http\Controllers\PublicSiteController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\StudentController;
use App\Models\Student;
use Illuminate\Support\Facades\Route;

Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');
Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');

Route::get('/', [PublicSiteController::class, 'home'])->name('home');
Route::redirect('/profil-sekolah', '/#profil')->name('profil');
Route::get('/akademik', [PublicSiteController::class, 'akademik'])->name('akademik');
Route::redirect('/asrama-kehidupan-sekolah', '/kesiswaan-ekstrakurikuler#ekskul')->name('asrama');
Route::get('/kesiswaan-ekstrakurikuler', [PublicSiteController::class, 'kesiswaan'])->name('kesiswaan');
Route::get('/ppdb', [PublicSiteController::class, 'ppdb'])->name('ppdb');
Route::get('/berita', [PublicSiteController::class, 'berita'])->name('berita.index');
Route::get('/berita/{slug}', [PublicSiteController::class, 'beritaDetail'])->name('berita.show');
Route::redirect('/galeri', '/#galeri')->name('galeri');
Route::redirect('/prestasi', '/akademik#prestasi')->name('prestasi');
Route::redirect('/kontak', '/#kontak')->name('kontak');

Route::middleware('admin.session')->group(function () {
    Route::get('/admin/password/change', [AdminAuthController::class, 'editPassword'])
        ->name('admin.password.edit');
    Route::put('/admin/password/change', [AdminAuthController::class, 'updatePassword'])
        ->name('admin.password.update');

    Route::get('/admin', DashboardController::class)->name('dashboard');
    Route::get('/admin/beranda', [AdminContentController::class, 'beranda'])->name('admin.beranda');
    Route::post('/admin/beranda', [AdminContentController::class, 'updateBeranda'])->name('admin.beranda.update');
    Route::post('/admin/beranda/berita/{post}/gambar', [AdminContentController::class, 'updateBeritaImage'])->name('admin.beranda.post-image.update');

    Route::get('/admin/berita', [AdminPostController::class, 'index'])->name('admin.posts.index');
    Route::get('/admin/berita/create', [AdminPostController::class, 'create'])->name('admin.posts.create');
    Route::post('/admin/berita', [AdminPostController::class, 'store'])->name('admin.posts.store');
    Route::get('/admin/berita/{post}/edit', [AdminPostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('/admin/berita/{post}', [AdminPostController::class, 'update'])->name('admin.posts.update');
    Route::delete('/admin/berita/{post}', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');
    Route::get('/admin/berita/{post}/preview', [AdminPostController::class, 'preview'])->name('admin.posts.preview');
    Route::patch('/admin/berita/{post}/restore', [AdminPostController::class, 'restore'])->name('admin.posts.restore');
    Route::delete('/admin/berita/{post}/force', [AdminPostController::class, 'forceDelete'])->name('admin.posts.force-delete');

    Route::get('/admin/prestasi', [AchievementController::class, 'index'])->name('prestasi.index');
    Route::get('/admin/prestasi/create', [AchievementController::class, 'create'])->name('prestasi.create');
    Route::post('/admin/prestasi', [AchievementController::class, 'store'])->name('admin.prestasi.store');
    Route::get('/admin/prestasi/{achievement}/edit', [AchievementController::class, 'edit'])->name('prestasi.edit');
    Route::post('/admin/prestasi/{achievement}', [AchievementController::class, 'update'])->name('admin.prestasi.update');
    Route::delete('/admin/prestasi/{achievement}', [AchievementController::class, 'destroy'])->name('admin.prestasi.destroy');

    Route::get('/admin/pengumuman', fn () => redirect()->route('admin.posts.index', ['category' => 'Pengumuman']))->name('pengumuman.index');
    Route::get('/admin/pengumuman/create', fn () => redirect()->route('admin.posts.create'))->name('pengumuman.create');
    Route::get('/admin/pengumuman/{id}/edit', fn ($id) => redirect()->route('admin.posts.edit', $id))->name('pengumuman.edit');
    Route::post('/admin/pengumuman', [AdminPostController::class, 'store'])->name('admin.pengumuman.store');

    Route::get('/admin/kesiswaan', [ActivityController::class, 'index'])->name('admin.kesiswaan.index');
    Route::get('/admin/kesiswaan/create', [ActivityController::class, 'create'])->name('admin.kesiswaan.create');
    Route::post('/admin/kesiswaan', [ActivityController::class, 'store'])->name('admin.kesiswaan.store');
    Route::get('/admin/kesiswaan/{activity}/edit', [ActivityController::class, 'edit'])->name('admin.kesiswaan.edit');
    Route::post('/admin/kesiswaan/{activity}', [ActivityController::class, 'update'])->name('admin.kesiswaan.update');
    Route::get('/admin/kesiswaan-legacy', fn () => redirect()->route('admin.kesiswaan.index'))->name('kesiswaan.index');
    Route::get('/admin/kesiswaan/create-legacy', fn () => redirect()->route('admin.kesiswaan.create'))->name('kesiswaan.create');
    Route::get('/admin/kesiswaan/{activity}/edit-legacy', fn ($activity) => redirect()->route('admin.kesiswaan.edit', $activity))->name('kesiswaan.edit');

    Route::get('/admin/students/{id}/edit', function ($id) {
        $student = Student::findOrFail($id);

        return view('pages.admin.edit-student', ['student' => $student]);
    })->name('admin.students.edit');

    Route::get('/admin/api/students', [StudentController::class, 'index'])->name('admin.api.students.index');
    Route::get('/admin/api/students/{id}', [StudentController::class, 'show'])->name('admin.api.students.show');
    Route::post('/admin/api/students', [StudentController::class, 'store'])->name('admin.api.students.store');
    Route::post('/admin/api/students/{id}', [StudentController::class, 'update'])->name('admin.api.students.update');
    Route::delete('/admin/api/students/{id}', [StudentController::class, 'destroy'])->name('admin.api.students.destroy');

    Route::get('/admin/ppdb', [PpdbController::class, 'index'])->name('admin.ppdb');
    Route::get('/admin/ppdb/{application}', [PpdbController::class, 'show'])->name('admin.ppdb.show');
    Route::post('/admin/ppdb/{application}/verify', [PpdbController::class, 'verify'])->name('admin.ppdb.verify');

    Route::get('/admin/galeri', [GalleryController::class, 'index'])->name('admin.galeri');
    Route::get('/admin/galeri/upload', [GalleryController::class, 'index'])->name('admin.galeri.upload');
    Route::post('/admin/galeri', [GalleryController::class, 'store'])->name('admin.galeri.store');
    Route::get('/admin/galeri/{gallery}/edit', [GalleryController::class, 'index'])->name('admin.galeri.edit');
    Route::post('/admin/galeri/{gallery}', [GalleryController::class, 'update'])->name('admin.galeri.update');
    Route::delete('/admin/galeri/{gallery}', [GalleryController::class, 'destroy'])->name('admin.galeri.destroy');

    Route::get('/admin/pengaturan', [AdminContentController::class, 'pengaturan'])->name('admin.pengaturan');
    Route::post('/admin/pengaturan', [AdminContentController::class, 'updatePengaturan'])->name('admin.pengaturan.update');
});

Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AdminAuthController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('login.store');
Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [AdminAuthController::class, 'forgotPassword'])
    ->name('password.request');
Route::post('/forgot-password', [AdminAuthController::class, 'sendPasswordResetLink'])
    ->middleware('throttle:3,1')
    ->name('password.email');
Route::get('/reset-password/{token}', [AdminAuthController::class, 'resetPassword'])
    ->name('password.reset');
Route::post('/reset-password', [AdminAuthController::class, 'updateResetPassword'])
    ->middleware('throttle:5,1')
    ->name('password.update');
