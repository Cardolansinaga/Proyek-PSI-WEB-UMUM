<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;

Route::view('/', 'welcome')->name('home');
Route::view('/profil-sekolah', 'pages.umum.profil')->name('profil');
Route::view('/akademik', 'pages.umum.akademik')->name('akademik');
Route::view('/asrama-kehidupan-sekolah', 'pages.umum.asrama')->name('asrama');
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

// Create prestasi page
Route::get('/admin/prestasi/create', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return view('pages.admin.tambah-prestasi');
})->name('prestasi.create');

// Kesiswaan admin page
Route::get('/admin/kesiswaan', function (Request $request) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return view('pages.admin.kesiswaan');
})->name('kesiswaan.index');

// Edit guru page
Route::get('/admin/guru/{id}/edit', function (Request $request, $id) {
	if (! $request->session()->get('is_admin') && $request->cookie('is_admin') !== '1') {
		return redirect()->route('login');
	}
	return view('pages.admin.edit-guru', ['id' => $id]);
})->name('guru.edit');
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
		return redirect('/admin')->withCookie(Cookie::make('is_admin', '1', 120))->with('status', 'Login successful');
	}

	return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
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
	return back()->with('status', 'If that email exists we sent a reset link.');
})->name('password.email');
