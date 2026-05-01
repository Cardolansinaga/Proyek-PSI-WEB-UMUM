<?php

use Illuminate\Support\Facades\Route;

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
