<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;

Route::view('/', 'welcome')->name('home');
Route::view('/profil-sekolah', 'pages.umum.profil')->name('profil');
Route::view('/akademik', 'pages.umum.akademik')->name('akademik');
Route::redirect('/asrama-kehidupan-sekolah', '/kesiswaan-ekstrakurikuler#asrama')->name('asrama');
Route::view('/kesiswaan-ekstrakurikuler', 'pages.umum.kesiswaan')->name('kesiswaan');
Route::view('/ppdb', 'pages.umum.ppdb')->name('ppdb');
Route::view('/berita', 'pages.umum.berita')->name('berita.index');
Route::view('/berita/{slug}', 'pages.umum.berita-detail')->name('berita.show');
Route::view('/galeri', 'pages.umum.galeri')->name('galeri');
Route::view('/prestasi', 'pages.umum.prestasi')->name('prestasi');
Route::view('/kontak', 'pages.umum.kontak')->name('kontak');
Route::view('/alumni-kemitraan', 'pages.umum.alumni')->name('alumni');
Route::view('/guru-tenaga-kependidikan', 'pages.umum.guru')->name('guru');
// Admin dashboard route (serves admin dashboard view) - protected by simple session flag
Route::get('/admin', function (Request $request) {
	// allow either session flag or cookie as fallback
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}

	return view('pages.admin.dashboard');
})->name('dashboard');
// Admin sub-pages
Route::get('/admin/guru', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return view('pages.admin.guru');
})->name('guru.index');

Route::get('/admin/guru/create', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return view('pages.admin.form-guru', ['id' => 'baru', 'mode' => 'create']);
})->name('admin.guru.create');

Route::post('/admin/guru', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('guru.index')->with('status', 'Data guru berhasil disimpan.');
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
	return view('pages.admin.pengumuman');
})->name('pengumuman.index');

// Create pengumuman page
Route::get('/admin/pengumuman/create', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return view('pages.admin.tambah-pengumuman');
})->name('pengumuman.create');

Route::get('/admin/pengumuman/{id}/edit', function (Request $request, $id) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return view('pages.admin.tambah-pengumuman', ['id' => $id, 'mode' => 'edit']);
})->name('pengumuman.edit');

Route::post('/admin/pengumuman', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('pengumuman.index')->with('status', 'Pengumuman berhasil disimpan.');
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
})->name('kesiswaan.index');

Route::get('/admin/kesiswaan/create', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return view('pages.admin.form-kesiswaan', ['id' => 'baru', 'mode' => 'create']);
})->name('kesiswaan.create');

Route::get('/admin/kesiswaan/{id}/edit', function (Request $request, $id) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return view('pages.admin.form-kesiswaan', ['id' => $id, 'mode' => 'edit']);
})->name('kesiswaan.edit');

Route::post('/admin/kesiswaan', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('kesiswaan.index')->with('status', 'Data kesiswaan berhasil disimpan.');
})->name('admin.kesiswaan.store');

Route::post('/admin/kesiswaan/{id}', function (Request $request, $id) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('kesiswaan.index')->with('status', 'Data kesiswaan berhasil diperbarui.');
})->name('admin.kesiswaan.update');

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
	return view('pages.admin.galeri');
})->name('admin.galeri');

Route::get('/admin/galeri/upload', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return view('pages.admin.form-galeri', ['id' => 'baru', 'mode' => 'upload']);
})->name('admin.galeri.upload');

Route::get('/admin/galeri/{id}/edit', function (Request $request, $id) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return view('pages.admin.form-galeri', ['id' => $id, 'mode' => 'edit']);
})->name('admin.galeri.edit');

Route::post('/admin/galeri', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('admin.galeri')->with('status', 'Media galeri berhasil disimpan.');
})->name('admin.galeri.store');

Route::post('/admin/galeri/{id}', function (Request $request, $id) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('admin.galeri')->with('status', 'Media galeri berhasil diperbarui.');
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
	return view('pages.admin.form-guru', ['id' => $id, 'mode' => 'edit']);
})->name('guru.edit');

Route::post('/admin/guru/{id}', function (Request $request, $id) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return redirect()->route('guru.index')->with('status', 'Data guru berhasil diperbarui.');
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
