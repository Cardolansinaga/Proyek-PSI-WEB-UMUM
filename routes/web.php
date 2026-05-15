<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;

Route::view('/', 'welcome')->name('home');
Route::redirect('/profil-sekolah', '/#profil')->name('profil');
Route::view('/akademik', 'pages.umum.akademik')->name('akademik');
Route::redirect('/asrama-kehidupan-sekolah', '/kesiswaan-ekstrakurikuler#ekskul')->name('asrama');
Route::view('/kesiswaan-ekstrakurikuler', 'pages.umum.kesiswaan')->name('kesiswaan');
Route::view('/ppdb', 'pages.umum.ppdb')->name('ppdb');
Route::redirect('/berita', '/#berita')->name('berita.index');
Route::redirect('/berita/{slug}', '/#berita')->name('berita.show');
Route::redirect('/galeri', '/#galeri')->name('galeri');
Route::redirect('/prestasi', '/akademik#prestasi')->name('prestasi');
Route::redirect('/kontak', '/#kontak')->name('kontak');
Route::redirect('/alumni-kemitraan', '/')->name('alumni');
Route::redirect('/guru-tenaga-kependidikan', '/')->name('guru');
// Admin dashboard route (serves admin dashboard view) - protected by simple session flag
Route::get('/admin', function (Request $request) {
	// allow either session flag or cookie as fallback
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}

	return view('pages.admin.dashboard');
})->name('dashboard');

Route::get('/admin/beranda', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}

	return view('pages.admin.beranda');
})->name('admin.beranda');

// Admin sub-pages
Route::get('/admin/guru', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('dashboard');
})->name('guru.index');

Route::get('/admin/guru/create', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('dashboard');
})->name('admin.guru.create');

Route::post('/admin/guru', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('dashboard');
})->name('admin.guru.store');

Route::get('/admin/prestasi', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return view('pages.admin.prestasi');
})->name('prestasi.index');

Route::get('/admin/pengumuman', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('admin.beranda');
})->name('pengumuman.index');

// Create pengumuman page
Route::get('/admin/pengumuman/create', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('admin.beranda');
})->name('pengumuman.create');

Route::get('/admin/pengumuman/{id}/edit', function (Request $request, $id) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('admin.beranda');
})->name('pengumuman.edit');

Route::post('/admin/pengumuman', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('admin.beranda')->with('status', 'Konten Beranda berhasil disimpan.');
})->name('admin.pengumuman.store');

// Create prestasi page
Route::get('/admin/prestasi/create', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return view('pages.admin.tambah-prestasi');
})->name('prestasi.create');

Route::get('/admin/prestasi/{id}/edit', function (Request $request, $id) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return view('pages.admin.tambah-prestasi', ['id' => $id, 'mode' => 'edit']);
})->name('prestasi.edit');

Route::post('/admin/prestasi', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('prestasi.index')->with('status', 'Prestasi berhasil disimpan.');
})->name('admin.prestasi.store');

// Kesiswaan admin page
Route::get('/admin/kesiswaan', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return view('pages.admin.kesiswaan');
})->name('admin.kesiswaan.index');

Route::get('/admin/kesiswaan/create', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return view('pages.admin.form-kesiswaan', ['id' => 'baru', 'mode' => 'create']);
})->name('admin.kesiswaan.create');

Route::get('/admin/kesiswaan/{id}/edit', function (Request $request, $id) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return view('pages.admin.form-kesiswaan', ['id' => $id, 'mode' => 'edit']);
})->name('admin.kesiswaan.edit');

Route::post('/admin/kesiswaan', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('admin.kesiswaan.index')->with('status', 'Data kesiswaan berhasil disimpan.');
})->name('admin.kesiswaan.store');

Route::post('/admin/kesiswaan/{id}', function (Request $request, $id) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('admin.kesiswaan.index')->with('status', 'Data kesiswaan berhasil diperbarui.');
})->name('admin.kesiswaan.update');

