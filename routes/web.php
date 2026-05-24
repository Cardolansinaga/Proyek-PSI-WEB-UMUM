<?php

use App\Http\Controllers\AdminContentController;
use App\Http\Controllers\PublicSiteController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    Route::get('/admin', [AdminContentController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/beranda', [AdminContentController::class, 'beranda'])->name('admin.beranda');
    Route::post('/admin/beranda', [AdminContentController::class, 'updateBeranda'])->name('admin.beranda.update');
    Route::post('/admin/beranda/berita/{post}/gambar', [AdminContentController::class, 'updateBeritaImage'])->name('admin.beranda.post-image.update');

    Route::get('/admin/prestasi', [AdminContentController::class, 'prestasi'])->name('prestasi.index');
    Route::get('/admin/prestasi/create', [AdminContentController::class, 'createPrestasi'])->name('prestasi.create');
    Route::post('/admin/prestasi', [AdminContentController::class, 'storePrestasi'])->name('admin.prestasi.store');
    Route::get('/admin/prestasi/{achievement}/edit', [AdminContentController::class, 'editPrestasi'])->name('prestasi.edit');
    Route::post('/admin/prestasi/{achievement}', [AdminContentController::class, 'updatePrestasi'])->name('admin.prestasi.update');
    Route::delete('/admin/prestasi/{achievement}', [AdminContentController::class, 'destroyPrestasi'])->name('admin.prestasi.destroy');

    Route::get('/admin/pengumuman', fn () => redirect()->route('admin.beranda'))->name('pengumuman.index');
    Route::get('/admin/pengumuman/create', fn () => redirect()->route('admin.beranda'))->name('pengumuman.create');
    Route::get('/admin/pengumuman/{id}/edit', fn () => redirect()->route('admin.beranda'))->name('pengumuman.edit');
    Route::post('/admin/pengumuman', [AdminContentController::class, 'updateBeranda'])->name('admin.pengumuman.store');

    Route::get('/admin/kesiswaan', [AdminContentController::class, 'kesiswaan'])->name('admin.kesiswaan.index');
    Route::get('/admin/kesiswaan/create', [AdminContentController::class, 'createKesiswaan'])->name('admin.kesiswaan.create');
    Route::post('/admin/kesiswaan', [AdminContentController::class, 'storeKesiswaan'])->name('admin.kesiswaan.store');
    Route::get('/admin/kesiswaan/{activity}/edit', [AdminContentController::class, 'editKesiswaan'])->name('admin.kesiswaan.edit');
    Route::post('/admin/kesiswaan/{activity}', [AdminContentController::class, 'updateKesiswaan'])->name('admin.kesiswaan.update');
    Route::get('/admin/kesiswaan-legacy', fn () => redirect()->route('admin.kesiswaan.index'))->name('kesiswaan.index');
    Route::get('/admin/kesiswaan/create-legacy', fn () => redirect()->route('admin.kesiswaan.create'))->name('kesiswaan.create');
    Route::get('/admin/kesiswaan/{activity}/edit-legacy', fn ($activity) => redirect()->route('admin.kesiswaan.edit', $activity))->name('kesiswaan.edit');

    Route::get('/admin/students/{id}/edit', function ($id) {
        $student = App\Models\Student::findOrFail($id);

        return view('pages.admin.edit-student', ['student' => $student]);
    })->name('admin.students.edit');

    Route::get('/admin/api/students', [StudentController::class, 'index'])->name('admin.api.students.index');
    Route::get('/admin/api/students/{id}', [StudentController::class, 'show'])->name('admin.api.students.show');
    Route::post('/admin/api/students', [StudentController::class, 'store'])->name('admin.api.students.store');
    Route::post('/admin/api/students/{id}', [StudentController::class, 'update'])->name('admin.api.students.update');
    Route::delete('/admin/api/students/{id}', [StudentController::class, 'destroy'])->name('admin.api.students.destroy');

    Route::get('/admin/ppdb', [AdminContentController::class, 'ppdb'])->name('admin.ppdb');
    Route::get('/admin/ppdb/{application}', [AdminContentController::class, 'ppdbDetail'])->name('admin.ppdb.show');
    Route::post('/admin/ppdb/{application}/verify', [AdminContentController::class, 'verifyPpdb'])->name('admin.ppdb.verify');

    Route::get('/admin/galeri', [AdminContentController::class, 'galeri'])->name('admin.galeri');
    Route::get('/admin/galeri/upload', [AdminContentController::class, 'galeri'])->name('admin.galeri.upload');
    Route::post('/admin/galeri', [AdminContentController::class, 'storeGaleri'])->name('admin.galeri.store');
    Route::get('/admin/galeri/{gallery}/edit', [AdminContentController::class, 'galeri'])->name('admin.galeri.edit');
    Route::post('/admin/galeri/{gallery}', [AdminContentController::class, 'updateGaleri'])->name('admin.galeri.update');
    Route::delete('/admin/galeri/{gallery}', [AdminContentController::class, 'destroyGaleri'])->name('admin.galeri.destroy');

    Route::get('/admin/pengaturan', [AdminContentController::class, 'pengaturan'])->name('admin.pengaturan');
    Route::post('/admin/pengaturan', [AdminContentController::class, 'updatePengaturan'])->name('admin.pengaturan.update');
});

Route::view('/login', 'auth.login')->name('login');
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {
        $request->session()->regenerate();
        $adminEmail = env('ADMIN_EMAIL', 'admin@sman2balige.sch.id');

        if (strtolower($request->email) === strtolower($adminEmail)) {
            $request->session()->put('is_admin', true);
            $request->session()->put('admin_name', Auth::user()->name ?? 'Admin');

            return redirect('/admin')->with('status', 'Berhasil masuk ke dashboard admin.');
        }

        Auth::logout();

        return back()->withErrors(['email' => 'Akun tidak memiliki akses admin.'])->withInput();
    }

    return back()->withErrors(['email' => 'Email atau password tidak sesuai.'])->withInput();
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');

Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    return back()->with('status', 'Jika email terdaftar, instruksi pemulihan sudah dikirim.');
})->name('password.email');