// Legacy named route alias: keep templates referring to `kesiswaan.index` working
Route::get('/admin/kesiswaan-legacy', function (Request $request) {
    if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
        return redirect()->route('login');
    }
    return redirect()->route('admin.kesiswaan.index');
})->name('kesiswaan.index');

// Legacy aliases for create/edit route names used by older admin templates
Route::get('/admin/kesiswaan/create-legacy', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('admin.kesiswaan.create');
})->name('kesiswaan.create');

Route::get('/admin/kesiswaan/{id}/edit-legacy', function (Request $request, $id) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('admin.kesiswaan.edit', $id);
})->name('kesiswaan.edit');

Route::get('/admin/ppdb', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return view('pages.admin.ppdb');
})->name('admin.ppdb');

Route::get('/admin/ppdb/{id}', function (Request $request, $id) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return view('pages.admin.detail-ppdb', ['id' => $id]);
})->name('admin.ppdb.show');

Route::post('/admin/ppdb/{id}/verify', function (Request $request, $id) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('admin.ppdb')->with('status', 'Status pendaftar PPDB berhasil diperbarui.');
})->name('admin.ppdb.verify');

Route::get('/admin/galeri', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('admin.beranda');
})->name('admin.galeri');

Route::get('/admin/galeri/upload', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('admin.beranda');
})->name('admin.galeri.upload');

Route::get('/admin/galeri/{id}/edit', function (Request $request, $id) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('admin.beranda');
})->name('admin.galeri.edit');

Route::post('/admin/galeri', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('admin.beranda')->with('status', 'Galeri Beranda berhasil disimpan.');
})->name('admin.galeri.store');

Route::post('/admin/galeri/{id}', function (Request $request, $id) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('admin.beranda')->with('status', 'Galeri Beranda berhasil diperbarui.');
})->name('admin.galeri.update');

Route::get('/admin/pengaturan', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return view('pages.admin.pengaturan');
})->name('admin.pengaturan');

Route::post('/admin/pengaturan', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('admin.pengaturan')->with('status', 'Pengaturan berhasil disimpan.');
})->name('admin.pengaturan.update');

// Edit guru page
Route::get('/admin/guru/{id}/edit', function (Request $request, $id) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('dashboard');
})->name('guru.edit');

Route::post('/admin/guru/{id}', function (Request $request, $id) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('dashboard');
})->name('admin.guru.update');
// Login page for admin/portal staff
Route::view('/login', 'auth.login')->name('login');
// Handle login submission (placeholder - simple credential check)
Route::post('/login', function (Request $request) {
	$request->validate([
		'email' => 'required|email',
		'password' => 'required|string',
	]);

	// Simple placeholder auth: replace with Auth::attempt(...) in real app
	if ($request->email === 'admin@sman2balige.sch.id' && $request->password === 'password') {
		$request->session()->put('is_admin', true);
		$request->session()->put('admin_name', 'Admin Utama');
		// also set a cookie fallback so clients without session persistence still work
		return redirect('/admin')->withCookie(Cookie::make('is_admin', '1', 120))->with('status', 'Berhasil masuk ke dashboard admin.');
	}

	return back()->withErrors(['email' => 'Email atau password tidak sesuai.'])->withInput();
});

// Logout route to clear admin session
Route::post('/logout', function (Request $request) {
	$request->session()->forget('is_admin');
	$cookie = Cookie::forget('is_admin');
	return redirect()->route('login')->withCookie($cookie);
})->name('logout');
// Forgot password (show form)
Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
// Handle forgot password submission (placeholder)
Route::post('/forgot-password', function (Request $request) {
	$request->validate(['email' => 'required|email']);
	// In a real app: send reset link. Here we simulate success.
	return back()->with('status', 'Jika email terdaftar, instruksi pemulihan sudah dikirim.');
})->name('password.email');
